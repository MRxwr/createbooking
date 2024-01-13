<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir ="{{(app()->getLocale()=='ar'?'rtl':'ltr' )}}" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:description" content="{{ $description ?? '' }}">
    <meta name="twitter:card" content="summary">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="{{ $description ?? '' }}">

    @if($icon = get_icon())
        <link rel="icon" href="{{ $icon }}" />
    @endif

    <title>{{ $title }}</title>
    <link href="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  @if(app()->getLocale()=='ar')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/')}}jw-styles/themes/myshoots/assets/css/style-nrtl7f56.css?az=2">
  @endif
    <!--Owl Carousel CSS-->
  <link rel="stylesheet" href="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/owlcarousel/owl.carousel.css">
  <link rel="stylesheet" href="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/owlcarousel/owl.theme.default.css">
  <!--Lightbox gallery-->
  <link rel="stylesheet" href="{{asset('/')}}/jw-styles/themes/myshoots/assets/css/lightbox.min.css">
<!-- Custom styles for this template -->
  <link href="{{asset('/')}}jw-styles/themes/myshoots/assets/css/landing-page9830.css?y=2" rel="stylesheet">
       <!-- Data table CSS -->
  <link href="{{asset('/')}}backend/assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>	
    <style>
    td.disabled.day {
    color: #e7888c!important; 
    }
    td.today.disabled {
    color: #000!important; 
    }
    html, body {
    max-width: 100%;
    overflow-x: hidden;
    }
    </style>
    @do_action('theme.header')

    @yield('header')
    <script>
      var startDate='2022-01-01';
      var endDate='2046-12-31';
      var datesDisabled = ["13-03-2022"];
      var daysOfWeekDisabled = [5,6]
    </script>
</head>
<body class="{{ isset($post) ? 'single-post': '' }} {{ body_class() }}">
    @do_action('theme.after_body')

    @include('theme::header')

    @yield('content')

    @include('theme::footer')
 <!-- Bootstrap core JavaScript -->
  <script src="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/js/lightbox-plus-jquery.min.js"></script>
    <!-- Bootstrap Date-Picker Plugin -->
  
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
   @if(isset($post) &&Request::segment(1)=='package' )
    @apply_filters('theme.calendar.hooks',$post)
   @endif
  <script>

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
        //startDate: truncateDate(new Date()),
        startDate: new Date(startDate),
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
          
      }
    })
function truncateDate(date) {
  return new Date(date.getFullYear(), date.getMonth(), date.getDate());
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
  

  <script src="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/js/jquery.payform.min.js"></script>
  <script src="{{asset('/')}}jw-styles/themes/myshoots/assets/vendor/owlcarousel/owl.carousel.js"></script>
  <script>
     $(document).ready(function() {
       $('.instagram-carousel').owlCarousel({
         loop: true,
         autoplay: true,
         margin: 10,
         nav: false,
         dots: false,
         responsiveClass: true,
         responsive: {
           0: {
             items: 2
           },
           600: {
             items: 4
           },
           1000: {
             items: 6
           }
         }
       })
     })
  </script>
  <script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");
    // Declare a loop variable
    var i;
    // Full-width images
    function one() {
        for (i = 0; i < elements.length; i++) {
        elements[i].style.msFlex = "100%";  // IE10
        elements[i].style.flex = "100%";
      }
    }
    // Two images side by side
    function two() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.msFlex = "50%";  // IE10
        elements[i].style.flex = "50%";
      }
    }
    // Four images side by side
    function four() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.msFlex = "25%";  // IE10
        elements[i].style.flex = "25%";
      }
    }
    </script>
    <!-- Data table JavaScript -->
	<script src="{{asset('/')}}backend/assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('/')}}backend/assets/style/dist/js/dataTables-data.js"></script>
<script>
$(document).ready(function(){
    
	$('#book-btn').click(function(){
		var searchquery = $("input#bookingid").val();
    var dataString = 'searchquery='+searchquery;
	if(searchquery != ''){
    $('#bars1').show();
		$.ajax({
				type:'GET',
				url:'?ajaxpage=getBookingDetailsAjax',
				data: dataString,
				success:function(html){
          setTimeout(() => {
            $('#bars1').hide();
            $('#bookingDataDiv').html(html);
            $('#datable_1').DataTable({
              "bFilter": true,
              "bLengthChange": false,
              "bPaginate": true,
              "bInfo": false,
              });
            }, 1000);
				}
			}); 
		} else {
			alert("Please enter reservation number!");
			return false;
		}
	});

$("#booking_time").change(function(){
    var date = $("#booking_date").val();
    var time = this.value;
    var dataString = 'time='+time+'&date='+date;
	$.ajax({
				type:'POST',
				url:'pages/checkBookingDateTimeAjax.php',
				data: dataString,
				success:function(result){
					if(result == 1){
             $('#continue_to_payment').prop('disabled', true);
             $('#booking_time').prop('selectedIndex',0);
						 alert("Please select other time!");
					} else{
						$('#continue_to_payment').prop('disabled', false);
          }
                
				}
			}); 
			
		
			setInterval(fetchdata,900000);
  });
  

	
});

$("#contactForm").submit(function(event){
    // cancels the form submission
    event.preventDefault();
    submitForm();
});
function submitForm(){
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var subject = $("#subject").val();
    var message = $("#message").val();
  $('#bars1').show();
  $.ajax({
        type: "POST",
        url: "pages/contactFormAjax.php",
        data: "name=" + name + "&email=" + email + "&phone=" + phone + "&subject=" + subject + "&message=" + message,
        success : function(text){
            if (text == "success"){
                formSuccess();
                setTimeout(() => {
                  $('#bars1').hide();
                  formSuccess();
                  }, 1000);
                
            }
        }
    });
}
function formSuccess(){
    $( "#msgSubmit" ).removeClass( "hidden" );
}
</script>  
    @yield('footer')
    @do_action('theme.footer')
</body>
</html>