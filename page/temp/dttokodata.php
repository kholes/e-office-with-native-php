<?php
session_start();
include "../lib/lib.php";
include "../class/dttoko.cls.php";
$db=new Db();
$db->conDb();
$toko=new Dttoko();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$toko->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$toko->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('module'=>$_POST['module'],'id'=>$_POST['id']);
		$toko->addData($data);		
		$data=$toko->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('module'=>$_POST['module'],'id'=>$_POST['id']);
		$toko->updateData($id,$data);		
		$data=$toko->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$module->delData($id);
		$data=$toko->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="4%">No</th>
    <th width="33%" align="left">Nama Supplayer </th>
    <th width="52%" align="left">Alamat</th>
    <th width="11%" align="left">Tlp</th>
    <?php
		  if ($data!=0){
			foreach($data as $row){	  	
		  ?>
  </tr>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
    <td width="4%" align="center"><?php echo $c=$c+1;?></td>
    <td width="33%"><?php echo $row['nama']; ?></td>
    <td width="52%"><?php echo $row['alamat']; ?></td>
    <td width="11%"><?php echo $row['tlp']; ?></td>
  </tr>
  <?php
			}
		  }	  
		  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Data module tidak ditemukan.</p>"; 
	}
}
?>