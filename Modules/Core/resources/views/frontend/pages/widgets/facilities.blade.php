<div class="tp-feature-area pt-90 pb-90">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
             <div class="tp-feature-title-wrap mb-60 text-center">
                <h6 class="tp-section-title-pre-red tp-section-title-pre  wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">{{$data['lang'][$code]['section_subtitle']}}</h6>
                <h2 class="tp-section-title m-0 wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">{{$data['lang'][$code]['section_title']}}</h2>
                <p class="tp-section-title-para wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">{{$data['lang'][$code]['section_description']}}</p>
             </div>
          </div>

          @if($data['repeater'] && !empty($data['repeater']) && count($data['repeater']) > 0)
            @foreach ($data['repeater'] as $key => $item)
                
                @php
                
                    $image = !empty($item['image']) ? asset('storage/'.$item['image']) : '';
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6 mb-30 tp-feature-border">
                    <div class="tp-feature-wrapper text-center wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="tp-feature-thumb mb-15">
                            <img src="{{$image}}" alt="{{$item['lang'][$code]['title']}}">
                        </div>
                        <div class="tp-feature-content">
                            <h3 class="tp-feature-title">
                                <a href="{{$item['url'] ?? ''}}">{{$item['lang'][$code]['title'] ?? ''}}</a>
                            </h3>
                            <p>{{$item['lang'][$code]['description'] ?? ''}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
          @endif
       </div>
    </div>
</div>