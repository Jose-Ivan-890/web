<?php
include "../class/classBD.php";
include "../recursos/fpdf/fpdf.php";
include "../recursos/phpqrcode/qrlib.php";
//include "../recursos/barcode/fpdf.php";


$oBD = new baseDatos();
    $registro= $oBD->saca_registro("SELECT * from Usuario u  join Inscritos i on u.Id=i.IdUsuario join Torneo t on t.Id=i.IdTorneo where I.Id=".$_POST['Id']);
    $oBD->consulta("UPDATE Inscritos set Factura=1 where Id=".$_POST['Id']);
    //$query="SELECT *  from Usuario";
    //$link=mysqli_connect("localhost","userBasta","1234","basta");
/*

    class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}
$query="SELECT * from";
*/


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

/*CABECERA*/
// Movernos a la derecha
$pdf->Cell(65 );
// Título
$pdf->Cell(70,10,'Factura de '.$registro->Nombre.'',1,0,'C');
 // Salto de línea
$pdf->Ln(20);
// $pdf->Cell(10,40,'Factura de '.$tabla);
     
$pdf->Cell(40,10,'Fecha Torneo ',1,0,'C',0);
$pdf->Cell(35,10,'Hora ',1,0,'C',0);
$pdf->Cell(35,10,'Costo',1,0,'C',0);
$pdf->Cell(30,10,'Premio ',1,0,'C',0);
$pdf->Cell(30,10,'Puntos',1,1,'C',0);

$pdf->Cell(40,10,' '.$registro->Fecha.' ',1,0,'C',0);
$pdf->Cell(35,10,' '.$registro->HoraInicio.' ',1,0,'C',0);
$pdf->Cell(35,10,' '.$registro->Costo.' ',1,0,'C',0);
$pdf->Cell(30 ,10,'  '.$registro->Premio.' ',1,0,'C',0);
$pdf->Cell(30 ,10,'  '.$registro->PuntosMeta.' ',1,1,'C',0);



$pdf->Cell(50,50,' ',1,0,'C',0);





  /*FOOTER*/  
  $pdf->SetY(-15);
    // Arial italic 8
    $pdf->SetFont('Arial','I',8);
    // Número de página
    $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
    
    /*Imprimir archivo*/  
    $pdf->Output();    
     

    
    
 
?>