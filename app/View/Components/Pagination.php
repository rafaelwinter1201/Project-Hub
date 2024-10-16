<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $actualpage;
    public $totalpage;
    public $messageerror;

    public function __construct($actualpage, $totalpage)
    {
        $this->actualpage = $actualpage;
        $this->totalpage = $totalpage;
        if($actualpage > $totalpage || $actualpage < 1){
            $this->totalpage = $totalpage;
            $this->messageerror = true;
        }
    }

    public function render()
    {
        return view('components.pagination');
    }
}

