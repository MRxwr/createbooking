@extends('juzaweb::layouts.backend')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row mb-3">
        <div class="col-md-12 mb-3">
            @do_action('admin.employees.ckeckbox')
        </div>
        
        <div class="col-md-12">
            
           <div id='calendar'></div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/fc-3.2.2/fh-3.1.2/r-2.1.0/sc-1.4.2/datatables.min.css" />
    <script>
   
   $(document).ready(function() {
      var user = {{(isset($_GET['user'])?$_GET['user']:0)}};
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
          //return ['all', event.user].indexOf($('.option').val()) >= 0
        },
     events: '{{route("admin.employee-json")}}'+'?user='+user,
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
    
    if(user==0){
         $('#emp_users .option').each(function() {
          $(this).prop('checked',true);
       });
    }else{
         $("#emp"+user).prop("checked", true);
         $("#empall").prop("checked", false);
    }

  $("#empall").change(function(){

      var checked = $(this).is(':checked'); // Checkbox state

     // Select all
     if(checked){
         
       $('#emp_users .option').each(function() {
          $(this).prop('checked',true);
          
       });
        user = parseInt($(this).val());
        ajaxurl(user);
     }else{
       // Deselect All
       $('#emp_users .option').each(function() {
         $(this).prop('checked',false);
         //user = $('employees').val(value)
       });
        
     }
    
  });
 
  // Changing state of Checkbox
  var checked = []
  $(".option").change(function(){
      
    // When total options equals to total selected option
    if($(".option").length == $(".option:checked").length) {
        //alert($(".option").length);
       $("#empall").prop("checked", true);
       var user = 0;
       ajaxurl(user)
       
       var checked = []
    } else {
       $("#empall").prop("checked", false);
      user = parseInt($(this).val());
      ajaxurl(user);
     
    }
   });

   });
    function ajaxurl(user){
       
        var ajroute = '{{route("admin.employee-calendar")}}';
            ajroute = ajroute +'?user='+user;  
             window.location.href=ajroute;
        
    }
function gotopage(selval){
        var value = selval.options[selval.selectedIndex].value;
        var route = '{{route('admin.booking-calendar')}}';
        if(value){
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