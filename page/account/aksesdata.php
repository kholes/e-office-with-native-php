<?php
session_start();
include "../../lib/lib.php";
include "../../class/jabatan.cls.php";
include "../../class/module.cls.php";
include "../../class/level.cls.php";
$level=new Level();
$db=new Db();
$db->conDb();

$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$level->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$level->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('level'=>$_POST['level'],'id'=>$_POST['id']);
		$level->addData($data);		
		$data=$level->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('level'=>$_POST['level'],'id'=>$_POST['id']);
		$level->updateData($id,$data);		
		$data=$level->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$level->delData($id);
		$data=$level->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
$jabatan=new Jabatan();
$module=new Module();
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
	<th width="4%">No</th>
    <th width="15%" align="left">Level</th>
    <th width="81%" align="left">Hak akses </th>
    <?php
	  if ($data!=0){
	  	foreach($data as $row){	  	
			  ?>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
    	<td width="4%" align="center"><?php echo $c=$c+1;?></td>
    	<td  width="15%"><?php echo $row['id']; ?></td>
    	<td width="81%">
		<?php 
			$mdl=$row['module']; 
			$rmdl=explode(',',$mdl);
			$cmdl=count($rmdl);
			for($n=0;$n<$cmdl;$n++){
				echo "<li><a href='' style='color:#000'>".$module->getField('nama',$rmdl[$n])."</a><li>";
			} 
			?>
		</td>
	</tr>
  <?php
	  	}
	  }	  
	  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Data akses tidak ditemukan.</p>"; 
	}
}
?>
