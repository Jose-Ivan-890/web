<?

session_start();
include "../class/classBD.php";
//var_dump($_POST);
//var_dump($_SESSION);
//exit;

if (!isset($_POST['calculo'])) {
   header ("location: ../registro.php?e=4");
}
//if ($_POST['calculo']!=$_SESSION['calculo']) {
 //  header ("location: ../registro.php?e=3");
//}


$conexion=mysqli_connect("localhost", "userBasta", '12345','basta');

$cadena="ABCDEFGHJKLMNPQRSTUVWXYZ23456789123456789";
$numeC=strlen($cadena);
$nuevPWD="";
for ($i=0; $i<8; $i++)
  $nuevPWD.=$cadena[rand()%$numeC]; 

$cad="insert into usuario set Nombre='".$_POST['nombre']."', Apellidos='".$_POST['apellidos']."',Genero='".$_POST['genero']."', Email='".$_POST['email']."',IdTipo='1' ,clave=password('".$nuevPWD."')";

 include("class.phpmailer.php");
 include("class.smtp.php");

$mail = new PHPMailer();
$mail->IsSMTP();
    $mail->Host="smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 0;  // enables SMTP debug information (for testing) lo pondremos en 0 despues 
                              // 1 = errors and messages
                              // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication
    
    
    $mail->Username =  ""; 
    $mail->Password = "";
    $mail->From="";
    $mail->FromName="";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO ".$_POST['nombre']." ".$_POST['apellidos']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
    $mail->AddAddress($_POST['email']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send()) 
          echo  "Error: " . $mail->ErrorInfo;
    else { 
    //  $bloque=$oBD -> mysqli_query("Select email from usuarios where email= '".$_POST['email']."' ;");             
      //if (mysqli_num_rows($bloque)==0) { //!mysqli_num_rows($bloque)  es lo mismo
     //  echo (mysqli_num_rows($bloque));
       //  $result=mysqli_query($conexion,$cad);
       //    header("location: index.php?e=7"); 
       // /*********************** 
       $oBD = new baseDatos(); 
       $bloque=$oBD -> consulta("Select email from usuario where Email= '".$_POST['email']."' ;");             
       if ($oBD->numeRegistros===0) { //!mysqli_num_rows($bloque)  es lo mismo
      //  echo (mysqli_num_rows($bloque));
          $result=$oBD->insertdato($cad);
         //  header("location: index.php?e=7"); 
       }
         //¨************************** */
        // }

           else{header("location: registro.php?m=2");  }
               
      }
/*

PROBLEMAS A SOLUCIONAR EN EL REGISTRO
1) DETECTAR QUE EL CORREO YA ESTA REGISTRADO, 
   YA QUE ES LA LLAVE PRIMARIA Y NO SE DEBE ENVIAR
   EL CORREO SI YA ESTABA REGISTRADO.
2) LA CLAVE DEBE DE CIFRARSE, POR QUE EN EL 
   LOGUEO SE CIFRA.


*/











?>