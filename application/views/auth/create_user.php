 <!--League Schedule Slider Start-->
 <section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                    <h2 class="section-title"> Nuevo Usuario </h2>
                    </div>        
                    <div class="col-xs-6 col-md-2">
                        <div class="pull-right">
                        <?php echo anchor('usuarios', 'Cancelar', 'class=detail-btn'); ?>
                        <!-- <a href="" class="detail-btn">Cancelar</a> -->
                        </div>
                        
                    </div>

                   
                    

                    <div class="col-md-12">
                        <?php if (isset($message)): ?>
                        <div class="alert alert-danger" role="alert">
                          <ol>
                            <?php echo $message; ?>
                          </ol>
                        </div>
                        <?php endif; ?>
                        <?php $form_attributes = array('class' => 'contact-form review-form');
                        echo form_open('usuarios/nuevo', $form_attributes); ?>
                        <form class="contact-form review-form">
                        <div class="row">
                        <h4 class="section-title">Información Basica</h4>
                        </div>
                         <div class="row">
                          <div class="col-md-4">
                            <label for="nombre" class="control-label">Nombre</label>
                            <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Nombre"> -->
                            <?php echo form_input($nombre); ?>
                          </div>
                          <div class="col-md-4">
                            <label for="paterno" class="control-label">Apellido Paterno</label>
                              <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Apellido Paterno"> -->
                              <?php echo form_input($paterno); ?>
                          </div>
                          <div class="col-md-4">
                            <label for="materno" class="control-label">Apellido Materno</label>
                              <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Apellido Materno"> -->
                              <?php echo form_input($materno); ?>

                          </div>
                          <div class="col-md-4">
                            <label for="email" class="control-label">Correo Electronico</label>
                            <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Correo Electronico"> -->
                            <?php echo form_input($email); ?>
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword3" class="control-label">Contraseña</label>
                            <!-- <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña"> -->
                            <?php echo form_input($password); ?>

                          </div>
                          <div class="col-md-4">
                              <label for="rol" class="control-label">Seleccione el Rol</label>
                              <!-- <select class="form-control">
                                  <option>Administrador</option>
                                  <option>Entrenador</option>
                                  <option>Empleado</option>
                                </select> -->
                                <?php echo form_dropdown('rol',$rol_data, $rol, 'class="form-control"'); ?>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top: 1em;">
                              <!-- <button type="submit" class="submit">Agregar Usuario</button> -->
                              <?php echo form_submit('submit', 'Agregar Usuario', 'class="submit" style="max-width:15em;"'); ?>
                            </div>
                          </div>
                          </div>
                       <!--  </form> -->
                       <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->