<!--Top Players Start-->
<div class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-title">Promociones</h2>
                    </div>
                </div>
                <div class="row">
                    <!--Top Player Start-->
                    <?php  if(!empty($ads)) : ?>
                    <?php foreach($ads as $image) :?>
                    <div class="col-md-6 col-sm-6">
                        <div class="player-thumb">
                                <img src="images/public/<?php echo $image->path; ?>" alt="<?php echo $image->path; ?>" style="max-width:100%;">    
                            
                            
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?php else : ?>
                    <div class="col-md-3 col-sm-3">
                        <div class="player-thumb"> <img src="images/topplayer1.jpg" alt="">
                            
                        </div>
                    </div>
                    <!--Top Player End-->

                    <!--Top Player Start-->
                    <div class="col-md-3 col-sm-3">
                        <div class="player-thumb"> <img src="images/topplayer2.jpg" alt="">
                        
                        </div>
                    </div>
                    <!--Top Player End-->

                    <!--Top Player Start-->
                    <div class="col-md-3 col-sm-3">
                        <div class="player-thumb"> <img src="images/topplayer3.jpg" alt="">
                           
                        </div>
                    </div>
                    <!--Top Player End-->

                    <!--Top Player Start-->
                    <div class="col-md-3 col-sm-3">
                        <div class="player-thumb"> <img src="images/topplayer4.jpg" alt="">
                            
                        </div>
                    </div>
                    <!--Top Player End-->
                    <?php endif ?>
                    

                </div>
            </div>
        </div>
        <!--Top Players End-->


<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
    <div class="container">
        <div class="row">
        <div class="col-md-5">
            <div class="contact-info">
            <h2 class="section-title"> Sobre Nosotros </h2>
            <address>
              <ul>
                <li>
                  <div class="add-icon"> <i class="fa fa-map-marker"></i> </div>
                  <strong>Domicilio</strong>
                  <p>Calle Palomar #1 Col. Centro <br>
                  Fresnillo, Zacatecas <br>
                  C.P. 999059
                </p>
                </li>
                <li>
                  <div class="add-icon"> <i class="fa fa-phone"></i> </div>
                  <strong>Llamanos</strong>
                  <p> (493) 93-2-93-94<br>
                 </p>
                </li>
                <li>
                    <div class="add-icon"><i class="fas fa-clock"></i></div>
                    <strong>Horarios</strong>
                    <p>
                        Lunes a Viernes: 6:00 am - 10:30pm <br>
                        Sabado y Domingo: 8:00 am - 02:00pm 
                    </p>
                </li>
                <li>
                  <div class="add-icon"> <i class="fa fa-envelope"></i> </div>
                  <strong>Correo Electronico</strong>
                  <a href="mailto:info@saluddeacero.com.mx">info@saluddeacero.com.mx</a> </li>
                <li class="player-social">
                  <div class="add-icon"> <i class="fa fa-share-alt"></i> </div>
                  <strong>Siguenos en Facebook</strong>
                  <a href="https://www.facebook.com/SaluddeAceroOficial/" class="fb-icon"><i class="fab fa-facebook"></i></a>  </li>
              </ul>
              </address>
                            </div>
                        </div>
        
        <div class="col-md-7">
                            <div class="contact-form">
                                <h2 class="section-title"> Mapa </h2>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3667.8388885138816!2d-102.87983384946564!3d23.17607958480129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86830b9926f3344b%3A0x511b19510e59a7d3!2sCalle+Palomar+1%2C+Centro%2C+99039+Fresnillo%2C+Zac.!5e0!3m2!1ses-419!2smx!4v1539841623550" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
    </div>
</section>
        <!--League Schedule Slider End-->

<!--Top Players Start-->
<div class="news-section-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title">Galeria</h2>
            </div>
        </div>
        <div class="gallery">
            <div class="container">
                <div class="row">
                    <?php if(!empty($gallery)): ?>
                        <?php foreach($gallery as $image): ?>
                            <div class="col-md-4 col-sm-4">
                                <div class="gall-thumb">
                                    <div class="cap">
                                        <a href="images/public/<?php echo $image->path; ?>" rel="prettyPhoto[pp_gal]"> <i class="fa fa-expand" aria-hidden="true"></i> </a> <strong>Ampliar</strong> </div>
                                        <img src="images/public/<?php echo $image->path; ?>" alt=""> </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                        <?php endif ?>
                                        
                        <!--Gallery Img Start-->
                        
                        <!--Gallery Img End-->

                    </div>
                </div>
            </div>

                

    </div>
</div>
        <!--Top Players End-->

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
  $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>