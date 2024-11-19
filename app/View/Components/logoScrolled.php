<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class logoScrolled extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $path, public string $name)
    {
        $this->path;
        $this->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.logo-scrolled');
    }
}
