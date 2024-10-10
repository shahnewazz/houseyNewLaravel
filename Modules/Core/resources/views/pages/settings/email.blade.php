@extends('core::layouts.master')

@section('content')
@include('core::pages.settings._nav')

    <x-core::card>
        <x-slot name="header">
           Email Settings
        </x-slot>
    
        <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1">
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_sender_name" :value="'Sender Name'" />
                    <x-core::form.input type="text" id="email_sender_name" name="email_sender_name" value="{{ old('email_sender_name') }}" />
                    <x-core::form.input-error field="email_sender_name" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_sender_email" :value="'Sender Email'" />
                    <x-core::form.input type="email" id="email_sender_email" name="email_sender_email" value="{{ old('email_sender_email') }}" />
                    <x-core::form.input-error field="email_sender_email" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_recipient_email" :value="'Recipient'" />
                    <x-core::form.input type="email" id="email_recipient_email" name="email_recipient_email" value="{{ old('email_recipient_email') }}" />
                    <x-core::form.input-error field="email_recipient_email" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_host" :value="'Mail Host'" />
                    <x-core::form.input type="email" id="email_host" name="email_host" value="{{ old('email_host') }}" />
                    <x-core::form.input-error field="email_host" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_smtp_username" :value="'SMTP Username'" />
                    <x-core::form.input type="email" id="email_smtp_username" name="email_smtp_username" value="{{ old('email_smtp_username') }}" />
                    <x-core::form.input-error field="email_smtp_username" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_smtp_password" :value="'SMTP Password'" />
                    <x-core::form.input type="email" id="email_smtp_password" name="email_smtp_password" value="{{ old('email_smtp_password') }}" />
                    <x-core::form.input-error field="email_smtp_password" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_port" :value="'Mail Port'" />
                    <x-core::form.input type="email" id="email_port" name="email_port" value="{{ old('email_port') }}" />
                    <x-core::form.input-error field="email_port" />
                </div>
            </div>
            <div class="col">
                <div class="mb-5">
                    <x-core::form.input-label for="email_encryption" :value="'Mail Encryption'" />
                    <select name="email_encryption" class="form-select conca-select2">
                        <option value="ssl">SSL</option>
                        <option value="tls">TLS</option>
                    </select>
                    <x-core::form.input-error field="email_encryption" />
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button class="btn btn-success">Save</button>

            <form action="{{route('admin.email.testMail')}}" method="POST">
                @csrf
                @method('POST')
                <button class="btn btn-primary">Send Test Mail</button>
            </form>
        </x-slot>
    </x-core::card>
@endsection