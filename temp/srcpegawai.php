<?php
session_start();
include "lib/lib.php";
include "class/user.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$toko=$_GET['cari'];
if (isset($toko)){
	$sql=mysql_query("SELECT id,nama FROM pegawai WHERE nama LIKE '%$toko%' ORDER BY id");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			echo $row[0].".".$row[1]."\n";
		}
	}
}
?>
