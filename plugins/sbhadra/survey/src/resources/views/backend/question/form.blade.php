@extends('juzaweb::layouts.backend')

@section('content')

    @component('juzaweb::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-8">

                {{ Field::text($model, 'title', [
                    'required' => true,
                    'class' => empty($model->slug) ? 'generate-slug' : '',
                ]) }}
            
                   <div class="options multi" id="dynamic_field"  @if( $model->question_type=='3' || $model->question_type=='4' ) style="display: none;" @endif >
                  

                     @if($model->options)
                      @php
                         $options = json_decode($model->options);
                         $options = (array) $options;
                         $total_opt=count($options);
                      @endphp
                      
                      @foreach($options as $k=> $option)
                       <div id="row{{$k}}" class="row">
                            <div class="form-group col-sm-10 ">
                                <label class="control-label mb-10 text-left">Option {{$k+1}}</label>
                                <input type="text" id="input-file-max-fs{{$k}}" name="options[]" class="form-control" value="{{$option}}">
                            </div>
                            
                               @if($k==0)
                                
                               @elseif($k==1)
                                <div class="form-group col-sm-2 ">
                                    <button type="button" name="add" id="add" class="btn btn-success" style="margin-top:30px;">Add More</button>
                                </div>
                               @elseif($k>1)
                                <div class="form-group col-sm-2 ">
                                    <button type="button" name="remove" id="{{$k}}" class="btn btn-danger btn_remove" style="margin-top:30px;">Remove</button>
                                </div>
                               @endif   
                        </div>
                        @endforeach
                     @else
                        <div class="row">
                            <div class="form-group col-sm-10 ">
                                <label class="control-label mb-10 text-left">Option 1</label>
                                <input type="text" id="input-file-max-fs" name="options[]" value="" class="form-control">
                            </div>
                            <div class="form-group col-sm-2 ">
                                <!-- <button type="button" name="fixed" id="fixed" class="btn btn-success">Fixed</button> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-10 ">
                                <label class="control-label mb-10 text-left">Option 2</label>
                                <input type="text" id="input-file-max-fs" name="options[]" value=""  class="form-control">
                            </div>

                            <div class="form-group col-sm-2 ">
                            <button type="button" name="add" id="add" class="btn btn-success" style="margin-top:30px;">Add More</button>
                            </div>
                        </div>
                        @endif
                    </div>
                @do_action('post_type.'. $postType .'.form.left')

            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label class="control-label mb-10 text-left">Question Type</label>
                        <select class="form-control" name="question_type" id="question_type">
                            <option value="1" @if( $model->question_type=='1') selected="selected" @endif>Multiple choice(Single)</option>
                            <option value="2" @if( $model->question_type=='2') selected="selected" @endif>Multiple choice(Multiple)</option>
                            <option value="3" @if( $model->question_type=='3') selected="selected" @endif>True/False</option>
                            <option value="4" @if( $model->question_type=='4') selected="selected" @endif>Text field</option>
                        </select>
                </div>

                {{ Field::select($model, 'status', [
                    'options' => $model->getStatuses()
                ]) }}
                @do_action('post_type.'. $postType .'.form.right', $model)
            </div>
        </div>
        
    @endcomponent
    <script type="text/javascript">
  
  $(document).ready(function(){
    $('#question_type').on('change', function() {
      //alert( this.value );
      if(this.value==1 || this.value==2){
           $('.multi').css('display','block');
      }else{
           $('.multi').css('display','none');
      }
   });
    var i=2;
    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="form-group col-sm-10 "><label class="control-label mb-10 text-left">Option '+i+'</label><input type="text" id="input-file-max-fs" name="options[]" class="form-control" /></div><div class="form-group col-sm-2 "><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="margin-top:30px;">Remove</button></div></div>');
    }); 
    
    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id"); 
      $('#row'+button_id+'').remove();
    });
 

  $('.datetimepicker').datetimepicker({
              format: 'LT',
              useCurrent: false,
              icons: {
                      time: "fa fa-clock-o",
                      date: "fa fa-calendar",
                      up: "fa fa-arrow-up",
                      down: "fa fa-arrow-down"
                  },
          });
  });
</script>
@endsection
