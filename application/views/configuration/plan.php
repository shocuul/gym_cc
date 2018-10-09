<div class="inner-banner">
            <h1><?php echo htmlspecialchars($plan->nombre, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><?php echo htmlspecialchars($plan->descripcion, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li> <?php echo anchor('#rutinaAdd','Agregar Rutina','data-toggle="modal" class="detail-btn"'); ?> </li>
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
                                <?php var_dump($routines); ?>
                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-1.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">NBA Finals Cleveland Cavaliers</a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map map-toggle" href="#collapse1">View Map</a>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="event-map" id="collapse1">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.91476775007!2d-74.11976241555821!3d40.69740344311313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY!5e0!3m2!1sen!2s!4v1522218677770"></iframe>

                                        </div>

                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>June</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-2.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">Cras eu arcu vitae enim lacinia</a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-3.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">Nunc suscipit diam volutpat dui </a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-4.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">Maecenas pretium eros in posuere</a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-5.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">Cras euismod sem ac laoreet posuere</a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-6.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">Nulla elementum tortor a dui </a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
                                <!--Event Post End-->

                                <!--Event Post Start-->
                                <div class="event-post">
                                    <div class="event-date">
                                        <h5><span>Jan</span> 01, 2018</h5>
                                        <strong>6:00 pm - 8:00 pm</strong> </div>
                                    <div class="event-content">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/event-small-7.jpg" alt=""></div>
                                            <div class="event-txt">
                                                <h4><a href="#">NBA Finals Cleveland Cavaliers</a></h4>
                                                <p class="loc"><i class="fa fa-map-marker"></i> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                                                <div class="event-box-footer"> <span class="map-icon"><i class="fa fa-map"></i></span> <a class="detail-btn" href="#">Buy Tickets</a> <a class="view-map" href="#">View Map</a> </div>
                                            </div>
                                        </div>
                                        <div class="event-map"> </div>
                                    </div>
                                </div>
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