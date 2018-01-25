<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmerek.cls.php";
$db=new Db();
$db->conDb();
$dtmerek=new Dtmerek();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$dtmerek->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$dtmerek->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtmerek->addData($data);		
		$data=$dtmerek->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtmerek->updateData($id,$data);		
		$data=$dtmerek->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$dtmerek->delData($id);
		$data=$dtmerek->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
if ($data!=0){
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
		  <th width="4%">No</th>
		  <th width="96%" align="left">Nama Merek</th>
		  <?php
	  if ($data!=0){
	  	foreach($data as $row){	  	
	  ?>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
		<td width="4%" align="center"><?php echo $c=$c+1;?></td>
		<td width="96%"><?php echo $row['merek']; ?></td>
	  </tr>
	  <?php
	  	}
	  }	  
	  ?>
	</table>
	<?php
	}else{ 
		echo "<p class='pesan'>Data merek tidak ditemukan.</p>"; 
	}
}
?>