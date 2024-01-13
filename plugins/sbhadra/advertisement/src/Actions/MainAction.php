<?php

namespace Sbhadra\Advertisement\Actions;

use Illuminate\Support\Arr;
use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Sbhadra\Advertisement\Models\Advertise;

class MainAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerAdvertise']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHeaderAdvertise']);
        // $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addCstudioHeaderSlider']);
        // $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addHayaHeaderSlider']);
        //$this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addAdminMenus']);
    }

    public function registerAdvertise()
    {
        HookAction::registerPostType('advertise', [
            'label' => trans('sbad::app.advertise'),
            'model' => Advertise::class,
            'menu_position' => 36,
            'menu_icon' => 'fa fa-image',
        ]);
    }
    public function addHeaderAdvertise()
    {
       
        $this->addAction('theme.footer', function () {
            $advertise = Advertise::where('status','publish')->first();
            //var_dump($sliders); 
           if($advertise ){
            if (is_home()) {
            echo '<!-- custom-popup  -->
               <div class="custom-popup modal fade" id="AdvertiseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="height:350px;background-image: url('. upload_url($advertise->thumbnail) .');">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <img src="'.asset("/").'jw-styles/themes/hbqhaya/assets/img/popup_close.svg" alt="img">
                            </button>
                        </div>
                        <div class="modal-body px-sm-5">
                         </div>
                        <div class="modal-footer d-flex align-items-center justify-content-center mb-3">
                        <div class="package-head bg-light radius15 mh53 py-1 px-4 d-inline-flex align-items-center">
                            <h4 class="fs24">'.$advertise->title.'</h4>
                        </div>
                           <a class="fs18 mt-4 btn btn-dark radius0 w-100" href="'.$advertise->url.'" > Book Now</a>
                        </div>
                        
                    </div>
                </div>
               </div>
            <!-- custom-popup -->';
            }
          }
        }, 2, 1);
        add_action('theme.footer', function() {
            $html = '<script>
                    $(document).ready(function(){
                        $("#AdvertiseModal").modal("show"); 
                    });
                    </script>';
           echo  $html;
        }, 35, 1);
    }

}
