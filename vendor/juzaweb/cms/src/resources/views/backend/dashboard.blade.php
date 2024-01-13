@extends('juzaweb::layouts.backend')

@section('content')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-0 bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fa fa-list font-size-50 mr-3"></i>
                        <div>
                            <div class="font-size-21 font-weight-bold">Posts</div>
                            <div class="font-size-15">253</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 bg-info text-white">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fa fa-list font-size-50 mr-3"></i>
                        <div>
                            <div class="font-size-21 font-weight-bold">Pages</div>
                            <div class="font-size-15">15</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fa fa-users font-size-50 mr-3"></i>
                        <div>
                            <div class="font-size-21 font-weight-bold">Users</div>
                            <div class="font-size-15">36</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <i class="fa fa-hdd-o font-size-50 mr-3"></i>
                        <div>
                            <div class="font-size-21 font-weight-bold">Media Files</div>
                            <div class="font-size-15">32</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @do_action('backend.dashboard.view')
    <!-- <div class="row">
        <div class="col-md-12">
            <div id="curve_chart" style="width: 100%; height: 300px"></div>
        </div>
    </div> -->

    <!-- <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Taday's Booking</h5>
                </div>

                <div class="card-body">
                    <table class="table" id="users-table">
                        <thead>
                            <tr>
                                <th data-formatter="index_formatter" data-width="5%">#</th>
                                <th data-field="name">Name</th>
                                <th data-field="created" data-width="30%" data-align="center">12.36.25</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Views</h5>
                </div>

                <div class="card-body">
                    <table class="table" id="posts-top-views">
                        <thead>
                            <tr>
                                <th data-formatter="index_formatter" data-width="5%">#</th>
                                <th data-field="title">ssss</th>
                                <th data-field="views" data-width="10%"></th>
                                <th data-field="created" data-width="30%" data-align="center"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

    

    <script type="text/javascript">
        setTimeout(function () {
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        }, 200);

        function drawChart() {
            var jsonData = $.ajax({
                url: "{{ route('admin.dashboard.views_chart') }}",
                dataType: "json",
                async: false
            }).responseText;
            jsonData = JSON.parse(jsonData);

            var data = google.visualization.arrayToDataTable(jsonData);

            var options = {
                title: "{{ trans('cms::app.chart_post_views_this_week') }}",
                curveType: 'function',
                legend: { position: 'bottom' },
                vAxis: {
                    minValue:0,
                    viewWindow: {
                        min: 0
                    }
                }
            };

            var chart = new google.visualization.LineChart(
                document.getElementById('curve_chart')
            );

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script>
    $(function() {
      $("#booking-table").dataTable();
    });
</script>

    





@endsection
