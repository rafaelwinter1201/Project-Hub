<?php

namespace App\Livewire;

use Livewire\Component;

class DataRange extends Component
{
    public $startDate;
    public $endDate;
    public $endDateDisabled = true;

    public function updatedStartDate($value) // Corrigido para "updatedStartDate"
    {
        // Habilitar o enddate quando o startdate for preenchido
        if ($value) {
            $this->endDateDisabled = false;
        } else {
            // Desabilitar o enddate se o startdate estiver vazio
            $this->endDate = null;
            $this->endDateDisabled = true;
        }

        $this->emit('startDateUpdated', $value);
    }

    public function render()
    {
        return view('livewire.data-range');
    }
}

