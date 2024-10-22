@php
// echo "<pre>";
// print_r($data);
// echo "</pre>";

$menu = \Modules\Core\Models\Menu::where('code', $code)->findorFail($data['menu']);

@endphp

<header class="tp-header-height">
         
    <!-- header-area-start -->
    <div class="tp-header-area">
       <div class="tp-header-top tp-header-border-bottom d-none d-lg-block">
          <div class="container">
             <div class="row">
                <div class="col-md-6">
                   <div class="tp-header-info">
                      <ul>
                        @foreach ($data['repeater'] as $key => $item)
                        <li>
                            <a href="{{$item['url'] ?? ''}}">
                               <span>
                                {!! $item['icon']['icon_type'] == 'image' ? '<img src="'.asset('storage/'.$item['icon']['icon_content']['image']).'" alt="icon">' : $item['icon']['icon_content']['svg'] !!}
                               </span>
                               {{$item['lang'][$code]['text'] ?? ''}}
                            </a>
                         </li>
                        @endforeach
                      </ul>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="tp-header-top-right d-flex justify-content-end align-items-center">

                        @if (!empty($data['search_switch']) && $data['language_switch'] == '1')
                        <div class="tp-header-usd tp-header-border-right tp-header-usd-spacing mr-20">
                            <span class="tp-header-selected-usd">EN</span>
                            <ul class="tp-header-usd-list">
                                <li>Spanish</li>
                                <li>English</li>
                                <li>Canada</li>
                            </ul>
                        </div>
                        @endif

                        @if (!empty($data['account']))
                        <div class="tp-header-acount tp-header-usd tp-header-border-right">
                            <a href="{{$data['account']['url'] ?? '#'}}">
                                <span>
                                    {!! $data['account']['icon']['icon_type'] == 'image' ? '<img width="17px" height="17px" src="'.asset('storage/'.$data['account']['icon']['icon_content']['image']).'" alt="icon">' : $data['account']['icon']['icon_content']['svg'] !!}
                                </span>
                                {{$data['account']['text'] ?? ''}}
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
                      <div class="tp-header-logo">
                         <a href="{{url('/')}}">
                            <img data-width="138" src="{{asset('storage/'.$data['logo']) ?? ''}}" alt="logo">
                        </a>
                      </div>   
                   </div>
                   <div class="col-xl-6 col-lg-8 d-none d-lg-block">
                      <div class="tp-main-menu">
                         <nav class="tp-mobile-menu-active">
                            <ul>
                               @foreach ($menu->menu_items as $key => $item)
                               <li>
                                    <a href="{{$item['href']}}" target="{{$item['target']}}">{{$item['text']}}</a>
                               </li>
                                   
                               @endforeach
                            </ul>
                         </nav>
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


                        @if(!empty($data['button']))
                        <div class="tp-header-btn-wrap d-none d-lg-block ml-30">
                            <a class="tp-header-btn" href="{{$data['button']['url']}}" target="{{$data['button']['target'] == 1 ? '_blank' : '_self' }}">
                                {{ $data['button']['text'] ?? '' }}
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

