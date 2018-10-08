<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    <h2 class="section-title"> Socios </h2>
                    </div>        
                    <div class="col-md-6">
                        <?php echo anchor('socios/nuevo','Agregar Nuevo Socio', 'class="detail-btn"'); ?>
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
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Edad</th>
                                        <th>Genero</th>
                                        <th>Peso</th>
                                        <th>Estatura</th>
                                        <th>Acciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($members as $member):  ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($member->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($member->nombre .' '. $member->paterno .' '. $member->materno, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($member->edad, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($member->genero), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($member->peso, ENT_QUOTES, 'UTF-8'); ?> kg.</td>
                                        <td><?php echo htmlspecialchars($member->estatura, ENT_QUOTES, 'UTF-8'); ?> m.</td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <a href="">
                                                    <i class="fa fa-key"></i>
                                                </a>
                                                <?php  echo anchor("socio/detalles/" . $member->id,'<i class="fa fa-user-circle"></i>');?> 
                                                <!-- <a href="">
                                                    <i class="fa fa-user-circle"></i>
                                                </a> -->
                                                <?php echo anchor("socios/editar_socio/" . $member->id, '<i class="fa fa-edit"></i>'); ?>
                                                <button type="button" class="btn" data-toggle="modal" data-target="#deleteModal" onClick="fillModal('<?php echo $member->id ?>','<?php echo $member->nombre .' '. $member->paterno .' '. $member->materno ?>')">
                                                <i class="fa fa-trash"></i>
                                                
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="techlinqs-pagination text-center">
                                <ul class="pagination">
                                    <li>
                                        <span class="page-numbers current" aria-current="page">1</span>
                                        <a href="" class="page-numbers">2</a>
                                        <a href="" class="next page-numbers">Siguiente <i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario | Confirmacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="modalName"></h4>
      </div>
      <div class="modal-footer">
        <?php echo form_open('socios/eliminar'); ?>
        <input type="hidden" name="user_id" id="user_id" value="" />
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar socio','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>
    function fillModal(id, nombre)
    {   
        $("#modalName").html('Desea eliminar al socio ' + nombre);
        document.getElementById('user_id').setAttribute('value', id);
        console.log(id + nombre);
    }
</script>