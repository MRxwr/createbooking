<?php

namespace Juzaweb\Http\Controllers\Frontend;

use Illuminate\Support\Facades\App;
use Juzaweb\Http\Controllers\FrontendController;
use Juzaweb\Models\Post;

class PaymentController extends FrontendController
{
    public function index()
    {
        do_action('theme.payment.index');
        if ($pageId = jw_payment_page()){
            return App::call('Juzaweb\Http\Controllers\Frontend\PageController@detail', ['id' => $pageId]);
        }
    }

    public function getSuccess()
    {
        do_action('theme.payment.success');
        if ($pageId = jw_success_page()) {
            //echo  $pageId;
            $payment_data ='';
            return App::call('Juzaweb\Http\Controllers\Frontend\PageController@detail', ['id' => $pageId]);
        }
    }

    public function getFailed()
    {
        do_action('theme.payment.failed');
        if ($pageId = jw_failed_page()) {
            //echo  $pageId;
            return App::call('Juzaweb\Http\Controllers\Frontend\PageController@detail', ['id' => $pageId]);
        }
    }

    

    protected function handlePage()
    {
        $config = get_configs(['title', 'description']);
        $theme = jw_theme_info();
        $view = $this->getViewPage();
        $posts = Post::createFrontendBuilder()->paginate(10);

        $params = [
            'title' => $config['title'],
            'description' => $config['description'],
            'theme' => $theme,
            'config' => $config,
            'posts' => $posts,
        ];

        return apply_filters(
            'theme.page.home.handle',
            view($view, $params),
            $params
        );
    }

    protected function getViewPage()
    {
        $view = 'theme::index';

        return $view;
    }
}
