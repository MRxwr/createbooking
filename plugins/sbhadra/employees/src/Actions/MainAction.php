<?php

namespace Sbhadra\Employees\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;


class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
       
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'userPermistionlist']);
    }

    public function userPermistionlist()
    {
        $this->addAction('post_type.users.form.right', function($model){
            $userId = \Auth::id();
            $permissions = array();
            if(isset($model->permissions)){
                $permissions = json_decode($model->permissions,true);
            }
            $html = '';
            $html .= '<div class="row">';
        
               $adminPrefix = config('juzaweb.admin_prefix');
               $adminUrl = url($adminPrefix);
               $currentUrl = url()->current();
               $segment3 = request()->segment(3);
               $segment2 = request()->segment(2);
               $items = \Juzaweb\Support\MenuCollection::make(\Juzaweb\Facades\HookAction::getAdminMenu());
               
               foreach($items as $item){
                //var_dump($item);
                $strChild = '';
                $hasActive = false;
                $selected='';
                //var_dump($permissions);
                $permission = array();
                //var_dump($item->get("slug"));
                if(!empty($permissions) && array_key_exists($item->get("slug"),$permissions) && is_array($permissions[$item->get("slug")])){
                    $permission=$permissions[$item->get("slug")];
                    if(isset($permissions[$item->get("slug")][$item->get("slug")]) && $permissions[$item->get("slug")][$item->get("slug")]==1){
                        $selected='checked';
                        
                    }
                }else if(!empty($permissions) && array_key_exists($item->get("slug"),$permissions) &&  $permissions[$item->get("slug")]==1){
                    $selected='checked'; 
                }else{
                    $selected=''; 
                }

                //var_dump($permission);

                foreach($item->getChildrens() as $child) {
                    $checked =0;
                    if(isset($permission[$child->get("slug")])){
                        $checked = $permission[$child->get("slug")];
                    }
                    
                    if (empty($segment2)) {
                        $active = empty($child->getUrl());
                    } else {
                        $active = request()->is($adminPrefix .'/'. $child->get('url') . '*');
                    }
    
                    if ($active) {
                        $hasActive = true;
                    }
                    //echo $checked;
                    $strChild .= view('sbem::menu_left_item', [
                        'adminUrl' => $adminUrl,
                        'item' => $child,
                        'parent' => $item->get("slug"),
                        'checked'=>$checked,
                        'active' => $active
                    ])->render();
                }
                
                $html .='<div class="col-md-4">
                          <label for="'.$item->get("slug") .'" class="juzaweb__menuLeft__item__link" style="color:#000;">
                            <input id="'.$item->get("slug") .'"  type="hidden" name="permission['.$item->get("slug") .']" value="0" >
                            <input id="'.$item->get("slug") .'"  type="checkbox" name="permission['.$item->get("slug") .']" value="1" '.$selected.' >
                            <span class="juzaweb__menuLeft__item__title" style="color:#000;">'.$item->get("title").'</span>
                         </label>
                        <ul style="color:#000;">
                        '.$strChild.'
                        </ul>
                    </div>';
                
                }
            $html .= '</div>';
            if($model->id !=$userId){
                echo   $html ;
            }
           
       }, 20, 1);
    }
 

}
