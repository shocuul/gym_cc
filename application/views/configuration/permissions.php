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
                        <div class="sp-table-wrapper">
                            <table class="points-listing">
                                <thead>
                                    <tr class="first">
                                        <th>Nombre</th>
                                        <th>Modulo Usuarios</th>
                                        <th>Modulo Socios</th>
                                        <th>Modulo Planes</th>
                                        <th>Modulo Configuracion</th>
                                        <th>Modulo Estadisticas</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo form_open(uri_string(),'class="contact-form review-form"'); ?>
                                    <?php foreach($groups as $group): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($group->descripcion, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="text-align:center;"><input class="form-check-input" type="checkbox" value="usuarios" id="<?php echo $group->nombre; ?>[]" name="<?php echo $group->nombre; ?>[]" <?php echo ($permissions[$group->nombre]['users']) ? 'checked' : ''?> <?php echo ($group->nombre === 'admin') ? 'disabled':'' ?>></td>
                                        <td><input class="form-check-input" type="checkbox" value="socios" id="<?php echo $group->nombre; ?>[]" name="<?php echo $group->nombre; ?>[]" <?php echo ($permissions[$group->nombre]['members']) ? 'checked' : ''?> <?php echo ($group->nombre === 'admin') ? 'disabled':'' ?>></td>
                                        <td><input class="form-check-input" type="checkbox" value="planes" id="<?php echo $group->nombre; ?>[]" name="<?php echo $group->nombre; ?>[]" <?php echo ($permissions[$group->nombre]['plans']) ? 'checked' : ''?> <?php echo ($group->nombre === 'admin') ? 'disabled':'' ?>></td>
                                        <td><input class="form-check-input" type="checkbox" value="configuracion" id="<?php echo $group->nombre; ?>[]" name="<?php echo $group->nombre; ?>[]" <?php echo ($permissions[$group->nombre]['config']) ? 'checked' : ''?> <?php echo ($group->nombre === 'admin') ? 'disabled':'' ?>></td>
                                        <td><input class="form-check-input" type="checkbox" value="estadisticas" id="<?php echo $group->nombre; ?>[]" name="<?php echo $group->nombre; ?>[]" <?php echo ($permissions[$group->nombre]['stats']) ? 'checked' : ''?> <?php echo ($group->nombre === 'admin') ? 'disabled':'' ?>></td>
                                        <td>
                                            <?php if($group->nombre != 'admin'): ?>
                                            <a data-toggle="modal" href="#groupDelete" onClick="fillDeleteModal('<?php echo $group->id ?>','<?php echo $group->descripcion; ?>')"><i class="fa fa-trash"></i></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                            <div class="form-group">
                            <div class="col-sm-10" style="margin-top: 1em;">
                              <!-- <button type="submit" class="submit">Agregar Usuario</button> -->
                              <?php echo form_hidden('action','update_permission'); ?>
                              <?php echo form_submit('submit', 'Actualizar Permisos', 'class="btn btn-info detail-btn" style="max-width:15em;"'); ?>
                            </div>
                          </div>
                        </div><!-- END -->
                        <?php echo form_close(); ?>
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
                <h4 style="margin-bottom:20px;">Permisos</h4>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="users" id="users" name="users">
                <label class="form-check-label" for="usuarios">
                    Modulo Usuarios
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="members" id="members" name="members" >
                <label class="form-check-label" for="socios">
                    Modulo Socios
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="plans" id="plans" name="plans" >
                <label class="form-check-label" for="planes">
                    Modulo Planes
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="stats" id="stats" name="stats" >
                <label class="form-check-label" for="estadisticas">
                    Modulo Estadisticas
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="config" id="config" name="config" >
                <label class="form-check-label" for="configuracion">
                    Modulo Configuracion
                </label>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden('action','add_plan'); ?>
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

<div class="modal fade" id="groupDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:200001;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Grupo | Confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalName"></h4>
      </div>
      <div class="modal-footer">
        <?php echo form_open('configuracion/permisos/eliminar'); ?>
        <input type="hidden" name="group_id" id="group_id" value="" />
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar Grupo','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>

    function fillDeleteModal(id, nombre)
    {
        $('#modalName').html('¿Desea eliminar el grupo ' + nombre + '?.');
        document.getElementById('group_id').setAttribute('value', id);
    }
    function fillEditModal(id, nombre, descripcion)
    {
        document.getElementById('edit_nombre').setAttribute('value', nombre);
        document.getElementById('edit_descripcion').value =descripcion;
        document.getElementById('plan_id').setAttribute('value',id);
    }
</script>