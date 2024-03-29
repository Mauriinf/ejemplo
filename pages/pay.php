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

$currentPage = $_SERVER["PHP_SELF"];

$colname_update = "-1";
if (isset($_GET['userid'])) {
  $colname_update = $_GET['userid'];
}
mysql_select_db($database_localhost, $localhost);
$query_update = sprintf("SELECT * FROM tbl_userreg WHERE userid = %s", GetSQLValueString($colname_update, "int"));
$update = mysql_query($query_update, $localhost) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);

$colname_Recordset1 = "-1";
if (isset($_GET['userid'])) {
  $colname_Recordset1 = $_GET['userid'];
}
mysql_select_db($database_localhost, $localhost);
$query_Recordset1 = sprintf("SELECT * FROM tbl_userreg WHERE userid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $localhost) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
 mysql_select_db($database_localhost, $localhost);
if (isset($_POST['txt_search'])) {
	$searchword=$_POST['txt_search'];
	$query_Recordset1="select * from tbl_userreg where firstname LIKE  '%".$searchword."%'";
   
}

else{
	
$query_Recordset1="select * from tbl_userreg";	
	
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $localhost) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);


if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pyment</title>
<link href="../image/kk_logo.png" rel="icon" type="image/x-icon" />
<style type="text/css">
.b {
	font-size: 36px;
}
.c{
	background-position:right;
	
	
	
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
   <li><a href='<?php echo $logoutAction ?>'>Cerrar Sesión</a></li>
   
</ul>  
</div>
  <div id="content">
    
    <div id="c1"><span class="txtuserreg"> <img src="../image/office.png" width="74" height="76" alt="us" />Pagos de Miembros:</span></div>
    <div id="c2"><hr/><form action="" id="form1" method="post" name="form1">
      <label for="txt_search"></label>
      <input type="text" name="txt_search" id="txt_search" />
      <input class="abc" type="submit" name="btn_search" id="btn_search" value="Buscar" />
    </form>
     
<p> 
      <form action="" id="form2" method="post" name="form2">
        <table width="570" border="0" align="center" cellpadding="4" cellspacing="2">
          <tr>
            <td width="150" height="20" bgcolor="#2F6F2E">ID Usuario</td>
            <td width="174" bgcolor="#2F6F2E">Nombres</td>
            <td width="170" bgcolor="#2F6F2E">Apellidos</td>
            <td width="34" bgcolor="#CC9"> </td>
          </tr>
          <?php do { ?>
            <tr>
              <td height="20"><?php echo $row_Recordset1['userid']; ?> </td>
              <td><a> <?php echo $row_Recordset1['firstname']; ?> </a></td>
              <td><?php echo $row_Recordset1['lastname']; ?> </td>
              <td class="kk"> <p>
              <a href="userpay.php?userid=<?php echo $row_Recordset1['userid']; ?>" class="abc">Realizar&nbsp;Pago</a></p>
              </td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
        
        <p><br />
        </p>
        <table border="0">
          <tr>
            <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>" class="kk">Primero</a>
                ||
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>" class="kk">Anterior</a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>" class="kk">Siguiente</a>||
                <?php } // Show if not last page ?></td>
            <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>" class="kk">Final</a>
                <?php } // Show if not last page ?></td>
          </tr>
        </table>
Archivos <?php echo ($startRow_Recordset1 + 1) ?> de <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> a <?php echo $totalRows_Recordset1 ?>
      </form><hr/>
    </div> <div id="footer" style="text-align:center;">Contactos:  <a href="http://platea21.blogspot.com" target="_blank">platea21.blogspot.com</a> by @gorchor
     &nbsp;
  </div>
  </div>
     
</div>
  
</div>

</body>
</html>
<?php
mysql_free_result($update);

mysql_free_result($Recordset1);
?>
