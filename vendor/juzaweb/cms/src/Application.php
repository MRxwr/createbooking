<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */
namespace Juzaweb;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function getNamespace()
    {
        return 'Juzaweb';
    }
}
