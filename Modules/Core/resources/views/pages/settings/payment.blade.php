@extends('core::layouts.master')

@section('content')
@include('core::pages.settings._nav')

<form action="">
    <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1">
        <div class="col">
            <form action="">
                <x-core::card>
                    <x-slot name="header_2">
                        <div class="card-header bg-white p-4 d-flex align-items-center">
                            <h5 class="mb-0 text-capitalize d-flex gap-1 fw-bold">Stripe</h5>
                            <div class="form-check form-switch form-check-reverse ms-auto">
                                <input class="form-check-input" type="checkbox" role="switch" id="stripe_status" name="stripe_status" checked>
                                <label class="form-check-label" for="stripe_status">Status</label>
                            </div>                      
                        </div>
                        
                    </x-slot>
    
                    <div class="mb-4">
                        <x-core::form.input-label for="stripe_name" :value="'Title'" required="true" />
                        <x-core::form.input type="text" id="stripe_name" name="stripe_name" value="{{ old('stripe_name') }}" required />
                        <x-core::form.input-error field="stripe_name" />
                    </div>
    
                    <div class="mb-4">
                        <x-core::form.input-label for="stripe_key" :value="'Stripe Key'" required="true" />
                        <x-core::form.input type="text" id="stripe_key" name="stripe_key" value="{{ old('stripe_key') }}" required />
                        <x-core::form.input-error field="stripe_key" />
                    </div>
                    <div class="mb-4">
                        <x-core::form.input-label for="stripe_secret_key" :value="'Stripe Secret Key'" required="true" />
                        <x-core::form.input type="text" id="stripe_secret_key" name="stripe_secret_key" value="{{ old('stripe_secret_key') }}" required />
                        <x-core::form.input-error field="stripe_secret_key" />
                    </div>
                    <div class="mb-4">
                        <x-core::form.input-label for="stripe_secret_mode" :value="'Mode'" required="true" />
                        <select name="stripe_secret_mode" id="stripe_secret_mode" class="form-select conca-select2" required>
                            <option value="live">Live</option>
                            <option value="test">Test</option>
                        </select>
                        <x-core::form.input-error field="stripe_secret_mode" />
                    </div>
            
                        @php
                            $logo_stripe = asset('demo/payment/stripe.png');
                        @endphp    
                        
                        <div class="mb-3">
                            <x-core::form.input-label class="d-block" :value="'Stripe Logo'" />
                            
                            <div class="mb-2 image-upload-container payment-gateway-logo">
                                <img src="{{$logo_stripe}}" class="img-thumbnail stripe-logo image-preview p-2" alt="stripe-logo" data-default="{{$logo_stripe}}">
                            </div>
                            
                            <label for="stripe_logo" class="btn btn-sm btn-label-primary me-3">
                                <span>Upload Logo</span>                    
                                <x-core::form.input type="file" id="stripe_logo" name="stripe_logo" class="image-input" data-target=".stripe-logo" data-reset=".stripe-logo-reset" hidden />
                            </label>
                            <button type="button" class="btn btn-sm btn-label-secondary stripe-logo-reset image-reset d-none" data-target=".stripe-logo">Reset</button>
    
            
                            <x-core::form.input-error field="stripe_logo" />
                        </div>
            
                    
                    
                    <x-slot name="footer">
                        <button class="btn btn-primary">Save</button>
                    </x-slot>
                </x-core::card>
            </form>
        </div>
        <div class="col">
            <form action="">
                <x-core::card>
                    <x-slot name="header_2">
                        <div class="card-header bg-white p-4 d-flex align-items-center">
                            <h5 class="mb-0 text-capitalize d-flex gap-1 fw-bold">Paypal</h5>
                            <div class="form-check form-switch form-check-reverse ms-auto">
                                <input class="form-check-input" type="checkbox" role="switch" id="paypal_status" name="paypal_status" checked>
                                <label class="form-check-label" for="paypal_status">Status</label>
                            </div>                      
                        </div>
                        
                    </x-slot>
    
                    <div class="mb-4">
                        <x-core::form.input-label for="paypal_name" :value="'Title'" required="true" />
                        <x-core::form.input type="text" id="paypal_name" name="paypal_name" value="{{ old('paypal_name') }}" required />
                        <x-core::form.input-error field="paypal_name" />
                    </div>
    
                    <div class="mb-4">
                        <x-core::form.input-label for="paypal_key" :value="'Client ID'" required="true" />
                        <x-core::form.input type="text" id="paypal_key" name="paypal_key" value="{{ old('paypal_key') }}" required />
                        <x-core::form.input-error field="paypal_key" />
                    </div>
                    <div class="mb-4">
                        <x-core::form.input-label for="paypal_secret_key" :value="'Secret Key'" required="true" />
                        <x-core::form.input type="text" id="paypal_secret_key" name="paypal_secret_key" value="{{ old('paypal_secret_key') }}" required />
                        <x-core::form.input-error field="paypal_secret_key" />
                    </div>
                    <div class="mb-4">
                        <x-core::form.input-label for="paypal_mode" :value="'Mode'" required="true" />
                        <select name="paypal_mode" id="paypal_mode" class="form-select conca-select2" required>
                            <option value="live">Live</option>
                            <option value="test">Test</option>
                        </select>
                        <x-core::form.input-error field="paypal_mode" />
                    </div>
            
                        @php
                            $logo_paypal = asset('demo/payment/paypal.png');
                        @endphp    
                        
                        <div class="mb-3">
                            <x-core::form.input-label class="d-block" :value="'Paypal Logo'" />
                            
                            <div class="mb-2 image-upload-container payment-gateway-logo">
                                <img src="{{$logo_paypal}}" class="img-thumbnail paypal-logo image-preview p-2" alt="paypal-logo" data-default="{{$logo_paypal}}">
                            </div>
                            
                            <label for="paypal_logo" class="btn btn-sm btn-label-primary me-3">
                                <span>Upload Logo</span>                    
                                <x-core::form.input type="file" id="paypal_logo" name="paypal_logo" class="image-input" data-target=".paypal-logo" data-reset=".paypal-logo-reset" hidden />
                            </label>
                            <button type="button" class="btn btn-sm btn-label-secondary paypal-logo-reset image-reset d-none" data-target=".paypal-logo">Reset</button>
    
            
                            <x-core::form.input-error field="paypal_logo" />
                        </div>
            
                    
                    
                    <x-slot name="footer">
                        <button class="btn btn-primary">Save</button>
                    </x-slot>
                </x-core::card>
            </form>
        </div>
    </div>
    

</form>
@endsection