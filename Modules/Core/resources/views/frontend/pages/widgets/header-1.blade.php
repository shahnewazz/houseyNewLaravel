@php
// echo "<pre>";
// print_r($data);
// echo "</pre>";

$menu = isset($data['menu']) ? \Modules\Core\Models\Menu::findOrFail($data['menu']) : null;

if($code != 'en'){
   $menu_data = $menu->translations[$code] ?? $menu->menu_items;
}else{
   $menu_data = is_null($menu) ? [] : $menu->menu_items;
}

@endphp

<header class="tp-header-height">
         
    <!-- header-area-start -->
    <div class="tp-header-area">
       <div class="tp-header-top tp-header-border-bottom d-none d-lg-block p-relative">
          <div class="container">
             <div class="row">
                <div class="col-md-6">
                   <div class="tp-header-info">
                      <ul>
                        @foreach ($data['repeater'] as $key => $item)
                           @if(!empty($item['lang'][$code]['text']))
                           <li>
                              @if (!empty($item['url']))
                                 <a href="{{$item['url'] ?? ''}}">
                                    <span>
                                    {!! ($item['icon']['icon_type'] == 'image' && !empty($item['icon']['icon_content']['image'])) ? '<img src="'.asset('storage/'.$item['icon']['icon_content']['image']).'" alt="icon">' : ($item['icon']['icon_content']['svg'] ?? '') !!}
                                    </span>
                                    {{$item['lang'][$code]['text'] ?? ''}}
                                 </a>
                              @else
                                 <span>
                                    {!! ($item['icon']['icon_type'] == 'image' && !empty($item['icon']['icon_content']['image'])) ? '<img src="'.asset('storage/'.$item['icon']['icon_content']['image']).'" alt="icon">' : ($item['icon']['icon_content']['svg'] ?? '') !!}
                                 </span>
                                 {{$item['lang'][$code]['text'] ?? ''}}
                              @endif
                           </li>
                           @endif
                        @endforeach
                      </ul>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="tp-header-top-right d-flex justify-content-end align-items-center">

                        @if (!empty($data['search_switch']) && $data['language_switch'] == '1')
                        <div class="tp-header-usd tp-header-border-right tp-header-usd-spacing mr-20">
                            <span class="tp-header-selected-usd">{{strtoupper(app()->getLocale())}}</span>

                              <ul class="tp-header-usd-list">
                                 @foreach (\Modules\Core\Models\Language::where('status', 1)->get() as $language)
                                 <li>
                                       <a class="lang-btn @if (session('lang') == $language->code) active @endif" data-lang="{{ $language->code }}"  href="javascript:void(0);"   >
                                          <div class="d-flex align-items-center gap-1">
                                             @isset($language->image)
                                             <img class="rounded-pill object-cover" width="16px" height="16px" src="{{ asset('storage/' . $language->image) }}" alt="{{ $language->name }}">
                                             @endisset
                                             {{ $language->name }}
                                          </div>
                                       </a>
                                 </li>
                                 @endforeach
                              </ul>
                        </div>
                        @endif

                        @if (!empty($data['account']) && isset($data['account']['lang'][$code]['text']))
                        <div class="tp-header-acount tp-header-usd tp-header-border-right">
                            <a href="{{$data['account']['url'] ?? '#'}}">
                                <span>
                                    {!! $data['account']['icon']['icon_type'] == 'image' && !empty($data['account']['icon']['icon_content']['image']) ? '<img width="17px" height="17px" src="'.asset('storage/'.$data['account']['icon']['icon_content']['image']).'" alt="icon">' : ($data['account']['icon']['icon_content']['svg'] ?? '') !!}
                                </span>
                                {{$data['account']['lang'][$code]['text'] ?? ''}}
                            </a>
                        </div>
                        @endif
                   </div>
                </div>
             </div>
          </div>
       </div>

       <div id="header-sticky" class="tp-header-bottom tp-header-sm-spacing">
          <div class="container">
             <div class="tp-header-main-wrap p-relative">
                <div class="row align-items-center">
                   <div class="col-xl-2 col-lg-2 col-6">
                     @if (!empty($data['logo']) )
                     <div class="tp-header-logo">
                        <a href="{{url('/')}}">
                           <img data-width="138" src="{{asset('storage/'.$data['logo']) ?? ''}}" alt="logo">
                       </a>
                     </div>   
                     @endif
                  </div>
                   <div class="col-xl-6 col-lg-8 d-none d-lg-block">
                      <div class="tp-main-menu">
                           @if(isset($menu_data) && count($menu_data) > 0)
                         <nav class="tp-mobile-menu-active">
                            <ul>

                               @foreach ($menu_data as $key => $item)
                               <li>
                                    <a href="{{$item['href']}}" target="{{$item['target']}}">{{$item['text']}}</a>
                               </li>
                                   
                               @endforeach
                            </ul>
                         </nav>
                           @endif
                      </div>
                   </div>
                   <div class="col-xl-4 col-lg-2 col-6">
                      <div class="tp-header-action d-flex justify-content-end">

                        @if (!empty($data['search_switch']) && $data['search_switch'] == '1')
                        <div class="tp-header-search tp-search-click d-none d-xl-block">
                            <form action="#" class="tp-header-form tp-header-input-toggle">
                                <input class="tp-header-search-input" type="text" placeholder="Search...">
                                <button class="tp-header-submit-btn" type="button">
                                    <span>
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.1111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.1111C15.2222 4.18375 12.0385 1 8.1111 1C4.18375 1 1 4.18375 1 8.1111C1 12.0385 4.18375 15.2222 8.1111 15.2222Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M17.0001 17L13.1334 13.1333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                            </form>
                        </div>
                        @endif


                        @if(!empty($data['button']) && isset($data['button']['lang'][$code]['text']))
                        <div class="tp-header-btn-wrap d-none d-lg-block ml-30">
                            <a class="tp-header-btn" href="{{$data['button']['url']}}" target="{{$data['button']['target'] == 1 ? '_blank' : '_self' }}">
                                {{ $data['button']['lang'][$code]['text'] ?? '' }}
                            </a>
                        </div>
                        @endif

                        <div class="tp-header-3-menu-bar d-lg-none tp-header-menu-btn-black">
                            <button class="tp-offcanvas-open-btn">
                               <span></span>
                               <span></span>
                               <span></span>
                            </button>
                        </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- header-area-end -->

 </header>

