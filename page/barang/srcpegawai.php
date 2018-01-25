<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$toko=$_GET['cari'];
if (isset($toko)){
	$sql=mysql_query("SELECT id,nama,jabatan FROM pegawai WHERE nama LIKE '%$toko%' or jabatan like '%$toko%' ORDER BY id");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			echo $row[1]."-".$row[2]."-".$row[0]."\n";
		}
	}
}
?>
