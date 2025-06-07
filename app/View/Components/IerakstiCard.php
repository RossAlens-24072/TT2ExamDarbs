<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IerakstiCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $ieraksti;
    
    public function __construct($ieraksti)
    {
        $this->ieraksti = $ieraksti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ieraksti-card');
    }
}
