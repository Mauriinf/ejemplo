<?php require_once('../Connections/localhost.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_localhost, $localhost);
$query_totalmembers = "SELECT * FROM tbl_userreg";
$totalmembers = mysql_query($query_totalmembers, $localhost) or die(mysql_error());
$row_totalmembers = mysql_fetch_assoc($totalmembers);
$totalRows_totalmembers = mysql_num_rows($totalmembers);

mysql_select_db($database_localhost, $localhost);
$query_amountsum = "SELECT SUM( amount) FROM tbl_userreg";
$amountsum = mysql_query($query_amountsum, $localhost) or die(mysql_error());
$row_amountsum = mysql_fetch_assoc($amountsum);
$totalRows_amountsum = mysql_num_rows($amountsum);

mysql_select_db($database_localhost, $localhost);
$query_Recordset1 = "SELECT SUM(amount) FROM tbl_equip";
$Recordset1 = mysql_query($query_Recordset1, $localhost) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inicio Platea21 GYM</title>



<link href="../image/kk_logo.png" rel="icon" type="image/x-icon" />


<style type="text/css">
.headtext {
	text-align: left;
}
.headtext {
	text-align: right;
}
</style>
<br />
<link href="../css/home.css" rel="stylesheet" type="text/css" />
<link href="../css/me.css" rel="stylesheet" type="text/css" />  
 
   
  
</head>

<body>
<div id="head">
<img src="../image/main.png" /><div id="logo"> 
     
  </div>
  
  
  <div id='cssmenu'>
 <ul>
 
 
 
 
  
 
 
   <li class='active'><a href='home.php'>Inicio</a></li>
   <li><a href='myembers.php'>Lista de Miembros</a></li>
   <li><a href='equiplist.php'>Lista de Equipamento</a></li>
   <li><a href='pay.php'>Pagos</a></li>
   <li style="color:#DDDDC7"><a href="alerts.php">Estado</a></li>
   <li style=""><a href='<?php echo $logoutAction ?>'>Cerrar Sesión</a></li>
   
</ul>  
</div>
<br/>
  <div id="content">
    
  
  <hr />
<header> <div class="q" id="uno"> <a href="userr.php"><img src="../image/contract11.png" class="icon" /> </a>
  <p class="text"><a href="userr.php">Registro de Usuario </a></p></div> 

<div class="q" id="dos"><a href="equi.php"><img src="../image/finance-and-business4.png" class="icon" /> </a>
  <p class="text"><a href="equi.php">Registro de Equipamento </a></p> </div>

<div class="q" id="tres"><a href="pay.php"><img src="../image/done2.png" class="icon" /> </a>
  <p class="text"><a href="pay.php"> Pagos</a></p> </div>
<div class="q"id="custro"><a href="myembers.php"><img src="../image/drink70.png" " class="icon" /></a> 
  <p class="text"><a href="myembers.php">Administrar Miembros</a></p> </div>
 
</header>
  
   <div id="below" >
 </div>
  <header1> <div class="b" id="c">
    <img class="n" src="../image/office.png" width="138" height="49"/>  
    <p class="text">Total Clientes: <?php echo $totalRows_totalmembers ?></p>
  </div> 

<div class="b" id="d"> <img class="n" src="../image/finance-and-business5.png" width="130" height="135" />
<p class="text">Total Ingresos: $
<?php echo $row_amountsum['SUM( amount)']; ?>
   </p>
</div>
 
<div class="b" id="e"> <img class="n" src="../image/currency-symbol.png" width="512" height="512" />
<p class="text">Total Equipamento Invertido: $ <?php echo $row_Recordset1['SUM(amount)']; ?> </p>
</div>
<div class="b" id="f"><img class="n" src="../image/deadlines.png" width="512" height="512" />  <p class="text">Fecha:  <?php

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
 //$datenow=date("l, d F Y");  
    
  //echo $datenow;
   
  



?> </p></div>
 
</header1><br/>
  
</div><hr />
  <div id="footer" style="text-align:center;">Contactos:  <a href="http://platea21.blogspot.com" target="_blank">platea21.blogspot.com</a> by @gorchor
     &nbsp;
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($totalmembers);

mysql_free_result($amountsum);

mysql_free_result($Recordset1);
?>
