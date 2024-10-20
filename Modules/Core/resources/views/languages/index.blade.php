@extends('core::layouts.master')

@section('content')
@isset($languages)
<div class="card">
    <div class="card-body">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h4 class="m-0">Languages</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.languages.create') }}" class="btn btn-primary">Add Language</a>
            </div>
        </div>
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Default</th>
                    <th scope="col">Translations</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($languages as $lang)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @isset($lang->image)
                                <div class="avatar avatar-sm rounded-xl">
                                    <img src="{{ asset('storage/'.$lang->image) }}" alt="{{$lang->name}}">
                                </div>
                            @endisset
                            {{$lang->name}}
                        </div>
                    </td>
                    <td>{{$lang->code}}</td>
                    <td>
                        
                        @if ($lang->direction == 'ltr')
                            Left To Right
                        @else
                            Right To Left
                        @endif
                    </td>
                    <td>
                        <form action="{{route('admin.languages.default', ['id' => $lang->id])}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="isDefault" id="default_{{$lang->id}}" @if ($lang->isDefault == 1) checked @endif>
                            </div>          
                        </form>
                    </td>
        
                    <td>
                        <a href="{{ route('admin.languages.translate', ['code' => $lang->code]) }}" class="btn btn-icon btn-label-primary">
                            <svg width="20" height="18" viewBox="0 0 470 401" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M416.333 122.667H299V53.3333C298.983 39.1937 293.359 25.638 283.36 15.6397C273.362 5.64141 259.806 0.0169371 245.667 0H53.6666C39.5269 0.0169371 25.9712 5.64141 15.9729 15.6397C5.97466 25.638 0.350189 39.1937 0.333252 53.3333V181.333C0.350189 195.473 5.97466 209.029 15.9729 219.027C25.9712 229.025 39.5269 234.65 53.6666 234.667V256.96C53.6586 261.168 54.903 265.284 57.2412 268.783C59.5795 272.282 62.906 275.006 66.7973 276.608C70.7056 278.236 75.0099 278.664 79.1622 277.837C83.3145 277.011 87.1271 274.968 90.1146 271.968C90.504 271.594 90.8609 271.187 91.1813 270.752L117.72 234.667H171V304C171.017 318.14 176.641 331.695 186.64 341.694C196.638 351.692 210.194 357.316 224.333 357.333H342.584L379.917 394.667C382.901 397.649 386.702 399.68 390.839 400.503C394.977 401.326 399.266 400.903 403.163 399.289C407.061 397.675 410.392 394.941 412.737 391.434C415.081 387.926 416.332 383.803 416.333 379.584V357.333C430.473 357.316 444.029 351.692 454.027 341.694C464.025 331.695 469.65 318.14 469.667 304V176C469.65 161.86 464.025 148.305 454.027 138.306C444.029 128.308 430.473 122.684 416.333 122.667ZM112.333 213.333C110.671 213.342 109.034 213.739 107.552 214.493C106.071 215.247 104.786 216.336 103.8 217.675L74.9999 256.715V224C74.9999 221.171 73.8761 218.458 71.8757 216.458C69.8753 214.457 67.1622 213.333 64.3333 213.333H53.6666C45.1797 213.333 37.0403 209.962 31.0392 203.961C25.038 197.96 21.6666 189.82 21.6666 181.333V53.3333C21.6666 44.8464 25.038 36.7071 31.0392 30.7059C37.0403 24.7047 45.1797 21.3333 53.6666 21.3333H245.667C254.154 21.3333 262.293 24.7047 268.294 30.7059C274.295 36.7071 277.667 44.8464 277.667 53.3333V122.667H224.333C212.985 122.7 201.949 126.384 192.856 133.173L159.373 59.5733C158.525 57.7111 157.159 56.1322 155.437 55.025C153.716 53.9178 151.713 53.3292 149.667 53.3292C147.62 53.3292 145.617 53.9178 143.896 55.025C142.175 56.1322 140.808 57.7111 139.96 59.5733L86.6266 176.907C86.0484 178.184 85.7277 179.563 85.6829 180.964C85.638 182.366 85.8699 183.762 86.3653 185.074C86.8606 186.385 87.6097 187.587 88.5697 188.609C89.5297 189.63 90.6817 190.453 91.9599 191.029C93.3306 191.664 94.8225 191.996 96.3333 192C98.3804 191.999 100.384 191.41 102.105 190.301C103.827 189.193 105.192 187.613 106.04 185.749L122.595 149.333H176.76L177.517 150.987C173.301 158.654 171.061 167.25 171 176V213.333H112.333ZM167.064 128H132.291L149.667 89.7707L167.064 128ZM448.333 304C448.333 312.487 444.962 320.626 438.961 326.627C432.959 332.629 424.82 336 416.333 336H405.667C402.838 336 400.125 337.124 398.124 339.124C396.124 341.125 395 343.838 395 346.667V379.584L354.541 339.125C352.541 337.125 349.829 336.001 347 336H224.333C215.846 336 207.707 332.629 201.706 326.627C195.705 320.626 192.333 312.487 192.333 304V176C192.333 167.513 195.705 159.374 201.706 153.373C207.707 147.371 215.846 144 224.333 144H416.333C424.82 144 432.959 147.371 438.961 153.373C444.962 159.374 448.333 167.513 448.333 176V304Z" fill="currentColor" />
                                <path d="M373.667 202.667H331V181.333C331 178.504 329.876 175.791 327.876 173.791C325.875 171.79 323.162 170.667 320.333 170.667C317.504 170.667 314.791 171.79 312.791 173.791C310.79 175.791 309.667 178.504 309.667 181.333V202.667H267C264.171 202.667 261.458 203.79 259.457 205.791C257.457 207.791 256.333 210.504 256.333 213.333C256.333 216.162 257.457 218.875 259.457 220.876C261.458 222.876 264.171 224 267 224H346.147C343.535 242.122 334.319 258.639 320.269 270.379C312.063 263.525 305.43 254.982 300.824 245.333C300.244 244.035 299.411 242.866 298.372 241.895C297.334 240.923 296.112 240.169 294.778 239.677C293.444 239.184 292.026 238.964 290.605 239.028C289.185 239.091 287.792 239.439 286.507 240.049C285.223 240.659 284.074 241.52 283.127 242.58C282.18 243.641 281.455 244.88 280.994 246.225C280.533 247.57 280.346 248.994 280.443 250.413C280.54 251.831 280.92 253.216 281.56 254.485C286.516 264.762 293.292 274.057 301.56 281.92C292.08 285.957 281.879 288.026 271.576 288C270.194 288.006 268.828 288.29 267.558 288.833C266.287 289.376 265.138 290.168 264.179 291.162C263.22 292.156 262.469 293.332 261.972 294.621C261.474 295.91 261.24 297.286 261.283 298.667C261.369 301.535 262.573 304.256 264.637 306.249C266.702 308.242 269.464 309.349 272.333 309.333C289.285 309.327 305.929 304.798 320.547 296.213C335.3 304.762 352.04 309.287 369.091 309.333C370.472 309.327 371.839 309.044 373.109 308.501C374.379 307.958 375.528 307.166 376.488 306.172C377.447 305.177 378.198 304.001 378.695 302.712C379.192 301.423 379.427 300.048 379.384 298.667C379.298 295.798 378.094 293.078 376.029 291.085C373.965 289.092 371.203 287.985 368.333 288C358.354 287.961 348.486 285.908 339.32 281.963C355.209 266.512 365.241 246.025 367.704 224H373.667C376.496 224 379.209 222.876 381.209 220.876C383.209 218.875 384.333 216.162 384.333 213.333C384.333 210.504 383.209 207.791 381.209 205.791C379.209 203.79 376.496 202.667 373.667 202.667Z" fill="currentColor" />
                            </svg>
                        </a>
                    </td>
        
                    <td>
                        <form action="{{route('admin.languages.status', ['id' => $lang->id])}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" id="status_{{$lang->id}}" @if ($lang->status == 1) checked @endif>
                            </div>  
                        </form>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.languages.edit', ['id' => $lang->id]) }}" class="btn btn-sm btn-label-primary">
                                Edit
                            </a>
                            @if($lang->isDefault == 0 && $lang->code != 'en')
                            <form action="{{route('admin.languages.destroy', ['id' => $lang->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-label-danger lang-del-btn">Delete</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
        
            <tr>
                <td colspan="7">
                    <div class="alert alert-warning">No Data Found</div>
                </td>
            </tr>
                
            @endforelse
                
            </tbody>
        </table>
        @if ($languages->hasPages())
            <div class="d-flex justify-content-end">
                {!! $languages->links('core::components.pagination') !!}
            </div>                    
        @endif
        
    </div>
</div>
@endisset
@endsection

@push('scripts')
<script>
    "use strict";

    $(document).ready(function(){


        $(document).on('click', '.lang-del-btn', function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                html: "All Translations will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });

        })


        $(document).on('change', 'input[name="isDefault"]',  function(){    
            const originalChecked = $(this).prop('checked');        
            Swal.fire({
                title: 'Are you sure?',
                text: "Set This Language as Default?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, set it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }else{
                    $(this).prop('checked', !originalChecked);
                }
            });
        });

        $(document).on('change', 'input[name="status"]',  function(){        
            const originalChecked = $(this).prop('checked');            
            Swal.fire({
                title: 'Are you sure?',
                text: "Change Language Status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }else{
                    $(this).prop('checked', !originalChecked);
                }
            });
        });

        
    });
</script>
@endpush