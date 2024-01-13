<?php

namespace Sbhadra\Survey\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Survey\Models\Question;

class QuestionDatatable extends PostTypeDataTable
{
    protected $tvSeries;

    public function mount($postType)
    {
        parent::mount($postType);
    }

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
            'type' => [
                'label' => 'Question type',
                'formatter' => function ($value, $row, $index) {
                    if( $row->question_type=='1'){
                        return 'Multiple choice(Single)';
                    }elseif( $row->question_type=='2'){
                        return 'Multiple choice(Multiple)';
                    }elseif( $row->question_type=='3'){
                        return 'True/False';
                    }elseif( $row->question_type=='4'){
                        return 'Text field';
                    }
                   
                }
            ],
            'created_at' => [
                'label' => trans('sbph::app.created_at'),
                'width' => '15%',
                'align' => 'center',
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
        $query = Question::query();
        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
                $q->orWhere('description', 'like', '%'. $keyword .'%');
            });
        }

        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'Question':
                Theme::destroy($ids);
                break;
        }
    }
}
