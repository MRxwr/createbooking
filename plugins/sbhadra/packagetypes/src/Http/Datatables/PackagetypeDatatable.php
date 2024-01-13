<?php

namespace Sbhadra\Packagetypes\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Abstracts\DataTable;
use Sbhadra\Packagetypes\Models\PackageType;

class PackagetypeDatatable extends DataTable
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
                'formatter' => function ($value, $row, $index) {
                    return $row->title;
                }
            ],
            
            'status' => [
                'label' => trans('sbph::app.status'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return ($row->status==1?'Active':'In-active');
                }
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
                    $edit =route('admin.package-type.edit',['id'=>$row->id]);
                    $link =route('admin.package-type-attributes.index',['id'=>$row->id]);
                    return '<a class="btn btn-sm btn-primary" href="'.$edit.'">Edit</a> <a class="btn btn-sm btn-default" href="'.$link.'">Attributes</a> ';
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
        $query = PackageType::query();
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
               
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                PackageType::destroy($ids);
                break;
        }
    }
}
