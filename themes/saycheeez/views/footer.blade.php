          <!-- site-footer -->
          <footer class="site-footer bg-dark text-white d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 offset-xl-4 col-sm-6 d-flex align-items-center justify-content-center">
                    <p >
                            Copyright 2022 - <a href="#" class="text-dark">{{ get_config('title') }}</a> 
                        
                       <a href="http://createkuwait.com/" target="_blank" class="text-dark">Developed by createkuwait</a>
                        </p>
                    </div>
                    <div class="col-xl-4 col-sm-6 d-flex align-items-center justify-content-center mt-4 mt-sm-0">
                    <ul class="social-list d-flex align-items-center">
                    
                  
                                @php
                                    $youtube  = get_theme_config('youtube');
                                    $facebook  = get_theme_config('facebook');
                                    $instagram = get_theme_config('instagram');
                                    $twitter   = get_theme_config('twitter');
                                    $whatsapp  = get_theme_config('whatsapp');
                                    $email  = get_theme_config('email');
                                    $snapchat  = get_theme_config('snapchat');
                                @endphp
                                @if($youtube)
                                <li class="ms-3">
                                    <a href="{{$youtube}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/yt.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                                @if($instagram)
                                    <li class="ms-3">
                                        <a href="{{$instagram}}">
                                            <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/in.svg" alt="img">
                                        </a>
                                    </li>
                                @endif
                                
                                 @if($twitter)
                                <li class="ms-3">
                                    <a href="{{$twitter}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/tw.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                                @if($facebook)
                                <li class="ms-3">
                                    <a href="{{$facebook}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/fb.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                                @if($snapchat)
                                <li class="ms-3">
                                    <a href="{{$snapchat}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/sn.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                                 @if($email)
                                <li class="ms-3">
                                    <a href="mailto:{{$email}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/email.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                                @if($whatsapp)
                                <li class="ms-3">
                                    <a href="https://wa.me/{{$whatsapp}}">
                                        <img src="{{asset('/')}}jw-styles/themes/saycheeez/assets/img/wh.svg" alt="img">
                                    </a>
                                </li>
                                @endif
                               
                            </ul>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- site-footer -->
       

