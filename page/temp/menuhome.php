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
	$linksurat="?p=".encrypt_url('entrisurat');
	$linkbarang="?p=".encrypt_url('barangkeluar');
	$linkaset="?p=".encrypt_url('asettetap');
	if($level=='SKR'||$level=='KKR'||$level=='KTU'||$level=='KSI'){
		header('location:'.$linksurat);
	}elseif($level=='STB'){
		header('location:'.$linkbarang);
	}elseif($level=='STA'){
		header('location:'.$linkaset);
	}elseif($level=='ROT'||$level=='ADM'){
		$hak=explode(',',$mod);
		$q=sizeof($hak);
		?>
		<div style=" display:block;width:100%;">
			<div class="home-menu">			
			<?php
			for($i=0;$i<$q;$i++){
			?>
				<div class="work">
					<a href='?p=<?php echo encrypt_url($module->getField('url',$hak[$i]));?>'>
						<img src='<?php echo $module->getField('icon',$hak[$i]);?>'  class='media'>
						<div class="caption">
							<div class="work_title">
								<h1><?php echo $module->getField('nama',$hak[$i]);?></h1>
							</div>
						</div>
					</a>		
				</div>
			<?php
			}
			?>
			</div>
		</div>
		<?php
	}
}
?>
