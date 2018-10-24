<div class="inner-banner">
            <h1><?php echo htmlspecialchars($plan->nombre, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><?php echo htmlspecialchars($plan->descripcion, ENT_QUOTES, 'UTF-8'); ?></p>
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
                            <div class="events-posts">
                                <?php echo $message; ?>
                                <!--Event Post Start-->
                                <?php if(!empty($routines)): ?>
                                <?php foreach ($routines as $routine): ?> 
                                <div class="event-post">
                                    <div class="event-date" style="width:10%;">
                                        <h5><span><?php //echo $routine->orden ?></span></h5>
                                    </div>
                                    <div class="event-content" style="width:90%;">
                                        <div class="event-txt-wrap">
                                            <div class="event-thumb"><img src="images/public/<?php echo $routine->imagen; ?>" alt="<?php echo $routine->imagen; ?>" style="width:100%;"></div>
                                            <div class="event-txt">
                                                <h4><a href="#"><?php echo $routine->instruccion; ?></a></h4>
                                                <p class="loc"><i class="fa fa-dumbbell"></i> <?php echo $routine->ejercicio; ?></p>
                                                <div class="event-box-footer">  

                                                    <a class="detail-btn" href="#rutinaDelete" data-toggle="modal" onClick="fillDeleteModal('<?php echo $routine->id ?>','<?php echo $routine->ejercicio ?>')"><i class="fas fa-trash-alt"></i></a> 

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach ?>
                                <!--Event Post End-->
                                <?php else: ?>
                                    <div class="alert alert-info" role="alert">
                                    No hay rutinas registradas aun, da click en  <strong>Agregar Rutina</strong> para comenzar.
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!--Sidebar Start-->
                        <div class="col-md-3">
                            <div class="sidebar">

                                
                                <!--Widget End-->

                                <!--Widget Start-->
                                <div class="widget">
                                    <h3>Socios</h3>
                                    <ul class="small-grid">
                                        <!--Row Start-->
                                        <?php if(!empty($users)): ?>
                                            <?php foreach($users as $user): ?>
                                                <li class="news">
                                                <div class="small-thumb"> <img src="images/public/<?php echo $user->avatar->path; ?>" alt=""> </div>
                                                <div class="news-txt">
                                                <h6> <?php echo anchor('socio/detalles/'.$user->user_id,$user->nombre.' '. $user->paterno.' '.$user->materno); ?> </h6>
                                                </div>
                                                </li>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <div class="alert alert-info" role="alert">
                                            No hay socios subscritos a este plan.
                                            </div>
                                        <?php endif ?>
                                        
                                        <!--Row End-->
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
                <?php echo form_open(uri_string().'/rutina'); ?>
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
                    <input type="hidden" name="imagen" id="imagen">
                    <div id="fileupload" class="dropzone"></div>
                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden('id', $plan->id); ?>
                <?php echo form_input($csrf); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Añadir Plan','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="rutinaDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:200001;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Rutina | Confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalName"></h4>
      </div>
      <div class="modal-footer">
        <?php echo form_open(uri_string().'/eliminar_rutina'); ?>
        <input type="hidden" name="delete_rutina_id" id="delete_rutina_id" value="" />
        <?php echo form_input($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar Rutina','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function fillDeleteModal(id, nombre)
    {
        $('#modalName').html('¿Desea eliminar la rutina '+nombre+'?.')
        document.getElementById('delete_rutina_id').setAttribute('value', id);
    }
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
</script>
