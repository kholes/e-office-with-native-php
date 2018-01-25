<?php
session_start();
$lev=$_SESSION['level'];
$mod=$_SESSION['module'];
if($mod=='0'){
	$menu=$module->getAll();
	?>
		<li><a href='?p=<?php echo encrypt_url('home');?>'><img src="img/home-black.png" /></a></li>
		<?php
		foreach ($menu as $row){
			echo "<li><a href='".encrypt_url($row['url'])."'>".$row['nama']."</a></li>";
		}
		?>
		<li><a href='?p=<?php echo encrypt_url('logout');?>'><img src="img/logout-black.png" /></a></li>
	<?php
}else{
	$level=$user->getField('level',$logid);
	$linksurat="?p=".encrypt_url('surat');
	$linkbarang="?p=".encrypt_url('barang');
	$linkaset="?p=".encrypt_url('asettetap');
	$linkadmin="?p=".encrypt_url('admin');
	if($level=='SKR'||$level=='KKR'||$level=='KTU'||$level=='KSI'||$level=='STF'){
		header('location:'.$linksurat);
	}elseif($level=='STB'){
		header('location:'.$linkbarang);
	}elseif($level=='STA'){
		header('location:'.$linkaset);
	}elseif($level=='ROT'||$level=='ADM'){
		header('location:'.$linkadmin);
	}
}
?>
