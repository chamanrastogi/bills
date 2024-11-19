<?php

namespace App\View\Components\backend\backend_component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductForm extends Component
{
    public $product;
    public $categories;  
    public $isEdit;
    /**
     * Create a new component instance.
     */
    public function __construct($product = null,$categories = [], $isEdit = false)
    {
        $this->product = $product;        
        $this->categories = $categories;
        $this->isEdit = $isEdit;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.backend_component.product-form');
    }
}
