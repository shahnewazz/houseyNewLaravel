<?php

namespace Modules\Core\View\Components\Widget;

use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $class = '',
        public string $src = '',
        public string $title = '',
        public string $widget = '',
        public string $code = '',
    )
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.widget/card');
    }
}
