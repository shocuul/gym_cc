 <!--League Schedule Slider Start-->
 <section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                    <h2 class="section-title"> Nuevo Socio </h2>
                    </div>        
                    <div class="col-xs-6 col-md-2">
                        <div class="pull-right">
                        <?php echo anchor('socios','Cancelar','class=detail-btn'); ?>
                        <!-- <a href="" class="detail-btn">Cancelar</a> -->
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
                        echo form_open('socios/nuevo', $form_attributes); ?>
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
                          <div class="col-md-3">
                              <label for="genero" class="control-label">Seleccione el genero</label>
                              <?php echo form_dropdown('genero', $genero_data, $genero, 'class="form-control"'); ?>
                              <!-- <select class="form-control">
                                  <option>Hombre</option>
                                  <option>Mujer</option>
                                </select> -->
                          </div>
                          <div class="col-md-3">
                                <label for="edad" class="control-label">Edad</label>
                                <div class="input-group">
                                    <?php echo form_input($edad); ?>
                                    <div class="input-group-addon">años.</div>
                                </div>
                            </div>
                          <div class="col-md-3">
                            <label for="peso" class="control-label">Peso</label>
                             <div class="input-group">
                                 <!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Peso"> -->
                                <?php echo form_input($peso); ?>
                                <div class="input-group-addon">kg.</div>
                             </div>
                          </div>
                          <div class="col-md-3">
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
                                    echo form_button('generate_button', '<i class="fas fa-fingerprint"></i> Generar Claves','id="generate_button" class="submit" disabled onClick="generate_login_info()" style="margin-top:1.4em;" data-toggle="tooltip" data-placement="top" title="Para habilitar este boton escriba el nombre y apellidos del socio"'); ?>
                                </div>
                            </div>
                            <span id="mensaje_generate">
                              
                            </span>
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
                            <label for="mme" class="control-label">Masa Muscular Esquelética</label>
                            <div class="input-group">
                                <div class="input-group-addon">MME</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Masa Muscular Esquelética"> -->
                                 <?php echo form_input($mme); ?>
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="mgc" class="control-label">Masa Grasa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">MGC</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Masa Grasa Corporal"> -->
                                 <?php echo form_input($mgc); ?>
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="act" class="control-label">Agua Corporal Total</label>
                            <div class="input-group">
                                <div class="input-group-addon">ACT</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Agua Corporal Total"> -->
                                 <?php echo form_input($act); ?>
                                 
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="imc" class="control-label">Índice de Masa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">IMC</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Índice de Masa Corporal"> -->
                                 <?php echo form_input($imc); ?>
                                <div class="input-group-addon">kg/m2</div>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="pmc" class="control-label">Porcentaje de Masa Corporal</label>
                            <div class="input-group">
                                <div class="input-group-addon">PMC</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Porcentaje de Masa Corporal">  -->
                                 <?php echo form_input($pmc); ?>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="rcc" class="control-label">Relación Cintura-Cadera</label>
                            <div class="input-group">
                                <div class="input-group-addon">RCC</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Relación Cintura-Cadera">  -->
                                 <?php echo form_input($rcc); ?>
                             </div>
                          </div>
                          <div class="col-md-4">
                            <label for="mb" class="control-label">Metabolismo Basal</label>
                            <div class="input-group">
                                <div class="input-group-addon">MB</div>
                                 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Metabolismo Basal">  -->
                                 <?php echo form_input($mb); ?>
                             </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10" style="margin-top: 1em;">
                              <!-- <button type="submit" class="submit">Agregar Socio</button> -->
                              <?php echo form_submit('submit', 'Agregar Socio', 'class="submit" style="max-width:15em;" data-toggle="tooltip" data-placement="top" title="Cerciorese de anotar el usuario y clave del socio."'); ?>
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
<script type="application/javascript">

  function check_for_userdata()
  {
    var nombre = document.getElementById('nombre').value;
    var paterno = document.getElementById('paterno').value;
    var materno = document.getElementById('materno').value;

    console.log(nombre + paterno + materno);

    if(nombre == "" && paterno == "" && materno == "")
    {
      document.getElementById('generate_button').disabled = true;
    }else{
      document.getElementById('generate_button').disabled = false;
    }
  }    


function generate_login_info(){
    console.log('esta es una prueba');
    var nombre = document.getElementById('nombre').value;
    var paterno = document.getElementById('paterno').value;
    var materno = document.getElementById('materno').value;
    $.ajax(
    {
      type:"post",
      url:"<?= base_url(); ?>ajax/generate_login_info",
      data:{nombre:nombre, paterno:paterno, materno:materno},
      success:function(response)
      {
        //var response = JSON.parse(response)
        console.log(response.usuario);
        
        document.getElementById('usuario').setAttribute('value', response.usuario);
        document.getElementById('password').setAttribute('value', response.password);
        document.getElementById('password').disabled = false
        document.getElementById('usuario').disabled = false

        // $('#usuario').val(response.usuario);
        // $('#usuario').disabled = false;
        // $('#password').val(response.password);
        // $('#usuario').disabled = false;
        $('#mensaje_generate').html('<div class="alert alert-warning">Favor de anotar la informacion de inicio de sesion antes de agregar al socio</div>');
      },
      error:function()
      {
        console.log("Error Interno");
      }

    });
  } 

   
</script>