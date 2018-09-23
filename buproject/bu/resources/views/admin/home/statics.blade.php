@extends('admin.layouts.layout')

@section('title')
    احصائيات اضافة العقار عن السنة
    {{$year}}
@endsection

@section('header')

@endsection
@section('content')
    <section class="content-header">
        <h1>
            احصائيات اضافة العقار عن السنة
            {{$year}}        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i>الرئيسية</a></li>
            <li><a href="{{url('/adminpanel/buYear/statics')}}">احصائيات اضافة العقار عن السنة
                    {{$year}}</a></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url'=>'/adminpanel/buYear/statics','method' => 'post']) !!}
                <select class="select2" style="width: 100px" name="year">
                    @for($i=2018;$i<=2050;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <input type="submit" name="submit" value="اظهار الاحصائيات" class="btn btn-warning"/>
                {!! Form::close() !!}
                <p class="text-center">
                    <strong>  احصائيات اضافة العقار عن السنة
                        {{$year}}</strong>
                </p>
                <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                </div><!-- /.chart-responsive -->
            </div><!-- /.col -->

        </div><!-- /.row -->

    </section>

@endsection


@section('footer')
    {{Html::script('cus/js/select2.js')}}
    <script type="text/javascript">
        $(".select2").select2({
            dir: "rtl"
        });
        /* ChartJS
* -------
* Here we will create a few charts using ChartJS
*/

        //-----------------------
        //- MONTHLY SALES CHART -
        //-----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

        var salesChartData = {
            labels: [
                "يناير",
                "فبراير",
                "مارس",
                "ابريل",
                "مايو",
                "يونيو",
                "يوليو",
                "أغسطس",
                "سبتمبر",
                " أكتوبر",
                " نوفمبر",
                "ديسمبر"

            ],
            datasets: [

                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [
                        @foreach($new as $c)
                            @if(is_array($c))
                        {{$c['counting']}},
                            @else
                        {{$c}},
                            @endif
                        @endforeach
                    ]
                }
            ]
        };
    </script>

@endsection
