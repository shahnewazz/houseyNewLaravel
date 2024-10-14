<!-- Business information -->
<form action="{{route('admin.general.business.update')}}" method="POST">
    @csrf
    @method('PUT')
    <x-core::card>
        <x-slot name="header">
            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 8H14M7.5 7V9M10.5 4C10.5 3.20435 10.1839 2.44129 9.62132 1.87868C9.05871 1.31607 8.29565 1 7.5 1C6.70435 1 5.94129 1.31607 5.37868 1.87868C4.81607 2.44129 4.5 3.20435 4.5 4M2 4H13C13.5523 4 14 4.44772 14 5V12C14 12.5523 13.5523 13 13 13H2C1.44772 13 1 12.5523 1 12V5C1 4.44772 1.44772 4 2 4Z" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Business information
        </x-slot>

        <div class="row row row-cols-lg-3 row-cols-1 row-cols-sm-2 g-3">
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="default_currency" :value="'Currency'" />
                    <select name="default_currency" class="form-select conca-select2" required>
                        <option value="USD" {{ $settings['default_currency'] == 'usd' ? 'selected' : '' }}>USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="INR">INR</option>
                        <option value="AUD">AUD</option>
                        <option value="CAD">CAD</option>
                    </select>
                    <x-core::form.input-error field="default_currency" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="default_currency_position" :value="'Currency Position'" />
                    <div class="form-control form-group d-flex gap-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="default_currency_position" id="currency_left" value="left" @if ($settings['default_currency_position'] == 'left') checked @endif required>
                            <label class="form-check-label" for="currency_left">($) Left Side</label>
                        </div>                          
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="default_currency_position" id="currency_right" value="right" @if ($settings['default_currency_position'] == 'right') checked @endif required>
                            <label class="form-check-label" for="currency_right">Right Side ($)</label>
                        </div>                          
                    </div>
                    <x-core::form.input-error field="default_currency_position" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="digit_after_decimal" :value="'Digits After Decimal ( Ex:0.00) '" />
                    <x-core::form.input type="number" id="digit_after_decimal" name="digit_after_decimal" value="{{ old('digit_after_decimal', $settings['digit_after_decimal']) }}" required />
                    <x-core::form.input-error field="digit_after_decimal" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="pagination_limit" :value="'Pagination'" />
                    <x-core::form.input type="number" id="pagination_limit" name="pagination_limit" value="{{ old('pagination_limit', $settings['pagination_limit']) }}" required/>
                    <x-core::form.input-error field="pagination_limit" />
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </x-slot>
    </x-core::card>
</form>