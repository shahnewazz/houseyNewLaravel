

@extends('core::layouts.master')

@section('content')

<div class="card shadow rounded-md">
    <div class="card-body">
        <div class="row align-items-sm-stretch">
            @foreach ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="fw-medium mb-5 text-body">{{$role->name}}</h2>

                        <p>{{__('role.total_users')}} {{$role->users_count}}</p>
                        

                        <h6 class="fw-medium mb-3 text-body">{{__('role.permissions')}}</h6>
                        <div class="mb-6">
                            @foreach ($role->permissions as $permission)
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-dot bg-primary me-1"></span> {{ucfirst(explode('-', $permission->name)[1])}}
                            </div>
                            @endforeach
                        </div>

                        <div class="d-flex align-items-end gap-3 mt-auto">
                            <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('admin.roles.destroy', $role->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-label-danger role-del-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-xl-4 col-lg-6 col-md-6">
                <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Add Role</a>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
  
<script>
    "use strict";

    $(function() {
        $(document).on('click', '.role-del-btn', function(e) {
            e.preventDefault();
        

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    });

</script>



@endpush