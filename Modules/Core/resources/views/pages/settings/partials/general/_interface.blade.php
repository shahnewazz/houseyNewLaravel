
<!-- site settings -->
<form action="{{route('admin.general.interface.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <x-core::card>
        <x-slot name="header">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.23077 1H5.92308C6.2495 1 6.56255 1.12967 6.79336 1.36048C7.02418 1.5913 7.15385 1.90435 7.15385 2.23077V13.9231C7.15385 14.7391 6.82967 15.5218 6.25264 16.0988C5.6756 16.6758 4.89297 17 4.07692 17V17C3.67286 17 3.27275 16.9204 2.89944 16.7658C2.52613 16.6112 2.18693 16.3845 1.90121 16.0988C1.32417 15.5218 1 14.7391 1 13.9231V2.23077C1 1.90435 1.12967 1.5913 1.36048 1.36048C1.5913 1.12967 1.90435 1 2.23077 1V1Z" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7.15389 6.53835L11.4616 2.20604C11.6922 1.97681 12.0041 1.84814 12.3293 1.84814C12.6544 1.84814 12.9664 1.97681 13.197 2.20604L15.7939 4.81527C16.0231 5.04587 16.1518 5.35781 16.1518 5.68297C16.1518 6.00812 16.0231 6.32006 15.7939 6.55066L6.25543 16.1014" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.4615 10.8462H15.7692C16.0956 10.8462 16.4087 10.9759 16.6395 11.2067C16.8703 11.4375 17 11.7505 17 12.077V15.7693C17 16.0957 16.8703 16.4087 16.6395 16.6396C16.4087 16.8704 16.0956 17 15.7692 17H4.0769" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 5.9231H7.15385" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 10.8462H7.15385" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            Website Interface
        </x-slot>
        <div class="row row-cols-lg-3 row-cols-1 row-cols-sm-2">
            <!-- site color -->
            <div class="col">
                <x-core::card class="shadow-none">
                    <x-slot name="header">
                        Website Color
                    </x-slot>

                    <div class="alert alert-warning">
                        <strong>Info!</strong> Please add HEX color code (#fff)
                    </div>
        
                    <div class="mb-4">
                        <x-core::form.input-label for="site_primary_color" :value="'Primary'" />
                        <div class="input-group">
                            <x-core::form.input type="text" id="site_primary_color" name="site_primary_color" class="input-color" value="{{ old('site_primary_color', $settings['site_primary_color']) }}" required/>
                            <span class="input-group-text site-color-primary input-color-placeholder"></span>
                        </div>
                        <x-core::form.input-error field="site_primary_color" />                   
                    </div>                  
                    <div class="mb-3">
                        <x-core::form.input-label for="site_secondary_color" :value="'Secondary'" />
                        <div class="input-group">
                            <x-core::form.input type="text" id="site_secondary_color" name="site_secondary_color" class="input-color" value="{{ old('site_secondary_color', $settings['site_secondary_color']) }}" required/>
                            <span class="input-group-text site-color-secondary input-color-placeholder"></span>
                        </div>
                        <x-core::form.input-error field="site_secondary_color" />                   
                    </div> 
                    <div class="mb-3">
                        <x-core::form.input-label for="site_body_color" :value="'Body'" />
                        <div class="input-group">
                            <x-core::form.input type="text" id="site_body_color" name="site_body_color" class="input-color" value="{{ old('site_body_color', $settings['site_body_color']) }}" required/>
                            <span class="input-group-text site-color-secondary input-color-placeholder"></span>
                        </div>   
                        <x-core::form.input-error field="site_body_color" />                   
                    </div> 
                    <div class="mb-3">
                        <x-core::form.input-label for="site_heading_color" :value="'Heading'" />
                        <div class="input-group">
                            <x-core::form.input type="text" id="site_heading_color" name="site_heading_color" class="input-color" value="{{ old('site_heading_color', $settings['site_heading_color']) }}" required/>
                            <span class="input-group-text site-color-secondary input-color-placeholder"></span>
                        </div>
                        <x-core::form.input-error field="site_heading_color" />                   
                    </div> 
        
                </x-core::card>   
            </div>
        
            <!-- site logo -->
            <div class="col">
                <x-core::card class="shadow-none">
                    <x-slot name="header">
                        Website Logo
                    </x-slot>
        
                    @php
                        $site_logo_primary = asset('storage/'.$settings['site_logo']) ?? '';
                        $site_logo_secondary = asset('storage/'.$settings['site_logo_secondary']) ?? '';
                        $site_favicon = asset('storage/'.$settings['site_favicon']) ?? '';
                    @endphp

                    <div class="mb-5">
                        <x-core::form.input-label class="d-block" :value="'Primary Logo'" />
                        
                        <div class="mb-2 image-upload-container">
                            <img src="{{$site_logo_primary}}" class="img-thumbnail site-logo-primary image-preview" alt="site-logo-primary" data-default="{{$site_logo_primary}}">
                        </div>
                        
                        <label for="site_logo_primary" class="btn btn-sm btn-label-primary me-3">
                            <span>Upload Primary</span>                    
                            <x-core::form.input value="{{$site_logo_primary}}" type="file" id="site_logo_primary" name="site_logo" class="image-input" data-target=".site-logo-primary" data-reset=".site-logo-primary-reset" hidden />
                        </label>
                        <button type="button" class="btn btn-label-secondary site-logo-primary-reset image-reset d-none" data-target=".site-logo-primary">Reset</button>
                        
                        <x-core::form.input-error field="site_logo_primary" />
                    </div>
        
                    
                    <div class="mb-3">
                        <x-core::form.input-label class="d-block" :value="'Secondary Logo'" />
                        
                        <div class="mb-2 image-upload-container">
                            <img src="{{$site_logo_secondary}}" class="img-thumbnail site-logo-secondary image-preview" alt="site-logo-secondary" data-default="{{$site_logo_secondary}}">
                        </div>
                        
                        <label for="site_logo_secondary" class="btn btn-sm btn-label-primary me-3">
                            <span>Upload Secondary</span>                    
                            <x-core::form.input value="{{$site_logo_secondary}}" type="file" id="site_logo_secondary" name="site_logo_secondary" class="image-input" data-target=".site-logo-secondary" data-reset=".site-logo-secondary-reset" hidden />
                        </label>
                        <button type="button" class="btn btn-label-secondary site-logo-secondary-reset image-reset d-none" data-target=".site-logo-secondary">Reset</button>
        
                        <x-core::form.input-error field="site_logo_secondary" />
                    </div>

                    <div class="mb-3">
                        <x-core::form.input-label for="site_logo_width" :value="'Logo Width'" />
                        <x-core::form.input type="number" id="site_logo_width" name="site_logo_width" value="{{ old('site_logo_width', $settings['site_logo_width']) }}" required />
                         
                        <x-core::form.input-error field="site_logo_width" />                   
                    </div> 
        
                </x-core::card>
            </div>
        
            <!-- site favicon -->
            <div class="col">
                <!-- site favicon -->
                <x-core::card class="shadow-none">
                    <x-slot name="header">
                        Website Favicon
                    </x-slot>
        
                    <div class="mb-3">
                        <x-core::form.input-label class="d-block" :value="'Favicon'" />
        
                        <div class="mb-2 image-upload-container">
                            <img src="{{$site_favicon}}" class="img-thumbnail site-favicon image-preview" alt="site-favicon" data-default="{{$site_favicon}}">
                        </div>
        
                        <label for="site_favicon" class="btn btn-sm btn-label-primary me-3">
                            <span>Upload Favicon</span>                    
                            <x-core::form.input type="file" id="site_favicon" name="site_favicon" class="image-input" data-target=".site-favicon" data-reset=".site-favicon-reset" hidden />
                        </label>
                        <button type="button" class="btn btn-label-secondary site-favicon-reset image-reset d-none" data-target=".site-favicon">Reset</button>
        
                        <x-core::form.input-error field="site_favicon" />
                    </div>
        
                </x-core::card>

                <!-- preloader -->
                <x-core::card class="shadow-none">
                    <x-slot name="header">
                        Preloader
                    </x-slot>
        
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="site_preloader" id="site_preloader" @if ($settings['site_preloader'] == 'on') checked @endif>
                            <label class="form-check-label" for="site_preloader">Enable Preloader ?</label>
                        </div>                      
                    </div>
        
                    <div class="mb-4">
                        <x-core::form.input-label for="site_preloader_overlay" :value="'Preloader Overlay Color'" />
                        <div class="input-group">
                            <x-core::form.input type="text" id="site_preloader_overlay" name="site_preloader_overlay" class="input-color" value="{{ old('site_preloader_overlay', $settings['site_preloader_overlay']) }}" />
                            <span class="input-group-text site-color-primary input-color-placeholder"></span>
                        </div>   
                        <div class="form-text">Add HEX color code (#fff)</div>
                        <x-core::form.input-error field="site_preloader_overlay" />                   
                    </div>
        
                </x-core::card>
        
            </div>
        </div>
        <x-slot name="footer">
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </x-slot>
    </x-core::card>
</form>