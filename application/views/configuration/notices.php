<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    <h2 class="section-title">Comunicados</h2>
                    </div>        
                    <div class="col-md-6">
                        <!-- <a class="detail-btn">Agregar Nuevo Usuario</a> -->
                        <a data-toggle="modal" href="#noticeAdd" class="detail-btn"><i class="fas fa-plus-circle"></i> Agregar Nuevo Comunicado</a>
                    </div>

                    <div class="col-md-4">
                        <div class="side-search">
                         <form>
                            <!-- <input type="search" id="search" class="search" placeholder="Buscar aqui...">
                            <button>
                                <i class="fa fa-search"></i>
                            </button> -->
                        </form>   
                        </div>
                        

                    </div>
                    

                    <div class="col-md-12">
                        
                        <?php if(!empty($notices)): ?>
                        <div class="sp-table-wrapper">
                            <table class="points-listing">
                                <thead>
                                    <tr class="first">
                                        <th>#</th>
                                        <th>Comunicado</th>
                                        <th>Acciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($notices as $notice): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($notice->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($notice->comunicado, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <a data-toggle="modal" href="#noticeDelete" onClick="fillDeleteModal('<?php echo $notice->id ?>'"><i class="fa fa-trash"></i></a>
                                            
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                        </div><!-- END -->
                        <?php else: ?>
                        <div class="alert alert-info" role="alert">
                              No hay comunicados registrados <strong>Agregar Nuevo Comunicado</strong> para comenzar.
                        </div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->
<div class="modal fade" id="noticeAdd" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Comunicado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string()); ?>

                <div class="form-group">
                    <?php echo form_label('Comunicado', 'comunicado'); ?>
                   
                        <?php echo form_textarea($comunicado); ?>

                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('action','add'); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Añadir Comunicado','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>


<div class="modal fade" id="noticeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:200001;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Plan | Confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalName"></h4>
      </div>
      <div class="modal-footer">
        <?php echo form_open(uri_string()); ?>
        <input type="hidden" name="delete_notice_id" id="delete_notice_id" value="" />
        <?php echo form_hidden($csrf); ?>
        <?php echo form_hidden('action','delete'); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar Plan','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>


    function fillDeleteModal(id)
    {
        //$('#modalName').html('¿Desea eliminar el plan ' + nombre + '?.');
        document.getElementById('delete_notice_id').setAttribute('value', id);
    }
    
</script>