<?php

namespace Sbhadra\Packagethemes\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Packagethemes\Models\Theme;
use Juzaweb\Models\Taxonomy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerPackage']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getPackageThemes']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'doProcessPackageThemes']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getThemesByCategory']);
        
    }

    public function registerPackage()
    {
       
        HookAction::registerPostType('package-themes', [
            'label' => trans('sbpa::app.theme'),
            'model' => Theme::class,
            'menu_position' => 34,
            'parent' => 'packages',
            'menu_icon' => 'fa fa-list',
        ]);
        HookAction::registerTaxonomy('categories', 'package-themes', [
            'label' => trans('sbpa::app.categories'),
            'menu_position' => 6, 
        ]); 
        
    }
    public function getPackageThemes()
    {
        add_filters('theme.cstudio.theme_category', function(){
            $taxonomies = Taxonomy::where('post_type','package-themes')->where('taxonomy','categories')->get();
            $options = '';
            foreach($taxonomies as $taxonomy ){
                $options .='<option value="'.$taxonomy->slug.'">'.$taxonomy->name.'</option>';
            }
            $html ='<div class="package-head bg-light radius15 mh53 py-1 px-3 mb-3 d-inline-flex align-items-center">
                    <h4 class="fs23">
                        '.trans('sbpa::app.theme').':
                    </h4>
                </div>
                <div class="package-body text-muted mb-5 pb-4 pt-3">
                    <select class="form-control teheme2" id="package_category">
                        <option value="0">All</option>
                    '.$options.'
                    </select>
                </div>';
            
            return $html;
         });

        
       
        add_filters('theme.cstudio.themes4sd', function(){
            $themes = Theme::get();
            $html ='';
            if(!empty($themes)){
                    $html .='<div class="col-xl-10 pe-xxl-0"><div class="theme_select_slider owl-carousel owl-theme">';
                    foreach($themes as $theme){
                        $html .='<div class="theme-select">
                        <label class="container_radio themeCheck">
                            <label for="slect'.$theme->id.'" class="d-inline-block">'.$theme->title.'</label>
                            <input type="radio" id="slect'.$theme->id.'" value="'.$theme->id.'" name="theme_id">
                            <span class="checkmark"></span>
                            <a href="'.$theme->getThumbnail().'" class="themeCheck_img image-link border">
                                <img src="'.$theme->getThumbnail().'" alt="img" class="w-100">
                            </a>
                        </label>
                    </div>';
                     }
                    $html .='</div> </div>';
                    $html .='<div class="col-xl-12 pt-5 d-flex align-items-center justify-content-center">
                    <button class="owl-arrow MyPrevButton">Previous</button>
                    <button class="owl-arrow MyNextButton">Next</button>
                </div>';
            }
            return $html;
         });

         add_action('theme.footer', function() {
            $html = '<script>
                    $("#package_category").change(function() {
                        var categoryid = $("#package_category").val();
                        $.ajax({
                            type: "GET",
                            url: "?ajaxpage=getThemesByCategory",
                            data: "categoryid=" + categoryid ,
                            success : function(res){
                                $( "#th_result" ).html( data );
                            }
                         });
                    });
               </script>';
           echo  $html;
        }, 15, 1);

    }
    public function getThemesByCategory(){
        if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage'] =='getThemesByCategory' ){
            if(isset($_REQUEST['categoryid'])){
                $taxonomy = Taxonomy::where('slug', $_REQUEST['categoryid'])->firstOrFail();
                $postType = $taxonomy->getPostType('model');
                $posts = $postType::paginate();
                //dd($posts);
            }
        exit;
       }
    }
   
    public function doProcessPackageThemes(){
        add_action('theme.booking.extra', function($payment_data) {
            $booking = Booking::find($payment_data['booking_id']);
            if(isset($payment_data['theme_id'][0])){
                $theme_id =  $payment_data['theme_id'][0];
                $booking->theme_id =  $theme_id ;
            }
            if(isset($payment_data['theme_id'][1])){
                $theme_id =  $payment_data['theme_id'][1];
                $booking->theme_2id =  $theme_id ;
            }
            $booking->save();
        }, 10, 1);
    }



}
