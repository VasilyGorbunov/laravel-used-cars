<?php

namespace App\Livewire;

use App\Models\Car;
use Faker\Provider\Text;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CarList extends Component implements HasTable, HasForms
{
    use InteractsWithForms, InteractsWithTable;

    public Collection $cars;

    public function mount()
    {
        $this->cars = Car::all();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Car::query())
            ->contentGrid([
                'md' => 4,
                'xl' => 6,
            ])
            ->recordClasses(['!ring-0 !shadow-none'])
            ->columns([
                View::make('cars.table.row-content')
            ])
            ->filters([
                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship(name: 'brand', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['value'], function (Builder $query, $value) {
                            $query->whereIn('id', Car::search($value)->keys());
                        });
                    }),
                Filter::make('model')
                    ->form([
                        TextInput::make('model')
                            ->label('Car model'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['model'], function (Builder $query, $model) {
                            $query->whereIn('id', Car::search($model)->keys());
                        });
                    }),
                Filter::make('year')
                    ->form([
                        TextInput::make('yearFrom')
                            ->label('From Year'),
                        TextInput::make('yearTo')
                            ->label('To Year'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['yearFrom'], function (Builder $query, $yearFrom) {
                                $query->where('year', '>=', $yearFrom);
                            })
                            ->when($data['yearTo'], function (Builder $query, $yearTo) {
                                $query->where('year', '<=', $yearTo);
                            });
                    }),
            ], layout: FiltersLayout::AboveContentCollapsible);
    }

    public function render()
    {
        return view('livewire.car-list');
    }
}
