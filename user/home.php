<?php
session_start();
//var_dump($_SESSION);
//exit;
if (!isset($_SESSION['isAdmin'])) {
  header("../index.php");
}

include "cabecera.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-3" is="subMenu">
        <button type="button" class="btm btn-lg btn-block btn-info" onclick="rank('miRanking')" >Rank</button>
        <button type="button" class="btm btn-lg btn-block btn-info">Torneos</button>
        <button type="button" class="btm btn-lg btn-block btn-info">Invitar</button>
        <button type="button" class="btm btn-lg btn-block btn-info">Jugar</button>
            <div class="row" id="wait"></div>
        </div  >
        <div class="col-md-9" id="areaTrabajo"> area de trabajo</div>
    </div>
</div>