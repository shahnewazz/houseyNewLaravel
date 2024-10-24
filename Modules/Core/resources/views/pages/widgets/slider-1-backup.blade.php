<div class="card mb-5 widget-item" data-index="{{ $id }}">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <span class="handle">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 2.5L7 0.5M7 0.5L9 2.5M7 0.5V13.5M5 11.5L7 13.5M7 13.5L9 11.5M11.5 5L13.5 7M13.5 7L11.5 9M13.5 7H0.5M2.5 5L0.5 7M0.5 7L2.5 9" stroke="#000001" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <button class="btn btn-xs btn-icon btn-primary ms-3 me-3 widget-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#widget-body-{{ $id }}" aria-expanded="true" aria-controls="widget-body-{{ $id }}">
                <svg class="plus" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1V17M1 9H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="minus" width="16" height="2" viewBox="0 0 18 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <span class="card-title m-0 fs-4">Slider 1 Widget</span>
            <div class="d-flex align-items-center justify-content-end ms-auto gap-3 widget-controls">
                <button type="button" class="btn btn-xs btn-label-danger btn-icon widget-remove">
                    <svg width="16" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.1158 13.0223L15.8644 13.0686L15.8644 13.0686L15.1158 13.0223ZM16.4152 4.15739C16.4408 3.74396 16.1264 3.3881 15.7129 3.36254C15.2995 3.33698 14.9437 3.65141 14.9181 4.06484L16.4152 4.15739ZM3.08197 4.06592C3.05701 3.65246 2.7016 3.33751 2.28814 3.36247C1.87468 3.38743 1.55974 3.74285 1.5847 4.15631L3.08197 4.06592ZM2.87076 13.0135L2.12213 13.0587L2.12213 13.0587L2.87076 13.0135ZM14.334 17.2559L13.7188 16.8269L13.7188 16.8269L14.334 17.2559ZM13.2673 18.2587L12.8771 17.6182L12.8771 17.6182L13.2673 18.2587ZM3.64772 17.2532L3.03212 17.6816L3.03212 17.6816L3.64772 17.2532ZM4.71471 18.2577L5.10525 17.6174L5.10525 17.6174L4.71471 18.2577ZM1 3.36111C0.585786 3.36111 0.25 3.6969 0.25 4.11111C0.25 4.52532 0.585786 4.86111 1 4.86111V3.36111ZM17 4.86111C17.4142 4.86111 17.75 4.52532 17.75 4.11111C17.75 3.6969 17.4142 3.36111 17 3.36111V4.86111ZM11.9981 2.85931L12.673 2.53216L12.673 2.53216L11.9981 2.85931ZM11.93 4.43827C12.1107 4.811 12.5594 4.96668 12.9321 4.786C13.3048 4.60531 13.4605 4.15668 13.2798 3.78395L11.93 4.43827ZM6.0297 2.93001L5.34726 2.61893L5.34726 2.61893L6.0297 2.93001ZM4.80888 3.80003C4.63707 4.17694 4.80334 4.62175 5.18024 4.79356C5.55714 4.96536 6.00196 4.79909 6.17376 4.42219L4.80888 3.80003ZM6.97076 1.36726L7.42727 1.96232L7.42727 1.96232L6.97076 1.36726ZM7.21822 1.20811L7.57033 1.87031L7.57033 1.87031L7.21822 1.20811ZM11.0458 1.35272L11.4942 0.751519L11.4942 0.751517L11.0458 1.35272ZM10.8016 1.19973L10.4562 1.86547L10.4562 1.86547L10.8016 1.19973ZM6.02778 13.8889C6.02778 14.3031 6.36356 14.6389 6.77778 14.6389C7.19199 14.6389 7.52778 14.3031 7.52778 13.8889H6.02778ZM7.52778 8.55556C7.52778 8.14134 7.19199 7.80556 6.77778 7.80556C6.36356 7.80556 6.02778 8.14134 6.02778 8.55556H7.52778ZM10.4722 13.8889C10.4722 14.3031 10.808 14.6389 11.2222 14.6389C11.6364 14.6389 11.9722 14.3031 11.9722 13.8889H10.4722ZM11.9722 8.55556C11.9722 8.14134 11.6364 7.80556 11.2222 7.80556C10.808 7.80556 10.4722 8.14134 10.4722 8.55556H11.9722ZM15.8644 13.0686L16.4152 4.15739L14.9181 4.06484L14.3672 12.976L15.8644 13.0686ZM1.5847 4.15631L2.12213 13.0587L3.6194 12.9683L3.08197 4.06592L1.5847 4.15631ZM14.3672 12.976C14.296 14.129 14.245 14.9407 14.1454 15.5685C14.0477 16.1842 13.9131 16.5482 13.7188 16.8269L14.9492 17.6849C15.3256 17.1451 15.5115 16.5307 15.6269 15.8035C15.7403 15.0882 15.7949 14.1924 15.8644 13.0686L14.3672 12.976ZM8.99355 19.5278C10.1195 19.5278 11.017 19.5286 11.7379 19.4595C12.4709 19.3892 13.0956 19.2415 13.6575 18.8992L12.8771 17.6182C12.5869 17.795 12.2153 17.9068 11.5947 17.9663C10.962 18.027 10.1487 18.0278 8.99355 18.0278V19.5278ZM13.7188 16.8269C13.4962 17.1462 13.2095 17.4157 12.8771 17.6182L13.6575 18.8992C14.1676 18.5884 14.6075 18.1749 14.9492 17.6849L13.7188 16.8269ZM2.12213 13.0587C2.19007 14.1841 2.24342 15.0811 2.35602 15.7974C2.47052 16.5257 2.65588 17.141 3.03212 17.6816L4.26332 16.8248C4.06906 16.5456 3.93477 16.1811 3.83782 15.5644C3.73898 14.9357 3.6891 14.1228 3.6194 12.9683L2.12213 13.0587ZM8.99355 18.0278C7.8369 18.0278 7.02246 18.027 6.38896 17.9662C5.76759 17.9066 5.39559 17.7945 5.10525 17.6174L4.32418 18.898C4.8865 19.241 5.51187 19.3889 6.24572 19.4593C6.96744 19.5286 7.86608 19.5278 8.99355 19.5278V18.0278ZM3.03212 17.6816C3.37367 18.1724 3.8137 18.5867 4.32418 18.898L5.10525 17.6174C4.77261 17.4145 4.48588 17.1446 4.26332 16.8248L3.03212 17.6816ZM1 4.86111H17V3.36111H1V4.86111ZM11.3232 3.18647L11.93 4.43827L13.2798 3.78395L12.673 2.53216L11.3232 3.18647ZM5.34726 2.61893L4.80888 3.80003L6.17376 4.42219L6.71215 3.24109L5.34726 2.61893ZM6.71215 3.24109C6.91419 2.79785 7.04573 2.51101 7.16712 2.29825C7.28145 2.09786 7.3591 2.01462 7.42727 1.96232L6.51425 0.772198C6.23072 0.98971 6.03431 1.25686 5.86426 1.55491C5.70127 1.84058 5.53813 2.20021 5.34726 2.61893L6.71215 3.24109ZM9.03052 0.25C8.57035 0.25 8.17545 0.249284 7.84791 0.279102C7.50618 0.310212 7.18162 0.378131 6.8661 0.545901L7.57033 1.87031C7.64619 1.82998 7.75414 1.79384 7.9839 1.77292C8.22785 1.75072 8.54341 1.75 9.03052 1.75V0.25ZM7.42727 1.96232C7.47233 1.92775 7.52018 1.89698 7.57033 1.87031L6.8661 0.545901C6.74277 0.611482 6.62508 0.687174 6.51425 0.772199L7.42727 1.96232ZM12.673 2.53216C12.4772 2.12828 12.3097 1.7811 12.1442 1.50545C11.9716 1.21778 11.7743 0.96045 11.4942 0.751519L10.5974 1.95391C10.6649 2.00429 10.7423 2.08449 10.8581 2.27741C10.9811 2.48235 11.1159 2.75882 11.3232 3.18647L12.673 2.53216ZM9.03052 1.75C9.50577 1.75 9.81335 1.75069 10.0514 1.77198C10.2755 1.79203 10.3815 1.82667 10.4562 1.86547L11.147 0.533997C10.8368 0.373063 10.5192 0.307838 10.1851 0.277949C9.86484 0.249309 9.47935 0.25 9.03052 0.25V1.75ZM11.4942 0.751517C11.3845 0.669737 11.2684 0.596992 11.147 0.533997L10.4562 1.86547C10.5056 1.89108 10.5528 1.92066 10.5974 1.95392L11.4942 0.751517ZM7.52778 13.8889V8.55556H6.02778V13.8889H7.52778ZM11.9722 13.8889V8.55556H10.4722V13.8889H11.9722Z" fill="currentColor"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @php
        $item_count = @isset($data['repeater']) ? count($data['repeater']) : 1;
        $code = @isset($data) ? $code : 'en';
        $all_languages = \Modules\Core\Models\Language::all();
    @endphp

    <div class="collapse" id="widget-body-{{ $id }}">
        <div class="card-body">
            <div class="widget-form" id="widget-{{ $id }}" data-index="{{ $id }}" data-item_count="{{$item_count}}">
                <input type="hidden" name="widgets[widget-{{$id}}][widget_type]" value="slider-1">

                <div class="row">
                    
                    <div class="col">
                        <h5 class="mt-3">Items</h5>
                        <div class="repeater-form-fields-wrapper">
                            @isset($data['repeater'])

                                @forelse ($data['repeater'] as $key => $item)
                                @php
                                    $loop_count = $loop->iteration;
                                @endphp

                                <div class="repeater-form-fields pb-4">
                                    <div class="card-header d-flex align-items-center gap-3">
                                        <button class="btn btn-icon btn-xs btn-label-primary repeater-form-move" type="button">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 2.5L7 0.5M7 0.5L9 2.5M7 0.5V13.5M5 11.5L7 13.5M7 13.5L9 11.5M11.5 5L13.5 7M13.5 7L11.5 9M13.5 7H0.5M2.5 5L0.5 7M0.5 7L2.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-icon btn-xs btn-label-primary repeater-form-toggle-btn" type="button">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 11.5V2.5M7 11.5L9.5 9M7 11.5L4.5 9M7 2.5L9.5 5M7 2.5L4.5 5M13.5 0.5H0.5M13.5 13.5H0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <h5 class="card-title repeater-item-title">Item {{$loop_count}}</h5>
                                        <button class="btn btn-icon btn-xs btn-label-danger repeater-form-remove-btn ms-auto" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 0.999939L1 14.9999M1 0.999939L15 14.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="repeater-form-wrapper">

                                        <div class="row row-cols-lg-1">
                                            <div class="col">
                                                <div class="repeater-lang-content">
                
                                                    <div class="repeater-lang-btn-wrapper">
                                                        @foreach ($site_languages as $lang)
                                                        <button type="button" class="repeater-lang-btn @if ($code == $lang->code) active @endif" data-code="{{$lang->code}}">{{$lang->code}}</button>
                                                        @endforeach
                                                    </div>
                
                                                    @foreach ($site_languages as $lang)
                                                    <div class="repeater-lang-tab @if ($code == $lang->code) active @endif" data-code="{{$lang->code}}">
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Subtitle '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][lang][{{$lang->code}}][subtitle]" value="{{$item['lang'][$lang->code]['subtitle'] ?? ''}}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Title '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][lang][{{$lang->code}}][title]" value="{{$item['lang'][$lang->code]['title'] ?? ''}}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Button Text '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][button][lang][{{$lang->code}}][text]" value="{{$item['button']['lang'][$lang->code]['text'] ?? ''}}" />
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
                                                    <div class="mb-3">
                                                        <x-core::form.input-label :value="'URL'" />
                                                        <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1]['button'][url]" />
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="btn_target-[repeater-item-{{$loop_count}}]" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][button][target]" @if (!empty($item['button']['target']) && $item['button']['target'] == 1) checked @endif >
                                                        <label class="form-check-label" for="btn_target-[repeater-item-{{$loop_count}}]">Open In New Window</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="btn_nofollow-[repeater-item-{{$loop_count}}]" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][button][follow]" @if (!empty($item['button']['follow']) && $item['button']['follow'] == 1) checked @endif>
                                                        <label class="form-check-label" for="btn_nofollow-[repeater-item-{{$loop_count}}]">Add Nofollow</label>
                                                    </div>
                                                </div>

                                                @php
                                                    $item_image = !empty($item['image']) ? asset('storage/'.$item['image']) : '';
                                                    $item_image_db = !empty($item['image_db']) ? $item['image_db'] : (!empty($item['image']) ? $item['image'] : '');
                                                @endphp

                                                <div class="conca-image-upload-container">
                                                    <div>
                                                        <x-core::form.input-label :value="'Image'" />
                                                        <div>
                                                            <img src="{{$item_image}}" class="img-thumbnail image-preview" alt="item-image" data-default="{{$item_image}}">
                                                        </div>
                                                    </div>

                                                    <input name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][image_db]" type="hidden" value="{{$item_image_db}}">
                                                    <input type="file" hidden class="image-input" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-{{$loop_count}}][image]">

                                                    <button class="btn btn-sm btn-label-primary conca-image-upload-btn">Upload</button>
                                                    <button class="btn btn-sm btn-label-secondary conca-image-reset-btn d-none">Reset</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                @empty
                                    no Data
                                @endforelse 
                            @else
                                <div class="repeater-form-fields pb-4">
                                    <div class="card-header d-flex align-items-center gap-3">
                                        <button class="btn btn-icon btn-xs btn-label-primary repeater-form-move" type="button">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 2.5L7 0.5M7 0.5L9 2.5M7 0.5V13.5M5 11.5L7 13.5M7 13.5L9 11.5M11.5 5L13.5 7M13.5 7L11.5 9M13.5 7H0.5M2.5 5L0.5 7M0.5 7L2.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-icon btn-xs btn-label-primary repeater-form-toggle-btn" type="button">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 11.5V2.5M7 11.5L9.5 9M7 11.5L4.5 9M7 2.5L9.5 5M7 2.5L4.5 5M13.5 0.5H0.5M13.5 13.5H0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <h5 class="card-title repeater-item-title">Item 1</h5>
                                        <button class="btn btn-icon btn-xs btn-label-danger repeater-form-remove-btn ms-auto" type="button">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 0.999939L1 14.9999M1 0.999939L15 14.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="repeater-form-wrapper">

                                        <div class="row row-cols-lg-1">
                                            <div class="col">
                                                <div class="repeater-lang-content">
                
                                                    <div class="repeater-lang-btn-wrapper">
                                                        @foreach ($site_languages as $lang)
                                                        <button type="button" class="repeater-lang-btn @if ($code == $lang->code) active @endif" data-code="{{$lang->code}}">{{$lang->code}}</button>
                                                        @endforeach
                                                    </div>
                
                                                    @foreach ($site_languages as $lang)
                                                    <div class="repeater-lang-tab @if ($code == $lang->code) active @endif" data-code="{{$lang->code}}">
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Subtitle '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][lang][{{$lang->code}}][subtitle]" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Title '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][lang][{{$lang->code}}][title]" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <x-core::form.input-label :value="'Button Text '.$lang->code.' '"/>
                                                            <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][button][lang][{{$lang->code}}][text]" />
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="mb-3">
                                                        <x-core::form.input-label :value="'URL'" />
                                                        <x-core::form.input type="text" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1]['button'][url]" />
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="btn_target-[repeater-item-1]" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][button][target]" >
                                                        <label class="form-check-label" for="btn_target-[repeater-item-1]">Open In New Window</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="btn_nofollow-[repeater-item-1]" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][button][follow]">
                                                        <label class="form-check-label" for="btn_nofollow-[repeater-item-1]">Add Nofollow</label>
                                                    </div>
                                                </div>

                                                @php
                                                    $item_image = '';
                                                    $item_image_db = '';
                                                @endphp                                      

                                                <div class="conca-image-upload-container">
                                                    <div>
                                                        <x-core::form.input-label :value="'Image'" />
                                                        <img src="{{$item_image}}" class="img-thumbnail image-preview" alt="item-image" data-default="{{$item_image}}">
                                                    </div>

                                                    <input name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][image_db]" type="hidden" value="{{$item_image_db}}"> 
                                                    <input type="file" hidden class="image-input" name="widgets[widget-{{$id}}][widget_data][repeater][repeater-item-1][image]">

                                                    <button class="btn btn-sm btn-label-primary conca-image-upload-btn">Upload</button>
                                                    <button class="btn btn-sm btn-label-secondary conca-image-reset-btn d-none">Reset</button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endisset
                        </div>
                        <button class="btn btn-sm btn-primary repeater-form-add-btn" type="button">Add New</button>
                        
                    </div>
                </div>
            
                
            </div>
        </div>
    </div>
</div>