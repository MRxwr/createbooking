<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Actions;

use Juzaweb\Abstracts\Action;
use Juzaweb\Facades\HookAction;
use Juzaweb\Models\Page;
use Juzaweb\Models\Post;
use Juzaweb\Support\Theme\CustomMenuBox;
use Juzaweb\Version;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MenuAction extends Action
{
    public function handle()
    {
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addDatatableSearchFieldTypes']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addPostTypes']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addBackendMenu']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addSettingPage']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addAdminScripts'], 10);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addAdminStyles'], 10);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'addMenuBoxs'], 50);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addTaxonomiesForm']);
        $this->addAction(self::JUZAWEB_INIT_ACTION, [$this, 'registerEmailHooks']);
        //$this->addAction(self::BACKEND_CALL_ACTION, [$this, 'checkSiteValidity'], 10);
    }

    public function addBackendMenu()
    {
        
        
        HookAction::addAdminMenu(
            trans('juzaweb::app.dashboard'),
            'dashboard',
            [
                'icon' => 'fa fa-dashboard',
                'position' => 1,
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.dashboard'),
            'dashboard',
            [
                'icon' => 'fa fa-dashboard',
                'position' => 1,
                'parent' => 'dashboard',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.updates'),
            'updates',
            [
                'icon' => 'fa fa-refresh',
                'position' => 2,
                'parent' => 'dashboard',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.media'),
            'media',
            [
                'icon' => 'fa fa-image',
                'position' => 3,
            ]
        );
       if(Auth::id()==1){
        HookAction::addAdminMenu(
            trans('juzaweb::app.appearance'),
            'appearance',
            [
                'icon' => 'fa fa-paint-brush',
                'position' => 40,
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.themes'),
            'themes',
            [
                'icon' => 'fa fa-paint-brush',
                'position' => 1,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.widgets'),
            'widgets',
            [
                'icon' => 'fa fa-list',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.menus'),
            'menus',
            [
                'icon' => 'fa fa-list',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.customize'),
            'customize',
            [
                'icon' => 'fa fa-wrench',
                'position' => 30,
                'parent' => 'appearance',
                'turbolinks' => false,
            ]
        );

      }
        HookAction::addAdminMenu(
            trans('juzaweb::app.customize'),
            'customize',
            [
                'icon' => 'fa fa-wrench',
                'position' => 30,
                'parent' => 'setting',
                'turbolinks' => false,
            ]
        );


    

        HookAction::addAdminMenu(
            trans('juzaweb::app.reading'),
            'reading',
            [
                'icon' => 'fa fa-book',
                'position' => 10,
                'parent' => 'setting',
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.permalinks'),
            'permalinks',
            [
                'icon' => 'fa fa-link',
                'position' => 15,
                'parent' => 'setting',
            ]
        );
        if(Auth::id()==1){
            HookAction::addAdminMenu(
                trans('juzaweb::app.plugins'),
                'plugin',
                [
                    'icon' => 'fa fa-plug',
                    'position' => 50,
                ]
            );

            HookAction::addAdminMenu(
                trans('juzaweb::app.plugins'),
                'plugins',
                [
                    'icon' => 'fa fa-plug',
                    'position' => 50,
                    'parent' => 'plugin',
                ]
            );

            HookAction::addAdminMenu(
                trans('juzaweb::app.add_new'),
                'plugins.install',
                [
                    'icon' => 'fa fa-plus',
                    'position' => 50,
                    'parent' => 'plugin',
                ]
            );
        }
        HookAction::addAdminMenu(
            trans('juzaweb::app.users'),
            'users',
            [
                'icon' => 'fa fa-users',
                'position' => 60,
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.setting'),
            'setting',
            [
                'icon' => 'fa fa-cogs',
                'position' => 70,
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.general_setting'),
            'setting.system',
            [
                'icon' => 'fa fa-cogs',
                'position' => 1,
                'parent' => 'setting',
            ]
        );

        // HookAction::addAdminMenu(
        //     trans('juzaweb::app.email_templates'),
        //     'email-template',
        //     [
        //         'icon' => 'fa fa-envelope',
        //         'position' => 50,
        //         'parent' => 'setting',
        //     ]
        // );
        if(Auth::id()==1){
        HookAction::addAdminMenu(
            trans('juzaweb::app.logs'),
            'logs',
            [
                'icon' => 'fa fa-users',
                'position' => 99,
            ]
        );

        HookAction::addAdminMenu(
            trans('juzaweb::app.email_logs'),
            'logs.email',
            [
                'icon' => 'fa fa-cogs',
                'position' => 1,
                'parent' => 'logs',
            ]
        );
        
         if (config('juzaweb.logs_viewer')) {
            HookAction::addAdminMenu(
                trans('juzaweb::app.error_logs'),
                'logs.error',
                [
                    'icon' => 'fa fa-exclamation-triangle',
                    'position' => 1,
                    'parent' => 'logs',
                ]
            );
        }
      }
    }

    public function addSettingPage()
    {
        HookAction::addSettingForm('general', [
            'name' => trans('juzaweb::app.general_setting'),
            'view' => 'juzaweb::backend.setting.system.form.general',
        ]);

        HookAction::addSettingForm('recaptcha', [
            'name' => trans('juzaweb::app.google_recaptcha'),
            'view' => 'juzaweb::backend.setting.system.form.recaptcha',
            'priority' => 15,
        ]);

        HookAction::addSettingForm('email', [
            'name' => trans('juzaweb::app.email_setting'),
            'view' => 'juzaweb::backend.email.setting',
            'priority' => 15,
        ]);
    }

    public function addPostTypes()
    {
        HookAction::registerPostType('pages', [
            'label' => trans('juzaweb::app.pages'),
            'model' => Page::class,
            'menu_icon' => 'fa fa-edit',
            'rewrite' => false,
        ]);

        HookAction::registerPostType('posts', [
            'label' => trans('juzaweb::app.posts'),
            'model' => Post::class,
            'menu_icon' => 'fa fa-edit',
            'menu_position' => 15,
            'supports' => [
                'category',
                'tag',
                'comment',
            ],
        ]);
    }

    public function addMenuBoxs()
    {
        HookAction::registerMenuBox('custom_url', [
            'title' => trans('juzaweb::app.custom_url'),
            'group' => 'custom',
            'menu_box' => new CustomMenuBox(),
        ]);
    }

    public function addTaxonomiesForm()
    {
        $types = HookAction::getPostTypes();
        foreach ($types as $key => $type) {
            add_action('post_type.'.$key.'.form.right', function ($model) use ($key) {
                echo view('juzaweb::components.taxonomies', [
                    'postType' => $key,
                    'model' => $model,
                ])->render();
            });
        }
    }

    public function addAdminScripts()
    {
        $ver = Version::getVersion();
        HookAction::enqueueScript('core', 'jw-styles/juzaweb/styles/js/vendor.js', $ver);
        HookAction::enqueueScript('core', 'jw-styles/juzaweb/styles/js/backend.js', $ver);
        HookAction::enqueueScript('core', 'jw-styles/juzaweb/styles/ckeditor/ckeditor.js', $ver);
    }

    public function addAdminStyles()
    {
        HookAction::enqueueStyle('core', 'jw-styles/juzaweb/styles/css/vendor.css');
        HookAction::enqueueStyle('core', 'jw-styles/juzaweb/styles/css/backend.css');
    }

    public function addDatatableSearchFieldTypes()
    {
        $this->addFilter(Action::DATATABLE_SEARCH_FIELD_TYPES_FILTER, function ($items) {
            $items['text'] = [
                'view' => view('juzaweb::components.datatable.text_field'),
            ];

            $items['select'] = [
                'view' => view('juzaweb::components.datatable.select_field'),
            ];

            $items['taxonomy'] = [
                'view' => view('juzaweb::components.datatable.taxonomy_field'),
            ];

            return $items;
        });
    }

    public function registerEmailHooks()
    {
        HookAction::registerEmailHook('register_success', [
            'label' => trans('juzaweb::app.registered_success'),
            'params' => [
                'name' => trans('juzaweb::app.user_name'),
                'email' => trans('juzaweb::app.user_email'),
                'verifyToken' => trans('juzaweb::app.verify_token'),
            ],
        ]);
    }
    public function checkSiteValidity(){
           $site_key='';
           $site_key= get_config('site_key');
           if(isset($site_key)){
              $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://admin.createkwservers.com/api/v2/verify?site_key='.$site_key,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: XSRF-TOKEN=eyJpdiI6IitEbXA4RlNBb1RxTDE2ak1wdWlxdGc9PSIsInZhbHVlIjoiR25OYm41c0kyOUJGZ2V6K2hQbXlkalRvUG4vM0Q2d0hNM3Q1cElhRFlucGk3NHJJUlEwM0FzQS9HM1NKdjQrOHRFK29aelhVYjBiR2gvcWZDbEdpVngyMTFmQm9RSk8zYmZHU0dGRkRvZHBQbnNIR0FKQ09QWVFnTDhrYndGaC8iLCJtYWMiOiI4NDgyYzhhMzAwNzYyNWQwNTYxN2Y4YTM0Y2IxMWViNTZlZGE2YWI4YzdmMWQ2YTVhZGIwODk0ZTM0YWZkMGQ5In0%3D; laravel_session=eyJpdiI6IjZFNmxZbitNK3JjSDVIVlZTaEdjemc9PSIsInZhbHVlIjoidTc0MmlYR0lZT2txRlBrR1NBOTVaRHdLOFdSWUcranZ6Q2VnVHFsLzdiYS94amNhbEZiaWNCMWcydDRhaTF5UERqcHNUZWsxRkswTDdmNTViWnl2WTB1SDRmL1Rqc0dOR1lwUDdqNktCQ1puektNSVp1VE8rSE9sb055L3Y5eEgiLCJtYWMiOiIyMDE3MjdjYTlmYTA3NmI2MWJmYTA0YWQ3Y2RlM2MxZmIwZjY5Yzk0NTJjNDQ5MGRlMTAxN2Y5YzE4MWVlNmZmIn0%3D'
                ),
            ));
            $response = curl_exec($curl);
             curl_close($curl);
            //echo $response;
            $response = json_decode($response);
            //dd($response);
            if($response){
            if($response->status!='success'){
                if($response->status=='error'){
                    echo '<!DOCTYPE html>
                            <html>
                            <head>
                                <style>
                                    html, body {height:100%;}
                                    html {display:table; width:100%;}
                                    body {display:table-cell; text-align:center;padding: 75px;}
                                </style>
                            </head>
                            <body style="align:center">
                            <h1>Your site is in-active</h1>
                            <p>Please contact with your provide regarding this issue</p>
                            </body>
                            </html>';
                            exit;
                }else if($response->status=='expire'){
                 echo '<!DOCTYPE html>
                        <html>
                        <head>
                            <style>
                                html, body {height:100%;}
                                html {display:table; width:100%;}
                                body {display:table-cell; text-align:center;padding: 75px;}
                                btn.btn-renew {
                                    text-decoration: none;
                                    background-color: #04AA6D;
                                    color: #ffffff;
                                    border-color: #04AA6D;
                                  }
                                .btn {
                                   
                                    font-size: 16px;
                                    font-family: "Source Sans Pro", sans-serif;
                                    padding: 15px 20px;
                                    border-radius: 5px;
                                    margin-top:15px;
                                }
                            </style>
                        </head>
                        <body style="align:center">
                        <h1>Your site expire</h1>
                        <p>Your site is expire ! please contact with vendor Or Please renew the site</p>
                        <br>
                        <form action="https://admin.createkwservers.com/api/v2/renew" method="post">
                            <input type="hidden" name="site_key" value="'.$response->data->site_key.'">
                             <button class="btn btn-renew" > '.$response->data->amount.'KD Renew Now</button>
                        </form>
                        </body>
                        </html>';
                        exit;
                }
                //dd($response);
            }
          }else{
            echo '<!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            html, body {height:100%;}
                            html {display:table; width:100%;}
                            body {display:table-cell; text-align:center;padding: 75px;}
                        </style>
                    </head>
                    <body style="align:center">
                    <h1>You site key (site_key) Not setup in admin </h1>
                    <p>Please add your site key</p>
                    <p>Contact your service provider and get site key</p>
                    <p>Go Admin->setting-> General setting and  placed the site key </p>
                    </body>
                    </html>';
                    exit;
        }
        }else{
            echo '<!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            html, body {height:100%;}
                            html {display:table; width:100%;}
                            body {display:table-cell; text-align:center;padding: 75px;}
                        </style>
                    </head>
                    <body style="align:center">
                    <h1>You site key (site_key) Not setup in admin </h1>
                    <p>Please add your site key</p>
                    <p>Contact your service provider and get site key</p>
                    <p>Go Admin-> setting->General setting and  placed the site key </p>
                    </body>
                    </html>';
            exit;
        }
      
    }
}
