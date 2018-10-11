<div class="inner-banner">
            <h1><?php echo htmlspecialchars($plan->nombre, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><?php echo htmlspecialchars($plan->descripcion, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li>
                        <?php echo anchor('#rutinaAdd','Agregar Rutina','data-toggle="modal" class="detail-btn"'); ?> </li>
                </ul>
                <ul class="pull-right">
                    <li><?php echo anchor('configuracion/planes','Volver','class="detail-btn"'); ?></li>
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
                            <div class="events-posts">
                                <?php echo $message; ?>
                                <!--Event Post Start-->
                                <?php foreach ($routines as $routine): ?> 
                                <div class="event-post">
                                    <div class="event-date" style="width:10%;">
                                        <h5><span><?php //echo $routine->orden ?></span></h5>
                                    </div>
                                    <div class="event-content" style="width:90%;">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/<?php echo $routine->imagen; ?>" alt="<?php echo $routine->imagen; ?>" style="width:100%;"></div>
                                            <div class="event-txt">
                                                <h4><a href="#"><?php echo $routine->instruccion; ?></a></h4>
                                                <p class="loc"><i class="fa fa-dumbbell"></i> <?php echo $routine->ejercicio; ?></p>
                                                <div class="event-box-footer">  

                                                    <a class="detail-btn" href="#"><i class="fas fa-trash-alt"></i></a> 

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach ?>
                                <!--Event Post End-->

                            </div>
                        </div>

                        <!--Sidebar Start-->
                        <div class="col-md-3">
                            <div class="sidebar">

                                <!--Widget Start-->
                                <div class="widget">
                                    <div class="text-widget"> <img src="images/txt-img.jpg" alt="">
                                        <h3>About us</h3>
                                        <p> Duis aute dolor reprehenderit in voluptate cillum dolore pariatur. Ue Excepteur cupidatat proident, sunt in culpa officia deserunt mollit anim id est laborum. </p>
                                        <a class="detail-btn" href="#">Read More</a> </div>
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

<div class="modal fade" id="rutinaAdd" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Rutina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart(uri_string().'/rutina'); ?>
                <div class="form-group">
                    <?php echo form_label('Ejercicio', 'ejercicio'); ?>

                        <?php echo form_input($ejercicio); ?>

                </div>

                <div class="form-group">
                    <?php echo form_label('Instruccion', 'instruccion'); ?>
                    <?php echo form_textarea($instruccion); ?>

                </div>

                <div class="form-group">
                    <?php echo form_label('Imagen','imagen'); ?>
                    <?php echo form_upload($imagen); ?>
                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden('id', $plan->id); ?>
                <?php echo form_hidden($csrf); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Añadir Plan','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>