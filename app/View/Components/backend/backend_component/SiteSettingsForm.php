<?php

namespace App\View\Components\backend\backend_component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SiteSettingsForm extends Component
{
    public $sitesetting;  
   
    /**
     * Create a new component instance.
     */
    public function __construct($sitesetting = null)
    {
        $this->sitesetting = $sitesetting;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.backend_component.site-settings-form');
    }
}
