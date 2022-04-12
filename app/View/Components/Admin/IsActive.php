<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class IsActive extends Component
{
    public $id, $is_active, $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $is_active, $model)
    {
        $this->id = $id;
        $this->is_active = $is_active;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.is-active');
    }
}