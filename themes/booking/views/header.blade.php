<!-- header -->

<div class="headerClass">
            <div class="row m-0 w-100" style="height: 50px;">
                <div class="col-4 d-flex align-items-center justify-content-center">
                <?php 
                $enable_multilanguage = get_config('enable_multilanguage');
                if($enable_multilanguage==1){ ?>
					<select class="btn selectpicker" data-width="fit" id="change_language">
                        @if(app()->getLocale()=='ar')
                            <option  value="">@lang('theme::app.arabic')</option>
                            <option  value="{{URL::current()}}?lang=en">@lang('theme::app.english')</option>
                        @else 
                            <option  value="">@lang('theme::app.english')</option>
                            <option  value="{{URL::current()}}?lang=ar">@lang('theme::app.arabic')</option>
                        @endif
					</select>
                <?php } ?>
                </div>
                <div class="col-8 d-flex align-items-center justify-content-center">
                   {{ $title }}
                </div>
            </div>
        </div>	<!-- end of header -->

	<!-- mobile hero section -->

	<div class="row m-0 w-100">
        <div class="col-12 p-0 d-block d-md-none">
            <div class="heroBg">
                <div class="heroLogoBg">
                <img src="{{ $logo}}" class="heroLogo">
                </div>
            </div>
        </div>
    </div>
	
	<!-- end of mobile hero section -->

	<!-- social Media Bar -->
	<div class="row py-3 m-0">
	<div class="col-md-12 d-flex justify-content-center align-items-center">
		<div class="row p-3 socialMediaBar">
            @if($youtube)
                <!-- <a href="{{$youtube}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv">
                    <span class="socialMediaSpan"><i class="fa fa-youtube" aria-hidden="true"></i></span>
                </a> -->
            @endif
            @if($instagram)
                    <a href="{{$instagram}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                            <span class="socialMediaSpan"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                    </a>
            @endif
            
            @if($twitter)
            
                <a href="{{$twitter}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                        <span class="socialMediaSpan"><i class="fa fa-twitter" aria-hidden="true"></i></span>
                </a>
            
            @endif
            @if($facebook)
            <a href="{{$facebook}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                    <span class="socialMediaSpan"><i class="fa fa-facebook" aria-hidden="true"></i></span>
            </a>
            
            @endif
            @if($snapchat)
                <a href="{{$snapchat}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                        <span class="socialMediaSpan"><i class="fa fa-snapchat" aria-hidden="true"></i></span>
                </a>
            @endif
           
            @if($whatsapp)
                <a href="https://wa.me/{{$whatsapp}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                        <span class="socialMediaSpan"><i class="fa fa-whatsapp" aria-hidden="true"></i></span>
                </a>
            @endif
            @if($email)
            
            <a href="mailto:{{$email}}" class="col-2 d-flex align-items-center justify-content-center socialIconDiv" target="_blank">
                <span class="socialMediaSpan"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            </a>
        
        @endif
            <!-- <a class="col-2 d-flex align-items-center justify-content-center socialIconDiv">
                <span class="socialMediaSpan"><i class="fa fa-globe" aria-hidden="true"></i></span>
            </a> -->
			
		</div>

	</div>
</div>	<!-- end of social media bar -->
	