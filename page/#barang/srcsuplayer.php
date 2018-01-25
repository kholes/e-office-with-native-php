<?php
include "../../lib/lib.php";
$db=new Db();
$db->conDb();
$toko=$_GET['cari'];
if (isset($toko)){
	$sql=mysql_query("SELECT id,nama FROM dttoko WHERE nama LIKE '%$toko%' ORDER BY id");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			echo $row[0].".".$row[1]."\n";
		}
	}
}
?>