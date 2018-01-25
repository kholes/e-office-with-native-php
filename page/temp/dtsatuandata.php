<?php
session_start();
include "../lib/lib.php";
include "../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$dtsatuan=new Dtsatuan();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$dtsatuan->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$dtsatuan->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtsatuan->addData($data);		
		$data=$dtsatuan->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtsatuan->updateData($id,$data);		
		$data=$dtsatuan->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$dtsatuan->delData($id);
		$data=$dtsatuan->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
if ($data!=0){
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <th width="4%">No</th>
		  <th width="96%" align="left">Nama Merek</th>
		  <?php
	  if ($data!=0){
	  	foreach($data as $row){	  	
	  ?>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
		<td width="4%" align="center"><?php echo $c=$c+1;?></td>
		<td width="96%"><?php echo $row['satuan']; ?></td>
	  </tr>
	  <?php
	  	}
	  }	  
	  ?>
	</table>
	<?php
	}else{ 
		echo "<p class='pesan'>Data satuan tidak ditemukan.</p>"; 
	}
}
?>