<?php

namespace App\View\Components\backend\backend_component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryForm extends Component
{
    public $category;   
    public $isEdit;
    /**
     * Create a new component instance.
     */
    public function __construct($category = null, $isEdit = false)
    {
        $this->category = $category;      
        $this->isEdit = $isEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.backend_component.category-form');
    }
}
