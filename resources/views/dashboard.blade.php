@extends('layouts.main')

@section('title', 'Drill Hydraulic - Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('style.css') }}" />
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

    .hidden {
        display: none;
    }
</style>
@endsection

@section('js')
<script>
    jQuery('.digitsOnly').keypress(function(event){
        if(event.which !=8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }
    });

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

    function bottomCriticalDepth(i) {
        let bot = $('#casing_length' + i).val();

        $('#casing_bottom_citical_depth' + i).val(bot);

        let top = 0;
        if (i != 0) {
            top = $('#casing_length' + (i - 1)).val();
        }

        $('#casing_top_citical_depth' + i).val(top);
    }

    function psiMd(value, component, i) {
        let md = 0;

        if (component == 'drill_pipe') {
            md = value;
        } else {
            md = Number(value) + Number($('#psi_md' + (i - 1)).val());
        }

        $('#psi_md' + i).val(md);
    }

    function getCombination(value) {
        $.ajax({
            type: 'GET',
            url: "{{ route('ajax.combination') }}",
            data: {
                combination: value
            },
            success: function(data) {
                $('#set_standpipe_id').val(data.standpipe_id);
                $('#set_standpipe_length').val(data.standpipe_length);
                $('#set_rotary_hose_id').val(data.rotary_hose_id);
                $('#set_rotary_hose_length').val(data.rotary_hose_length);
                $('#set_swivel_id').val(data.swivel_id);
                $('#set_swivel_length').val(data.swivel_length);
                $('#set_kelly_pipe_id').val(data.kelly_pipe_id);
                $('#set_kelly_pipe_length').val(data.kelly_pipe_length);
                $('#set_edp_35').val(data.edp_35);
                $('#set_edp_45').val(data.edp_45);
                $('#set_edp_50').val(data.edp_50);
            }
        });
    }

    $('#set-select').on('change', function() {
        getCombination(this.value);

        let pipe = $('#edpt-select').find(":selected").val();
        getOutputSurface(this.value, pipe);
    });


    getCombination($('#set-select').find(":selected").val());

    function getOutputSurface(combination, type) {
        $.ajax({
            type: 'GET',
            url: "{{ route('ajax.output.surface') }}",
            data: {
                combination: combination,
                type: type
            },
            success: function(data) {
                $('#output_se_edpl').val(data);
            }
        });
    }

    $('#edpt-select').on('change', function() {
        let combination = $('#set-select').find(":selected").val();
        getOutputSurface(combination, this.value);
    });

    getOutputSurface($('#set-select').find(":selected").val(), $('#edpt-select').find(":selected").val());
</script>
@endsection

@section('container')
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @include('modal-input')

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="rheological">
                            @include('rheological')
                        </div>

                        <div class="tab-pane active" id="pressure">
                            @include('pressure-loss')
                        </div>

                        <div class="tab-pane" id="ecd">
                            @include('underconstruction')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection