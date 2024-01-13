@extends('juzaweb::layouts.frontend')

@section('content')
<style>
.site-header.d-flex.align-items-center {
  display: none!important;
}
.contacts .mbr-section-subtitle, .contacts .mbr-section-title, .contacts .mbr-section-text {
  color: #222;
}
.mbr-section {
  position: relative;
  padding-top: 120px;
  padding-bottom: 120px;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  background-size: cover;
}
  .mbr-table-cell {
     display: table-cell;
     float: none;
     padding-bottom: 0;
     padding-top: 0;
     position: relative;
     vertical-align: middle;
    }
    .mbr-section-title {
          text-align: center;
        }
    .mbr-section-text {
       text-align: center;
       font-size: 16px;
       color: #222;
    }
 .contacts .mbr-map {
  height: 56vh;
}
#contacts2-8 .mbr-section-title {
  text-align: right;
}
.mbr-section-hero .mbr-section-title {
  color: #222;
  margin-bottom: 1.6875rem;
}
#contacts2-8 .mbr-section-subtitle {
  font-size: 30px;
  font-family: 'Open Sans', sans-serif;
}
.display-6 {
  font-size: 1.5rem;
}
.padding-top-40 {
  padding-top: 40px;
}
</style>
 <!-- contact-details -->
 <section class="contact-details py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-300 SegoeUIL pe-4">
                                            {{ $post->getTitle() }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pb-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-11">
                        <div class="row">
                            
                            <div class="col-xl-12 d-flex justify-content-end text-center">
                                <div class="map-location">
                                <img style="width:300px" src="{{ $post->getThumbnail() }}" alt="{{ $post->getTitle() }}" class="mt-xl-0 mt-4">
                                </div>
                            </div>
                            <div class="col-xl-12 pb-5 text-center SegoeUIL" style="font-size: 18px;"> 
                                {!! $post->getContent() !!} 
                                 <div  class="w-100 fs25 text-center">
                                     <a class="btn btn-sm btn-light mh63 fs25 radius15 w-50" href="https://goo.gl/maps/cVJ2cfA68ftDYKKH7">{{ $post->getTitle() }} </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <section class="mbr-section mbr-section-hero contacts contacts2" id="contacts2-8" data-rv-view="9" style="background-color: rgb(236, 240, 241); padding-top: 0px; padding-bottom: 0px;">
       
        <!-- contact-details -->
          <div class="container-fluid">
            <div class="row">
                

                <div class="col-xs-12 col-md-6 col-lg-6 text-xs-right SegoeUIL">

                    <div class="padding-top-40"></div>
                    <div>

                      <h2 class="mbr-section-subtitle category SegoeUIL">العنوان</p>

                      <h2 class="mbr-section-title display-6 SegoeUIL">الخالدية - قطعه 3 - شارع بلودان- منزل 14</h2>

                    </div>
                    
                    <div>
                      <p class="mbr-section-subtitle category SegoeUIL">الايميل</p>

                      <h1 class="mbr-section-title display-6 SegoeUIL">HBQ.photo@gmail.com</h1>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 padding-left-0 padding-right-0">
                    <div class="mbr-map" style=" height: 56vh;">
                        <iframe frameborder="0" style="border:0 border: 0; width: 100%;height: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.5855035639424!2d47.96474131509836!3d29.323831982150168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDE5JzI1LjgiTiA0N8KwNTgnMDEuMCJF!5e0!3m2!1sen!2skw!4v1605728568239!5m2!1sen!2skw" allowfullscreen=""></iframe>
                        </div>
                </div>

            </div>
        </div>
    
</section>
@endsection
