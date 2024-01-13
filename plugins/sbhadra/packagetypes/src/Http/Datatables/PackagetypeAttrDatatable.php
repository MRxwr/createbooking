<?php

namespace Sbhadra\Packagetypes\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Abstracts\DataTable;
use Sbhadra\Packagetypes\Models\PackageType;
use Sbhadra\Packagetypes\Models\PackageTypeAttribute;

class PackagetypeAttrDatatable extends DataTable
{
 
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns()
    {
        return [
            'title' => [
                'label' => trans('sbph::app.name'),
                'formatter' => [$this, 'rowActionsFormatter']
            ],
            'created_at' => [
                'label' => trans('sbph::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ],
            'actions' => [
                'label' => trans('sbph::app.actions'),
                'width' => '15%',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ]
        ];
    }

    /**
     * Query data datatable
     *
     * @param array $data
     * @return Builder
     */
    public function query($data)
    {
        $query = PackageTypeAttribute::query();
        // $package_type_id= \Request::$request->get('id');
        // dd($package_type_id);
        if(isset($_GET['id'])){
            $query ->where('package_type_id',$_GET['id']);
        }
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
                $q->where('package_type_id', 'like', '%'. $keyword .'%');
               
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                PackageTypeAttribute::destroy($ids);
                break;
        }
    }
}
