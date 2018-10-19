<div class="inner-banner">
            <img src="images/public/<?php echo $img_avatar->path; ?>" style="max-width: 250px; max-height: 200px;">
            <h1><?php echo htmlspecialchars($member->nombre .' '. $member->paterno .' '. $member->materno , ENT_QUOTES, 'UTF-8'); ?></h1>
            <p>
            <strong>Edad:</strong> <?php echo htmlspecialchars($member->edad , ENT_QUOTES, 'UTF-8'); ?>
            || <strong>Peso:</strong> <?php echo htmlspecialchars($member->peso , ENT_QUOTES, 'UTF-8'); ?>
            || <strong>Estatura:</strong>  <?php echo htmlspecialchars($member->estatura , ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li>
                    <?php // echo anchor(uri_string().'/asistencia','Registrar Asistencia','data-toggle="modal" class="detail-btn"'); ?>
                        <?php echo anchor('#imageAdd','Subir Imagen','data-toggle="modal" class="detail-btn"'); ?> </li>
                </ul>
                <ul class="pull-right">
                    <li><?php //echo anchor('socio/detalles/'.$member->id.'','Volver','class="detail-btn"'); ?></li>
                </ul>
             </div>
        </div>
        <!--Inner Banner End-->

        <div class="page-wrapper" style="padding:0;">
            <?php echo $message; ?>

            <!-- Blog Full Start -->
            <div class="events-listing">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 pro-tabs" style="margin-top:20px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#RutinasRegistradas" aria-controls="RutinasRegistradas" role="tab" data-toggle="tab">Rutinas Asignadas</a></li>
                                        <li role="presentation"><a href="#RutinasCompleto" aria-controls="RutinasCompleto" role="tab" data-toggle="tab">Rutinas Realizadas</a></li>
                                        <li role="presentation"><a href="#Estadisticas" aria-controls="Estadisticas" role="tab" data-toggle="tab">Estadisticas</a></li>
                                        <li role="presentation"><a href="#Asistencias" aria-controls="Asistencias" role="tab" data-toggle="tab">Asistencias</a></li>
                                        <li role="presentation"><a href="#Galeria" aria-controls="Galeria" role="tab" data-toggle="tab">Galeria</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="RutinasRegistradas">
                                            <?php if(!empty($subscribe_plans)):?>
                                                <?php foreach($subscribe_plans as $plan):?>
                                                <div class="small-txt" style="padding-bottom:1.5em;">
                                                    <h2>Plan: <?php echo $plan->nombre;?></h2>
                                                </div>
                                                <?php foreach($plan->current_routines as $routine): ?>
                                                    <div class="event-post">
                                                        <div class="event-date" style="width:10%;">
                                                            <h5><span><?php //echo date("F j, Y, g:i a",strtotime($routine->fecha_creacion)) ?></span></h5>
                                                        </div>
                                                        <div class="event-content" style="width:90%;">
                                                            <div class="event-txt-wrap">
                                                                <div class="event-thumb">
                                                                    <img src="images/public/<?php echo $routine->imagen;?>" alt="<?php echo $routine->imagen;?>" style="width:100%;">
                                                                </div>
                                                                <div class="event-txt">
                                                                    <h4><a href=""><?php echo $routine->instruccion;?></a></h4>
                                                                    <p class="loc"><i class="fa fa-dumbbell"></i><?php echo $routine->ejercicio; ?></p>
                                                                    <div class="event-box-footer">
                                                                        <?php echo anchor(uri_string().'/realizar/'.$routine->id,'Rutina Realizada','class="detail-btn"');?>
                                                                    <!-- <a data-toggle="modal" class="detail-btn" href="#rutineEdit@>Rutina Realizada</a>  -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                                <?php endforeach ?>
                                                
                                            <?php else:?>
                                            <div class="alert alert-info" role="alert">
                                            No se a registrado ninguna rutina.
                                            </div>
                                            <?php endif ?>
                                            

                                        </div>

                                            <div role="tabpanel" class="tab-pane" id="RutinasCompleto">
                                            <?php if(!empty($subscribe_plans)):?>
                                                <?php foreach($subscribe_plans as $plan): ?>
                                                <div class="small-txt" style="padding-bottom:1.5em;">
                                                    <h2>Plan: <?php echo $plan->nombre;?></h2>
                                                    </div>
                                                <?php foreach($plan->completed_routines as $routine): ?>
                                                    <div class="event-post">
                                                        <div class="event-date" style="width:10%;">
                                                            <h5><span><?php //echo date("F j, Y, g:i a",strtotime($routine->fecha_creacion)) ?></span></h5>
                                                        </div>
                                                        <div class="event-content" style="width:90%;">
                                                            <div class="event-txt-wrap">
                                                                <div class="event-thumb">
                                                                    <img src="images/public/<?php echo $routine->imagen;?>" alt="<?php echo $routine->imagen;?>" style="width:100%;">
                                                                </div>
                                                                <div class="event-txt">
                                                                    <h4><a href=""><?php echo $routine->instruccion;?></a></h4>
                                                                    <p class="loc"><i class="fa fa-dumbbell"></i><?php echo $routine->ejercicio; ?></p>
                                                                    <div class="event-box-footer">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                                <?php endforeach ?>
                                            <?php else:?>
                                            <div class="alert alert-info" role="alert">
                                                El socio no ha completado ninguna rutina
                                            </div>
                                            <?php endif ?>
                                            
                                        
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="Estadisticas">
                                            <div id="chart_div" style="width: 100%; height: 500px;"></div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="Asistencias">
                                            <div class="sp-table-wrapper">
                                                <table class="points-listing">
                                                    <thead>
                                                        <tr class="first">
                                                            <th style="width:30px;"><i class="fas fa-bell"></i></th>
                                                            <th>Fecha</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        <?php // var_dump($assists); ?>
                                                        <?php foreach($assists as $a):?>
                                                        <tr>
                                                            <td><img src="images/green.png" alt="" style="max-width:10px;"></td>
                                                            <td><?php echo htmlspecialchars($a->fecha, ENT_QUOTES, 'UTF-8'); ?></td>
                                                        </tr>
                                                        <?php endforeach?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!--  Termina TabPanel -->
                                        <div role="tabpanel" class="tab-pane" id="Galeria">
                                             <!-- Gallery Page Start -->
                                        <div class="gallery">
                                        <div class="container">
                                        <div class="row">
                                        <?php if(!empty($gallery)): ?>
                                        <?php foreach($gallery as $image): ?>
                                            <div class="col-md-4 col-sm-4">
                                            <div class="gall-thumb">
                                            <div class="cap">
                                            <a href="images/public/<?php echo $image->path; ?>" rel="prettyPhoto[pp_gal]"> <i class="fa fa-expand" aria-hidden="true"></i> </a> <strong><?php echo htmlspecialchars($member->nombre .' '. $member->paterno .' '. $member->materno , ENT_QUOTES, 'UTF-8'); ?></strong> </div>
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
            <!-- Gallery Page End -->
                                        </div>
                                        </div>
                                        </div>
                                    <!-- </div> -->
                            
                        

                        <!--Sidebar Start-->
                        <!-- <div class="col-md-3">
                            <div class="sidebar">

                                Widget Start
                                <div class="widget">
                                    <div class="text-widget">
                                        <h3>Medidas</h3>
                                        <a data-toggle="modal" class="detail-btn btn-block" href="#addreadingModal">Registrar Medida</a> </div>
                                </div>
                                <div class="widget">
                                    <div class="text-widget .news-txt">
                                    <a data-toggle="modal" class="detail-btn btn-block rm" href="#addreadingModal">Quitar Plan</a>
                                    </div>
                                </div>
                                Widget End

                            

                                

                            </div>
                        </div>
                        Sidebar End -->

                    </div>
                </div>
            </div>
            <!-- Blog Full End -->

<div class="modal fade" id="imageAdd" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir Imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart(uri_string()); ?>
                <div class="form-group">
                    <?php echo form_label('Imagen','imagen'); ?>
                    <input type="hidden" name="imagen" id="imagen">
                    <div id="fileupload" class="dropzone"></div>
                </div>
                <div class="form-group form-check">
                    <?php echo form_checkbox($avatar); ?>
                    <?php echo form_label('Usar como avatar','avatar','class="form-check-input"')?>
                </div>
                    
                
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('id', $member->id); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Subir Imagen','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
  $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#fileupload",{
        url:'index.php?/ajax/upload',
        acceptedFiles: 'image/*',
        maxFilesize: 3,
        maxFiles:1,
        dictDefaultMessage:"Arrastra las imagenes aqui.",
        success:function(file, response){
            console.log(response);
            $('#imagen').val(response.file_name);
        }
    });
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        $.ajax({
            type:"get",
            url:"index.php?/ajax/generate_chart_data/<?php echo $member->id ?>",
            success:function(response){
                //console.log(response);
                var data = google.visualization.arrayToDataTable(response);
                var options = {
                    vAxis: {title: 'Medidas'},
                    hAxis: {title: 'Fechas'},
                    seriesType: 'bars',
                    //series: {5: {type: 'line'}},
                    width:1000,
                    height:500
                };
                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        })
    }
function fillRoutineModal(id, ejercicio, instruccion)
{
    document.getElementById('ejercicio').setAttribute('value', ejercicio);
    $('#nombre_ejercicio').html(ejercicio);
    document.getElementById('instruccion').value = instruccion;
    document.getElementById('rutine_id').setAttribute('value',id);
}
</script>