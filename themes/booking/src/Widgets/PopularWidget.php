<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Theme\Widgets;

use Illuminate\View\View;
use Juzaweb\Abstracts\Widget;

class PopularWidget extends Widget
{
    /**
     * Creating widget Backend
     *
     * @param array $data
     * @return View
     */
    public function form($data)
    {
        return view('theme::components.widgets.popular_movies.form', compact(
            'data'
        ));
    }

    /**
     * Creating widget front-end
     *
     * @param array $data
     * @return View
     */
    public function show($data)
    {
        return view('theme::components.widgets.popular_movies.show', compact(
            'data'
        ));
    }
}