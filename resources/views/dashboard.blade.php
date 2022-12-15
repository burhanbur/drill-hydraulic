@extends('layouts.main')

@section('title', 'Drill Hydraulic - Dashboard')

@section('css')
<style>
    .text-center {
        text-align: center;
    }

    .form-control-custom {
        width: 70%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
@endsection

@section('js')
<script>
    <?php if ($model == 'semua') { ?>
        var chartData = {
            labels: <?= json_encode($xChartValues); ?>,
            datasets: [
                <?php $i = 0;
                foreach (\App\Helpers\Dropdown::listRheologicalModel() as $k => $v) { ?> {
                        label: '<?= $v ?>',
                        backgroundColor: '<?= \App\Helpers\Dropdown::listColor()[$i] ?>',
                        borderColor: '<?= \App\Helpers\Dropdown::listColor()[$i] ?>',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: '<?= \App\Helpers\Dropdown::listColor()[$i] ?>',
                        pointHighlightFill: '#fff',
                        borderWidth: 4,
                        // pointRadius			: 4,
                        pointHighlightStroke: '<?= \App\Helpers\Dropdown::listColor()[$i] ?>',
                        data: <?= json_encode($yChartValues[$k]); ?>
                    },
                <?php $i++;
                } ?>
            ],
        }

        var chartOption = {
            legend: {
                display: true,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        reverse: false
                    },
                }],
                xAxes: [{
                    ticks: {
                        reverse: true
                    },
                }],
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }

        var lineChartCanvas = $('#myChart').get(0).getContext('2d');
        var lineChartOption = $.extend(true, {}, chartOption);
        var lineChartData = $.extend(true, {}, chartData);
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartData.datasets[2].fill = false;
        lineChartData.datasets[3].fill = false;
        lineChartData.datasets[4].fill = false;
        lineChartOption.datasetFill = false;

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOption
        })

    <?php } else { ?>
        var xValues = <?= json_encode($xChartValues); ?>;
        var yValues = <?= json_encode($yChartValues); ?>;

        var myChart = new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    // lineTension: 0,
                    // pointRadius: 4,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,1.0)",
                    borderWidth: 8,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            reverse: false
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            reverse: true
                        },
                    }],
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }
            }
        });
    <?php } ?>
</script>
@endsection

@section('container')
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="rheological">
                            @include('rheological')
                        </div>

                        <div class="tab-pane" id="pressure">
                            @include('underconstruction')
                        </div>

                        <div class="tab-pane" id="ecd">
                            @include('underconstruction')
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</section>
</div>
@endsection