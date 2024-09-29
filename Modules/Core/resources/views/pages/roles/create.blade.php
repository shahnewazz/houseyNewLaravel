

@extends('core::layouts.master')

@section('content')



<div class="card shadow rounded-md">
    <div class="card-body">
        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-normal mb-0 text-body">Create Role</h6>
                        </div>
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <x-core::form.input-label for="roleName" :value="__('Role Name')" />
                                <x-core::form.input type="text" id="roleName" name="name" value="{{ old('name') }}" required/>
                                <x-core::form.input-error field="name" />
                            </div>
                          
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap fw-medium text-heading">Administrator Access <i class="icon_info_alt ms-2" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Allows a full access to the system" data-bs-original-title="Allows a full access to the system"></i></td>
                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                        <label class="form-check-label" for="selectAll">
                                                        Select All
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @php
                                            $groupedPermissions = \Spatie\Permission\Models\Permission::all()->groupBy(function($item, $key) {
                                                return explode('-', $item->name)[0]; 
                                            });
                                        @endphp

                                      

                                        @foreach ($groupedPermissions as $group => $permissions)
                                        <tr>
                                            <td class="text-nowrap fw-medium text-heading">{{ ucfirst($group) }} Permissions</td>
                                            <td>

                                                <div class="d-flex justify-content-end">
                                                    @foreach($permissions as $permission)
                                                    <div class="form-check mb-0 me-4 me-lg-12">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="permission-{{ $permission->id }}">
                                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                            {{ ucfirst(explode('-', $permission->name)[1]) }}
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
