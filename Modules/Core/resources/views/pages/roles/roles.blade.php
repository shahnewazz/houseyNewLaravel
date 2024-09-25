

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
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos">
                                    <img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Katy Turner" data-bs-original-title="Katy Turner">
                                    <img class="rounded-circle" src="../../assets/img/avatars/9.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Peter Adward" data-bs-original-title="Peter Adward">
                                    <img class="rounded-circle" src="../../assets/img/avatars/4.png" alt="Avatar">
                                </li>
                                <li class="avatar">
                                    <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                                </li>
                            </ul>
                        </div>
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
