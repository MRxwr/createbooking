<?php

namespace Sbhadra\Packagetypes\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Illuminate\Support\Facades\DB;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Packagetypes\Models\PackageType;
use Sbhadra\Packagetypes\Models\PackageTypeAttribute;

class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'packageThemeField']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerPackageType']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'AdminPackageThemeField']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'updatepackagefield']);
       
    }

    public function registerPackageType()
    {
      HookAction::addAdminMenu(
        trans('sbha::app.Pictures_type'),
        'package-type',
        [
            'icon' => 'fa fa-list',
            'position' => 6,
            'parent' => 'packages',
        ]
      );
        
    }

    public function AdminPackageThemeField(){
      add_action('post_type.package.form.right', function($model){
        
        $pAttrs = (array) json_decode($model->package_type_attributes);
        //dd($pAttrs);
         $html='';
           $packagetypes= PackageType ::where('status',1)->get();
           if(!empty($packagetypes)){
              $html .='<div class="form-group">
                <label class="col-form-label" for="is_pieces">'.trans('sbha::app.Pictures_type').'</label>
                <div class="accordion-container">';
                foreach($packagetypes as $type){
                  $attrs=array();
                  if(isset($pAttrs[$type->id])){
                    $attrs = $pAttrs[$type->id];
                  }
                  $packagetypeAttrs= PackageTypeAttribute ::where('package_type_id',$type->id)->where('status',1)->get();
                     $html .='<div class="set">
                          <a href="javascript:void(0)"><i class="fa fa-plus"></i>'.$type->title.' <span class="fa fa-question" style="float:right"  data-toggle="tooltip" data-placement="right" title="'.$type->note.'"></span></a> 
                          <div class="content">';
                          foreach($packagetypeAttrs as $attr){
                            $checked='';
                             if(in_array($attr->id,$attrs)){
                               $checked ='checked';
                             }
                             if($attr->is_theme==1){
                                 $thm='Album picture';
                             }else{
                                 $thm='Normal picture';
                             }
                            $html .='<label class="col-form-label" for="ta'.$type->id.'_'.$attr->id.'"><input type="checkbox" id="ta'.$type->id.'_'.$attr->id.'" name="attr['.$type->id.'][]" value="'.$attr->id.'" '.$checked.'>'.$attr->title.'('.$attr->price.'KD) - <strong>'. $thm.'</strong></label>';
                          }
                    $html .='</div> </div>';
                  }
              $html .='</div>
            </div>';
            }
          echo  $html;
      }, 17, 1);
      add_action('juzaweb_header', function(){
        echo '<style>
                .accordion-container{
                  position: relative;
                  max-width: 500px;
                  height: auto;
                  margin: 10px auto;
                }
                .accordion-container > h2{
                  text-align: center;
                  color: #fff;
                  padding-bottom: 5px;
                  margin-bottom: 20px;
                  padding-bottom: 15px;
                 
                }
                .set{
                  position: relative;
                  width: 100%;
                  height: auto;
                  
                  border: 1px solid #f5f5f5;
                }
                .set > a{
                  display: block;
                  padding: 5px 15px;
                  text-decoration: none;
                  color: #555;
                  font-weight: 600;
                  -webkit-transition: all 0.2s linear;
                  -moz-transition: all 0.2s linear;
                  transition: all 0.2s linear;
                  height: 48px;
                  
                }
                .set > a i {
                  float: left;
                  margin: 5px 10px;
                  height: 30px;
                  width: 30px;
                  background-color: #ccc;
                  padding: 11px;
                  font-size: 10px;
                  border-radius: 50%;
                }
                .set > a.active{
                  background-color:#fff;
                  color: #333;
                }
                .content{
                  background-color: #fff;
                  display:none;
                }
                .content label{
                  padding: 5px;
                  margin-left: 40px;
                  color: #333;
                }
                .content label input{
                  margin-right: 15px;
                }
        </style>';
      }, 15, 1);
      add_action('juzaweb_footer', function(){
        echo '<script>
                $(document).ready(function() {
                  $(".set > a").on("click", function() {
                    if ($(this).hasClass("active")) {
                      $(this).removeClass("active");
                      $(this)
                        .siblings(".content")
                        .slideUp(200);
                      $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                    } else {
                      $(".set > a i")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                      $(this)
                        .find("i")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                      $(".set > a").removeClass("active");
                      $(this).addClass("active");
                      $(".content").slideUp(200);
                      $(this)
                        .siblings(".content")
                        .slideDown(200);
                    }
                  });
                });
            </script>';
        
      }, 15, 1);
    }
    
    public function updatepackagefield(){
      add_action('plugin.package.update', function($model){ 
          if(isset( $_REQUEST)){
             $request = $_REQUEST;
             if(isset($request['attr'])){
                 $model->package_type_attributes = $request['attr'];
             }
             $model->save();
          }
         
       
      }, 15, 1);
   }
//juzaweb_header

public function packageThemeField(){
  add_action('theme.reservation.exfields', function($model){
    $model = Package::find($_REQUEST['id']);
    $pAttrs='';
    if(isset($model->package_type_attributes)){
      $pAttrs = (array) json_decode($model->package_type_attributes);
    }
    //dd($pAttrs);
     $html='';
       $packagetypes= PackageType ::where('status',1)->where('ptype',$_REQUEST['type'])->get();
       if(!empty($packagetypes)){
          $html .='<div class="col-sm-12 pe-xl-5 pt-4">
                     <div class="package-head bg-light radius15 mh53 py-1 px-3 mb-4 d-inline-flex align-items-center">
                       <h4  class="fs23">'.trans('theme::app.Pictures_type').'</h4>
                       </div>
                       </div>
                  <div class="col-xxl-9">
                    <div class="form-control border accordion-container">';
                    $html .= '<input type="hidden"  name="pictures_type_price" id="pictures_type_price" value="0.00">';
            foreach($packagetypes as $type){
              $attrs=array();
              if(isset($pAttrs[$type->id])){
                $attrs = $pAttrs[$type->id];
              }
              $packagetypeAttrs= PackageTypeAttribute ::where('package_type_id',$type->id)->where('status',1)->get();
              if(!empty($attrs)){
                 $html .='<div class="set">
                      <a class="fs23" href="javascript:void(0)"><!--<i class="fa fa-plus"></i><span> --!>'.$type->title.'</span> <!--<span class="fa fa-question" style="float:right"  data-toggle="tooltip" data-placement="right" title="'.$type->note.'"></span> --!></a> 
                      <div class="content">';
                      foreach($packagetypeAttrs as $attr){
                        $checked='';
                        if($attr->is_theme==1){
                          $thm='Album Picture';
                          }else{
                              $thm='Normal Picture';
                          }
                          $thm='';
                         if(in_array($attr->id,$attrs)){
                           $checked ='';
                           $html .='<label class="fs23 d-flex align-items-center" for="ta'.$type->id.'_'.$attr->id.'"><input class="pictype" style="margin: 5px; width: 25px; min-height: 25px;" type="radio" id="ta'.$type->id.'_'.$attr->id.'" name="pictures_type" data-price="'.$attr->price.'" value="'.$attr->title.'('.$attr->price.'KD)" '.$checked.'>'.$attr->title.'(<span style="color: #f70505 !important;font-weight: bold;" >'.$attr->price.'KD </span>)</label>';
                         }
                        
                        //$html .='<label class="fs23 d-flex align-items-center" for="ta'.$type->id.'_'.$attr->id.'"><input class="pictype" style="margin: 5px; width: 25px; min-height: 25px;" type="radio" id="ta'.$type->id.'_'.$attr->id.'" name="pictures_type" data-price="'.$attr->price.'" value="'.$attr->id.'" '.$checked.'>'.$attr->title.'('.$attr->price.'KD) - <strong>'. $thm.'</strong></label>';
                      }
                   $html .='</div> </div>';
                }
              }
          $html .='</div>
                </div>';
        }
      echo  $html;
  }, 17, 1);
  add_action('theme.header', function(){
    echo '<style>
            .accordion-container{
              direction:'.(app()->getLocale()=='ar'?'rtl':'ltr').';
              position: relative;
              width: 100%;
              height: auto;
              margin: 10px 10px;
            }
            .accordion-container > h2{
              text-align: center;
              color: #fff;
              padding-bottom: 5px;
              margin-bottom: 20px;
              padding-bottom: 15px;
             
            }
            .set{
              position: relative;
              width: 100%;
              height: auto;
              border: 1px solid #f5f5f5;
            }
            .set > a{
              display: block;
              padding: 5px 15px;
              text-decoration: none;
              color: #555;
              font-weight: 600;
              -webkit-transition: all 0.2s linear;
              -moz-transition: all 0.2s linear;
              transition: all 0.2s linear;
              height: 48px;
              
            }
            .set > a i {
              float: left;
              margin: 5px 10px;
              height: 30px;
              width: 30px;
              background-color: #ccc;
              padding: 11px;
              font-size: 10px;
              border-radius: 50%;
            }
            .set > a.active{
              background-color:#fff;
              color: #333;
            }
            .content{
              background-color: #fff;
              /*display:none;*/
            }
            .content label{
              padding: 5px;
              margin-left: 40px;
              color: #333;
              width: 100%;
            }
            .content label input{
              margin-right: 15px;
            }
    </style>';
  }, 15, 1);
  add_action('theme.footer', function(){
    echo '<script>
            $(document).ready(function() {
              $(".set2 > a").on("click", function() {
                if ($(this).hasClass("active")) {
                  $(this).removeClass("active");
                  $(this)
                    .siblings(".content")
                    .slideUp(200);
                  $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
                } else {
                  $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
                  $(this)
                    .find("i")
                    .removeClass("fa-plus")
                    .addClass("fa-minus");
                  $(".set > a").removeClass("active");
                  $(this).addClass("active");
                  $(".content").slideUp(200);
                  $(this)
                    .siblings(".content")
                    .slideDown(200);
                }
              });
            });
        </script>';
    
  }, 17, 1);
 }
}
