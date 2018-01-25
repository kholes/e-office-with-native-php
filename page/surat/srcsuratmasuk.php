<?php
session_start();
include "../../lib/lib.php";
$db=new Db();
$db->conDb();
$toko=$_GET['cari'];
if (isset($toko)){
	$sql=mysql_query("SELECT nosurat FROM dtsuratmasuk WHERE nosurat LIKE '%$toko%' ORDER BY nosurat");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			$data=$row[0]."\n";
			echo $data;
			
		}
	}
}
?>
