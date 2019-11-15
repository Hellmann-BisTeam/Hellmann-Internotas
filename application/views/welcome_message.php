
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<?php 

//Dato menor a 400 primer formulario 
	if($INT_LPCS<400){  ?>

<div class="col-md-12">

   <h3>Valores Digitación</h3>
    <form action="<?php echo base_url();?>index.php/Cinternota/go_insert" id="formulario" method="POST">
    <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Piso</label>
                        <input type="hidden" class="form-control" id="INT_ID"  name="INT_ID" value="<?=$INT_ID?>" >
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
                         <?php if ($INT_TIPO ==null){
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
                        <select class="form-control select2" name="txtInternota"  style="width: 100%;" required>
                          <option selected="<?=$INT_NOTA?>"> <?=$INT_NOTA?></option>
                          <?php 
                              foreach($INTERNOTAS as $row){
                                echo  '<option value="'.$row->INT_NOTA.'">'.$row->INT_NOTA.'</option>';
                             }
                          ?>
                        </select>
                      </div>
                    </div>
                    <!--<div class="col-sm-6">
                    
                      <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" id="INT_ID"  name="INT_ID" value="<?=$INT_ID?>" >
                      </div>
                    </div>-->
     </div>
    

    <div class="row">


        
        <!--<div class="col-sm-3">
          <label>Internota</label>
           <input type="text" class="form-control" name="Internota" id="Internota" value="<?=$INT_NOTA?>" readonly>
          
        </div>-->
        <div class="col-sm-3">
          <label>Tienda</label>
           <input type="text" class="form-control" name="Internota" id="Internota" value="<?=$INT_SHOP?>" readonly>
          
        </div>
        <div class="col-sm-3">
          <label>Total</label>
          <input type="number" class="form-control" name="Total" id="Total" value="<?=$INT_LPCS?>" readonly>
          
        </div>
        <div class="col-sm-3">

          <div class="form-group">
                        <label>Concepto</label>
                        <select class="form-control" name="Concepto" id="Concepto" required>
                        

                        <?php if ($INT_CONCEPTO ==null){
                         	echo '<option value="">Seleccione...</option>';
                         }//else 
                         	//echo '<option value="'.$INT_TIPO.'">'.$INT_TIPO_DESCRIP.'</option>';     
                         ?>



                          <!--<option value=" <?=$INT_CONCEPTO?>"><?=$INT_CONCEPTO?></option>-->
                          <?php 
                            foreach($CONCEPTOS as $row)
                              echo '<option value="'.$row->INT_CONCEPTO_ID.'">'.$row->INT_CONCEPTO_ID.'</option>';  

                          ?>
                        </select>
                      </div>     
        </div>
        <div class="col-sm-3">

          <div class="form-group">
            <label>WP <?php echo $mensaje;?></label>
          <input type="number" class="form-control" name="Wp" id="Wp" minlength="9" maxlength="10" value="<?=$INT_WP_CODE?>"required>
          </div>     
        </div>
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-success" value="Registrar">Ingresar</button>
      </div>
     
    </form>
    <div class="row">
    	<div>
    		<br>
    		<br>
    		<br>
    	</div>
    </div>
<!--div vista-->
	<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Últimos 10 registros </h1>
              </div>
              <!-- INT_SHOP,INT_NOTA,INT_LPCS,INT_PISO,INT_TIPO,INT_CONCEPTO,INT_WP_CODE -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table id="tablaSingle" class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>INT_SHOP</th>
                      <th>INT_NOTA</th>
                      <th>INT_LPCS</th>
                      <th>INT_PISO</th>
                      <th>INT_TIPO</th>
                      <th>INT_CONCEPTO</th>
                      <th>INT_WP_CODE</th>
                      <th>INT_FECHA_SET</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div> <!--row de la vista-->
<script type="text/javascript">
   	var baseurl="<?php echo base_url();?>";
   	//alert (baseurl);
   	var d=1;
$.post(baseurl+"index.php/Cinternota/list_single",
{
    d: d
},
function (data) {
    // body...
    //alert(data);
    var obj= JSON.parse(data);
    $.each(obj,function(i,item){ //recorre
        $('#tablaSingle').append(
        '<tr>'+
            '<td>'+item.INT_SHOP  +'</td>'+
            '<td>'+item.INT_NOTA  +'</td>'+
            '<td>'+item.INT_LPCS  +'</td>'+
            '<td>'+item.INT_PISO  +'</td>'+
            '<td>'+item.INT_TIPO  +'</td>'+
            '<td>'+item.INT_CONCEPTO  +'</td>'+
            '<td>'+item.INT_WP_CODE  +'</td>'+
            '<td>'+item.INT_FECHA_SET  +'</td>'+
        '</tr>'
 
        ); 
 
    });
});

</script>

<!--div vista-->
</div>
<!--ACA EMPIEZA FORM DE MAYOR A 400-->
<?php }else{ 
 ?>
<body>
<div style="margin: auto;width: 80%;">
<form id="form1" name="form1" method="" >
<div class="row">
	<div class="col-sm-4">
       <div class="form-group">
            <label>Piso</label>
            <select class="form-control" name="Piso" id="Piso" required>
            <option value="<?=$INT_PISO?>"><?=$INT_PISO?></option>
              <?php
              //
                foreach($PISOS as $row){
                    if ($row->INT_PISO_ID !=$INT_PISO){
                        echo  '<option value="'.$row->INT_PISO_ID.'">'.$row->INT_PISO_ID.'</option>';
                        }
                }
             ?>
            </select>
        </div>
     </div>
     <div class="col-sm-4">
          <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="Tipo" id="Tipo" required>
                         <?php if ($INT_TIPO ==null){
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
      <div class="col-sm-4">
            <div class="form-group">
                <label>Total</label>
                <input type="text" class="form-control" id="txtTotal"  name="txtTotal" value="<?=$INT_LPCS?>" readonly>
            </div>
      </div>
      <div class="col-sm-4">
            <div class="form-group">
            	<label>Internota</label>
           <input type="hidden" class="form-control" id="HInternota"  name="HInternota" value="<?=$INT_NOTA?>">
            	<select class="form-control select2" id="txtInternota" name="txtInternota"  style="width: 100%;" required>
             	<option selected="<?=$INT_NOTA?>"> <?=$INT_NOTA?></option>
                <?php 
                    foreach($INTERNOTAS as $row){
                        echo  '<option value="'.$row->INT_NOTA.'">'.$row->INT_NOTA.'</option>';
                    }
                ?>
                </select>
            </div>
        </div>

</div>


<div class="row">

    <div class="col-sm-3">
        <label>Tienda</label>
        <input type="text" class="form-control" name="Tienda_M" id="Tienda_M"  value="<?=$INT_SHOP?>" readonly>
    </div>
    <div class="col-sm-3">
        <label>Total</label>
        <input type="number" class="form-control" name="Total_M" id="Total_M" min="1" required>
    </div>
    <div class="col-sm-3">
	<div class="form-group">
        <label>Concepto</label>
        <select class="form-control" name="Concepto_M" id="Concepto_M">
            <option value="">Seleccione</option>
                 <?php  foreach($CONCEPTOS as $row)
                              echo '<option value="'.$row->INT_CONCEPTO_ID.'">'.$row->INT_CONCEPTO_ID.'</option>';  

                          ?>
                        </select>
                      </div>     
        </div>
        <div class="col-sm-3">

          <div class="form-group">
            <label>WP</label>
          <input type="number" class="form-control" min ="0" minlength="9" maxlength="10" name="Wp_M" id="Wp_M" >
          </div>     
        </div>
        
    </div>
<input type="button" name="send" class="btn btn-primary" value="add data" id="butsend"   >
<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
</form>
<!--<input type="text" id="prueba"/>-->
<!--<button onclick="limpiar()">Limpiar</button>-->

<table id="table1" name="table1" class="table table-bordered">
<tbody>
<tr>
<th>ID</th>
<th>Tienda</th>
<th>Total</th>
<th>Concepto</th>
<th>WP</th>
<th>Action</th>
<tr>
</tbody>
</table>
</div>
<script>
$(document).ready(function() {
var id = 1; 
/*Assigning id and class for tr and td tags for separation.*/
$("#butsend").click(function() {

var Total_Validacion= $("#Total_M").val();
var Concepto_Validacion= $("#Concepto_M").val();
var Wp_Validacion= $("#Wp_M").val();
var x='si';
var y='si';
var z='si';
if(Total_Validacion==""){
	msg = "Debes Ingresar el Total";
	x='no';
	alert(msg);
} 
if(Concepto_Validacion==""){
	msg2 = "Debes Ingresar el Concepto";
	y='no';
	alert(msg2);

}
if(Wp_Validacion==""){
	msg3 = "Debes Ingresar el Wp";
	z='no';
	alert(msg3);
}
	
if(z=='si' && y=='si' && z=='si'){
var newid = id++; 
$("#table1").append('<tr valign="top" id="'+newid+'">\n\
<td width="100px" >' + newid + '</td>\n\
<td width="100px" class="Tienda_M'+newid+'">' + $("#Tienda_M").val() + '</td>\n\
<td width="100px" class="Total_M'+newid+'">' + $("#Total_M").val() + '</td>\n\
<td width="100px" class="Concepto_M'+newid+'">' + $("#Concepto_M").val() + '</td>\n\
<td width="100px" class="Wp_M'+newid+'">' + $("#Wp_M").val() + '</td>\n\
<td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
}



});
$("#table1").on('click', '.remCF', function() {
$(this).parent().parent().remove();
});
/*BOTON DE ENVIO*/
$("#butsave").click(function() {

var Total_Validacion= $("#Total_M").val();
var Concepto_Validacion= $("#Concepto_M").val();
var Wp_Validacion= $("#Wp_M").val();
//alert(Total_Validacion);
//alert(Concepto_Validacion);
//alert(Wp_Validacion);
var x='si';
var y='si';
var z='si';
if(Total_Validacion==""){
	msg = "Debes Ingresar el Total";
	x='no';
	alert(msg);
} 
if(Concepto_Validacion==""){
	msg2 = "Debes Ingresar el Concepto";
	y='no';
	alert(msg2);

}
if(Wp_Validacion==""){
	msg3 = "Debes Ingresar el Wp";
	z='no';
	alert(msg3);
}
if(z=='si' && y=='si' && z=='si'){
	var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
	var Tienda_M = new Array(); 
	var Total_M = new Array();
	var Concepto_M = new Array();
	var Wp_M = new Array();

	for ( var i = 1; i <= lastRowId; i++) {
	Tienda_M.push($("#"+i+" .Tienda_M"+i).html()); /*pushing all the names listed in the table*/
	Total_M.push($("#"+i+" .Total_M"+i).html()); /*pushing all the emails listed in the table*/
	Concepto_M.push($("#"+i+" .Concepto_M"+i).html()); 
	Wp_M.push($("#"+i+" .Wp_M"+i).html()); 
	}
}
var sendTienda_M = Tienda_M; 
var sendTotal_M = Total_M;
var sendConcepto_M = Concepto_M;
var sendWp_M=Wp_M;

var Piso= $("#Piso").val();  //alert(Piso);
var Tipo= $("#Tipo").val();	 //alert(Tipo);
var TotalPadre= $("#txtTotal").val();	 
var HInternota= $("#HInternota").val();	 //alert(HInternota);


var sendPiso=Piso;
var sendTipo=Tipo;
var sendTotalPadre=TotalPadre;
var sendInternota=HInternota;


var largo =sendTotal_M.length;
//alert(largo);
//alert(sendTotal_M);
/*alert(sendPiso);
alert(sendTipo);
alert(sendTotalPadre);
alert(sendInternota);
alert(sendTienda_M);

alert(sendConcepto_M);
alert(sendWp_M);
alert(largo);*/

//SUMA los elementos del array TOTAL
//var x=eval(sendTotal_M.join("+"));
//console.log(x);

//alert($("#txtTotal").val());
//alert(x);

//if(x>$("#txtTotal").val()) {
	
//	alert('el valor de la suma es mayor a el Total internota');
//}
//if(x<$("#txtTotal").val()) {
//	alert('el valor de la suma es menor a el Total internota');
//}
//if(x==$("#txtTotal").val()){
//	alert('valores permitidos');


$.ajax({
url: "Welcome/llegue",
type: "post",
data: {Tienda_M : sendTienda_M , 
	   Total_M : sendTotal_M, 
	   Concepto_M: sendConcepto_M, 
	   Wp_M:sendWp_M, 
	   largo : largo,
	   Piso :sendPiso,
	   Tipo :sendTipo,
	   TotalPadre : sendTotalPadre,
	   HInternota :sendInternota

	},
success : function(data){
alert(data); /* alerts the response from php.*/
}
});

//}

});
});

</script>



</body>
<?php }
?>
</html>


