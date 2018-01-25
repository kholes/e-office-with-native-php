<?php
session_start();
include "../lib/lib.php";
include "../class/dtbarang.cls.php";
$db=new Db();
$db->conDb();

$dtbarang=new Dtbarang();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$dtbarang->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$dtbarang->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$barang->addData($data);		
		$data=$barang->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$barang->updateData($id,$data);		
		$data=$barang->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$barang->delData($id);
		$data=$barang->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
include "../class/dtkategori.cls.php";
include "../class/dtmerek.cls.php";
include "../class/dtsatuan.cls.php";
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$dtsatuan=new Dtsatuan();
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="3%">NO</th>
    <th width="10%" align="left">KODE</th>
    <th width="19%" align="left">KATEGORI</th>
    <th width="30%" align="left">NAMA</th>
    <th width="9%" align="left">MEREK</th>
    <th width="4%">STOK</th>
    <th width="9%">MIN-STOK</th>
    <th width="7%" align="left">SATUAN</th>
    <?php
			  if ($data!=0){
				foreach($data as $row){	  	
			  ?>
  </tr>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
    <td width="3%" align="center"><?php echo $c=$c+1;?></td>
    <td width="10%"><?php echo $row['barcode']; ?></td>
    <td width="19%"><?php echo $dtkategori->getField('kategori',$row['kategori']); ?></td>
    <td width="30%"><?php echo $row['nama']; ?></td>
    <td width="9%"><?php echo $dtmerek->getField('merek',$row['merek']); ?></td>
    <td width="4%" align="center"><?php echo $row['stok']; ?></td>
    <td width="9%" align="center"><?php echo $row['minstok']; ?></td>
    <td width="7%"><?php echo $dtsatuan->getField('satuan',$row['satuan']); ?></td>
  </tr>
  <?php
				}
			  }	  
			  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Data barang tidak ditemukan.</p>"; 
	}
}
?>