 <!--League Schedule Slider Start-->
 <section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                    <h2 class="section-title"> Nuevo Socio </h2>
                    </div>        
                    <div class="col-xs-6 col-md-2">
                        <div class="pull-right">
                        <?php echo anchor('members','Cancelar','class=detail-btn'); ?>
                        <a href="" class="detail-btn">Cancelar</a>
                        </div>
                        
                    </div>
                       <div class="col-md-12">
                        <?php if(isset($message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <ol>
                                    <?php echo $message; ?>
                                </ol>
                            </div>
                        <?php endif; ?>
                        <!-- <form class="review-form contact-form"> -->
                        <?php $form_attributes = array('class' => 'review-form contact-form'); 
                        echo form_open('miembros/nuevo', $form_attributes); ?>
                        <div class="row">
                           <h4 class="section-title">Información basica</h4>
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
                            <label for="inputEmail3" class="control-label">Apellido Materno</label>
                              <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Apellido Materno"> -->
                            <?php echo form_input($materno); ?>

                          </div>
                          <div class="col-md-4">
                              <label for="genero" class="control-label">Seleccione el genero</label>
                              <?php echo form_dropdown('genero', $genero_data, $genero, 'class="form-control'); ?>
                              <!-- <select class="form-control">
                                  <option>Hombre</option>
                                  <option>Mujer</option>
                                </select> -->
                          </div>
                          <div class="col-md-4">
                            <label for="peso" class="control-label">Peso</label>
                             <div class="input-group">
                                 <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Peso"> -->
                                <?php echo form_input($peso); ?>
                                <div class="input-group-addon">kg.</div>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="estatura" class="control-label">Estatura</label>
                             <div class="input-group">
                                 <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Estatura"> -->
                                <?php echo form_input($estatura); ?>
                                 <div class="input-group-addon">m.</div>
                             </div>

                            </div>
                        <!-- </form> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <h4 class="section-title">
                                    Informacion de contacto y inicio de sesion del Socio
                                </h4>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="email" class="control-label">Correo Electronico</label>
                                    <?php echo form_input($email); ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="usuario" class="control-label">Usuario del Socio</label>
                                    <?php echo form_input($usuario); ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="password" class="control-label">Contrasena del Socio</label>
                                    <?php echo form_input($password); ?>
                                </div>

                                <div class="col-md-3">
                                    <?php 
                                    $js = 'onClick="test()"';
                                    echo echo form_button('generate_button', 'Generar Claves', $js); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                         <form class="review-form contact-form">
                        <div class="row">
                           <h4 class="section-title">Mediciones Iniciales del Socio</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Masa Muscular Esquelética</label>
                            <div class="input-group">
                                <div class="input-group-addon">MME</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Masa Muscular Esquelética">
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Masa Grasa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">MGC</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Masa Grasa Corporal">
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Agua Corporal Total</label>
                            <div class="input-group">
                                <div class="input-group-addon">ACT</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Agua Corporal Total">
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Índice de Masa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">IMC</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Índice de Masa Corporal">
                                <div class="input-group-addon">kg/m2</div>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Porcentaje de Masa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">PMC</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Porcentaje de Masa Corporal"> 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Relación Cintura-Cadera</label>
                            <div class="input-group">
                                <div class="input-group-addon">RCC</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Relación Cintura-Cadera"> 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="inputEmail3" class="control-label">Metabolismo Basal</label>
                            <div class="input-group">
                                <div class="input-group-addon">MB</div>
                                 <input type="email" class="form-control" id="inputEmail3" placeholder="Metabolismo Basal"> 
                             </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top: 1em;">
                              <button type="submit" class="submit">Agregar Socio</button>
                            </div>
                          </div>
                          
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <!--League Schedule Slider End-->
<script>
function test(){
    console.log('esta es una prueba');
}    
</script>