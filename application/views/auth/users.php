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
                            <input type="search" class="search" placeholder="Buscar aqui...">
                            <button>
                                <i class="fa fa-search"></i>
                            </button>
                        </form>   
                        </div>
                        

                    </div>
                    

                    <div class="col-md-12">
                        

                        <div class="sp-table-wrapper">
                            <table class="points-listing">
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
                                            switch($user->grupo) :
                                                case 9:
                                                    echo 'Administrador';
                                                    break;
                                                case 4:
                                                    echo 'Entrenador';
                                                    break;
                                                default:
                                                    echo 'Sin grupo';
                                                    break;
                                            endswitch;
                                            ?>
                                        </td>
                                        <td>
                                            <div class="pro-share" style="margin:0;">
                                                <a href="">
                                                    <i class="fa fa-user-circle"></i>
                                                </a>
                                                <a href="">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                
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
                                        <a href="" class="next page-numbers">Next <i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->