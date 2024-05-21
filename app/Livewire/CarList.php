<?php

namespace App\Livewire;

use App\Models\Car;
use Faker\Provider\Text;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
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
                'md' => 2,
                'xl' => 3,
            ])
            ->recordClasses(['!ring-0 !shadow-none'])
            ->columns([
//                Stack::make([
//                    TextColumn::make('brand.name'),
//                    TextColumn::make('model'),
//                    TextColumn::make('year'),
//                    TextColumn::make('images'),
//                ]),
                View::make('cars.table.row-content')
            ]);
    }

    public function render()
    {
        return view('livewire.car-list');
    }
}
