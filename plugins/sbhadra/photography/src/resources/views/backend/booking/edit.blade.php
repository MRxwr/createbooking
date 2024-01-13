@extends('juzaweb::layouts.backend')
@section('content')
<style>
    .col-sm-6.col-md-2.theme-select {
          overflow: hidden;
          text-align: center;
          border: 1px solid #63636357;
          margin: 5px;
      }
     #totalprice {
         color: #fff;
     }
     .package-head.bg-success.radius15.mh67.py-1.px-3.mb-4 {
        float: right;
    }
</style>
<script>
      var startDate='2022-01-01';
      var endDate='2046-12-31';
      var datesDisabled = ["13-01-2022"];
      var daysOfWeekDisabled = [5,6]
</script>
    <?php 
        $id =0;
       if(isset($_REQUEST['id'])){
         $id = @(isset($_REQUEST['id'])?$_REQUEST['id']:0 );
        } 
     ?>
    <div class="form">
         <form action="{{url()->current()}}" method="get">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group row">
                    <label for="" class="col-sm-5 col-md-4 col-form-label">Select Package:</label>
                            <div class="col-sm-7 col-md-8">
                                <select class="form-control form-control-lg" name="id" onchange="packageRedirect(this.value);" required disabled>
                                    @foreach($packages as $package)
                                    <option value="{{$package->id}}" @if($id==$package->id) selected="selected" @endif> {{$package->title}}</option>
                                    @endforeach
                                </select> 
                            </div>
                    </div>
            </div>
            <div class="col-md-7">
            <div class="form-group"> <!-- Date input -->
                <input type="hidden" name="package_id" id="package_id" value="{{ $post->id }}">
                <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                <input class="form-control" id="date" name="date" value="@if(isset($_REQUEST['date'])) {{$_REQUEST['date']}} @endif" placeholder="MM/DD/YYY" type="text" required/>
                <div id="bookingdate"></div>
              </div>
              <div class="btn-group float-right" style="display:none;"><button type="submit" id="date_change" class="btn btn-success px-5"><i class="fa fa-save"></i> Next</button> </div>
            </div>
            </div>
        </form>
    </div>

   

    <div @if(isset($_REQUEST['date']) && ($_REQUEST['date']!='') ) style="display:block" @else style="display:none" @endif>
    @component('juzaweb::components.form_resource', [
        'model' => $model,
    ])
    <div class="row">
            <div class="col-md-8">
                <div class="row">
                <input type="hidden" name="title" id="title" value="{{$model->title}}">
                <input type="hidden" name="slug" id="slug" value="CPBK{{time()}}">
                 <input type="hidden" name="total_price" id="" value="{{$model->total_price}}">
                    <div class="col-12">
                    <h2 class="shoots-Head2">Booking Information</h2>
                    </div>
                    <div class="col-md-8 col-sm-10">
                    @if(isset($_REQUEST['date']) && ($_REQUEST['date']!='') )
                    <div class="form-group row">
                            <label for="" class="col-sm-5 col-md-4 col-form-label">Old Date/Time:</label>
                            <div class="col-sm-7 col-md-8">
                            {{$model->booking_date}} : {{$model->timeslot->starttime}} - {{$model->timeslot->endtime}}
                            </div>
                        </div>
                    
                        @do_action('admin.reservation.data')
                        @do_action('admin.reservation.time')
                    @endif
                        @do_action('admin.reservation.fields')
                    </div>
                </div>
                

                @do_action('post_type.'. $postType .'.form.left')

            </div>

            <div class="col-md-4 text-right">
                <div class="col-sm-12 pe-xl-5 pt-4 text-right">
                    <div style="width:225px;margin-right: -10px;"  class="package-head bg-success radius15 mh67 py-1 px-3 mb-4 "> 
                        <h4 id="booking_total" class="fs23" style="padding: 20px;">{{$model->total_price}}KD</h4>
                    </div>
            </div>
               
            </div>
            </div>
            @endcomponent
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/> 
        <style>
            .datepicker-inline{
            width: 100%;
            }
            .datepicker table {
            margin: 0;
            
            width: 100%;
        }
        </style>
      
        @do_action('admin.calendar.hooks')
 
        <script>
        var packageRedirect = function(id){
            var durl = "{{url()->current()}}?id="+id;
            window.location = durl;
        }
        $(document).ready(function(){
            var date_input=$('#bookingdate'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: "dd-mm-yyyy",
                inline:true,
                sideBySide: true,
                container: container,
                todayHighlight: true,
                daysOfWeekDisabled: daysOfWeekDisabled,
                datesDisabled:datesDisabled,
                autoclose: true,
                startDate: truncateDate(),
                //startDate: new Date(startDate),
                endDate: new Date(endDate),
                icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down"
                        },
            };
            date_input.datepicker(options).on('changeDate', showTestDate);
            function showTestDate(){
            var value = $('#bookingdate').datepicker('getFormattedDate');
                $("#date").val(value);
                $("#date_change").click();
                
            }
            })
            function truncateDate(date) {
                //alert(startDate);
                var date = new Date();
                var st = new Date(startDate);
                if(st.getTime()>date.getTime()){
                return new Date(startDate);
                }else{
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
             }
            }
            $(document).ready(function(){
                $('#booknow').click(function(){
                var date = $("#date").val();
            var package_id = $("#package_id").val();
                if(date != ""){
                window.location.href = "{{url('/reservations')}}?id="+package_id+"&date="+date;
                } else{
                    alert("Please select date!"); 
                    return false;
                }
            });
            })
        </script>
        <script>
         $(document).ready(function(){
            //set_package_price();
          });
$("body").on("click", ".xprice", function(e) {
    //alert('okey')
    calculate_price();
  });
 var set_package_price = function(){
   var package_price = $("#package_price").val();
    localStorage.setItem("total_price",package_price);
    localStorage.setItem("package_price",package_price);
    localStorage.setItem("exprice",0.00);
    localStorage.setItem("noofpieces_price",0.00);
    localStorage.setItem("picture_type_price",0.00);
    //alert(package_price);
    $("#booking_total_price").val(package_price);
    $('#totalprice').text(package_price+'KD');
  }

  var calculate_price = function(){
    var exprice = 0.00;
    //var package_price = $('#booking_price').val()
    var package_price = localStorage.getItem("package_price");
    var noofpieces_price = localStorage.getItem("noofpieces_price");
    var picture_type_price = localStorage.getItem("picture_type_price");
    setTimeout( function() 
      {
          $("input:checkbox[name='service_item[]']:checked").each(function(){
            exprice = parseFloat(exprice) + parseFloat($(this).attr('data-exprice'));
          });
          localStorage.setItem("exprice",exprice);
          var itemval=35.500;
          var total_price =  (parseFloat(package_price) + parseFloat(exprice) + parseFloat(noofpieces_price) + parseFloat(picture_type_price)); 
          localStorage.setItem("total_price",total_price);
          $("#booking_total_price").val(total_price);
          $('#totalprice').text(total_price+'KD');
      }, 2000);
      
  }
        </script>
     @do_action('admin.booking.script')

@endsection
