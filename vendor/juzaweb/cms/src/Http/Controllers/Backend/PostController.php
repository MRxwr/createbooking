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

use Juzaweb\Http\Controllers\BackendController;
use Juzaweb\Models\Post;
use Juzaweb\Traits\PostTypeController;

class PostController extends BackendController
{
    use PostTypeController;

    protected function getModel()
    {
        return Post::class;
    }
}
