<?php

namespace Sbhadra\Photography\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Juzaweb\Http\Datatables\PostTypeDataTable;
use Sbhadra\Photography\Models\Booking;
use Sbhadra\Packagethemes\Models\Theme;
use Auth;

class SuccessBookingDatatable extends PostTypeDataTable
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
                'label' => trans('sbph::app.bookingid'),
                'formatter' => function ($value, $row, $index) {
                    return $row->title;
                }
            ],
            
            'package' => [
                'label' => trans('sbph::app.package'),
                'formatter' => function ($value, $row, $index) {
                    return $row->package->title;
                }
            ],
            'customer_name' => [
                'label' => trans('sbph::app.customer_name'),
                'formatter' => function ($value, $row, $index) {
                    return $row->customer_name;
                }
            ],
            'mobile_number' => [
                'label' => trans('sbph::app.mobile_number'),
                'formatter' => function ($value, $row, $index) {
                    return '<a href="https://wa.me/+965'. $row->mobile_number.'" >'.$row->mobile_number.'</a>';
                }
            ],
            'booking_date' => [
                'label' => trans('sbph::app.booking_date'),
                'formatter' => function ($value, $row, $index) {
                    return $row->booking_date;
                }
            ],
            'timeslot' => [
                'label' => trans('sbph::app.booking_time'),
                'width' => '14%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                   //return var_dump($row->timeslot);
                    return $row->timeslot->starttime .'to'. $row->timeslot->endtime;
                }
            ],
            'services' => [
                'label' => trans('sbph::app.services'),
                'width' => '14%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    $sht='';
                    if($row->services){
                        foreach($row->services as $service){
                            $sht .='<span  class="btn btn-info btn-sm">'.$service->title.'</span>';
                        }
                   }
                   return $sht;
                }
            ],
            'booking_notes' => [
                'label' => 'Notes',
                'formatter' => function ($value, $row, $index) {
                    return $row->booking_notes;
                }
            ],
            'status' => [
                'label' => trans('sbph::app.status'),
                'formatter' => function ($value, $row, $index) {
                    return ($row->status=='yes'?'Free':$row->status);
                }
            ],
           'coupon_code' => [
                'label' => 'coupon code',
                'formatter' => function ($value, $row, $index) {
                    return $row->coupon_code;
                }
            ],
            'employee_id' => [
                'label' => 'Employee',
                'formatter' => function ($value, $row, $index) {
                    if($row->employee){
                        return $row->employee->name ;
                    }
                }
            ],
            'actions' => [
                'label' => trans('sbph::app.actions'),
                'width' => '5%',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    $view_details = route('admin.bookings.view', [$row->id]);
                    $view_edit = URL('admin/bookings/'.$row->id.'/edit').'?id='.$row->package_id.'&package_id='.$row->package_id.'&date='.$row->booking_date;
                   
                    $add_notes = '<a  id="'.$row->id.'" class="dropdown-item add_note" data-toggle="modal" data-target="#add_notes_modal"> <i class=" fa fa-file-text-o"></i> Note</a>';
                    $add_notes .= '<a  id="'.$row->id.'" class="dropdown-item assign_epm" data-toggle="modal" data-target="#assign_epm_modal"> <i class=" fa fa-user"></i> Assign Employee</a>';
                   
                    if($row->status=='Yes' ||$row->status=='yes' ){
                    $booking_cancel = '<form action="'.route('admin.bookings.cancel').'" method="post" class="form-ajax" novalidate="novalidate">
                    <input type="hidden" name="id" value="'.$row->id.'">
                    '.csrf_field().'
                    <button type="submit" class="dropdown-item"> <i class=" fa fa-times"></i> Cancel</button>
                    </form>';
                    }else{
                        $booking_cancel = '';
                    }
                    if($row->status=='cancel' && $row->transaction_id!=''){
                      $booking_refund = '<form action="'.route('admin.bookings.refund').'" method="post" class="form-ajax" novalidate="novalidate">
                        <input type="hidden" name="id" value="'.$row->id.'">
                        '.csrf_field().'
                        <button type="submit" class="dropdown-item"> <i class=" fa fa-undo"></i> Refund</button>
                        </form>';
                     }else{
                        $booking_refund = '';
                     }
                     if($row->status=='Yes' ||$row->status=='yes' ){
                        $booking_sendsms = '<form action="'.route('admin.bookings.sendsms').'" method="post" class="form-ajax" novalidate="novalidate">
                        <input type="hidden" name="id" value="'.$row->id.'">
                        '.csrf_field().'
                        <button type="submit" class="dropdown-item"> <i class=" fa fa-mobile"></i> Send Sms</button>
                        </form>';
                        $booking_sendsms = '';
                     }else{
                        $booking_sendsms = '';
                     }
                     if($row->status=='Yes' ||$row->status=='yes' ){
                    $booking_complete = '<form action="'.route('admin.bookings.complete').'" method="post" class="form-ajax" novalidate="novalidate">
                        <input type="hidden" name="id" value="'.$row->id.'">
                        '.csrf_field().'
                        <button type="submit" class="dropdown-item"> <i class=" fa fa-mobile"></i> Completed</button>
                        </form>';
                    }else{
                        $booking_complete = '';
                     }
                    return '<div class="dropdown d-inline-block mb-2 mr-2">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Options
                        </button>
                            <div class="dropdown-menu" role="menu" style="">
                             <a href="'.$view_details.'" class="dropdown-item"> <i class=" fa fa-eye"></i> View</a>
                             <a href="'.$view_edit.'" class="dropdown-item"> <i class=" fa fa-edit"></i>Reschedule</a>
                            '.$booking_cancel.'
                            '.$booking_sendsms.'
                            '.$booking_refund.'
                            '.$booking_complete.'
                            '.$add_notes.'
                            </div>
                        </div>
                    </div>';
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
        $query = Booking::query();
        if(Auth::user()->usertype=='company'){
            $query->where('company_id', \Auth::user()->id)->where('status','Yes');
        }else{
          $query ->whereIn('status',['Yes','yes']);  
        }
        //$query ->whereIn('status',['Yes','yes']);
        if ($keyword = Arr::get($data, 'keyword')) {
            
            $query->where(function (Builder $q) use ($keyword) {
                $q->where('title', 'like', '%'. $keyword .'%');
                $q->orWhere('booking_date', 'like', '%'. $keyword .'%');
                $q->orWhere('mobile_number', 'like', '%'. $keyword .'%');
                $q->orWhere('customer_name', 'like', '%'. $keyword .'%');
            });
        }
        return $query;
    }

    public function bulkActions($action, $ids)
    {
        switch ($action) {
            case 'delete':
                Booking::destroy($ids);
                break;
        }
    }
    public function searchFields()
    {
        return [
            'keyword' => [
                'type' => 'text',
                'label' => trans('juzaweb::app.keyword'),
                'placeholder' => trans('juzaweb::app.keyword'),
            ]
        ];
    }
}
