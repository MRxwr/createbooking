<?php

namespace Sbhadra\Slider\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Slider\Models\Slider;

class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerSlider']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHeaderSlider']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addCstudioHeaderSlider']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHayaHeaderSlider']);
        //$this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addAdminMenus']);
    }

    public function registerSlider()
    {
        HookAction::registerPostType('sliders', [
            'label' => trans('sbsl::app.sliders'),
            'model' => Slider::class,
            'menu_position' => 31,
            'menu_icon' => 'fa fa-image',
        ]);
    }
    public function addHeaderSlider()
    {
       
        $this->addAction('theme.slider', function () {
            
            $sliders = Slider::where('status','publish')->get();
            //var_dump($sliders);
            
           if($sliders ){
            echo '<div id="demo" class="carousel slide" data-ride="carousel">';
            echo ' <ul class="carousel-indicators">';
                foreach($sliders as $key=>$slider){
                    echo '<li data-target="#demo" data-slide-to="0"  class="'.($key==0?'active':'').'" ></li>';
                }
            echo '</ul>';
            echo '<div class="carousel-inner">';
                foreach($sliders as $key=>$slider){
                    echo '<div class="carousel-item '.($key==0?'active':'').' ">';
                     echo '<img src="'. upload_url($slider->thumbnail) .'" class="img-fluid d-block mx-auto" alt="">';
                    echo '</div>';

                }
            echo '</div>';
            echo '<a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>';
            echo '</div>';
          }
        });
    }

    public function addCstudioHeaderSlider()
    {
       
        $this->addAction('theme.cstudio.slider', function () {
            $sliders = Slider::where('status','publish')->get();
            //var_dump($sliders);
            $html='';
           if($sliders ){
                $html .= '<section class="hero-slider">';
                $html=  '<div class="container"><div class="row"> <div class="col-xl-12 px-0"><div class="hero-slick">';
                    foreach($sliders as $key=>$slider){
                        $html .=  '<div class="hero-item">
                            <img src="'. upload_url($slider->thumbnail) .'" alt="img" class="mw-100 d-sm-block d-none">
                            <img src="'. upload_url($slider->thumbnail) .'" alt="img" class="mw-100 d-sm-none d-block">
                        </div>';
                    }
                $html .=  ' </div></div> </div></div>';
                $html .=  '</section>';
            }
            echo $html;

        });
    }

    public function addHayaHeaderSlider()
    {
       
        $this->addAction('theme.Haya.slider', function () {
            $sliders = Slider::where('status','publish')->get();
            //var_dump($sliders);
            $html='';
            if($sliders ){
                $html .='<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                
                $html .= '<div class="carousel-inner">';
                    foreach($sliders as $key=>$slider){
                        $html .= '<div class="carousel-item '.($key==0?'active':'').' ">';
                        $html .= '<img src="'. upload_url($slider->thumbnail) .'" class="img-fluid d-block mx-auto" alt="">';
                        $html .= '</div>';
    
                    }
                    $html .= '</div>';
                    $html .= '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Previous</span>
                     </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>';
                    $html .= '</div>';
              }
            echo $html;

        });
    }

}
