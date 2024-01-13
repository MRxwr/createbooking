<?php

namespace Sbhadra\Galleries\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Juzaweb\Models\Taxonomy;
use Sbhadra\Galleries\Models\Gallery;
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
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerGallery']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerTaxonomies']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getGalleyExImages']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'getCstudioGalleyExImages']);
 
    }

    public function registerGallery()
    {
        HookAction::registerPostType('galleries', [
            'label' => trans('sbga::app.galleries'),
            'model' => Gallery::class,
            'menu_position' => 30,
            'menu_icon' => 'fa fa-image',
        ]);
        
    }
   
    public function registerTaxonomies()
    {
        HookAction::registerTaxonomy('album', 'galleries', [
            'label' => trans('sbga::app.album'),
            'menu_position' => 8, 
        ]); 
    }

   

    static function getGalleyExImages(){
        add_filters('theme.galleries', function(){
        $galleries = Gallery::get();
        $html ='';
        if($galleries){
           
            $html .='<div class="mt-3 gallery-grid">';
             foreach($galleries as $image){
               $html .='          
               <div class="column">        
               <a class="example-image-link" img-id="gm-0" href="'.$image->getThumbnail().'" data-lightbox="example-set" data-title="">
                 <img src="'.$image->getThumbnail().'" style="width:100%">
              </a>
              </div>
             </div>';
             }
            $html .='</div>';
           
        }
        return $html;
     });
    }

    static function getCstudioGalleyExImages(){
        add_filters('theme.cstudio.galleries', function(){
        $galleries = Gallery::get();
        $html ='';
        if($galleries){
            $taxonomies = Taxonomy::where('post_type','galleries')->where('taxonomy','album')->get();
            //dd($taxonomies);
            $texo ='';
            foreach($taxonomies as $taxonomy ){
                $texo .='<button class="filter-button d-inline-block" data-filter="'.$taxonomy->slug.'"> '.$taxonomy->name.' </button>';
            }
            $html .='<div class="row">
                    <div class="col-xl-12 px-sm-0 mb-4 filter_btn">
                        <button class="filter-button d-inline-block active" data-filter="all">All</button>
                        '.$texo.'
                    </div>
                </div>';
            $html .='<div class="row portfolio-grid justify-content-center">';
             foreach($galleries as $image){
                    $albums = $image->getTaxonomies('album');
                    $alb='';
                    foreach($albums as $album ){
                        $alb = $alb .' '.$album->slug;
                    }
                
                   $html .='<div class="col-sm-4 col-6 px-0 gallery_product filter '.$alb.'">
                        <div class="filter-item position-relative d-flex align-items-center justify-content-center">
                            <img src="'.$image->getThumbnail().'" alt="img" class="w-100">
                            <a href="'.$image->getThumbnail().'" class="image-link bg-ovarley w-100 h-100 position-absolute d-flex align-items-center justify-content-center">
                                <img src="'.asset('/').'jw-styles/themes/cstudio/assets/img/zoom.svg" alt="img" class="mw-100 position-absolute">
                            </a>
                        </div>
                    </div>';
             }
            $html .='</div>';
        }
        return $html;
     });
    }

}
