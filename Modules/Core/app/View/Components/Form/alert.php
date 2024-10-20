<?php

namespace Modules\Core\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class alert extends Component
{
    public $type;  // 'success', 'danger', etc.
    public $style; // 'fill' or 'outline'
    public $message; // The alert message

    public function __construct($type = 'primary', $style = 'fill', $message = '')
    {
        $this->type = $type;
        $this->style = $style;
        $this->message = $message;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.form/alert');
    }
}
