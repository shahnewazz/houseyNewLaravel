<!-- General Settings -->
<form action="{{route('admin.general.update')}}" method="POST">
    @csrf
    @method('PUT')
    
    <img src="{{asset('uploads/site_logo.jpg')}}" alt="">
    <x-core::card>
        <x-slot name="header">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 2.5C4 3.32843 3.32843 4 2.5 4C1.67157 4 1 3.32843 1 2.5C1 1.67157 1.67157 1 2.5 1C3.32843 1 4 1.67157 4 2.5ZM4 2.5H14M9 7.5C9 8.32843 8.32843 9 7.5 9C6.67157 9 6 8.32843 6 7.5M9 7.5C9 6.67157 8.32843 6 7.5 6C6.67157 6 6 6.67157 6 7.5M9 7.5H14M6 7.5H1M11 12.5C11 13.3284 11.6716 14 12.5 14C13.3284 14 14 13.3284 14 12.5C14 11.6716 13.3284 11 12.5 11C11.6716 11 11 11.6716 11 12.5ZM11 12.5H1" stroke="#000001" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            General Settings
        </x-slot>
    
        <div class="row row-cols-lg-3 row-cols-1 row-cols-sm-2 g-3">
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_title" :value="'Site Title'" />
                    <x-core::form.input type="text" id="site_title" name="site_title" value="{{ old('site_title', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_TITLE]) }}" required />
                    <x-core::form.input-error field="site_title" />
                </div> 

            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_tagline" :value="'Site Tagline'" />
                    <x-core::form.input type="text" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_TAGLINE]) }}" required />
                    <x-core::form.input-error field="site_tagline" />
                </div> 
            </div>

            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_copyright" :value="'Site Copyright'" />
                    <x-core::form.input type="text" id="site_copyright" name="site_copyright" value="{{ old('site_copyright', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_COPYRIGHT]) }}" required />
                    <x-core::form.input-error field="site_copyright" />
                </div>  
            </div>
            
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_email" :value="'Site Email'" />
                    <x-core::form.input type="email" id="site_email" name="site_email" value="{{ old('site_email', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_EMAIL]) }}" required />
                    <x-core::form.input-error field="site_email" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_phone" :value="'Site Phone'" />
                    <x-core::form.input type="tel" id="site_phone" name="site_phone" value="{{ old('site_phone', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_PHONE]) }}" required />
                    <x-core::form.input-error field="site_phone" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_address" :value="'Site Address'" />
                    <x-core::form.input type="text" id="site_address" name="site_address" value="{{ old('site_address', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_ADDRESS]) }}" required />
                    <x-core::form.input-error field="site_address" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_latitude" :value="'Latitude'" />
                    <x-core::form.input type="text" id="site_latitude" name="site_latitude" value="{{ old('site_latitude', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_LATITUDE]) }}" required />
                    <x-core::form.input-error field="site_latitude" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_longitude" :value="'Longitude'" />
                    <x-core::form.input type="text" id="site_longitude" name="site_longitude" value="{{ old('site_longitude', $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_LONGITUDE]) }}" required />
                    <x-core::form.input-error field="site_longitude" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_timezone" :value="'Timezone'" />
                    <select name="site_timezone" class="form-select conca-select2" required>
                        @foreach (timezone_identifiers_list() as $timezone)
                            <option value="{{ $timezone }}" {{ $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_TIMEZONE] == $timezone ? 'selected' : '' }}>
                                {{ $timezone }}
                            </option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="site_timezone" />
                </div>                  
            </div>

            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_date_format" :value="'Date Format'" />
                    <select name="site_date_format" id="site_date_format" class="form-select conca-select2" required>
                        @foreach (Config::get('app.date_formats') as $format => $label)
                            <option value="{{ $format }}" {{ $settings[\Modules\Core\Enums\SiteSettingEnum::SITE_DATE_FORMAT] == $format ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="site_date_format" />
                </div>                  
            </div>
        </div> 
        
        <x-slot name="footer">
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </x-slot>
    </x-core::card> 
</form>
