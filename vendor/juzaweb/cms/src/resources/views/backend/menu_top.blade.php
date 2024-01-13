<div class="juzaweb__topbar">
    @php
    if(Auth::user()->usertype=='company'){
        $site_url=url('/'.Auth::user()->username);
    }else{
        $site_url=url('/');
    }
    @endphp 

    <div class="mr-4">
        <a href="{{ $site_url }}" class="mr-2" target="_blank">
            <i class="dropdown-toggle-icon fa fa-home" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Visit website"></i> Visit Site
        </a>
    </div>

    <div class="mr-auto">
        <div class="dropdown mr-4 d-none d-sm-block">
            <a href="javascript:void(0)" class="dropdown-toggle text-nowrap" data-toggle="dropdown">
                <i class="fa fa-plus"></i>
                <span class="dropdown-toggle-text"> New</span>
            </a>

            <div class="dropdown-menu" role="menu">
                
                {{--<a class="dropdown-item" href="{{ route('admin.posts.create') }}">@lang('juzaweb::app.post')</a>
                <a class="dropdown-item" href="{{ route('admin.page.create') }}">@lang('juzaweb::app.page')</a>--}}
                <a class="dropdown-item" href="{{ route('admin.users.create') }}">@lang('juzaweb::app.user')</a>
            </div>
        </div>
    </div>

    @do_action('backend.menu_top')

    <div class="juzaweb__topbar__actionsDropdown dropdown mr-4 d-none d-sm-block">
        <a href="javascript:void(0)" class="dropdown-toggle text-nowrap" data-toggle="dropdown" aria-expanded="false" data-offset="0,15">
            <i class="dropdown-toggle-icon fa fa-bell-o"></i>
        </a>
        @php
            $total = count_unread_notifications();

            $items = Auth::user()
                ->unreadNotifications()
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get(['id', 'data', 'created_at']);
        @endphp

        <div class="juzaweb__topbar__actionsDropdownMenu dropdown-menu dropdown-menu-right" role="menu">
            <div style="width: 350px;">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="jw__l1">
                            <div class="text-uppercase mb-2 text-gray-6 mb-2 font-weight-bold">@lang('juzaweb::app.notifications') ({{ $total }})</div>
                            <hr>
                            <ul class="list-unstyled">
                                @if($items->isEmpty())
                                    <p>@lang('juzaweb::app.no_notifications')</p>
                                @else
                                    @foreach($items as $notify)
                                        <li class="jw__l1__item">
                                            <a href="{{ @$notify->data['url'] }}" class="jw__l1__itemLink" data-turbolinks="false">
                                                <div class="jw__l1__itemPic mr-3">
                                                    @if(empty($notify->data['image']))
                                                        <i class="jw__l1__itemIcon fa fa-envelope-square"></i>
                                                    @else
                                                        <img src="{{ upload_url($notify->data['image']) }}" alt="">
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-blue">{{ @$notify->data['subject'] }}</div>
                                                    <div class="text-muted">{{ $notify->created_at ? $notify->created_at->diffForHumans() : '' }}</div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $user = jw_current_user();
        
    @endphp
    <div class="dropdown user-menu">
        <a href="" class="dropdown-toggle text-nowrap" data-toggle="dropdown" aria-expanded="false" data-offset="5,15">
            <img class="dropdown-toggle-avatar rounded-circle img-circle" src="{{ $user->getAvatar() }}" alt="User avatar" width="30" height="30"/>
        </a>

        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ $user->getAvatar() }}" style="width:100px; height:100px;" class="img-circle rounded-circle" alt="User Image">
                    <p style="color:black">{{ $user->name}} - Web Developer</p>
                </li>
              
                <!-- Menu Footer-->
                <li class="user-footer">
                @if($user->usertype=="company")
                <div class="pull-right">
                  <a class="btn btn-success" href="{{ route('admin.users.config',['id'=>$user->id]) }}">
                  <i class="dropdown-icon fa fa-gear"></i>
                </a>
                </div>
                  @endif
                    <div class="pull-left">
                        <a class="btn btn-primary  " href="{{ route('admin.users.edit', [$user->id]) }}">
                            <i class="dropdown-icon fa fa-user"></i>
                            <!-- {{ trans('juzaweb::app.profile') }} -->
                        </a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('logout') }}" class="btn btn-primary  " data-turbolinks="false">
                            <i class="dropdown-icon fa fa-sign-out"></i> <!-- {{ trans('juzaweb::app.logout') }} -->
                        </a>
                    </div>
                </li>
            </ul>
    </div>
</div>