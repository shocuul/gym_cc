<div class="inner-banner">
            <h1>Estadisticas</h1>
            <p>Asistencias de socios</p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li>
                        <?php //echo anchor('#rutinaAdd','<i class="fas fa-plus-circle"></i>  Agregar Rutina','data-toggle="modal" class="detail-btn"'); ?> </li>
                </ul>
                <ul class="pull-right">
                    <li><?php //echo anchor('configuracion/planes','<i class="fas fa-arrow-left"></i> Volver','class="detail-btn"'); ?></li>
                </ul>
             </div>
        </div>
        <!--Inner Banner End-->

        <div class="page-wrapper">
            <!-- Blog Full Start -->
            <div class="events-listing">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div id="curve_chart" style="width: 900px; height: 500px"></div>

                        </div>

                        <!--Sidebar Start-->
                        <div class="col-md-3">
                            <div class="sidebar">

                                <!--Widget Start-->
                                <div class="widget">
                                    <div class="text-widget"> 
                                        <h3>Fechas</h3>
                                        <form class="contact-form" style="padding: 0;">
                                            <?php echo form_dropdown('date', $dropdown['options'], $dropdown['select'],'class="form-control" id="date_dropdown" onchange="reloadCharts()"'); ?>
                                        </form>
                                    </div>
                                </div>
                                <!--Widget End-->

                                <!--Widget Start-->
                                
                                <!--Widget End-->

                                

                            </div>
                        </div>
                        <!--Sidebar End-->

                    </div>
                </div>
            </div>
            <!-- Blog Full End -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function reloadCharts()
    {
        drawVisualization();
    }

    function drawVisualization() {
        var select_date = $("select[id^='date_dropdown']").val();
        $.ajax({
            type:"post",
            url:"<?= base_url(); ?>ajax/generate_stats",
            data:{key:select_date},
            success:function(response){
                // console.log(response);
                var data = google.visualization.arrayToDataTable(response);
                var options = {
                    vAxis: {title: 'Asistencias'},
                    hAxis: {title: 'Dias de la semana'},
                    seriesType: 'bars',
                    //series: {5: {type: 'line'}},
                    width:770,
                    height:500
                };
                var chart = new google.visualization.ComboChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
                // console.log(response);
                // var data = google.visualization.arrayToDataTable(response);
                // var options = {
                //     title:'Asistencias por Semana',
                //     curveType: 'function',
                //     legend: { position: 'bottom' },

                //     vAxis: {title: 'Asistencias'},
                //     hAxis: {title: 'Fechas'},
                //     //series: {5: {type: 'line'}},
                //     //width:770,
                //     //height:500
                // };
                // var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                // chart.draw(data, options);

            }
        });
    }
    
</script>
