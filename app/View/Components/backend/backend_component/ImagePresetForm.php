<?php

namespace App\View\Components\backend\backend_component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImagePresetForm extends Component
{
    public $imagepreset;   
    public $isEdit;
    /**
     * Create a new component instance.
     */
    public function __construct($imagepreset = null, $isEdit = false)
    {
       
        $this->imagepreset = $imagepreset;      
        $this->isEdit = $isEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.backend_component.image-preset-form');
    }
}
