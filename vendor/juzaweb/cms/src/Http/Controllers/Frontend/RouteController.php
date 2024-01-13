<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 *
 * SBhadra0.
 * Date: 6/10/2021
 * Time: 3:31 PM
 */

namespace Juzaweb\Http\Controllers\Frontend;

use Illuminate\Support\Facades\App;
use Juzaweb\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Juzaweb\Models\User;

class RouteController extends FrontendController
{
    public function index($slug = null)
    {
        
        $slug = explode('/', $slug);
        if($this->iScompany($slug[0])){
            $company = $this->iScompany($slug[0]);
            do_action('theme.call_controller', $callback='CompanyController', $method='index', $slug);
            return $this->callController(
                CompanyController::class,
                'index',
                $slug
            );
        }else{
            $base = apply_filters('theme.permalink.base', $slug[0], $slug);
            $permalink = $this->getPermalinks($base);
            if ($permalink && $callback = $permalink->get('callback')) {
                return $this->callController($callback, 'index', $slug);
            }
            do_action('theme.call_controller', $callback='PageController', $method='index', $slug);
            return $this->callController(
                PageController::class,
                'index',
                $slug
            );
        }
        
    }
    static function iScompany($username = null){
        if($username != null){
          $company =  User::where('username',$username)->where('usertype','company')->where('status',"active")->first();
          //dd($company);
          if($company){
            return $company;
          }else{
            return false;
          }
        }
    }

    protected function callController($callback, $method = 'index', $parameters = [])
    {
        do_action('theme.call_controller', $callback, $method, $parameters);
        $parameters = array_values($parameters);
        return App::call($callback . '@' . $method, $parameters);
    }
}
