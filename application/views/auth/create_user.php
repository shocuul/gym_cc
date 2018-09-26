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
                        <?php $form_attributes = array('class' => 'contact-form review-form');
                        echo form_open('usuarios/create_user', $form_attributes); ?>
                        <form class="contact-form review-form">
                        <div class="row">
                        <h4 class="section-title">Información Basica</h4>
                        </div>
                         <div class="row">
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Nombre">
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Apellido Paterno</label>
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Apellido Paterno">
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Apellido Materno</label>
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Apellido Materno">

                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Correo Electronico</label>
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Correo Electronico">
                          </div>
                          <div class="col-md-4">
                            <label for="inputPassword3" class="control-label">Contraseña</label>
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña">

                          </div>
                          <div class="col-md-4">
                              <label for="rol" class="control-label">Seleccione el Rol</label>
                              <select class="form-control">
                                  <option>Administrador</option>
                                  <option>Entrenador</option>
                                  <option>Empleado</option>
                                </select>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top: 1em;">
                              <button type="submit" class="submit">Agregar Usuario</button>
                            </div>
                          </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->