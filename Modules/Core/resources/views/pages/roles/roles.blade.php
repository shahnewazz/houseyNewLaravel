

@extends('core::layouts.master')

@section('content')



<div class="card shadow rounded-md">
    <div class="card-body">
        <div class="row">
           <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-normal mb-0 text-body">Total 3 users</h6>
                            <div class="avatar-group d-flex">
                                <div class="avatar rounded-circle">
                                    <span class="avatar-text rounded-circle bg-label-success">KR</span>
                                </div>
                                <div class="avatar rounded-circle">
                                    <span class="avatar-text rounded-circle bg-label-secondary">TY</span>
                                </div>
                                <div class="avatar rounded-circle">
                                    <span class="avatar-text rounded-circle bg-label-warning">AQ</span>
                                </div>
                                <div class="avatar rounded-circle">
                                    <span class="avatar-text rounded-circle bg-label-danger">NF</span>
                                </div>
                                <div class="avatar rounded-circle">
                                    <span class="avatar-text rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                                </div>
                            </div>
                        </div>
                        <h6>Permissions</h6>
                        <ul>
                            <li>
                                User Panel
                            </li>
                            <li>
                                User Panel
                            </li>
                            <li>
                                User Panel
                            </li>
                            <li>
                                User Panel
                            </li>
                            <li>
                                User Panel
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h5 class="mb-1">Support</h5>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                            </div>
                            <a href="javascript:void(0);"><i class="ti ti-copy ti-md text-heading"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
