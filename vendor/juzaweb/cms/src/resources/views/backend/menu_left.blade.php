<ul class="juzaweb__menuLeft__navigation">
    @php
        $adminPrefix = config('juzaweb.admin_prefix');
        $adminUrl = url($adminPrefix);
        $currentUrl = url()->current();
        $segment3 = request()->segment(3);
        $segment2 = request()->segment(2);
        $items = \Juzaweb\Support\MenuCollection::make(\Juzaweb\Facades\HookAction::getAdminMenu());
        $permissions = array();
            $user = \Auth::user();
            if(isset($user->permissions)){
                $permissions = json_decode($user->permissions,true);
            }
            //dd($user)
    @endphp

    @foreach($items as $item)
    @php
    $selected = 0;
      if($user->id==1){
         $selected=1; 
      }else{
        if(is_array($permissions[$item->get("slug")])){
                $permission=$permissions[$item->get("slug")];
                if(isset($permissions[$item->get("slug")][$item->get("slug")]) && $permissions[$item->get("slug")][$item->get("slug")]==1){
                    $selected=1;
                    
                }
            }else if($permissions[$item->get("slug")]==1){
                    $selected=1; 
            }else{
                    $selected=0; 
            }
        }   
    @endphp
        @if($item->hasChildren())
            @php
            $strChild = '';
            $hasActive = false;
            foreach($item->getChildrens() as $child) {
                $view =0;
                if($user->id==1){
                    $view=1; 
                }else{
                    if(isset($permission[$child->get("slug")])){
                        $view = $permission[$child->get("slug")];
                    }
                }
                if($view ==1){
                    $selected =1;
                }

                if (empty($segment2)) {
                    $active = empty($child->getUrl());
                } else {
                    $active = request()->is($adminPrefix .'/'. $child->get('url') . '*');
                }

                if ($active) {
                    $hasActive = true;
                }

                $strChild .= view('juzaweb::backend.items.menu_left_item', [
                    'adminUrl' => $adminUrl,
                    'item' => $child,
                    'view' => $view,
                    'active' => $active
                ])->render();
            }
            @endphp
            @if($selected ==1)
              <li class="juzaweb__menuLeft__item juzaweb__menuLeft__submenu juzaweb__menuLeft__item-{{ $item->get('slug') }} @if($hasActive) juzaweb__menuLeft__submenu--toggled @endif">
                <span class="juzaweb__menuLeft__item__link">
                    <span class="juzaweb__menuLeft__item__title">{{ $item->get('title') }}</span>
                    <i class="juzaweb__menuLeft__item__icon {{ $item->get('icon') }}"></i>
                </span>
                <ul class="juzaweb__menuLeft__navigation" @if($hasActive) style="display: block;" @endif>
                    {!! $strChild !!}
                </ul>
              </li>
            @endif
        @else
            @component('juzaweb::backend.items.menu_left_item', [
                'adminUrl' => $adminUrl,
                'item' => $item,
                'view'=>$selected,
                'active' => request()->is($adminPrefix .'/'. $item->get('url') . '*'),
            ])
            @endcomponent
        @endif
    @endforeach
</ul>