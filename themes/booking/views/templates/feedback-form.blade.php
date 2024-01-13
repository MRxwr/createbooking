@extends('juzaweb::layouts.frontend')

@section('content')
 <!-- reservation-details -->
 <section class="reservation-details py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 pb-5">
                                <div class="site-title position-relative d-flex align-items-center">
                                    <div class="bg-white">
                                        <h3 class="fs30 text-300 SegoeUIL pe-4">
                                            @lang('theme::app.reservation_details')
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-xl-11 mb-4">
                        <div class="feedback-form">
                            @do_action('theme.feedback.form_submit')
                            @do_action('theme.feedback.form')
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- reservation-details -->
        
@endsection
@section('footer')
                <script>
                        $("#image-input").hide();
                        $("#image-input").change(function() {
                            if (typeof (FileReader) != "undefined") {

                            var image_holder = $("#preview-image");
                            image_holder.empty();

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "thumb-image"
                                }).appendTo(image_holder);

                            }
                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[0]);
                            } else {
                            alert("This browser does not support FileReader.");
                            }
                        });
                        $("#preview-image").click(function() {
                            $("#image-input").click();
                        });
                    </script>
@endsection
