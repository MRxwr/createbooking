
@php
        $selected='';
        if(isset($checked) && $checked==1){
                $selected='checked';
           
        }else{
            $selected=''; 
        }
@endphp
<li class="juzaweb__menuLeft__item-{{ $item->get('slug') }}" style="color:#000;">
<!-- {{ $adminUrl . $item->getUrl() }} -->
    <label for="{{ $item->get('slug') }}" class="juzaweb__menuLeft__item__link @if($active) juzaweb__menuLeft__item--active @endif" style="color:#000;" href="#" @if($item->get('turbolinks') === false) data-turbolinks="false" @endif >
    <input id="{{ $item->get('slug') }}" type="hidden" name="permission[{{$parent}}][{{ $item->get('slug') }}]" value="0" >
    <input id="{{ $item->get('slug') }}" type="checkbox" name="permission[{{$parent}}][{{ $item->get('slug') }}]" value="1" {{$selected}} >
        <span class="juzaweb__menuLeft__item__title" style="color:#000;">{{ $item->get('title') }}</span>{{$checked}}
        <!-- <i class="juzaweb__menuLeft__item__icon {{ $item->get('icon') }}"></i> -->
    </label>
</li>
