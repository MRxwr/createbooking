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
use Juzaweb\Models\Taxonomy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Juzaweb\Models\EmailList;
class MainAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'cStudioThemePackages']);
        $this->addAction(Action::JUZAWEB_INIT_ACTION, [$this, 'registerTemplates']);
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'addBreadcrumbs']);
        $this->addAction(Action::JUZAWEB_INIT_ACTION, [$this, 'sendContactMail']);
       
        // $this->addAction(Action::WIDGETS_INIT, [$this, 'registerSidebars']);
        // $this->addAction(Action::WIDGETS_INIT, [$this, 'registerWidgets']);
    }
    
    
    public function cStudioThemePackages()
    {
        $this->addAction('theme.header', function () {
            echo e(view('theme::components.header_script'));
        });
    }


    public function addHeaderSlider()
    {
        $this->addAction('theme.slider', function () {
            echo e(view('theme::components.header_script'));
        });
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
                    ->subject('New Demah Studio contact mail');
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
}
