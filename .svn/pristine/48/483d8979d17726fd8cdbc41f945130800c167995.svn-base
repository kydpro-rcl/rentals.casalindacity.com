<? #require('inc/PDF/fpdf.php');
session_start();
require_once('init.php');
$db= new subDB ();
   /*
	$PDF = new FPDF();
	$PDF->AddPage();
     //comienza lo de internet
	$PDF->SetAuthor('Lana Kovacevic');
	$PDF->SetTitle('FPDF tutorial');
    $PDF->Image('logo.png',10,20,33,0,' ','http://www.fpdf.org/');

    $PDF->SetXY(50,20);
	$PDF->SetDrawColor(50,60,100);
	$PDF->Cell(100,10,'FPDF Tutorial',1,0,'C',0);
     //termina lo de internet
	$PDF->SetFont('Arial', 'B', 16);
	$PDF->Cell(100, 10, 'Hello World-joseluis!');
	$PDF->Cell(60, 10, 'Hecho para RCL!- PRECIO'.$price_per_night);
	$referencia="7s3g";
	//$PDF->Output('../../invoices/invoice_sample.pdf', 'F');
	$PDF->Output('invoices/invoice_'.$referencia.'.pdf', 'F');
   $PDF->Close();
//	$PDF->Output();   */


//VARIABLES START


//VARIABLES END
require_once('template/head.php'); // SOLO PRESENTA EL HTML RESUMEN DESPUES DE GUARDAR EL PDF

$starting=date_to_insert($starting_date);
$ending=date_to_insert($ending_date);
$id_ocupacion=$db->insert_ocupacion_short_reserve($starting, $ending, $id_villa, $id_adm);

$ref=$id_ocupacion.$id_customer.$id_villa; //id ocupacion + id cliente + id villa
 // factura no.02201015031401  hora_ano_minutos_mes_segundos_dias   2010 03 01 02:15:14 YYYY MM DD HH:MM:SS

$id_reserve=$db->insert_short_reserva($ref, $id_ocupacion, $id_customer, $adults_qty, $children_qty, $interm_id, $qty_nights, $price_per_night, $amount_commision, $sub_total_rent, $ITBIS, $services_amount, $deposit, $general_amount, $status, $reserve_comment);
//SI EL ID DE LA OCUPACION ES IGUAL AL DE LA RESERVA ENTONCES ERROR Y MORIR (DEBERIA BORRAR LA OCUPACION QUE SE INSERTO? no pk a veces puede ser el mismos)

if ($adults_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
  for ($x=1;$x<=$adults_qty; $x++){
  	$name=${"a_name{$x}"}; $lastname=${"a_lastname{$x}"};
   // echo "NOMBRE ADULTOS:".$name." ".$lastname."<br>";
   // $name = 'p_item' . $item;        $value = $$name;         ej de variable variable
  // $item = "ABC"; ${"p_item{$item}"} print $p_itemABC;    igual que la linea anterio
    $db->insert_adults($id_reserve, $name, $lastname);
  	}
}

if ($children_qty>0){    //si la cantidad de adultos sobrepasa 1 entonces son insertado en la base de datos
  for ($c=1;$c<=$children_qty; $c++){
  	$name=${"c_name{$c}"}; $lastname=${"c_lastname{$c}"};
    $db->insert_children($id_reserve, $name, $lastname);
  	}
}
if ($massage_id>0) $db->insert_additional_services($massage_id, $id_reserve, $massage_amount, $massage_comment);
if ($pickup_id>0) $db->insert_additional_services($pickup_id, $id_reserve, $pickup_amount, $pickup_comment);
if ($VIPpickup_id>0) $db->insert_additional_services($VIPpickup_id, $id_reserve, $VIPpickup_amount, $VIPpickup_comment);
if ($chef_id>0) $db->insert_additional_services($chef_id, $id_reserve, $chef_amount, $chef_comment);
if ($fridge_id>0) $db->insert_additional_services($fridge_id, $id_reserve, $fridge_amount, $fridge_comment);
/*
echo "<b>ID villa</b> ".$id_villa."<BR>";
echo "<b>ID client</b> ".$id_customer."<BR>";
echo "<b>ID admin</b> ".$id_adm."<BR>";
echo "<b>empieza</b> ".date_to_insert($starting_date)."<BR>";
echo "<b>termina</b> ".$ending_date."<BR>";
echo "<b>cuantas noches?</b> ".$qty_nights."<BR>";
echo "<b>precio de noche</b> ".$price_per_night."<BR>";
echo "<b>monto por noches</b> ".$amount_per_nights."<BR>";
echo "<b>itebis</b> ".$ITBIS."<BR>";
echo "<b>sub total renta</b> ".$sub_total_rent."<BR>";
echo "<b>monto general</b> ".$general_amount."<BR>";

echo "<b>ID Ocupacion</b> ".$id_ocupacion."<BR>";

echo "<b>ref. reserva</b> ".$ref."<BR>";  //aun no definido

echo "<b>Id Reserva</b> ".$id_reserve."<BR>";

echo "<b>ID masaje</b> ".$massage_id."<BR>";
echo "<b>monto masaje</b> ".$massage_amount."<BR>";
echo "<b>massage commen</b>t ".$massage_comment."<BR>";

echo "<b>ID pickup</b> ".$pickup_id."<BR>";
echo "<b>pickup monto</b> ".$pickup_amount."<BR>";
echo "<b>pick up comment</b> ".$pickup_comment."<BR>";

echo "<b>ID vip</b> ".$VIPpickup_id."<BR>";
echo "<b>vip monto</b> ".$VIPpickup_amount."<BR>";
echo "<b>vip comment</b> ".$VIPpickup_comment."<BR>";

echo "<b>ID chef</b> ".$chef_id."<BR>";
echo "<b>monto chef</b> ".$chef_amount."<BR>";
echo "<b>chef comment</b> ".$chef_comment."<BR>";

echo "<b>ID fridge</b> ".$fridge_id."<BR>";
echo "<b>monto fridge</b> ".$fridge_amount."<BR>";
echo "<b>Fridge commen</b>t ".$fridge_comment."<BR>";

echo "<b>monto por servicios</b> ".$services_amount."<BR>";

echo "<b>ID intermediario</b> ".$interm_id."<BR>";
echo "<b>comentario reserva</b> ".$reserve_comment."<BR>";
echo "<b>status</b> ".$status."<BR>";

echo "<b>cantidad ninos</b> ".$children_qty."<BR>";
echo "<b>cantidad adultos</b> ".$adults_qty."<BR>";


echo "<b>Deposito</b> ".$deposit."<BR>"; //(si status)
*/
?>
<img src="images/logo.gif" border="0" style="float:left"><br/>
<p>Confirmation</p><a href="invoices/invoice_<?=$referencia?>.pdf" target="_blank" title="print invoice">Factura y Registro</a>
 <form method="post" action="">
      Price US$ <?=$price_per_night;?><br />
      General Amount US$ <?=$general_amount;?><br />
      <!-- <INPUT class="submit" TYPE="button" onClick="history.go(-1)" VALUE="Back">   -->
      <input class="book_but" type="submit" name="confirm" value="Print Invoice"   />
      <input class="book_but" type="submit" name="confirm" value="Print Register Sheet"   />
      <input class="book_but" type="submit" name="confirm" value="Sent to customer"   />

    <!--  <input class="submit" type="submit" name="print_invoice" value="Print Invoice"   />  -->
      </form>
	
   

      	Price US$ <?=$price_per_night;?><br />
        


<? echo ("<meta http-equiv=\"refresh\" content=\"3;url=booking-calendar.php\">"); //send people to calendar 
require_once('template/foot.php'); ?>

<table width="100%" align="center"><tr><td align="center">
<h2>Book successfuly created</h2>

<a href="booking-calendar.php">Go to Calendar</a><br>
<img src="images/loading.gif"/>
or you will be sent to Calendar in 5 seconds...
</td></tr></table>