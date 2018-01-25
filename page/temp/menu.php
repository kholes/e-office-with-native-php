<?php
session_start();
include "class/module.cls.php";
include "class/katmodule.cls.php";
$module=new Module();
$katmodule=new Katmodule();
$lev=$_SESSION['level'];
$mod=$_SESSION['module'];
if($mod=='0'){
	$menu=$module->getAll();
	?>
			<li><img src="img/home-black.png" /><a href='?p=".encrypt_url('home')."'>Home</a></li>
			<?php
			foreach ($menu as $row){
				echo "<li><a href='".encrypt_url($row['url'])."'>".$row['nama']."</a></li>";
			}
			?>
			<li><img src="img/home-black.png" /><a href='?p=".encrypt_url('home')."'>Home</a></li>
	
	<?php
}else{
	$hak=explode(',',$mod);
	$q=sizeof($hak);
	?>
	<ul id="foo2">
	<li><a href='?p=<?php echo encrypt_url('home');?>'><img src="img/home-black.png" />Home</a></li>
	<li><a href='?p=<?php echo encrypt_url('logout');?>'><img src="img/logout-black.png" />Keluar</a></li>
	<?php
	for($i=0;$i<$q;$i++){
		echo "<li><a href='?p=".encrypt_url($module->getField('url',$hak[$i]))."'><img src='".$module->getField('icon',$hak[$i])."'><br>".$module->getField('nama',$hak[$i])."</a></li>";
	}
	?>
		</ul>
		<div class="clearfix">
		</div>
		<a id="prev2" class="prev" href="#">&lt;</a>
		<a id="next2" class="next" href="#">&gt;</a>
	<?php
}
?>

