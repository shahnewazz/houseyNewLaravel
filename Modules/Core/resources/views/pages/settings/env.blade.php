@extends('core::layouts.master')

@section('content')
@include('core::pages.settings._nav')

    <form action="{{route('admin.env.update')}}" method="POST">
        @csrf
        @method('POST')
        <x-core::card>
            <x-slot name="header">
               Environments Settings
            </x-slot>
        
            @php
                $env = \Modules\Core\Models\SiteSetting::all()->pluck('value', 'key')->toArray(); 
            @endphp
            <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <div class="col">
                    <div class="mb-3">
                        <x-core::form.input-label for="app_name" :value="'App Name'" />
                        <x-core::form.input type="text" id="app_name" name="app_name" value="{{ old('app_name', $env['app_name']) }}" required />
                        <x-core::form.input-error field="app_name" />
                    </div>                  
                </div>
                <div class="col">
                    <div class="mb-3">
                        <x-core::form.input-label for="app_env" :value="'App Mode'" />
                        <select class="form-select conca-select2" id="app_env" name="app_env" required>
                            <option value="development" @if ($env['app_env'] == 'development') selected @endif>Development</option>
                            <option value="production" @if ($env['app_env'] == 'production') selected @endif>Production</option>
                        </select>
                        <x-core::form.input-error field="app_env" />
                    </div>                  
                </div>
                <div class="col">
                    <div class="mb-3">
                        <x-core::form.input-label for="app_debug" :value="'App Debug'" />
                        <select class="form-select conca-select2" id="app_debug" name="app_debug" required>
                            <option value="true" @if ($env['app_debug'] == 'true') selected @endif>True</option>
                            <option value="false" @if ($env['app_debug'] == 'false') selected @endif>False</option>
                        </select>
                        <x-core::form.input-error field="app_debug" />
                    </div>                  
                </div>
                <div class="col">
                    <div class="mb-3">
                        <x-core::form.input-label for="app_url" :value="'App URL'" />
                        <x-core::form.input type="url" id="app_url" name="app_url" value="{{ old('app_url', $env['app_url']) }}" required/>
                        <x-core::form.input-error field="app_url" />
                    </div>                  
                </div>
            </div>
            <x-slot name="footer">
                <button class="btn btn-primary">Save</button>
            </x-slot>
        </x-core::card>
    </form>
@endsection