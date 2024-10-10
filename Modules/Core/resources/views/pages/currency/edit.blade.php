@extends('core::layouts.master')

@section('content')

@include('core::pages.settings._nav')

<form action="" id="default_currency_form">
    <x-core::card>
        <x-slot name="header">
           Add Currency
        </x-slot>
    
        <div class="row row-cols-lg-2 row-cols-1">
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
            <button class="btn btn-primary float-end">Update</button>
        </x-slot>
    </x-core::card>
</form>
@endsection