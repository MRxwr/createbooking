@extends('juzaweb::layouts.frontend')
@section('content')
 @php
    $title =$company->name;
    $enable_single_package = $company->config["enable_single_package"];
   if($enable_single_package==1){
    $package_id = $company->config["package_id"];
    $post = \Sbhadra\Photography\Models\Package::find($package_id);
   }
    $enable_multiservice = $company->config["enable_multiservice"];
    $booking_type = $company->config["booking_type"];
@endphp
@if($enable_single_package==1)
 @include('theme::template-parts.booking-form')
@else
   <?php 
     $packages = \Sbhadra\Photography\Models\Package::where('status','publish')->where('company_id',$company->id)->get();
     if($packages){
              //var_dump($packages);
              if($packages->count()==1){
                  foreach($packages as $key=>$package){
                      $package_id =$package->id;
                      $post = \Sbhadra\Photography\Models\Package::find($package->id);
                      
                  }?>
                 @include('theme::template-parts.booking-form')
                <?php  }else{
              $html ='<div class="row m-0 w-100">
            <div class="col-md-12">
          <h3 class="fs30 text-600 SegoeUISB text-uppercase SegoeUIL px-5">'.trans('theme::app.our_packages').'
          </h3>
        </div>
        <div class="col-md-12">
          <div class="col-xl-12">
              <div class="row justify-content-center">';

                foreach($packages as $key=>$package){
                      $slug = ($package->is_theme_category==1?url('/theme-categoris?slug='.$package->slug):url('package/'.$package->slug.'?cat=all'));
                      $html .= '<div class="col-lg-4 px-xl-5 col-sm-6 mb-4">
                                  <div class="pack_item">
                                      <div class="pack_head d-flex align-items-center justify-content-center">
                                          <img src="'.url('jw-styles/themes/saycheeez/assets/img/camera.svg').'" alt="img" class="mw-100">
                                          <h4 class="fs26 text-600 SegoeUISB position-absolute pt-5">
                                          '.$package->title.'
                                          </h4>
                                      </div>
                                      <p class="fs17 px-1 py-1 text-center">
                                      '.str_replace('<ul>',' <ul class="package-list ps-4">',$package->short_description).' 
                                      </p>
                                      <div class="pack_img">
                                          <img src="'. upload_url($package->thumbnail) .'" alt="img" class="w-100">
                                      </div>
                                      <a href="'.$slug .'" class="fs18 mt-4 btn btn-dark radius0 w-100">
                                      '.trans('theme::app.book_now').'
                                      </a>
                                  </div>
                              </div>';

                      }
                      $html .='</div></div></div></div>';
     echo $html;
              }
                     
           }
   ?>
    
  @endif       
@endsection
@section('footer')
     <script>
        $(".serviceBLk ").on('click', function(event){
            //$( ".serviceBLk " ).removeClass("active");
            $(this).addClass("active ");
            $('#booking_time').val(this.id);
            //alert(this.id);
        });
    </script>
    <script>
    $(document).ready(function(){
        $("#booking_modal_now").on('click', function(event){
            var booking_time = $('#booking_time').val();
            var booking_total_price = $('#booking_total_price').val();
            var stat=0;
           // alert(booking_time);
            if(booking_total_price>0 && booking_time!='' ){
                stat=1;
            }
            if(stat==1){
                $('#exampleModal').modal('show'); 
            }else{
                alert('Please select time slot and Package type');
            }
            //$('#exampleModal').modal('show');
        });

        var limit = 2;
        $('input.theme_checkbox').on('change', function(evt) {
           
        if($('.theme_checkbox').filter(':checked').length >limit) {
            alert('You can select max 2 themes');
            this.checked = false;
          }
        });
    });
</script>
@endsection
