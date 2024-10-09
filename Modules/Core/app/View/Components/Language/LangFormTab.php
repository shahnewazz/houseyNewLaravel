<?php

namespace Modules\Core\View\Components\Language;

use Illuminate\View\Component;
use Illuminate\View\View;

class LangFormTab extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.language/langformtab');
    }
}
