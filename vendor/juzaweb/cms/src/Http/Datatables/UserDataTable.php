<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Abstracts\DataTable;
use Juzaweb\Models\User;

class UserDataTable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns()
    {
        return [
            'name' => [
                'label' => trans('juzaweb::app.name'),
                'formatter' => function ($value, $row, $index) {
                    return $row->name;
                },
            ],
            'email' => [
                'label' => trans('juzaweb::app.email'),
                'width' => '15%',
                'align' => 'center',
            ],
            'created_at' => [
                'label' => trans('juzaweb::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                },
            ],
            'Action' => [
                'label' => 'Action',
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    $html ='';
                    $html .='<a class="btn btn-primary" href="'.$this->currentUrl .'/'. $row->id . '/edit'.'">'. trans('juzaweb::app.edit').'</a>';
                    $html .='<a class="btn btn-danger" href="'.$this->currentUrl .'/'. $row->id . '/delete'.'">'. trans('juzaweb::app.delete').'</a>';
                    if($row->usertype=="company"){
                        $html .='<a class="btn btn-success" href="'.$this->currentUrl .'/'. $row->id . '/config'.'">Config</a>';
                    }
                   
                    return $html ;
                },
            ],
        ];
    }

    public function rowAction($row)
    {
        $data = parent::rowAction($row);

        $data['edit'] = [
            'label' => trans('juzaweb::app.edit'),
            'url' => route('admin.users.edit', [$row->id]),
        ];

        return $data;
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data)
    {
        $query = User::query();

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('name', 'like', '%'. $keyword .'%');
                $q->orWhere('email', 'like', '%'. $keyword .'%');
            });
        }

        if ($status = Arr::get($data, 'status')) {
            $query->where('status', '=', $status);
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                User::destroy($ids);

                break;
        }
    }
}
