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
<?php require_once('../Connections/localhost.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "eqp")) {
  $insertSQL = sprintf("INSERT INTO tbl_equip (name, vendor, amount, phone, address, `date`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['mnxx'], "text"),
                       GetSQLValueString($_POST['vendor'], "text"),
                       GetSQLValueString($_POST['price'], "int"),
                       GetSQLValueString($_POST['phonetxt'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['date'], "date"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());

  $insertGoTo = "equiplist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_equip = "SELECT * FROM tbl_equip";
$equip = mysql_query($query_equip, $localhost) or die(mysql_error());
$row_equip = mysql_fetch_assoc($equip);
$totalRows_equip = mysql_num_rows($equip);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EquipRegistration</title>
<link href="../image/kk_logo.png" rel="icon" type="image/x-icon" />
<style type="text/css">
.b {
	font-size: 36px;
}
.c{
	background-position:right;
	
	
	
}
table {
	text-align: center;
}
</style>
<link href="../jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css" />
<link href="../jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css" />
 
<script src="../jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
 
<br />
<link href="../css/home.css" rel="stylesheet" type="text/css" />
<link href="../css/me.css" rel="stylesheet" type="text/css" />  
 
 <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <link rel="stylesheet" type="text/css" href="../css/general_style.css" />
    
  
</head>

<body>
<div id="head">
<img src="../image/main.png" /> <div id="logo"> 
     
  </div>
  
  
  <div id='cssmenu'>
 <ul>
 
 
 
 
  
 
 
   <li class='active'><a href='home.php'>Inicio</a></li>
   <li><a href='myembers.php'>Lista de Miembros</a></li>
   <li><a href='equiplist.php'>Lista de Equipamento</a></li>
   <li><a href='pay.php'>Pagos</a></li>
   <li style="color:#DDDDC7"><a href="alerts.php">Estado</a></li>
   <li><a href='<?php echo $logoutAction ?>'>Cerrar Sesión</a></li>
   
</ul>  
</div>
  <div id="content">
    <div id="c1"><span class="b"><img src="../image/office1.png" width="74" height="76" alt="reg" class="c"   /></span> <span class="txtuserreg">Registro de Equipamento </span></div>
    <div id="c2">
      <fieldset><form action="<?php echo $editFormAction; ?>" id="eqp" name="eqp" method="POST"> <hr/><table width="423" align="left"    >
  <tr>
    <td width="91"   height="40" bgcolor="#006666">Nombre de Equipo</td>
    <td width="320"  > 
      
       
       
      <input name="mnxx" type="text" autofocus="autofocus" required="required" id="mnxx" placeholder="Nombre de Equipo" />
     </td>
  </tr>
  <tr>
    <td  class="table"  height="40" bgcolor="#999999">Vendedor</td>
    <td> 
      <input name="vendor" type="text" autofocus="autofocus" required="required" id="vendor" placeholder="Vendedor" />
        </td>
  </tr>
  <tr>
    <td height="40" bgcolor="#336666">Precio</td>
    <td> 
      <input name="price" type="text" autofocus="autofocus" required="required" id="price" placeholder="Precio" /></td>
  </tr>
  <tr>
    <td  height="40" bgcolor="#CCCCCC">Teléfono/Celular:</td>
    <td> 
      <input name="phonetxt" type="text" autofocus="autofocus" required="required" id="agetxt" placeholder="Celular" />
      </td>
  </tr>
  <tr>
    <td height="40" bgcolor="#669999" >Dirección</td>
    <td> 
      <input name="address" type="text" autofocus="autofocus" required="required" id="agetxt" placeholder="Dirección" />
         </td>
  </tr>
  <tr>
    <td height="40" bgcolor="#999966" >Descripción</td>
    <td> <textarea name="description"   autofocus="autofocus" required="required" id="description" placeholder="Sobre el Equipo"  ></textarea>
      
                                  </td>
  </tr>
  <tr>
    <td  height="40" bgcolor="#336666">Fecha</td>
    <td > <input name="date" type="date" id="date" /></td>
  </tr>
  <tr>
    <td> </td>
    <td height="30"> <hr/> <input type="submit" name="submit" id="submit" value="Guardar" /></td>
  </tr>
  
      </table>
        <table width="275" border="0">
          <tr>
             
          </tr>
        </table>
<input type="hidden" name="MM_insert" value="eqp" />
      </form></fieldset> 
    </div> <div id="footer" style="text-align:center;">Contactos:  <a href="http://platea21.blogspot.com" target="_blank">platea21.blogspot.com</a> by @gorchor
     &nbsp;
  </div>
  </div>
     
</div>
  
</div>

<script type="text/javascript">
$(function() {
	$( "#Datepicker1" ).datepicker(); 
});
</script>
</body>
</html>
<?php
mysql_free_result($equip);
?>
