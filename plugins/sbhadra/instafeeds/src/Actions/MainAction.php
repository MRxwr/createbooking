<?php

namespace Sbhadra\Instafeeds\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Instafeeds\Models\FeedGallery;
use Illuminate\Support\Facades\DB;

class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addInstaFeedsHomepage']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerFeeds']);
       
    }

    public function registerFeeds()
    {
        HookAction::registerPostType('instafeed', [
            'label' => trans('sbin::app.instafeed'),
            'model' => FeedGallery::class,
            'menu_position' => 47,
            'menu_icon' => 'fa fa-image',
        ]);
        
    }

  
    public function addInstaFeedsHomepage()
    {
        add_filters('theme.instafeed.home', function(){
         

            return '<section class="pb-0">
            <div class="container" style="max-width: 1340px;">
              <div class="row">
                <div class="col-12">
                  <h2 class="shoots-Head">Follow us on instagram</h2>
                </div>
              </div>
            </div>
          </section>
            <iframe name="frame" style="width:100%; min-height:350px;" id="frame" src="pages/insta.html" allowtransparency="true" frameborder="0"></iframe>';
       }, 10, 1);

       add_filters('theme.instafeed.home2nd', function(){
        $feeds =  FeedGallery::where('status','publish')->get();
        //dd($feeds);
        $html ='';
        $html .= '<div class="row justify-content-center">';
        if($feeds){
          foreach($feeds as $key=>$feed){
                $html .= ' <div class="col-lg-2 col-sm-4 col-6 px-0">
                      <a href="'.$feed->url.'" class="position-relative d-flex align-items-end justify-content-end">
                          <img src="'.upload_url($feed->thumbnail).'" alt="img" class="w-100">
                          <img src="'.url('jw-styles/themes/demah/assets/img/in_icon.svg').'" alt="img" class="position-absolute p-3">
                      </a>
                  </div>';
                }
            }
          $html .= ' </div>';
          return $html;
         }, 10, 1);


         add_filters('theme.instafeed.home1st', function(){
          $feeds =  FeedGallery::where('status','publish')->get();
          //dd($feeds);
          $html ='';
          $html .= '<div class="row justify-content-center">';
          if($feeds){
            foreach($feeds as $key=>$feed){
                    $html .= ' <div class="col-xl-3 col-sm-3 col-6 px-0">
                     <div class="instagram-item position-relative d-flex align-items-center justify-content-center">
                        <img src="'.upload_url($feed->thumbnail).'" alt="img" class="w-100">
                        <a href="'.$feed->url.'"  class="bg-ovarley w-100 h-100 position-absolute d-flex align-items-center justify-content-center">
                            <img src="'.url('jw-styles/themes/hbqhaya/assets/img/in.svg').'" alt="img" class="position-absolute p-3">
                        </a>
                        </div>
                     </div>';
                  }
              }
            $html .= ' </div>';
            return $html;
           }, 10, 1);
    }

}
