<div class="inner-banner">
            <h1>Estadisticas</h1>
            <p>Asistencias de socios</p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li>
                        <?php echo anchor('#rutinaAdd','<i class="fas fa-plus-circle"></i>  Agregar Rutina','data-toggle="modal" class="detail-btn"'); ?> </li>
                </ul>
                <ul class="pull-right">
                    <li><?php echo anchor('configuracion/planes','<i class="fas fa-arrow-left"></i> Volver','class="detail-btn"'); ?></li>
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
                                <div class="widget">
                                    <div class="social-counter">
                                        <ul>
                                            <li>
                                                <a class="item facebook"> <i class="fa fa-facebook"></i> <span class="count">6709</span><em>Likes</em> </a>
                                            </li>
                                            <li>
                                                <a class="item twitter"> <i class="fa fa-twitter"></i> <span class="count">2710</span><em>Followers</em> </a>
                                            </li>
                                            <li>
                                                <a class="item google"> <i class="fa fa-google-plus"></i> <span class="count">209</span><em>Followers</em> </a>
                                            </li>
                                            <li>
                                                <a class="item instagram"> <i class="fa fa-instagram"></i> <span class="count">5692</span><em>Followers</em> </a>
                                            </li>
                                            <li>
                                                <a class="item youtube"> <i class="fa fa-youtube"></i> <span class="count">16378</span><em>Subscribers</em> </a>
                                            </li>
                                            <li>
                                                <a class="item dribbble"> <i class="fa fa-dribbble"></i> <span class="count">15</span><em>Followers</em> </a>
                                            </li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Widget End-->

                                <!--Widget Start-->
                                <div class="widget">
                                    <h3>Latest News</h3>
                                    <ul class="small-grid">
                                        <!--Row Start-->
                                        <li class="news">
                                            <div class="small-thumb"> <img src="images/lng1.jpg" alt=""> </div>
                                            <div class="news-txt">
                                                <ul class="meta-info">
                                                    <li><a href="#">NFL</a></li>
                                                </ul>
                                                <h6> <a href="#">Following Usain. Bolt's final 100m</a> </h6>
                                            </div>
                                        </li>
                                        <!--Row End-->

                                        <!--Row Start-->
                                        <li class="news">
                                            <div class="small-thumb"> <img src="images/lng2.jpg" alt=""> </div>
                                            <div class="news-txt">
                                                <ul class="meta-info">
                                                    <li><a href="#">College Basketball</a></li>
                                                </ul>
                                                <h6> <a href="#">Dominique Wilkins' injury, Jordan </a> </h6>
                                            </div>
                                        </li>
                                        <!--Row End-->

                                        <!--Row Start-->
                                        <li class="news">
                                            <div class="small-thumb"> <img src="images/lng3.jpg" alt=""> </div>
                                            <div class="news-txt">
                                                <ul class="meta-info">
                                                    <li><a href="#">Soccer</a></li>
                                                </ul>
                                                <h6> <a href="#">Eight of the top nine scorers from </a> </h6>
                                            </div>
                                        </li>
                                        <!--Row End-->

                                    </ul>
                                </div>

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
            url:"index.php?/ajax/generate_stats",
            data:{key:select_date},
            success:function(response){
                console.log(response);
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
