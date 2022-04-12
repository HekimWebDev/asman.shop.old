<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Status extends Component
{
    public $id, $status, $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $status, $model)
    {
        $this->id = $id;
        $this->status = $status;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.status');
    }
}
