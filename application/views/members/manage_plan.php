<div class="inner-banner">
            <h1><?php echo htmlspecialchars($current_plan->nombre_plan, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><strong>Socio Seleccionado:</strong><?php echo htmlspecialchars($current_plan->nombre . ' ' . $current_plan->paterno . ' ' . $current_plan->materno , ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="fl-breadcrumps">
            <div class="container">
                <ul class="pull-left">
                    <li>
                        <?php //echo anchor('#rutinaAdd','Agregar Rutina','data-toggle="modal" class="detail-btn"'); ?> </li>
                </ul>
                <ul class="pull-right">
                    <li><?php echo anchor('socio/detalles/'.$member_id.'','Volver','class="detail-btn"'); ?></li>
                </ul>
             </div>
        </div>
        <!--Inner Banner End-->

        <div class="page-wrapper" style="padding:0;">
            <?php  echo $message; ?>

            <!-- Blog Full Start -->
            <div class="events-listing">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 pro-tabs" style="margin-top:20px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#RutinasRegistradas" aria-controls="RutinasRegistradas" role="tab" data-toggle="tab">Rutinas Registradas</a></li>
                                        <li role="presentation"><a href="#RutinasBase" aria-controls="RutinasBase" role="tab" data-toggle="tab">Rutinas Disponibles</a></li>
                                        <li role="presentation"><a href="#RutinasCompleto" aria-controls="RutinasCompleto" role="tab" data-toggle="tab">Rutinas Realizadas</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="RutinasRegistradas">
                                            <?php if(!empty($sub_rutines)):?>
                                                <?php foreach($sub_rutines as $routine): ?>
                                                    <div class="event-post">
                                                        <div class="event-date" style="width:10%;">
                                                            <h5><span><?php //echo date("F j, Y, g:i a",strtotime($routine->fecha_creacion)) ?></span></h5>
                                                        </div>
                                                        <div class="event-content" style="width:90%;">
                                                            <div class="event-txt-wrap">
                                                                <div class="event-thumb">
                                                                    <img src="images/<?php echo $routine->imagen;?>" alt="<?php echo $routine->imagen;?>" style="width:100%;">
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
                                            <?php else:?>
                                            <div class="alert alert-info" role="alert">
                                            No se a registrado ninguna rutina.
                                            </div>
                                            <?php endif ?>
                                            

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="RutinasBase">
                                            <?php if(!empty($routines)):?>
                                            <div class="events-posts">
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

                                                        <a data-toggle="modal" class="detail-btn" href="#rutineEdit" onClick="fillRoutineModal('<?php echo $routine->id ?>','<?php echo $routine->ejercicio ?>','<?php echo $routine->instruccion?>')">Asignar Rutina</a> 

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    <!--Event Post End-->

                                        </div>
                                        <?php else:?>
                                        <div class="alert alert-info" role="alert">
                                            No hay rutinas registradas en este plan.
                                        </div>
                                        <?php endif ?>  
                                               
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="RutinasCompleto">
                                            <?php if(!empty($sub_rutines_completed)):?>
                                                <?php foreach($sub_rutines_completed as $routine): ?>
                                                    <div class="event-post">
                                                        <div class="event-date" style="width:10%;">
                                                            <h5><span><?php //echo date("F j, Y, g:i a",strtotime($routine->fecha_creacion)) ?></span></h5>
                                                        </div>
                                                        <div class="event-content" style="width:90%;">
                                                            <div class="event-txt-wrap">
                                                                <div class="event-thumb">
                                                                    <img src="images/<?php echo $routine->imagen;?>" alt="<?php echo $routine->imagen;?>" style="width:100%;">
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
                                            <?php else:?>
                                            <div class="alert alert-info" role="alert">
                                                El socio no ha completado ninguna rutina
                                            </div>
                                            <?php endif ?>
                                            

                                        </div>
                                        </div>
                                    </div>
                            
                        

                        <!--Sidebar Start-->
                        <div class="col-md-3">
                            <div class="sidebar">

                                <!--Widget Start-->
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
                                <!--Widget End-->

                            

                                

                            </div>
                        </div>
                        <!--Sidebar End-->

                    </div>
                </div>
            </div>
            <!-- Blog Full End -->

<div class="modal fade" id="rutineEdit" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Rutina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string()); ?>
                <div class="form-group">
                    <?php echo form_label('Ejercicio', 'ejercicio'); ?>
                    <h3 id="nombre_ejercicio"></h3>
                    <input type="hidden" id="ejercicio" name="ejercicio" value="" class="form-control">
                </div>

                <div class="form-group">
                    <?php echo form_label('Instruccion', 'instruccion'); ?>
                    <textarea name="instruccion" id="instruccion" cols="20" rows="5" class="form-control"></textarea>

                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <input type="hidden" name="rutine_id" id="rutine_id" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Confirmar Asignacion','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="addreadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Mediciones del Socio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(uri_string().'/medidas'); ?>
      <div class="form-group">
          <?php echo form_label('Masa Muscular Esquelética','mme'); ?>
          <div class="input-group">
              <div class="input-group-addon">MME</div>
              <?php echo form_input($mme); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Masa Grasa Corporal','mgc'); ?>
          <div class="input-group">
              <div class="input-group-addon">MGC</div>
              <?php echo form_input($mgc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Agua Corporal Total', 'act'); ?>
          <div class="input-group">
              <div class="input-group-addon">ACT</div>
              <?php echo form_input($act); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Índice de Masa Corporal','imc'); ?>
          <div class="input-group">
              <div class="input-group-addon">IMC</div>
              <?php echo form_input($imc); ?>
              <div class="input-group-addon">kg/m2</div>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Porcentaje de Masa Corporal','pmc'); ?>
          <div class="input-group">
              <div class="input-group-addon">PMC</div>
              <?php echo form_input($pmc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Relación Cintura-Caderal','rcc'); ?>
          <div class="input-group">
              <div class="input-group-addon">RCC</div>
              <?php echo form_input($rcc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Metabolismo Basal','mb'); ?>
          <div class="input-group">
              <div class="input-group-addon">MB</div>
              <?php echo form_input($mb); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Imagen','imagen'); ?>
          <?php echo form_upload($imagen); ?>
      </div>
      </div>
      <div class="modal-footer">
        <?php echo form_hidden('current_id', $current_plan->id); ?>
        <?php echo form_hidden('member_id', $member_id); ?>
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Añadir Medicion','class="btn btn-info"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>
function fillRoutineModal(id, ejercicio, instruccion)
{
    document.getElementById('ejercicio').setAttribute('value', ejercicio);
    $('#nombre_ejercicio').html(ejercicio);
    document.getElementById('instruccion').value = instruccion;
    document.getElementById('rutine_id').setAttribute('value',id);
}
</script>