<?php
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	$p=decrypt_url(htmlentities($_GET['p']));
	$halaman="page/$p/$p.php";
	if(!file_exists($halaman) || empty($halaman)){
		header("location:index.php");
	}else{
		include "$halaman";
	}
}
?>