<!--League Schedule Slider Start-->
<section class="news-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                    <h2 class="section-title"> Detalles del Socio </h2>
                    </div>        
                    <div class="col-xs-6 col-md-2">
                        <div class="pull-right">
                        <!-- <a href="" class="detail-btn">Volver</a> -->
                        <?php echo anchor('socios','Volver','class="detail-btn"'); ?>
                        </div>
                    </div>
                    <div class="row">
                    <div class="row">
                    
                    </div>
                    
                                <div class="col-md-8 pull-left">
                                    <!-- <?php // var_dump($member); ?> -->
                                    <?php echo $message; ?>
                                   <div class="row">
                                       <div class="col-md-5">
                                           <div class="pro-large-img">
                                               <?php if(isset($avatar)): ?>
                                               <img src="images/member1.jpg" class="pro-large-img" alt="Member1">
                                                <?php else: ?>
                                                <img src="images/avatar.png" class="pro-large-img" alt="" style="max-width:100%;">
                                                <?php endif; ?>
                                           </div>
                                       </div>
                                       <div class="col-md-7">
                                           <div class="pro-small-info">
                                               <h2><?php echo htmlspecialchars($member->nombre .' '. $member->paterno .' ' . $member->materno, ENT_QUOTES, 'UTF-8'); ?></h2>
                                               <div class="pro-size">
                                                   <strong>Edad: <?php echo htmlspecialchars($member->edad, ENT_QUOTES, 'UTF-8'); ?> años.</strong>
                                               </div>
                                               <div class="pro-size">
                                                   <strong>Genero: <?php echo htmlspecialchars(ucfirst($member->genero), ENT_QUOTES, 'UTF-8'); ?>.</strong>
                                               </div>
                                               <div class="pro-size">
                                                   <strong>Peso: <?php echo htmlspecialchars($member->peso, ENT_QUOTES, 'UTF-8'); ?>kg.</strong>
                                               </div>
                                                <div class="pro-size">
                                                   <strong>Estatura: <?php echo htmlspecialchars($member->estatura, ENT_QUOTES, 'UTF-8'); ?>m.</strong>
                                               </div>
                                           </div>
                                           <?php echo form_button('add_reading','Add Mediciones','data-toggle="modal" data-target="#addreadingModal" class="submit"'); ?>
                                       </div>
                                       <div class="clearfix"></div>
                                       <div class="pro-tabs col-md-12">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#Rutina" aria-controls="Description" role="tab" data-toggle="tab">Rutina</a></li>
                                        <li role="presentation"><a href="#Registros" aria-controls="Reviews" role="tab" data-toggle="tab">Registros</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="Rutina">
                                            <p>Your Pittsburgh Penguins are hitting the ice ready to make a run for the cup this season! Show off your dedication to the rock star team you love to support in this 2017 Stanley Cup Playoffs Participant T-Shirt. This awesome top features invigorating graphics that are sure to push your Pittsburgh Penguins spirit to its full potential.</p>

                                            <h6>Detail:</h6>

                                            <ul>
                                                <li>Material: 100% Cotton</li>
                                                <li> Screen print graphics</li>
                                                <li> Crew neck</li>
                                                <li> Short sleeve</li>
                                                <li> Officially licensed</li>
                                                <li> Imported</li>
                                            </ul>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="Registros">
                                            <div id="chart_div" style="width: 900px; height: 500px;"></div>

                                                
                                               
                                            </div>
                                        </div>
                                    </div>
                                    </div><!-- row -->
                                </div>
                                <div class="col-md-4 pull-right">
                                    <div class="sidebar">
                                        <div class="widget">
                                        <h3>Planes Registrados</h3>
                                        <figure class="pl-banner">
                                            <div class="image-min">
                                                <img src="images/fitness.jpg" alt="fitness">
                                            </div>
                                            <figcaption>
                                                <h3>Fortaleza física</h3>
                                            </figcaption>
                                        </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                </div> <!-- row primero -->
            </div> <!-- container -->
        </section>
        <!--League Schedule Slider End-->

                <!-- Modal -->
<div class="modal fade" id="addreadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Mediciones del Socio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open(uri_string().'/medidas'); ?>
      <div class="form-group">
          <?php echo form_label('Masa Muscular Esquelética','mme'); ?>
          <div class="input-group">
              <div class="input-group-addon">MME</div>
              <?php echo form_input($mme); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Masa Grasa Corporal','mgc'); ?>
          <div class="input-group">
              <div class="input-group-addon">MGC</div>
              <?php echo form_input($mgc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Agua Corporal Total', 'act'); ?>
          <div class="input-group">
              <div class="input-group-addon">ACT</div>
              <?php echo form_input($act); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Índice de Masa Corporal','imc'); ?>
          <div class="input-group">
              <div class="input-group-addon">IMC</div>
              <?php echo form_input($imc); ?>
              <div class="input-group-addon">kg/m2</div>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Porcentaje de Masa Corporal','pmc'); ?>
          <div class="input-group">
              <div class="input-group-addon">PMC</div>
              <?php echo form_input($pmc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Relación Cintura-Caderal','rcc'); ?>
          <div class="input-group">
              <div class="input-group-addon">RCC</div>
              <?php echo form_input($rcc); ?>
          </div>
      </div>
      <div class="form-group">
          <?php echo form_label('Metabolismo Basal','mb'); ?>
          <div class="input-group">
              <div class="input-group-addon">MB</div>
              <?php echo form_input($mb); ?>
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <?php echo form_hidden('id', $member->id); ?>
        <?php echo form_hidden($csrf); ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php echo form_submit('submit', 'Añadir Medicion','class="btn btn-info"'); ?>
        <!-- <button type="button" class="btn btn-danger">Eliminar</button> -->
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        $.ajax({
            type:"get",
            url:"index.php?/ajax/generate_chart_data/<?php echo $member->id ?>",
            success:function(response){
                console.log(response);
                var data = google.visualization.arrayToDataTable(response);
                var options = {
                    vAxis: {title: 'Medidas'},
                    hAxis: {title: 'Fechas'},
                    seriesType: 'bars',
                    //series: {5: {type: 'line'}},
                    width:770,
                    height:500
                };
                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        })
    }
    
      
    </script>
