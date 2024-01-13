@extends('juzaweb::layouts.frontend')

@section('content')

<?php
 $enable_multiservice = get_config('enable_multiservice');
 $enable_single_package = get_config('enable_single_package');
 
    if($enable_single_package==1){
     $package_id = get_config('package_id'); 
     $post = \Sbhadra\Photography\Models\Package::find($package_id);
   }
?>
@if($enable_single_package==1)
@include('theme::template-parts.booking-form')
@else
   
    <div class="row m-0 w-100">
        <div class="col-md-12">
          <h3 class="fs30 text-600 SegoeUISB text-uppercase SegoeUIL px-5">
            @lang('theme::app.our_packages')
          </h3>
        </div>
        <div class="col-md-12">
           @do_action('theme.homepackages')
        </div>
    </div>
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
