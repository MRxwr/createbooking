<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Support\Theme;

use Juzaweb\Abstracts\CustomizeControl as BaseCustomizeControl;

class CustomizeControl extends BaseCustomizeControl
{
    public function contentTemplate()
    {
        switch ($this->args->get('type')) {
            case 'text':
                return view('juzaweb::backend.editor.control.text', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
            case 'textarea':
                return view('juzaweb::backend.editor.control.textarea', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
            case 'site_identity':
                return view('juzaweb::backend.editor.control.site_identity', [
                    'args' => $this->args,
                    'key' => $this->key,
                ]);
        }

        return '';
    }
}
