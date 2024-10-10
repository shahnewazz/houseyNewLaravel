@extends('core::layouts.master')

@section('content')

@include('core::pages.settings._nav')

<form action="" id="default_currency_form">
    <x-core::card>
        <x-slot name="header">
            Default Currency
        </x-slot>
    
        <div class="row row-cols-1">
            <div class="col">
                <div class="mb-5">
                    <label class="form-label" for="currency_default">
                        Choose Currency
                    </label>
                    <select name="currency_default" id="currency_default" class="form-select conca-select2">
                        <option value="usd">USD</option>
                        <option value="eur">EUR</option>
                        <option value="gbp">GBP</option>
                    </select>
                    <x-core::form.input-error field="currency_default" />
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button class="btn btn-primary float-end">Update</button>
        </x-slot>
    </x-core::card>
</form>

<form action="" id="default_currency_form">
    <x-core::card>
        <x-slot name="header">
           Add Currency
        </x-slot>
    
        <div class="row row-cols-lg-4 row-cols-1">
            <div class="col">
                <div class="mb-5">
                    <label class="form-label" for="currency_default">
                        Currency Name
                    </label>
                    <x-core::form.input type="text" id="currency_default" name="name" value="{{ old('currency_default') }}" />
                    <x-core::form.input-error field="currency_default" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <label class="form-label" for="currency_symbol">
                        Currency Symbol
                        <span class="text-dark opacity-50">(e.g $)</span>
                    </label>
                    <x-core::form.input type="text" id="currency_symbol" name="symbol" value="{{ old('currency_symbol') }}" />
                    <x-core::form.input-error field="currency_symbol" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <label class="form-label" for="currency_code">
                        Currency Code
                        <span class="text-dark opacity-50">(e.g USD)</span>
                    </label>
                    <x-core::form.input type="text" id="currency_code" name="code" value="{{ old('currency_code') }}" />
                    <x-core::form.input-error field="currency_code" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <label class="form-label" for="currency_exchange_rate">
                        Exchange Rate
                        <span class="text-dark opacity-50">(e.g 110)</span>
                    </label>
                    <x-core::form.input type="number" id="currency_exchange_rate" name="exchange_rate" value="{{ old('currency_exchange_rate') }}" />
                    <x-core::form.input-error field="currency_exchange_rate" />
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button class="btn btn-primary float-end">Add</button>
        </x-slot>
    </x-core::card>
</form>


<x-core::card>
    <x-slot name="header">
        Currency List
    </x-slot>
    
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Code</th>
                    <th>Exchange Rate (1 USD = ?)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="currency_table_list">
                @include('core::pages.currency._currency-list')
            </tbody>
        </table>
    </div>

</x-core::card>

@endsection

@push('scripts')
<script>
    'use strict';

    $(document).on('click', '.currency-del-btn', function(e){
        e.preventDefault();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        })

    })
</script>
    
@endpush
