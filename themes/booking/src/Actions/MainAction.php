<?php
/**
 * CreatePhoto - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Sonjoy Bhadra <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Theme\Actions;

use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Photography\Models\Package;
use Sbhadra\Photography\Models\Service;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Photography\Models\Timeslot;
use Sbhadra\Photography\Models\Branch;
use Juzaweb\Models\Taxonomy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Juzaweb\Models\EmailList;
use Illuminate\Support\Arr;
use Sbhadra\Packagethemes\Models\Theme;
use Juzaweb\Models\Page;
use Sbhadra\Photography\Models\Setting;

class MainAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'cStudioThemePackages']);
        $this->addAction(Action::JUZAWEB_INIT_ACTION, [$this, 'registerTemplates']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addBreadcrumbs']);
        $this->addAction(Action::JUZAWEB_INIT_ACTION, [$this, 'sendContactMail']); 
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'packageThemeField']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'updatepackagefield']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addBodyClass']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addFrontCategories']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addThemeExtraFields']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'doProcessPackageThemes']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getHomeAboutContent']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getTermsAndConditionContent']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getThemeFixedPriceText']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'themeServiceSloteScript']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getBranchService']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'generateBookingQR']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addCompanyBodyClass']);
        // $this->addAction(Action::WIDGETS_INIT, [$this, 'registerSidebars']);
        // $this->addAction(Action::WIDGETS_INIT, [$this, 'registerWidgets']);
    }
    
    
    public function cStudioThemePackages()
    {
        // $this->addAction('theme.header', function () {
        //     echo e(view('theme::components.header_script'));
        // });
    }


    public function addHeaderSlider()
    {
        // $this->addAction('theme.slider', function () {
        //     echo e(view('theme::components.header_script'));
        // });
    }

    public function addBreadcrumbs(){
        $this->addAction('theme.breadcrumbs', function () {
            echo  '<section class="breadcrumbs bg-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <ul class="breadcrumbs_list d-flex align-items-center">
                                    <li><a href="'.url('/').'" class="fs45 text-700 text-primary CarrinadyB">Home </a></li>
                                    <li><a href="#" class="fs45 text-700 text-primary CarrinadyB"> Graduation</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>';
                });
    }
    public function addStyles()
    {
        //HookAction::enqueueFrontendScript('main', 'assets/js/main.js');
        //HookAction::enqueueFrontendStyle('main', 'assets/css/main.css');
    }

    public function registerTemplates()
    {
        HookAction::registerThemeTemplate('home', [
            'name' => trans('theme::app.home'),
            'view' => 'templates.home',
        ]);
        HookAction::registerThemeTemplate('home', [
            'name' => trans('theme::app.home'),
            'view' => 'templates.home',
        ]);
        HookAction::registerThemeTemplate('contact-us', [
            'name' => trans('theme::app.contact-us'),
            'view' => 'templates.contact-us',
        ]);
        HookAction::registerThemeTemplate('gallery', [
            'name' => trans('theme::app.gallery'),
            'view' => 'templates.gallery',
        ]);
        HookAction::registerThemeTemplate('reservations', [
            'name' => trans('theme::app.reservations'),
            'view' => 'templates.reservations',
        ]);
        HookAction::registerThemeTemplate('reservations-check', [
            'name' => trans('theme::app.reservations-check'),
            'view' => 'templates.reservations-check',
        ]);
        HookAction::registerThemeTemplate('success', [
            'name' => trans('theme::app.success'),
            'view' => 'templates.success',
        ]);
        HookAction::registerThemeTemplate('failed', [
            'name' => trans('theme::app.failed'),
            'view' => 'templates.failed',
        ]);
        HookAction::registerThemeTemplate('themecategory', [
            'name' => trans('theme::app.themecategory'),
            'view' => 'templates.themecategory',
        ]);
        HookAction::registerThemeTemplate('location', [
            'name' => 'Location',
            'view' => 'templates.location',
        ]);
        
    }

    public function registerSidebars()
    {
        HookAction::registerSidebar('home', [
            'label' => trans('theme::app.home'),
            'description' => trans('theme::app.home_page_sidebar'),
        ]);

        HookAction::registerSidebar('sidebar', [
            'label' => trans('theme::app.sidebar'),
            'description' => trans('theme::app.sidebar_page'),
        ]);
    }

    public function sendContactMail(){
        if(isset($_POST['msgSubmit'])){
            //dd($_POST['contact']);
            $name = $_POST['contact']['name'];
            $email = $_POST['contact']['email'];
            $phone = $_POST['contact']['phone'];
            $subject = $_POST['contact']['subject'];
            $message = $_POST['contact']['message'];
            $mailbody = '<p>Name</p>';
            $mailbody = '<p> Name : '.$name .'</p>';
            $mailbody = '<p> Email : '.$email .'</p>';
            $mailbody = '<p> Pnone : '.$phone .'</p>';
            $mailbody = '<p> Subject : '.$subject .'</p>';
            $mailbody = '<p>'.$message .'</p>';
            $mailSubject = 'Demah Studio contact mail';
            $tomail =get_theme_config('email'); //'demahstudio@gmail.com';
            Mail::send('juzaweb::backend.email.layouts.default', [
                'body' => $mailbody,
            ], function ($message) {
                $message->to(['demahstudio@gmail.com'])
                    ->subject('New Booking contact mail');
            });
        }
    }
    public function registerWidgets()
    {
        // HookAction::registerWidget('slider_movie', [
        //     'label' => trans('theme::app.slider_movie'),
        //     'description' => trans('theme::app.slider_movie_description'),
        //     'widget' => new SliderMovie(),
        // ]);

        // HookAction::registerWidget('genre_movie', [
        //     'label' => trans('theme::app.genre_movie'),
        //     'description' => trans('theme::app.genre_movie_description'),
        //     'widget' => new GenreMovie(),
        // ]);

        HookAction::registerWidget('slider', [
            'label' => trans('theme::app.slider'),
            'description' => trans('theme::app.slider_description'),
            'widget' => new SliderWidget(),
        ]);

        // HookAction::registerWidget('popular_movies', [
        //     'label' => trans('theme::app.popular_movies'),
        //     'description' => trans('theme::app.popular_movies_description'),
        //     'widget' => new PopularWidget(),
        // ]);
    }


        
public function packageThemeField(){
    add_action('post_type.package.form.right', function($model){
      //dd($model);
       $html='';
        $taxonomies = Taxonomy::where('post_type','package-themes')->where('taxonomy','categories')->get();
        //dd($taxonomies);
        $options = '';
         $cat_slugs =[];
         if(isset($model->theme_category_ids)){
           $cat_slugs= json_decode($model->theme_category_ids);
         }

        foreach($taxonomies as $taxonomy ){
            if(in_array($taxonomy->slug,$cat_slugs)){
              $options .='<option value="'.$taxonomy->slug.'" selected="selected">'.$taxonomy->name.'</option>';
            }else{
              $options .='<option value="'.$taxonomy->slug.'">'.$taxonomy->name.'</option>';
            }
        }
        $catischecked='';
        if(isset($model->is_theme_category) && $model->is_theme_category==1){
          $catischecked='checked';
        }
      

        echo  $html;
    }, 10, 1);
    add_action('admin.booking.after', function($model){
      $html='';
      if(isset($model->package_type_attribute)){
          $html .='<div class="row">
          <div class="col-md-4">Package Type Attribute </div>
          <div class="col-md-8">'.$model->package_type_attribute.'</div>
         </div>';
       }
       if(isset($model->pictures_type)){
          $html .='<div class="row">
          <div class="col-md-4">Package Type Attribute </div>
          <div class="col-md-8">'.$model->pictures_type.'</div>
         </div>';
       }
       echo  $html;
   }, 10, 1);
  // @do_action('admin.booking.prices',$model);
   add_action('admin.booking.prices', function($model){
      $html='';
      $pieces_price =0.00;
      if(isset($model->number_of_pieces)){
          $pieces_price =$model->rate_per_pieces *$model->number_of_pieces;
       }
       $html .='<div class="row">
          <div class="col-md-6 ">Price for pieces</div>
          <div class="col-md-6 text-right"><strong>'.number_format((float)$pieces_price, 2, '.', '').' KD</strong></div>
      </div>';

       echo  $html;
   }, 10, 1);
   add_action('admin.booking.prices', function($model){
      $html='';
      $pictures_type_price =0.00;
      if(isset($model->pictures_type_price)){
          $pictures_type_price =$model->pictures_type_price;
       }
       $html .='<div class="row">
          <div class="col-md-6 ">Package Attribute Price</div>
          <div class="col-md-6 text-right"><strong>'.number_format((float)$pictures_type_price, 2, '.', '').' KD</strong></div>
      </div>';

       echo  $html;
   }, 15, 1);

   add_action('admin.booking.total', function($model){
      $html='';
      //$total =0.00;
      $total =$model->total_price;
      if(isset($model->total_price)){
          $total =$model->total_price;
       }
       $html .='<div class="row">
          <div class="col-md-6 ">Total</div>
          <div class="col-md-6 text-right"><strong>'.number_format((float)$total, 2, '.', '').' KD</strong></div>
      </div>';

       echo  $html;
   }, 10, 1);

   $this->addAction('admin.reservation.exfields', function() {
      $package = Package::find($_REQUEST['id']);
      //dd($package);
      $html ='';
      $html .= '<div class="form-group row">
          <label class="col-sm-5 col-md-4">'.trans('sbph::app.Pictures_type').': </label> 
          <div class="col-sm-7 col-md-8">';
          $html .= '<input type="radio" data-price="'.$package->price_electonic.'" class="pictype" style="margin: 5px; width: 25px; min-height: 25px;" name="pictures_type" id="pictures_type1" value="Electonic">'.trans('sbph::app.Electonic').'@'.$package->price_electonic.'KD';
          $html .= '<input type="radio" data-price="'.$package->price_printed_electonic.'" class="pictype" style="margin: 5px; width: 25px; min-height: 25px;"  name="pictures_type" id="pictures_type2" value="Printed + Electonic">'.trans('sbph::app.Printed_Electonic').'@'.$package->price_printed_electonic.'KD';
          $html .= '<input type="hidden"  name="pictures_type_price" id="pictures_type_price" value="0.00">';
          $html .= '</div>
          </div>
       ';
      // if( $package->is_pieces==1){
      //     $html .= '<div class="form-group row">
      //             <label class="col-sm-5 col-md-4">'.trans('sbph::app.Number_of_Pieces').':</label> 
      //                 <div class="col-sm-7 col-md-8"> 
      //                    <input type="number" class="form-control" name="number_of_pieces" id="number_of_pieces" value="">
      //                    <input type="hidden"  name="rate_per_pieces" id="rate_per_pieces" value="'.$package->rate_per_pieces.'">
      //                 </div>
      //         </div>
      //         <div class="form-group row">
      //             <label class="col-sm-5 col-md-4"> </label> 
      //             <div class="col-sm-7 col-md-8"> 
      //                 <div class="package-head  radius15 mh67 py-1 px-3 mb-4 d-inline-flex align-items-center">
      //                     <h4 class="fs23 text-danger">Each piece will cost  <span class="text-600">'.$package->rate_per_pieces.' KD</span></h4>
      //                 </div>
      //             </div>
      //         </div>';
      //   }
     }, 15, 1);
     add_action('admin.booking.script', function() {
      $html = '<script>
          $(document).ready(function(){
              
              $("#number_of_pieces").keyup(function(){
                  if(this.value>0){
                      var package_price = localStorage.getItem("package_price");
                      // var noofpieces_price = localStorage.getItem("noofpieces_price");
                      var picture_type_price = localStorage.getItem("picture_type_price");
                      var exprice = localStorage.getItem("exprice");
                      var rate_per_pieces =   $("#rate_per_pieces").val();
                      var  noofpieces_price = this.value*rate_per_pieces;
                      localStorage.setItem("noofpieces_price",noofpieces_price);
                      var total_price =  (parseFloat(package_price) + parseFloat(exprice) + parseFloat(noofpieces_price) + parseFloat(picture_type_price)); 
                      localStorage.setItem("total_price",total_price);
                      $("#booking_total_price").val(total_price);
                      $("#totalprice").text(total_price+"KD");
                     //alert(total_price);
                  }
              });
              $("body").on("change", ".pictype", function(e) {
                 
                  var exprice = localStorage.getItem("exprice");
                  var package_price = localStorage.getItem("package_price");
                  var noofpieces_price = localStorage.getItem("noofpieces_price");
                  var picture_type_price = 0.00;
                      
                  picture_type_price = $("input[name=pictures_type]:checked").attr("data-price");
                  $("#pictures_type_price").val(picture_type_price);
                  
                  localStorage.setItem("picture_type_price",picture_type_price);
                  var total_price =  (parseFloat(package_price) + parseFloat(exprice) + parseFloat(noofpieces_price) + parseFloat(picture_type_price)); 
                  
                  localStorage.setItem("total_price",total_price); 
                  $("#booking_total_price").val(total_price);
                  $("#totalprice").text(total_price+"KD");
                    
                });
          });
      </script>';
     echo  $html;
  }, 25, 1);

  // add_action('admin.cstudio.themes', function(){
      
  //     //dd($themes);
  //     if(isset($_REQUEST['category']) && $_REQUEST['category']!='all'){
  //             // $taxonomy = Taxonomy::where('slug', $_REQUEST['category'])->firstOrFail();
  //             // $postType = $taxonomy->getPostType('model');
  //             // $themes = $postType::paginate();
  //             $themes = DB::table('package_themes')
  //             ->join('term_taxonomies', 'term_taxonomies.term_id', '=', 'package_themes.id')
  //             ->join('taxonomies', 'taxonomies.id', '=', 'term_taxonomies.taxonomy_id')
  //             ->where('taxonomies.slug', $_REQUEST['category'])
  //             ->select('package_themes.*')
  //             ->get();
  //             //dd($themes);
  //     } else{
  //         if(isset($_REQUEST['id'])){
  //             $pack=Package::find($_REQUEST['id']);
  //             if($pack->theme_category_ids!=''){
  //                 $slugs=json_decode($pack->theme_category_ids);
  //                 $themes = DB::table('package_themes')
  //                 ->join('term_taxonomies', 'term_taxonomies.term_id', '=', 'package_themes.id')
  //                 ->join('taxonomies', 'taxonomies.id', '=', 'term_taxonomies.taxonomy_id')
  //                 ->whereIn('taxonomies.slug', $slugs)
  //                 ->select('package_themes.*')
  //                 ->get();

  //             }else{
  //                 $themes =Theme::all();
  //             }
              
  //         }else{
  //             $themes =Theme::all();
  //         }
  //     }    
  //     $html ='';
  //     if(!empty($themes)){
  //             $html .='
  //             <div class="theme_select_slider row">';
  //                 foreach($themes as $theme){
  //                     $theme = Theme::find($theme->id);
  //                     $html .='<div class="col-sm-6 col-md-2 theme-select" >
  //                         <label class="container_radio themeCheck">
  //                             <label for="slect'.$theme->id.'" class="d-inline-block">'.$theme->title.'</label>
  //                             <input type="checkbox" id="slect'.$theme->id.'" value="'.$theme->id.'" name="theme_id[]">
                             
  //                             <a href="'.$theme->getThumbnail().'" class="themeCheck_img image-link border">
  //                                 <img src="'.$theme->getThumbnail().'" alt="img" class="" style="height:100px">
  //                             </a>
  //                         </label>
  //                     </div>';
  //              }
  //             $html .='</div>';
              
  //     }
  //     echo  $html;
  //  });

  //  add_action('admin.success.themes', function(){
      
  //     //dd($themes);
  //     if(isset($_REQUEST['category']) && $_REQUEST['category']!='all'){
  //             // $taxonomy = Taxonomy::where('slug', $_REQUEST['category'])->firstOrFail();
  //             // $postType = $taxonomy->getPostType('model');
  //             // $themes = $postType::paginate();
  //             $themes = DB::table('package_themes')
  //             ->join('term_taxonomies', 'term_taxonomies.term_id', '=', 'package_themes.id')
  //             ->join('taxonomies', 'taxonomies.id', '=', 'term_taxonomies.taxonomy_id')
  //             ->where('taxonomies.slug', $_REQUEST['category'])
  //             ->select('package_themes.*')
  //             ->get();
  //             //dd($themes);
  //     } else{
  //         if(isset($_REQUEST['id'])){
  //             $pack=Package::find($_REQUEST['id']);
  //             if($pack->theme_category_ids!=''){
  //                 $slugs=json_decode($pack->theme_category_ids);
  //                 $themes = DB::table('package_themes')
  //                 ->join('term_taxonomies', 'term_taxonomies.term_id', '=', 'package_themes.id')
  //                 ->join('taxonomies', 'taxonomies.id', '=', 'term_taxonomies.taxonomy_id')
  //                 ->whereIn('taxonomies.slug', $slugs)
  //                 ->select('package_themes.*')
  //                 ->get();

  //             }else{
  //                 $themes =Theme::all();
  //             }
              
  //         }else{
  //             $themes =Theme::all();
  //         }
  //     }    
  //     $html ='';
  //     if(!empty($themes)){
  //             $html .='
  //             <div class="theme_select_slider" style="height:250px;overflow-y: scroll;overflow-x: hidden;">
  //             <div class=" row">';
  //                 foreach($themes as $theme){
  //                     $theme = Theme::find($theme->id);
  //                     $html .='
  //                     <div class="col-sm-12 col-md-12 theme-select" >
  //                             <label class="container_radio themeCheck">
  //                             <input type="checkbox" id="slect'.$theme->id.'" value="'.$theme->id.'" name="theme_id[]">
                              
  //                             <img src="'.$theme->getThumbnail().'" alt="img" class="" style="height:48px;width:48px" >
  //                                 <label for="slect'.$theme->id.'" class="d-inline-block">'.$theme->title.'</label>
  //                             </label>
  //                         </div>';
  //                   }
  //             $html .='</div> </div>';
              
  //     }
  //     echo  $html;
  //  });

}
public function updatepackagefield(){
   add_action('plugin.package.update', function($model){ 
       if(isset( $_REQUEST)){
          $request = $_REQUEST;
          if(isset($request['is_theme_category'])){
              $model->is_theme_category = $request['is_theme_category'];
          }
          // if(isset($request['is_pieces'])){
          //     $model->is_pieces = $request['is_pieces'];
          // }
          if(isset($request['rate_per_pieces'])){
              $model->rate_per_pieces = $request['rate_per_pieces'];
          }
          // if(isset($request['price_electonic'])){
          //     $model->price_electonic = $request['price_electonic'];
          // }
         
          if(isset($request['price_printed_electonic'])){
              $model->price_printed_electonic = $request['price_printed_electonic'];
          }
          if(!empty($request['theme_category_ids'])){
              $model->theme_category_ids = json_encode($request['theme_category_ids']);
          }
          
          $model->save();
       }
      
    
   }, 10, 1);
}
public function addBodyClass()
  {
      $this->addAction('theme.homepackages', function () {
         //dd($model); 
        $packages = Package::where('status','publish')->get();
          if($packages){
              //var_dump($packages);
              $html ='<div class="col-xl-12">
              <div class="row justify-content-center">';

                foreach($packages as $key=>$package){
                      $slug = ($package->is_theme_category==1?url('/theme-categoris?slug='.$package->slug):url('package/'.$package->slug.'?cat=all'));
                      $html .= '<div class="col-lg-4 px-xl-5 col-sm-6 mb-4">
                                  <div class="pack_item">
                                      <div class="pack_head d-flex align-items-center justify-content-center">
                                          <img src="'.url('jw-styles/themes/saycheeez/assets/img/camera.svg').'" alt="img" class="mw-100">
                                          <h4 class="fs26 text-600 SegoeUISB position-absolute pt-5">
                                          '.$package->title.'
                                          </h4>
                                      </div>
                                      <p class="fs17 px-1 py-1 text-center">
                                      '.str_replace('<ul>',' <ul class="package-list ps-4">',$package->short_description).' 
                                      </p>
                                      <div class="pack_img">
                                          <img src="'. upload_url($package->thumbnail) .'" alt="img" class="w-100">
                                      </div>
                                      <a href="'.$slug .'" class="fs18 mt-4 btn btn-dark radius0 w-100">
                                      '.trans('theme::app.book_now').'
                                      </a>
                                  </div>
                              </div>';

                      }
                      $html .='</div></div>';
                      echo $html;
           }
      });
  } 


  public function addCompanyBodyClass()
  {
      $this->addAction('theme.company.homepackages', function ($model) {
         //dd($model); 
        $packages = Package::where('status','publish')->where('company_id',$model->id)->get();
          if($packages){
              //var_dump($packages);
              if($packages->count()==1){
                  foreach($packages as $key=>$package){
                      $html =  $package->id;
                  }
              }else{
              $html ='<div class="col-xl-12">
              <div class="row justify-content-center">';

                foreach($packages as $key=>$package){
                      $slug = ($package->is_theme_category==1?url('/theme-categoris?slug='.$package->slug):url('package/'.$package->slug.'?cat=all'));
                      $html .= '<div class="col-lg-4 px-xl-5 col-sm-6 mb-4">
                                  <div class="pack_item">
                                      <div class="pack_head d-flex align-items-center justify-content-center">
                                          <img src="'.url('jw-styles/themes/saycheeez/assets/img/camera.svg').'" alt="img" class="mw-100">
                                          <h4 class="fs26 text-600 SegoeUISB position-absolute pt-5">
                                          '.$package->title.'
                                          </h4>
                                      </div>
                                      <p class="fs17 px-1 py-1 text-center">
                                      '.str_replace('<ul>',' <ul class="package-list ps-4">',$package->short_description).' 
                                      </p>
                                      <div class="pack_img">
                                          <img src="'. upload_url($package->thumbnail) .'" alt="img" class="w-100">
                                      </div>
                                      <a href="'.$slug .'" class="fs18 mt-4 btn btn-dark radius0 w-100">
                                      '.trans('theme::app.book_now').'
                                      </a>
                                  </div>
                              </div>';

                      }
                      $html .='</div></div>';
              }
                      echo $html;
           }
      });
  }

public function addFrontCategories()
  {
      $this->addAction('theme.categories.page', function () {
          $slug = $_REQUEST['slug'];
          $package = Package::where('status','publish')->where('slug',$slug)->first();
          if(!empty($package)){
              if($package->theme_category_ids){
              $cats = json_decode($package->theme_category_ids);
              foreach($cats as $key=>$cat){
                  $taxonomies = Taxonomy::where('post_type','package-themes')->where('taxonomy','categories')->where('slug',$cat)->first();
                  //dd($taxonomies);
                  if(($key+1) % 2 != 0){
                      $slug = url('package/'.$package->slug).'?cat='. $taxonomies->slug;
                      echo   ' <div class="row py-5 my-5">         
                          <div class="col-xxl-7 offset-xxl-0 col-xl-6 offset-xl-1 d-xl-none d-flex justify-content-end mb-xl-0 mb-5">
                              <div class="pack_img position-relative">
                                  <img src="'.url('jw-styles/themes/demah/assets/img/pack_img_dots_right.svg').'" alt="img" class="position-absolute posLB">
                                  <img src="'. upload_url($taxonomies->thumbnail) .'" alt="img" class="mw-100">
                              </div>
                          </div>

                          <div class="col-xxl-4 offset-xxl-1 pe-xxl-5 col-xl-5 d-flex align-items-center">
                              <div class="pack_content position-relative d-flex align-items-center justify-content-center">
                                  <h4 class="position-absolute fs296 CarrinadyB text-primary pe-xl-5">
                                  '.($key+1).'
                                  </h4>
                                  <div class="pack_info">
                                      <h4 class="fs107 CarrinadyB text-primary text-uppercase mb-xl-5 pb-5 SegoeUIL">
                                      '.$taxonomies->name.'
                                      </h4>
                                      <p class="fs24 pb-5 mb-4">
                                      '.str_replace('<ul>',' <ul class="package-list ps-4">',$taxonomies->content).' 
                                      </p>
                                      <a href="'.$slug .'" class="btn btn-xl btn-primary mt-3 fs24">
                                      '.trans('theme::app.BookNow').'
                                      </a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-xxl-7 offset-xxl-0 col-xl-6 offset-xl-1 d-xl-flex d-none justify-content-end">
                              <div class="pack_img position-relative">
                                  <img src="'.url('jw-styles/themes/demah/assets/img/pack_img_dots_right.svg').'" alt="img" class="position-absolute posLB">
                                  <img src="'. upload_url($taxonomies->thumbnail) .'" alt="img" class="mw-100">
                              </div>
                          </div>
                      </div> ';
                  }else{
                      $slug = url('package/'.$package->slug).'?cat='. $taxonomies->slug;
                      echo '<div class="row py-5 my-5">
                      <div class="col-xxl-7 col-xl-6 mb-xl-0 mb-5">
                          <div class="pack_img position-relative">
                          <img src="'.url('jw-styles/themes/demah/assets/img/pack_img_dots_right.svg').'" alt="img" class="position-absolute posLB">
                          <img src="'. upload_url($taxonomies->thumbnail) .'" alt="img" class="mw-100">
                          </div>
                      </div>
                      
                      <div class="col-xxl-4 offset-xxl-0 ps-xxl-5 col-xl-5 offset-xl-1 d-flex align-items-center">
                          <div class="pack_content position-relative d-flex align-items-center justify-content-center">
                              <h4 class="position-absolute fs296 CarrinadyB text-primary">
                              '.($key+1).'
                              </h4>
                              <div class="pack_info">
                                  <h4 class="fs107 CarrinadyB text-primary text-uppercase mb-xl-5 pb-5 SegoeUIL">
                                  '.$taxonomies->name.'
                                  </h4>
                                  <p class="fs24 pb-5 mb-4">
                                  '.str_replace('<ul>',' <ul class="package-list ps-4">',$taxonomies->content).' 
                                  </p>
                                  <a href="'.$slug .'" class="btn btn-xl btn-primary mt-3 fs24">'.trans('theme::app.BookNow').'</a>
                              </div>
                          </div>
                      </div>
                  </div>';
                  }
              }
            }
          }   
      });
  }
public function addThemeExtraFields(){
  $this->addAction('theme.reservation.exfields', function() {
      $package = Package::find($_REQUEST['id']);
      //dd($package);
      $html = '';
      $html .= '<div class="col-xxl-8 pe-xl-5 pt-4">
      <div class="personal-form row">
          <div class="col-xxl-10 pb-3 fs23">
          <label>'.trans('theme::app.Pictures_type').': </label>';
          //$html .= '<input type="radio" data-price="'.$package->price_electonic.'" class="pictype" style="margin: 5px; width: 25px; min-height: 25px;" name="pictures_type" id="pictures_type1" value="Electonic">'.trans('theme::app.Electonic').'@'.$package->price_electonic.'KD';
          //$html .= '<input type="radio" data-price="'.$package->price_printed_electonic.'" class="pictype" style="margin: 5px; width: 25px; min-height: 25px;"  name="pictures_type" id="pictures_type2" value="Printed + Electonic">'.trans('theme::app.Printed_Electonic').'@'.$package->price_printed_electonic.'KD';
          $html .= '<input type="hidden"  name="pictures_type_price" id="pictures_type_price" value="0.00">';
          $html .= '</div>
          </div>
       </div>';

      // if( $package->is_pieces==1){
      //    echo '<div class="col-xxl-10 pe-xl-5">
      //             <div class="personal-form row">
      //                 <div class="col-xxl-8 pb-3">
      //                  <label>'.trans('theme::app.Number_of_Pieces').':</label> 
      //                  <input type="number" class="form-control" name="number_of_pieces" id="number_of_pieces" value="">
      //                  <input type="hidden"  name="rate_per_pieces" id="rate_per_pieces" value="'.$package->rate_per_pieces.'">
      //                </div>
      //                <div class="col-xxl-8 pb-3">
      //                  <label> </label> 
      //                  <div class="package-head bg-danger radius15 mh67 py-1 px-3 mb-4 d-inline-flex align-items-center">
      //                     <h4 class="fs23 text-danger">Each piece will cost  <span class="text-600">'.$package->rate_per_pieces.' KD</span></h4>
      //                  </div>
      //                </div>
      //             </div>
      //         </div>';
      //   }
     }, 15, 1);
     add_action('theme.footer', function() {
      $html = '<script>
          $(document).ready(function(){
              $("#number_of_pieces").keyup(function(){
                  if(this.value>0){
                      var package_price = localStorage.getItem("package_price");
                      // var noofpieces_price = localStorage.getItem("noofpieces_price");
                      var picture_type_price = localStorage.getItem("picture_type_price");
                      var exprice = localStorage.getItem("exprice");
                      var rate_per_pieces =   $("#rate_per_pieces").val();
                      var  noofpieces_price = this.value*rate_per_pieces;
                      localStorage.setItem("noofpieces_price",noofpieces_price);
                      var total_price =  (parseFloat(package_price) + parseFloat(exprice) + parseFloat(noofpieces_price) + parseFloat(picture_type_price)); 
                      localStorage.setItem("total_price",total_price);
                      $("#booking_total_price").val(total_price);
                      $("#totalprice").text(total_price+"KD");
                     //alert(total_price);
                  }
              });
              $("body").on("change", ".pictype", function(e) {
                 
                  var exprice = localStorage.getItem("exprice");
                  var package_price = localStorage.getItem("package_price");
                  var noofpieces_price = localStorage.getItem("noofpieces_price");
                  var picture_type_price = 0.00;
                      
                  picture_type_price = $("input[name=pictures_type]:checked").attr("data-price");
                  $("#pictures_type_price").val(picture_type_price);
                  
                  localStorage.setItem("picture_type_price",picture_type_price);
                  var total_price =  (parseFloat(package_price) + parseFloat(exprice) + parseFloat(noofpieces_price) + parseFloat(picture_type_price)); 
                  
                  localStorage.setItem("total_price",total_price); 
                  $("#booking_total_price").val(total_price);
                  $("#totalprice").text(total_price+"KD");
                    
                });
          });
      </script>';
     echo  $html;
  }, 25, 1);

  $this->addAction('booking.reservation.services', function($package) {
    //dd($package);
       echo $this->getPackageExService($package);
   }, 10, 1);
 
}
static function getPackageExService($package){
    $html ='';
    if($package->services){
         foreach($package->services as $service){
            $html .= '<label for="service'.$service->id.'" class="col d-flex align-items-center justify-content-center serviceBLk mx-2 mb-2 p-3">
                    <input id="service'.$service->id.'"  class="form-check-input xprice" type="checkbox" data-exprice="'.$service->price.'" value="'.$service->id.'" name="service_item[]">
                    <span>'.$service->title.' - '.$service->price.' KD.</span>
                </label>';
         }

    }
    return $html;
}

  public function doProcessPackageThemes(){
      add_action('theme.booking.extra', function($payment_data) {
         //dd($payment_data);
          $booking = Booking::find($payment_data['booking_id']);
          $booking->booking_price =  0.00 ;
          if(isset($payment_data['pictures_type'])){
              $booking->pictures_type =  $payment_data['pictures_type'] ;
          }
          
          // if(isset($payment_data['number_of_pieces'])){
          //     $booking->number_of_pieces =  $payment_data['number_of_pieces'] ;
          // }
          // if(isset($payment_data['rate_per_pieces'])){
          //     $booking->rate_per_pieces =  $payment_data['rate_per_pieces'] ;
          // }
           if(isset($payment_data['number_of_baby'])){
            $booking->number_of_baby = $payment_data['number_of_baby'];  
          }
          if(isset($payment_data['btype'])){
                $booking->btype = $payment_data['btype'];  
          }
          if(isset($payment_data['pictures_type_price'])){
              $booking->pictures_type_price =  $payment_data['pictures_type_price'] ;
          }
          if(isset($payment_data['total_price'])){
              $booking->total_price =  $payment_data['total_price'] ;
          }
          // if(isset($payment_data['theme_id'][0])){
          //     $theme_id =  $payment_data['theme_id'][0];
          //     $booking->theme_id =  $theme_id ;
          // }
          // if(isset($payment_data['theme_id'][1])){
          //     $theme_id =  $payment_data['theme_id'][1];
          //     $booking->theme_2id =  $theme_id ;
          // }
          $booking->save();
      }, 25, 1);
  }

  public function getHomeAboutContent(){
      $this->addAction('theme.home.about', function() {
          $page = Page::where('slug','about')->first();
          if($page){
          echo '<section class="about-us py-5 overflow-hidden">
          <div class="container py-5">
              <div class="row pt-lg-5 justify-content-center">
                  <div class="col-xl-10 px-xxl-5">
                      <div class="row">
                          <div class="col-xl-12 pb-5 mb-xl-5">
                              <div class="site-title position-relative d-flex align-items-center justify-content-center">
                                  <div class="bg-white">
                                      <h3 class="fs30 text-600 SegoeUISB text-uppercase SegoeUIL px-4 mx-2">
                                      '.$page->title.'
                                      </h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-9 px-xxl-5">
                      <div class="row">
                          <div class="col-xl-12 pt-xl-3 mt-xl-3">
                              <div class="about-info position-relative bg-white py-sm-4 px-xl-5 px-sm-4 p-3">
                                  <div class="row">
                                      <div class="col-xl-10 col-sm-9 text-300 pe-sm-5">
                                      '.str_replace('<p>','<p class="fs26">',$page->content).'   
                                      </div>
                                      <div class="col-xl-2 col-sm-3 px-xl-0 mt-4 mt-xl-0 d-flex justify-content-center">
                                          <div class="about-img">
                                              <img src="'.upload_url($page->thumbnail).'" alt="img" class="mw-100 radius25">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>';
           }
      });
  }

  public function getTermsAndConditionContent(){
      $this->addAction('theme.terms.content', function() {
          $page = Page::where('slug','terms-and-conditions')->first();
          if($page){
             echo $page->content;
           }
      });
  }

  public function getThemeFixedPriceText(){
      $this->addAction('theme.fixedprice.text', function() {
              $settings = Setting::all()->toArray();
              $config=array();
              foreach($settings as $setting){
                  $config[$setting["field_key"]] = $setting["field_value"];
              }
          if(isset($config['payment_type']) AND $config['payment_type']==1){
              $pay_amount = $config['pay_amount'];
             echo '<span class="text-600">'.$pay_amount.'KD</span>'; 
          }      
      });
  }

  public function getBranchService(){
        
    if(isset($_REQUEST['ajaxpage']) && $_REQUEST['ajaxpage']=='getBranchService'){
        //$service = $_REQUEST['sid']; 
        if(isset($_REQUEST['branch_id'])){
                $branch_id = $_REQUEST['branch_id'];
                $html ='';
                $branch = Branch::find($_REQUEST['branch_id']);
                
                if($branch->services){
                    foreach($branch->services as $service){
                        $html .= '<label for="service'.$service->id.'" class="col d-flex align-items-center justify-content-center serviceBLk mx-2 mb-2 p-3">
                        <input id="service'.$service->id.'"  class="form-check-input xprice" type="checkbox" data-exprice="'.$service->price.'" value="'.$service->id.'" name="service_item[]">
                        <span>'.$service->title.' - '.$service->price.' KD.</span>
                    </label>'; 
                    }
                }
            
                echo $html;
                exit;
        }else{
            echo 'Service not found';
            exit;
        }
      
   }
   
}
  public function themeServiceSloteScript(){
    add_action('theme.header', function(){
        $color  = get_theme_config('primary_color');
        echo '<style>
        :root {
            --primary_color: '.$color.' ; 
        }
         </style>';
      }, 15, 1);
    add_action('theme.footer', function() {

        $html = '<script>
            $(document).ready(function(){
                
                $("body").on("click", ".xprice", function(e) {
                    var sid = $(this).val();
                    var id = $("#id").val();
                    var date = $("#booking_date").val();
                    var _token = $("input[name=_token]").val();
                    if(this.checked){
                        $.ajax({
                            type: "POST",
                            url: "?ajaxpage=getServiceSlot",
                            data: {_token:_token,id: id,sid:sid,date:date},
                            success: function(data) {
                                //alert(data);
                                $("#booking_time").html(data);
                            },
                             error: function() {
                                alert("it broke");
                            },
                           
                        });
                    }   
                });

                $("body").on("change", ".branch", function(e) {
                    var branch_id = $(this).val();
                    var _token = $("input[name=_token]").val();
                    
                        $.ajax({
                            type: "POST",
                            url: "?ajaxpage=getBranchService",
                            data: {_token:_token,branch_id: branch_id},
                            success: function(data) {
                               
                                $("#package_services").html(data);
                            },
                             error: function() {
                                alert("it broke");
                            },
                           
                        });    
                });

                
                  
            });
        </script>';
        
       echo  $html;
    }, 35, 1);
  }
   
  public function generateBookingQR(){
    $this->addAction('booking.generate.qrcode', function($booking) {
        $bsid= base64_encode($booking->id);
         $booking_url = url('payment/success').'/?bsid='.$bsid;
         $curl = curl_init();
            curl_setopt_array($curl, array(
             CURLOPT_URL => 'https://createid.link/api/v1/generate/qrcode',
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => array('url' => $booking_url ,'logo_url' => ''),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
                return redirect()->back()->withErrors(['msg' => 'The Message']);
            } else {
                $res = json_decode($response);
                //dd($res);
                if($res->status == 'success'){
                    echo '<img src="'.$res->data.'" style="width:200px; height:200px">';
                }
            }
           //echo '<img src="https://i.imgur.com/GPTcUl3.png" style="width:200px; height:200px">';
       }, 10, 1);
   
  }
}
