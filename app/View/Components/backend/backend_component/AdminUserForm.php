<?php

namespace App\View\Components\backend\backend_component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminUserForm extends Component
{
    public $user; 
    public $roles;  
    public $isEdit;
    /**
     * Create a new component instance.
     */
    public function __construct($user = null, $roles = null, $isEdit = false)
    {
        $this->user = $user;
        $this->roles = $roles;
        $this->isEdit = $isEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.backend_component.admin-user-form');
    }
}
