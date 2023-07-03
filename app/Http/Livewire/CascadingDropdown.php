<?php

namespace App\Http\Livewire;

use App\Models\Continent;
use App\Models\Country;
use Livewire\Component;

class CascadingDropdown extends Component
{

    public $continents = [];

    public $countries = [];

    public $selectedContinentId;

    public $selectedCountryId;

    public function mount(): void
    {
        $this->continents = Continent::all();
    }

    public function changeContinent()
    {
        if ($this->selectedContinentId != '-1') {
            $this->countries = Country::where('continent_id', $this->selectedContinentId)->get();
        } else {
            $this->countries = [];
        }
    }

    public function render()
    {
        return view('livewire.cascading-dropdown');
    }
}
