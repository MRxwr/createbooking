<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */

namespace Juzaweb\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Juzaweb\Http\Controllers\BackendController;

class ReadingController extends BackendController
{
    public function index()
    {
        $title = trans('juzaweb::app.reading_settings');

        return view('juzaweb::backend.reading.index', compact(
            'title'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'show_on_front' => 'required|string|in:posts,page',
            'home_page' => 'required_if:show_on_front,page',
            'post_page' => 'string|nullable',
        ]);

        $settings = $request->only([
            'show_on_front',
            'home_page',
            'post_page',
            'payment_page',
            'success_page',
            'failed_page', 
        ]);

        if (Arr::get($settings, 'show_on_front') == 'posts') {
            $settings['home_page'] = null;
            $settings['post_page'] = null;
            // $settings['payment_page'] = null;
            // $settings['success_page'] = null;
            // $settings['failed_page'] = null;
            
        }

        foreach ($settings as $key => $value) {
            set_config($key, $value);
        }

        return $this->success([
            'message' => trans('juzaweb::app.save_successfully'),
        ]);
    }
}
