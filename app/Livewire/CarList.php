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

class CarList extends Component
{
    public Collection $cars;
    public $brand;
    public $model;

    public function mount()
    {
        $this->cars = Car::all();
        $this->brand = '';
        $this->model = '';
    }

    public function render()
    {
        $this->cars = Car::query()
            ->when($this->brand, fn(Builder $query, $brand) => $query->whereIn('id', Car::search($brand)->keys()))
            ->when($this->model, fn(Builder $query, $model) => $query->whereIn('id', Car::search($model)->keys()))
            ->get();

        return view('livewire.car-list');
    }
}
