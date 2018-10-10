<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    <h2 class="section-title"> Usuarios </h2>
                    </div>        
                    <div class="col-md-6">
                        <?php echo anchor('usuarios/nuevo', 'Agregar Nuevo Usuario','class=detail-btn'); ?>
                        <!-- <a class="detail-btn">Agregar Nuevo Usuario</a> -->
                    </div>

                    <div class="col-md-4">
                        <div class="side-search">
                         <form>
                            <input type="search" class="search" id="search" placeholder="Buscar aqui...">
                            <button>
                                <i class="fa fa-search"></i>
                            </button>
                        </form>   
                        </div>
                        

                    </div>
                    

                    <div class="col-md-12">
                        <?php echo $message; ?>
                        <div class="sp-table-wrapper">
                            <table class="points-listing" id="points-listing">
                                <thead>
                                    <tr class="first">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->nombre .' '. $user->paterno .' '. $user->materno, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->usuario, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php 
                                            echo $user->grupo->descripcion;
                                            // switch($user->grupo) :
                                            //     case 9:
                                            //         echo 'Administrador';
                                            //         break;
                                            //     case 4:
                                            //         echo 'Entrenador';
                                            //         break;
                                            //     default:
                                            //         echo 'Sin grupo';
                                            //         break;
                                            // endswitch;
                                            ?>
                                        </td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <a href="">
                                                    <i class="fa fa-user-circle"></i>
                                                </a>
                                                <?php echo anchor("usuarios/editar_usuario/" . $user->id, '<i class="fa fa-edit"></i>'); ?>
                                                <!-- <a href="">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                                <button type="button" class="btn" data-toggle="modal" data-target="#deleteModal" onClick="fillModal('<?php echo $user->id ?>','<?php echo $user->nombre .' '. $user->paterno .' '. $user->materno ?>')">
                                                <i class="fa fa-trash"></i>
</button>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                            <div class="techlinqs-pagination text-center">
                                
                                <ul class="pagination">
                                    <li>
                                        <?php echo $this->pagination->create_links(); ?>
                                        <!-- <span class="page-numbers current" aria-current="page">1</span>
                                        <a href="" class="page-numbers">2</a>
                                        <a href="" class="next page-numbers">Next <i class="fa fa-angle-right"></i></a> -->
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
        <?php echo form_open('usuarios/eliminar'); ?>
        <input type="hidden" name="user_id" id="user_id" value="" />
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Eliminar usuario','class="btn btn-danger"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>

    function load_users(query)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>index.php?ajax/usuarios",
            method:"post",
            data:{query:query},
            success:function(data){
                console.log(data);
                $('#points-listing').html("");
                //$('#points-listing').html(data);
            }
        })
    }

    $('#search').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_users(search);
        }else{
            load_users();
        }
    })

    function fillModal(id, nombre)
    {   
        $("#modalName").html('Desea eliminar al usuario ' + nombre);
        document.getElementById('user_id').setAttribute('value', id);
        console.log(id + nombre);
    }
</script>