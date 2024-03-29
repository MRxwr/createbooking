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

use Juzaweb\Abstracts\MenuBox;

class CustomMenuBox extends MenuBox
{
    public function mapData($data)
    {
        $result[] = $this->getData($data);

        return $result;
    }

    public function getData($item)
    {
        return [
            'label' => $item['label'],
            'link' => $item['link'],
        ];
    }

    public function addView()
    {
        return view('juzaweb::backend.menu.boxs.custom_add');
    }

    public function editView($item)
    {
        return view('juzaweb::backend.menu.boxs.custom_edit', [
            'item' => $item,
        ]);
    }

    public function getLinks($menuItems)
    {
        return $menuItems;
    }
}
