@extends('juzaweb::layouts.backend')

@section('content')
<style>
    #search-status{
        display:none;
    }
    .vodiapicker{
  display: none; 
}

#a{
  padding-left: 0px;
}

#a img, .btn-select img{
  width: 12px;
  
}

#a li{
  list-style: none;
  padding-top: 5px;
  padding-bottom: 5px;
}

#a li:hover{
 background-color: #F4F3F3;
}

#a li img{
  margin: 5px;
}

#a li span, .btn-select li span{
  margin-left: 30px;
}

/* item list */

.b{
  display: none;
  width: 100%;
  max-width: 350px;
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  border: 1px solid rgba(0,0,0,.15);
  border-radius: 5px;
  
}

.open{
  display: show !important;
}

.btn-select{
  margin-top: 10px;
  width: 100%;
  max-width: 350px;
  height: 34px;
  border-radius: 5px;
  background-color: #fff;
  border: 1px solid #ccc;
 
}
.btn-select li{
  list-style: none;
  float: left;
  padding-bottom: 0px;
}

.btn-select:hover li{
  margin-left: 0px;
}

.btn-select:hover{
  background-color: #F4F3F3;
  border: 1px solid transparent;
  box-shadow: inset 0 0px 0px 1px #ccc;
  
  
}

.btn-select:focus{
   outline:none;
}

.lang-select{
  margin-left: 50px;
}
</style>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="btn-group float-right">
                <a href="{{ route('bookings.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> @lang('sbsl::app.add_new')</a>
            </div>
        </div>
    </div>

    {{ $dataTable->render() }}
    
    <!-- Modal -->
    <div id="change_theme_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Theme</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           <form action="{{route('admin.change.theme')}}" method="post" class="form-ajax" novalidate="novalidate">
                    <input id="booking_id" type="hidden" name="id" value="">
                    {{csrf_field()}}
                      @do_action('admin.success.themes')
                    <br>
                    <div class="flot-right"> 
                        <button type="submit" class="btn btn-primary">Save Theme</button>
                    </div>
           </form>
        </div>
     </div>

    </div>
    </div>

    <div id="add_notes_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <form action="{{route('admin.add.notes')}}" method="post" class="form-ajax" novalidate="novalidate">
        <!-- Modal content-->
        <div class="modal-content">
          <input id="nbooking_id" type="hidden" name="id" value="">
          <div class="modal-header">
           
            <h4 class="modal-title">Update Booking Notes</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="pwd">Notes:</label>
                <textarea class="form-control" name="booking_notes"></textarea>
              </div>
            
          </div>
          <div class="modal-footer">
              <input type="submit" class="btn btn-primary" name="submit" value="submit">
          </div>
        </div>
        </form>
      </div>
      </div>
      
      <div id="assign_epm_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <form action="{{route('admin.add.employee')}}" method="post" class="form-ajax" novalidate="novalidate">
        <!-- Modal content-->
        <div class="modal-content">
          <input id="ebooking_id" type="hidden" name="id" value="">
          <div class="modal-header">
           
            <h4 class="modal-title">Assign Employee With the Booking </h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                    <label for="pwd">Employee:</label>
                    <select class="form-control" name="employee_id">
                         @do_action('admin.employees.option')
                    </select>
               
              </div>
          </div>
          <div class="modal-footer">
              <input type="submit" class="btn btn-primary" name="submit" value="submit">
          </div>
        </div>
        </form>
      </div>
      </div>
    <script>
      $("body").on("click", ".change_theme", function(e) {
         var booking_id = this.id;
         $('#booking_id').val(booking_id)
      });
      $("body").on("click", ".add_note", function(e) {
         var booking_id = this.id;
         $('#nbooking_id').val(booking_id)
      });
      $("body").on("click", ".assign_epm", function(e) {
         var booking_id = this.id;
         $('#ebooking_id').val(booking_id)
      });
    </script>
@endsection