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

class GenreMovie extends Widget
{
    /**
     * Creating widget Backend
     *
     * @param array $data
     * @return View
     */
    public function form($data)
    {
        return view('theme::components.widgets.genre.form', compact(
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
        return view('theme::components.widgets.genre.show', compact(
            'data'
        ));
    }

    /**
     * Updating data block
     *
     * @param array $data
     * @return array
     */
    public function update($data)
    {
        return $data;
    }
}