<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navbar extends Component
{
    public $name;
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
