<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    <h2 class="section-title">Imagenes</h2>
                    </div>        
                    <div class="col-md-6">
                        <!-- <a class="detail-btn">Agregar Nuevo Usuario</a> -->
                        <a data-toggle="modal" href="#imageAdd" class="detail-btn"><i class="fas fa-plus-circle"></i> Agregar Nueva Imagen</a>
                    </div>

                    <div class="col-md-4">
                    </div>
                    

                    <div class="col-md-12">
                        <?php echo $message; ?>
                        <?php if(!empty($images)): ?>
                        <div class="sp-table-wrapper">
                            <table class="points-listing">
                                <thead>
                                    <tr class="first">
                                        <th>#</th>
                                        <th>Imagen</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($images as $image): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="text-align:center;"><img src="<?= base_url(); ?>images/public/<?php echo $image->path; ?>" alt="<?php echo $image->path; ?>" style="max-width:200px;"></td>
                                        <td><?php echo htmlspecialchars(ucfirst($image->tipo), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <a data-toggle="modal" href="#imageDelete" onClick="fillDeleteModal('<?php echo $image->id ?>')"><i class="fa fa-trash"></i></a>
                                        
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                        </div><!-- END -->
                        <?php else: ?>
                        <div class="alert alert-info" role="alert">
                              No hay imagenes registradas aun, da click en <strong>Agregar Nueva Imagen</strong> para comenzar.
                        </div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->
<div class="modal fade" id="imageAdd" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string()); ?>
                <div class="form-group">
                    <?php echo form_label('Imagen'); ?>
                    <input type="hidden" name="imagen" id="imagen">
                    <div id="fileupload" class="dropzone"></div>
                </div>
                <h4 style="margin-bottom:20px;">Tipo de Imagen</h4>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="promocion" checked>
                <label class="form-check-label" for="tipo">
                    Promociones
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="menu" >
                <label class="form-check-label" for="tipo">
                    Menu de alimentacion
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="galeria" >
                <label class="form-check-label" for="tipo">
                    Galeria
                </label>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo form_input($csrf); ?>
                <?php echo form_hidden('action','add_image'); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Añadir Imagen','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="imageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:200001;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Plan | Confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalName">Desea eliminar la imagen?</h4>
      </div>
      <div class="modal-footer">
        <?php echo form_open(uri_string()); ?>
        <input type="hidden" name="imagen_id" id="imagen_id" value="" />
        <?php echo form_input($csrf); ?>
        <?php echo form_hidden('action','delete_image'); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar Imagen','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

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
    function fillDeleteModal(id, nombre)
    {
        //$('#modalName').html('¿Desea eliminar el plan ' + nombre + '?.');
        document.getElementById('imagen_id').setAttribute('value', id);
    }
    function fillEditModal(id, nombre, descripcion)
    {
        document.getElementById('edit_nombre').setAttribute('value', nombre);
        document.getElementById('edit_descripcion').value =descripcion;
        document.getElementById('plan_id').setAttribute('value',id);
    }
</script>