<div class="col-md-12">
  <div class="row">
    <div class="col-sm-6">
            <div class="form-group">
                <label>Piso</label>
                  <select class="form-control" name="Piso" required>
                    <option value="<?=$INT_PISO?>"><?=$INT_PISO?></option>
                    <?php 
                      foreach($PISOS as $row){
                            if ($row->INT_PISO_ID !=$INT_PISO){
                              echo  '<option value="'.$row->INT_PISO_ID.'">'.$row->INT_PISO_ID.'</option>';
                          }
                         }
                    ?>
                    </select>
            </div>
        </div>
    <div class="col-sm-6">
            <div class="form-group">
                <label>Tipo</label>
                    <select class="form-control" name="Tipo" required>
                    <?php 
                      if ($INT_TIPO ==null){
                          echo '<option value="">Seleccione...</option>';
                      }else 
                          echo '<option value="'.$INT_TIPO.'">'.$INT_TIPO_DESCRIP.'</option>';     
                    ?>
                          <!--<option value="<?=$INT_TIPO?>"><?=$INT_TIPO_DESCRIP?> </option>-->
                    <?php
                        foreach ($TIPOS as $row) {
                            if ($row->INT_TIPO_ID !=$INT_TIPO) {
                                echo '<option value="'.$row->INT_TIPO_ID.'">'.$row->INT_TIPO_DESCRIP.'</option>';     
                            }
                        } 

                    ?>
                    </select>
            </div>                    
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Internota</label>
                <!--<input type="text" class="form-control" id="INTERNOTA_N"  name="INTERNOTA_N" value="<?=$INTERNOTA_N?>">-->
                <select class="form-control select2" id="INTERNOTA_N" name="INTERNOTA_N"  style="width: 100%;" required>
                <option selected="<?=$INT_NOTA?>"><?=$INT_NOTA?></option>
                <?php 
                    foreach($INTERNOTAS as $row){
                       if($row->INT_NOTA!=$INTERNOTA_N){
                          echo  '<option value="'.$row->INT_NOTA.'">'.$row->INT_NOTA.'</option>';
                       }
                    }
                ?>
                </select>
            </div>
        </div>
  </div>
  <div class="row">
   
    
    <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                        <th>ID</th>
                        <th>INT_SHOP</th>
                        <th>INT_NOTA</th>
                        <th>INT_LPCS</th>
                        <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        ini_set('memory_limit', '1024M');
                        foreach ($SHOPS as $row) {
                          echo  '<tr>'.'<td>'.$row->INT_ID.'</td>';
                          echo  '<td>'.$row->INT_SHOP.'</td>';
                          echo  '<td>'.$row->INT_NOTA.'</td>';
                          echo  '<td>'.$row->INT_LPCS.'</td>';
                          echo  '<td>'.'<a href="Cinternota/go_insert2/'.$row->INT_NOTA.'/'.$row->INT_SHOP.'/'.$row->INT_LPCS.'/'.$INT_PISO.'/'.$INT_TIPO.'/'.$row->INT_ID.'">
                                      
                                      <p>Ingresar</p>
                                      </a>'.'</td>'.'</tr>';
                        }
                        //echo  '';
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
      </div>
    </div> 

</div>
<?php //ini_set('memory_limit', '1024M');
//ini_set('memory_limit', '-1');
?>
<script type="text/javascript">
   /* var baseurl="<?php echo base_url();?>";
    var INTERNOTA_N= $("#INTERNOTA_N").val();
    //var INTERNOTA_NN= $("#INTERNOTA_NN").val();
    //alert (baseurl);
    //alert(INTERNOTA_N);
    //alert(INTERNOTA_NN);
    var d=1;
  $.post(baseurl+"index.php/Cinternota/getNInternota",
  {
      INTERNOTA_N: INTERNOTA_N
  },
  function (data) {
      alert(data);
      //var obj= JSON.parse(data);
      //$.each(obj,function(i,item){ //recorre
          //$('#tablaTiendasSingle').append(
          //  '<tr>'+
            //    '<td>'+item.INT_SHOP  +'</td>'+
            //    '<td>'+item.INT_NOTA  +'</td>'+
            //    '<td>'+item.INT_LPCS  +'</td>'+
                        
          //  '</tr>'
         // ); 
      //});
  });*/

</script>




