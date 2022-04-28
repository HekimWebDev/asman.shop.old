<?php

namespace App\View\Components\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('admin.components.status');
    }
}
