<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Widget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $id, public $title, public string $widget_name, public array $data = [])
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.widget/widget');
    }
}
