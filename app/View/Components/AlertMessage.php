<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertMessage extends Component
{
    
    public $type;
    public $message;
    
    // Constructor para pasar los parámetros
    public function __construct($type = null, $message = null)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-message');
    }
}
