<?php

namespace Modules\Core\View\Components\Form;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

class DateFormatSelect extends Component
{
    public $formats;
    public $selected;

    use HasAttributes;

    public function __construct(array $formats = null, string $selected = '')
    {
        $this->formats = $formats ?? $this->defaultFormats();
        $this->selected = $selected;
    }

    public function defaultFormats()
    {
        $today = Carbon::now();
        return [
            'Y-m-d' => 'YYYY-MM-DD (e.g., ' . $today->format('Y-m-d') . ')',
            'd/m/Y' => 'DD/MM/YYYY (e.g., ' . $today->format('d/m/Y') . ')',
            'm-d-Y' => 'MM-DD-YYYY (e.g., ' . $today->format('m-d-Y') . ')',
            'M d, Y' => 'Month Day, Year (e.g., ' . $today->format('M d, Y') . ')',
            'D, M d Y' => 'Day, Month Day Year (e.g., ' . $today->format('D, M d Y') . ')',
            'F j, Y' => 'Full Month Name, Day, Year (e.g., ' . $today->format('F j, Y') . ')',
            'Y/m/d' => 'YYYY/MM/DD (e.g., ' . $today->format('Y/m/d') . ')',
            'd M, Y' => 'Day Month, Year (e.g., ' . $today->format('d M, Y') . ')',
            'l, F j, Y' => 'Weekday, Full Month Day, Year (e.g., ' . $today->format('l, F j, Y') . ')',
            'jS F Y' => 'Day Ordinal Full Month Year (e.g., ' . $today->format('jS F Y') . ')',
            'd.m.Y' => 'DD.MM.YYYY (e.g., ' . $today->format('d.m.Y') . ')',
            'Ymd' => 'YYYYMMDD (e.g., ' . $today->format('Ymd') . ')',
        ];
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.form.date-format-select', [
            'formats' => $this->formats,
            'selected' => $this->selected,
        ]);
    }
}
