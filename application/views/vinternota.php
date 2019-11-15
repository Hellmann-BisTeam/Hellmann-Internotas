<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
<div class="col-md-12">
  <br>
  <br>

</div>
<div class="col-md-12"> 


             <div class="card card-warning">
              <div class="card-header"><h3 class="card-title">Modulo Internotas</h3>
              </div>

              <div class="card-body">
                <form action="<?php echo base_url();?>index.php/Welcome" method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                 
                      <div class="form-group">
                        <label>Piso</label>
                        <select class="form-control" name="Piso" required>
                          <option value="">Seleccione</option>
                          <?php 
                          foreach($PISOS as $row){
                              echo  '<option value="'.$row->INT_PISO_ID.'">'.$row->INT_PISO_ID.'</option>';
                          }
                         ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="Tipo" id="input2" required >
                          <option value="">Seleccione</option>
                          <?php
                            foreach ($TIPOS as $row) {
                                echo '<option value="'.$row->INT_TIPO_ID.'">'.$row->INT_TIPO_DESCRIP.'</option>';     
                             } 

                          ?>  
                        </select>
                      </div>                    
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Internota</label>
                        <select class="form-control select2" name="txtInternota"  id ="'input3' "style="width: 100%;" required>
                          <option selected=""> </option>
                          <?php 
                              foreach($INTERNOTAS as $row){
                                echo  '<option value="'.$row->INT_NOTA.'">'.$row->INT_NOTA.'</option>';
                             }
                          ?>
                        </select>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" value="Registrar">Ingresar</button>
                  <!--<?php echo $id; echo $s;?>-->
                </div>                 
                </form>
           </div>

  
</div>









