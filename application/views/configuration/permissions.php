<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    <h2 class="section-title">Permisos</h2>
                    </div>        
                    <div class="col-md-6">
                        <!-- <a class="detail-btn">Agregar Nuevo Usuario</a> -->
                        <a data-toggle="modal" href="#groupsAdd" class="detail-btn">Añadir Nuevo Grupo</a>
                    </div>

                    <div class="col-md-4">
                        <div class="side-search">
                         <form>
                            <input type="search" class="search" placeholder="Buscar aqui...">
                            <button>
                                <i class="fa fa-search"></i>
                            </button>
                        </form>   
                        </div>
                        

                    </div>
                    

                    <div class="col-md-12">
                        <?php echo $message; ?>
                        <?php if(!empty($plans)): ?>
                        <div class="sp-table-wrapper">
                            <table class="points-listing">
                                <thead>
                                    <tr class="first">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Usuarios</th>
                                        <th>Socios</th>
                                        <th>Planes y Propositos</th>
                                        <th>Configuraciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($plans as $plan): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($plan->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($plan->nombre, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($plan->descripcion, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <?php echo anchor("configuracion/plan/" . $plan->id, '<i class="fas fa-clipboard-list"></i>'); ?>
                                                <a data-toggle="modal" href="#plansEdit" onClick="fillEditModal('<?php echo $plan->id ?>','<?php echo $plan->nombre ?>','<?php echo $plan->descripcion ?>')"><i class="fa fa-edit"></i></a>
                                               
                                                <!-- <a href="">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                                <a data-toggle="modal" href="#plansDelete" onClick="fillDeleteModal('<?php echo $plan->id ?>','<?php echo $plan->nombre ?>')"><i class="fa fa-trash"></i></a>
                                            
                                                </button>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                            <div class="techlinqs-pagination text-center">
                                <?php echo $this->pagination->create_links(); ?>
                                <ul class="pagination">
                                    <li>
                                       <?php echo $this->pagination->create_links(); ?>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- END -->
                        <?php else: ?>
                        <div class="alert alert-info" role="alert">
                              No hay planes registrados aun, da click en <strong>Agregar Nuevo Plan</strong> para comenzar.
                        </div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->
<div class="modal fade" id="groupsAdd" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(uri_string()); ?>
                <div class="form-group">
                    <?php echo form_label('Nombre', 'nombre'); ?>

                        <?php echo form_input($nombre); ?>

                </div>

                <div class="form-group">
                    <?php echo form_label('Descripcion', 'descripcion'); ?>
                   
                        <?php //echo form_textarea($descripcion); ?>

                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Añadir Grupo','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="plansEdit" tabindex="-1" role="dialog" aria-labelledby="plansFormModalLabel" aria-hidden="true" style="z-index:200001;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('configuracion/plan/editar'); ?>
                <div class="form-group">
                    <?php echo form_label('Nombre', 'nombre'); ?>
                    <input type="text" id="edit_nombre" name="edit_nombre" value="" class="form-control">
                </div>

                <div class="form-group">
                    <?php echo form_label('Descripcion', 'descripcion'); ?>
                    <textarea name="edit_descripcion" id="edit_descripcion" cols="40" rows="10" class="form-control"></textarea>

                </div>
                
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <input type="hidden" name="plan_id" id="plan_id" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <?php echo form_submit('submit', 'Editar Plan','class="btn btn-info"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="plansDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:200001;">
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
        <?php echo form_open('plan/eliminar'); ?>
        <input type="hidden" name="delete_plan_id" id="delete_plan_id" value="" />
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar Plan','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>

    function fillDeleteModal(id, nombre)
    {
        $('#modalName').html('¿Desea eliminar el plan ' + nombre + '?.');
        document.getElementById('delete_plan_id').setAttribute('value', id);
    }
    function fillEditModal(id, nombre, descripcion)
    {
        document.getElementById('edit_nombre').setAttribute('value', nombre);
        document.getElementById('edit_descripcion').value =descripcion;
        document.getElementById('plan_id').setAttribute('value',id);
    }
</script>