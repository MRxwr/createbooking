

<!DOCTYPE html>
<html lang="en">
<head>
	<title> {{ get_config('title') }} : We'll Be Back Soon. </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
			

	<div class="flex-w flex-str size1 overlay1">
		<div class="flex-w flex-col-sb wsize1 bg0 p-l-65 p-t-37 p-b-50 p-r-80 respon1">
			<div class="wrappic1">
				<a href="#">
					<img src="{{ upload_url(get_config('logo')) }}" alt="IMG">
				</a>
			</div>		
	
			<div class="w-full flex-c-m p-t-80 p-b-90">
				<div class="wsize2">
					<h3 class="l1-txt1 p-b-34 respon3">
						{!! $config['body_text'] !!}
					</h3>

					<p class="m2-txt1 p-b-46">
						{!! $config['footer_text'] !!}
					</p>

					<form class="contact100-form validate-form m-t-10 m-b-10">
						<div class="wrap-input100 validate-input m-lr-auto-lg" data-validate = "Email is required: ex@abc.xyz">
							<input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="email" placeholder="Email Address">

							<button class="flex-c-m ab-t-r size2 hov1">
								<i class="zmdi zmdi-long-arrow-right fs-30 cl1 trans-04"></i>
							</button>
						</div>		
					</form>
				</div>
			</div>
			
			<div class="flex-w">
				<a href="{!! $config['mt_facebook_url'] !!}" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-facebook"></i>
				</a>

				<a href="{!! $config['mt_twitter_url'] !!}" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-twitter"></i>
				</a>

				<a href="{!! $config['mt_instagram_url'] !!}" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10">
					<i class="fa fa-instagram-play"></i>
				</a>
			</div>
		</div>
			

		<div class="wsize1 simpleslide100-parent respon2">
			<!--  -->
			<div class="simpleslide100">
			    @if(isset($config['slide_1']))
			     @php $mgpath1 = upload_url($config['slide_1']);  @endphp
				    <div class="simpleslide100-item bg-img1" style="background-image: url('{{$mgpath1}}');"></div>
				@endif
				@if(isset($config['slide_2']))
			     @php $mgpath2 = upload_url($config['slide_2']);  @endphp
				    <div class="simpleslide100-item bg-img1" style="background-image: url('{{$mgpath2}}');"></div>
				@endif
				@if(isset($config['slide_3']))
			     @php $mgpath3 = upload_url($config['slide_3']);  @endphp
				    <div class="simpleslide100-item bg-img1" style="background-image: url('{{$mgpath3}}');"></div>
				@endif
				
				
			</div>
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/bootstrap/js/popper.js"></script>
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/vendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('/')}}jw-styles/themes/saycheeez/assets/maint/js/main.js"></script>

</body>
</html>