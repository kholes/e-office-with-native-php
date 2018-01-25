<div class="home">
<?php
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	include 'menuhome.php';
}
?>
</div>