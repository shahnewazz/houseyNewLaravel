<?php

namespace Modules\Core\View\Components\Widget;

use Illuminate\View\Component;
use Illuminate\View\View;

class Repeater extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title = '', public array $data = [])
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.widget/repeater');
    }
}
