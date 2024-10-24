<!-- hero area start -->
<div class="tp-hero-area p-relative">
    <div class="shop-slider-wrapper">
        <div class="swiper-container tp-hero-slider-active">
            <div class="swiper-wrapper">

                @if($data['repeater'] && !empty($data['repeater']) && count($data['repeater']) > 0)
                
                    @foreach ($data['repeater'] as $key => $item)
                        @php
                            $image = !empty($item['image']) ? asset('storage/'.$item['image']) : '';
                        @endphp
                        <div class="swiper-slide">
                            <div class="tp-hero-five-bg">
                                <div class="tp-hero-thumb" data-background="{{$image}}"></div>
                            </div>
                        </div>
                        
                    @endforeach
                @endif
                
            </div>
        </div>
    </div>
    <div class="tp-hero-arrow-box d-none d-sm-block">
        <button class="tp-hero-next">
            <svg width="32" height="62" viewBox="0 0 32 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31 61L1 31L31 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <button class="tp-hero-prev">
            <svg width="32" height="62" viewBox="0 0 32 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 61L31 31L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="tp-hero-content-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="tp-hero-content text-center">
                        <div class="tp-hero-title-box mb-30">
                            <h5 class="tp-hero-subtitle mb-15 wow img-custom-anim-top" data-wow-duration="1s" data-wow-delay="0.1s">{{$data['lang'][$code]['subtitle'] ?? ''}}</h5>
                            <h2 class="tp-hero-title wow img-custom-anim-top" data-wow-duration="1.5s" data-wow-delay="0.4s">{!!$data['lang'][$code]['title'] ?? '' !!}</h2>
                        </div>
                        @if(!empty($data['button']['lang'][$code]['text']))
                        <div class="tp-hero-btn-box  wow img-custom-anim-top" data-wow-duration="1.5s" data-wow-delay="0.4s">
                            <a class="tp-btn" href="{{$data['button']['url'] ?? ''}}">
                                <span class="explore-text">{{$data['button']['lang'][$code]['text'] ?? ''}}</span>   
                                <span class="tp-arrow-angle"> 
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M1 1H9V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                </span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hero area end -->