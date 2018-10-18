<!--Inner Banner Start-->
<div class="inner-banner">
            <h1>Menus de alimentacion</h1>
            <p>Complementa tu plan de ejercicios con estos planes alimenticios</p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <!-- <li> <a href="index.html">Home</a> </li>
                    <li> <a href="#">Gallery</a> </li> -->
                </ul>
                <ul class="pull-right">
                    <li><?php //echo anchor('socio/detalles/'.$member->id.'','Volver','class="detail-btn"'); ?></li>
                </ul>
        </div>
        <!--Inner Banner End-->

        <div class="page-wrapper" style="padding:0;">

            <!-- Gallery Page Start -->
            <div class="gallery">
                <div class="container">
                    <div class="row">
                        <?php if(!empty($images)):  ?>
                        <?php foreach($images as $image): ?>
                        <!--Gallery Img Start-->
                        <div class="col-md-4 col-sm-4">
                            <div class="gall-thumb">
                                <div class="cap">
                                    <a href="images/public/<?php echo $image->path; ?>" rel="prettyPhoto[pp_gal]"> <i class="fa fa-expand" aria-hidden="true"></i> </a> <strong>Ampliar Menu</strong> </div>
                                <img src="images/public/<?php  echo $image->path; ?>" alt="<?php  echo $image->path; ?>"> </div>
                        </div>
                        <!--Gallery Img End-->
                        <?php endforeach ?>
                        <?php else: ?>
                        <div class="alert alert-info" role="alert">
                            Aun no hay menus de alimentacion disponibles.
                        </div>
                        <?php endif ?>
                        <!--Gallery Img Start-->
                

                    </div>
                </div>
            </div>
            <!-- Gallery Page End -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
  $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>