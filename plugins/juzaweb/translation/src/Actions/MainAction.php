<?php

namespace Juzaweb\Translation\Actions;

use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
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
        $this->addAction(Action::BACKEND_CALL_ACTION, [$this, 'addBackendMenu']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'changeLanguageAction']);
    }

    public function addBackendMenu()
    {
        HookAction::addAdminMenu(
            trans('juzaweb::app.translations'),
            'translations',
            [
                'icon' => 'fa fa-language',
                'position' => 90,
            ]
        );
    }
    public function changeLanguageAction()
    {
        
            $lang = '';
            if(isset($_REQUEST['lang'])){
                $lang = $_REQUEST['lang'];
                Session::put('locale', $lang);
            }
            if($lang=='' && Session::get('locale')==''){
                $lang = 'ar';
            }else if($lang=='' && Session::get('locale')!=''){
                $lang = Session::get('locale'); 
            }
            Session::put('locale', $lang);
            app()->setLocale(Session::get('locale'));
            add_filters('theme.language.hooks', function() {
                $lang=Session::get('locale');
                echo 'language['.$lang.']';
            }, 10, 1);
        
    }
}
