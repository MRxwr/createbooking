@extends('juzaweb::layouts.backend')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row mb-3">
        
        <div class="col-md-8">
           <div id='calendar'></div>
        </div>

        <div class="col-md-4">
                <form action="{{route('admin.calendar-date')}}" method="POST">
                {!! csrf_field() !!}
                <div class="row">
                <div class="form-group">  
                        <h4>Add disable date</h4>
                </div>
                        <div class="col-md-12 form-group bootstrap-timepicker timepicker">
                                <label class="col-form-label" for="release">@lang('sbph::app.starttime')</label>
                                <select name="package_id" class="form-control input-small select2" id="package_id" onchange="gotopage(this)">
                                        <option value="0">Select Package</option>
                                        @foreach($packages as $key=>$package)
                                        @if(isset($_REQUEST['package']) && $_REQUEST['package']==$package->id)
                                                <option value="{{$package->id}}" selected="selected">{{$package->title}}</option>
                                        @else
                                                <option value="{{$package->id}}">{{$package->title}}</option>
                                        @endif
                                        @endforeach
                                </select>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        </div>
                        <div class="col-md-12 form-group bootstrap-timepicker timepicker">
                        <div class="row">
                                @if($model)
                                <label class="col-form-label" for="release">Slots</label>
                        
                                @foreach($model->slots as $slot)    
                                <div class="col-md-4">
                                        <label class="col-form-label" for="release">
                                                <input type="checkbox" name="slots[]" value="{{$slot->id}}">{{$slot->starttime}} - {{$slot->endtime}}
                                        </label>
                                </div>
                                @endforeach 
                                @endif
                        </div>
                        </div>
                        <div class="col-md-6 form-group bootstrap-timepicker timepicker">
                                <label class="col-form-label" for="release">@lang('sbca::app.start_date')</label>
                                <input id="start_date" name="start_date" type="date" class="form-control input-small" value="">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-date"></i></span>
                        </div>
                        <div class="col-md-6 form-group bootstrap-timepicker timepicker">
                                <label class="col-form-label" for="release">@lang('sbca::app.end_date')</label>
                                <input id="end_date" name="end_date" type="date" class="form-control input-small" value="">
                                <span class="input-group-addon"><i class="fa fa-watch"></i></span>
                        </div> 
                        <div class="col-md-12"><div class="btn-group float-right"><button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button> <button type="button" class="btn btn-warning cancel-button px-3"><i class="fa fa-refresh"></i> Reset</button></div></div> 
                
                </div> 
                </form>
                <div class="row">
                        <div class="col-md-12 mt-5">
                                <div class="table-responsive">
                                        @if(!empty($dates))
                                                <table class="table jw-table table-bordered table-hover" id="calendar_table">
                                                <thead>
                                                        <tr>
                                                         <th>Date range</th>
                                                         <th>Timeslot</th>
                                                          <th>Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach($dates as $date)
                                                        <tr>
                                                                <td>{{$date->from_date}} to {{$date->to_date}}</td>
                                                                <td>
                                                                 @php
                                                                   $dslot = '';
                                                                   if($date->slots=='all') {
                                                                        $dslot = 'All';   
                                                                   }elseif($date->slots!=''){
                                                                           $st=array();
                                                                           $jsd=json_decode($date->slots);
                                                                           foreach($model->slots as $slot) {
                                                                                   if(in_array($slot->id,$jsd)){
                                                                                        $st[]=$slot->starttime .'-'.$slot->endtime;
                                                                                   }
                                                                           }
                                                                           $dslot = json_encode($st);   
                                                                   }
                                                                 @endphp 
                                                                 {{$dslot}}      
                                                                </td>
                                                                <td><a href="{{route('admin.calendar.delete',['id'=>$date->id])}}" class="btn btn-danger"> <i class=" fa fa-trash"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>               
                                                <table>  
                                        @endif
                                </div>
                </div>
          
        
      </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/fc-3.2.2/fh-3.1.2/r-2.1.0/sc-1.4.2/datatables.min.css" />
    <script>
   
   $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        eventLimit: true, // allow "more" link when too many events
        timeFormat: 'H:mm',
     header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
     },
     eventMouseover: function (data, event, view) {
		var tooltip = '<div class="tooltiptopicevent tooltip tooltip-inner" style="width:auto;height:auto;position:absolute;z-index:10001;">' + data.title + '</div>';
		$("body").append(tooltip);
                $(this).mouseover(function (e) {
                        $(this).css('z-index', 10000);
                        $('.tooltiptopicevent').fadeIn('500');
                        $('.tooltiptopicevent').fadeTo('10', 1.9);
                }).mousemove(function (e) {
                        $('.tooltiptopicevent').css('top', e.pageY + 10);
                        $('.tooltiptopicevent').css('left', e.pageX + 20);
                });
        },
     eventRender: function( event, element, view ) {
        var title = element.find('.fc-title, .fc-list-item-title');          
        title.html(title.text());
        },
     events: '{{route("admin.booking-json")}}',
     selectable:true,
     selectHelper:true,
     select: function(start, end, allDay)
     {
       var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
       $('#start_date').val(start)
       var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
       $('#end_date').val(end)

      //var title = prompt("Enter Event Title");
    //   if(title)
    //   {
    //    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    //    $.ajax({
    //     url:"insert.php",
    //     type:"POST",
    //     data:{title:title, start:start, end:end},
    //     success:function()
    //     {
    //      calendar.fullCalendar('refetchEvents');
    //      alert("Added Successfully");
    //     }
    //    })
    //   }
     },
     editable:true,
    
 
     eventDrop:function(event)
     {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
       url:"update.php",
       type:"POST",
       data:{title:title, start:start, end:end, id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //alert("Event Updated");
       }
      });
     },
     eventClick:function(event)
     {
      if(confirm("Are you sure you want to leave this page?"))
      {
       var url = event.url;
      }
     },
 
    });



   });
    
function gotopage(selval){
        var value = selval.options[selval.selectedIndex].value;
        var route = '{{route('admin.booking-calendar')}}';
        if(value !=0){
            route = route +'?package='+value;    
        } 
        window.location.href=route;
       }
        $(document).ready(function() {
        var table = $('#calendar_table').DataTable( {

        } );
        });
   </script>
@endsection