@extends('core::layouts.master')

@section('content')
@include('core::pages.settings._nav')

    <form action="{{route('admin.email.update')}}"  method="POST">
        @csrf
        @method('POST')
        <x-core::card>
            <x-slot name="header">
               Email Settings
            </x-slot>
            @php
                $mail = \Modules\Core\Models\SiteSetting::all()->pluck('value', 'key')->toArray(); 
            @endphp
            <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_from_name" :value="'Sender Name'" />
                        <x-core::form.input type="text" id="mail_from_name" name="mail_from_name" value="{{ old('mail_from_name', $mail['mail_from_name']) }}" />
                        <x-core::form.input-error field="mail_from_name" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_from_address" :value="'Sender Email'" />
                        <x-core::form.input type="email" id="mail_from_address" name="mail_from_address" value="{{ old('mail_from_address', $mail['mail_from_address']) }}" />
                        <x-core::form.input-error field="mail_from_address" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_driver" :value="'Mail Driver'" />
                        <select name="mail_driver" class="form-select conca-select2">
                            <option value="smtp" @if ($mail['mail_driver'] == 'smtp') selected @endif>SMTP</option>
                        </select>
                        <x-core::form.input-error field="mail_driver" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_host" :value="'Mail Host'" />
                        <x-core::form.input type="text" id="mail_host" name="mail_host" value="{{ old('mail_host', $mail['mail_host']) }}" />
                        <x-core::form.input-error field="mail_host" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_port" :value="'Mail Port'" />
                        <x-core::form.input type="text" id="mail_port" name="mail_port" value="{{ old('mail_port', $mail['mail_port']) }}" />
                        <x-core::form.input-error field="mail_port" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_username" :value="'SMTP Username'" />
                        <x-core::form.input type="text" id="mail_username" name="mail_username" value="{{ old('mail_username', $mail['mail_username']) }}" />
                        <x-core::form.input-error field="mail_username" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_password" :value="'SMTP Password'" />
                        <x-core::form.input type="password" id="mail_password" name="mail_password" value="{{ old('mail_password', $mail['mail_password']) }}" />
                        <x-core::form.input-error field="mail_password" />
                    </div>
                </div>
                
                <div class="col">
                    <div class="mb-5">
                        <x-core::form.input-label for="mail_encryption" :value="'Mail Encryption'" />
                        <select id="mail_encryption" name="mail_encryption" class="form-select conca-select2">
                            <option value="ssl" @if ($mail['mail_encryption'] == 'ssl') selected @endif>SSL</option>
                            <option value="tls" @if ($mail['mail_encryption'] == 'tls') selected @endif>TLS</option>
                        </select>
                        <x-core::form.input-error field="mail_encryption" />
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <button type="submit" class="btn btn-success">Save</button>
        
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendTestMail">Send Test Mail</button>
                </div>
            </x-slot>
        </x-core::card>
    </form>

    <div class="modal fade" id="sendTestMail" tabindex="-1" aria-labelledby="sendTestMailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.email.testMail')}}"  method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">Send Test Mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <x-core::form.input-label for="recipient_email" :value="'Recipient'" />
                            <x-core::form.input type="email" id="recipient_email" name="recipient_email" value="{{ old('recipient_email') }}" />
                            <x-core::form.input-error field="recipient_email" />
                        </div>                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-core::card>
        <x-slot name="header_2">
            <div class="d-flex align-items-center">
                <h6 class="mb-0 text-capitalize d-flex gap-1 fw-bold">Set Email Templates</h6>
                <a href="#" class="ms-auto btn btn-primary">All Template</a>
            </div>
        </x-slot>
        @php
            $templates = \Modules\Core\Models\MailTemplate::templateSubject();
        @endphp

        @if (count($templates) == 0)
            <div class="alert alert-warning" role="alert">
                No email templates found.
            </div>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Template</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($templates as $key => $template)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $template }}</td>
                        <td>
                            <select class="form-select conca-select2" id="{{$key}}" name="{{$key}}" required>
                                <option value="development">Template 1</option>
                                <option value="production">Template 2</option>
                            </select>
                        </td>
                        <td>
                            <a href="#" class="btn btn-success">Save</a>
                        </td>
                    </tr>
                    
                @empty
                    
                @endforelse
            </tbody>
        </table>
        @endif
    </x-core::card>
@endsection