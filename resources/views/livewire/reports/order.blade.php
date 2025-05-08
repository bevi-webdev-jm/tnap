<div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="date">FILTER DATE</label>
                <input type="date" class="form-control" wire:model.live="date" id="date">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <figure class="highcharts-figure" wire:ignore>
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
            
        </div>

        <div class="col-lg-4">

            <div class="info-box">
                <span class="info-box-icon bg-info">
                    <i class="fa fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL UNIQUE CUSTOMERS</span>
                    <span class="info-box-number">{{$total_customer}}</span>
                </div>
            </div>

            @foreach($order_status_data as $data)
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <i class="fa fa-info-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{strtoupper($data->status)}}</span>
                        <span class="info-box-number">{{$data->total}}</span>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">TOTAL AMOUNT PER USER</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th class="text-center">TOTAL AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chart_ba_data as $data)
                                <tr>
                                    <td>{{$data['name']}}</td>
                                    <td class="text-right">{{number_format($data['y'], 2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">TOTAL AMOUNT PER PAYMENT METHOD</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th class="text-center">TOTAL AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payment_type_data as $data)
                                <tr>
                                    <td>{{$data['name']}}</td>
                                    <td class="text-right">{{number_format($data['y'], 2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

    <script>
        document.addEventListener('livewire:init', function() {
            (function (H) {
            H.seriesTypes.pie.prototype.animate = function (init) {
                const series = this,
                    chart = series.chart,
                    points = series.points,
                    {
                        animation
                    } = series.options,
                    {
                        startAngleRad
                    } = series;

                function fanAnimate(point, startAngleRad) {
                    const graphic = point.graphic,
                        args = point.shapeArgs;

                    if (graphic && args) {

                        graphic
                            // Set inital animation values
                            .attr({
                                start: startAngleRad,
                                end: startAngleRad,
                                opacity: 1
                            })
                            // Animate to the final position
                            .animate({
                                start: args.start,
                                end: args.end
                            }, {
                                duration: animation.duration / points.length
                            }, function () {
                                // On complete, start animating the next point
                                if (points[point.index + 1]) {
                                    fanAnimate(points[point.index + 1], args.end);
                                }
                                // On the last point, fade in the data labels, then
                                // apply the inner size
                                if (point.index === series.points.length - 1) {
                                    series.dataLabelsGroup.animate({
                                        opacity: 1
                                    },
                                    void 0,
                                    function () {
                                        points.forEach(point => {
                                            point.opacity = 1;
                                        });
                                        series.update({
                                            enableMouseTracking: true
                                        }, false);
                                        chart.update({
                                            plotOptions: {
                                                pie: {
                                                    innerSize: '40%',
                                                    borderRadius: 8
                                                }
                                            }
                                        });
                                    });
                                }
                            });
                    }
                }

                if (init) {
                    // Hide points on init
                    points.forEach(point => {
                        point.opacity = 0;
                    });
                } else {
                    fanAnimate(points[0], startAngleRad);
                }
            };
        }(Highcharts));

            window.addEventListener('update-chart', event => {
                const data = event.detail.data;

                Highcharts.chart('container', {
                    chart: { type: 'pie' },
                    title: { text: 'Total Quantity and Amount per SKU' },
                    tooltip: {
                        headerFormat: '',
                        pointFormat:
                            '<span style="color:{point.color}">\u25cf</span> ' +
                            '{point.name}: <b>{point.percentage:.1f}%</b><br>' +
                            '<b>Amount:</b> {point.y}<br>' +
                            '<b>Quantity:</b> {point.x}'
                    },
                    accessibility: { point: { valueSuffix: '%' } },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            borderWidth: 2,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b><br>{point.percentage:.1f}%',
                                distance: 20
                            }
                        }
                    },
                    series: [{
                        enableMouseTracking: false,
                        animation: { duration: 500 },
                        colorByPoint: true,
                        data: data
                    }]
                });
            });
        });
            

    </script>
