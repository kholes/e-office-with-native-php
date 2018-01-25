<?php
session_start();
include "../../lib/lib.php";
include "../../class/pegawai.cls.php";
include "../../class/jabatan.cls.php";
include "../../class/golongan.cls.php";
$db=new Db();
$db->conDb();
$jabatan=new Jabatan();
$pegawai=new Pegawai();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$pegawai->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$pegawai->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$pegawai->addData($data);		
		$data=$pegawai->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$pegawai->updateData($id,$data);		
		$data=$pegawai->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$pegawai->delData($id);
		$data=$pegawai->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
$golongan=new Golongan();
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  	<th width="4%">No</th>
    <th width="24%" align="left">Nama pegawai </th>
    <th width="18%" align="left">NIP</th>
    <th width="26%" align="left">Pangkat/Golongan </th>
    <th width="13%" align="left">SUBBAG/SEKSI</th>
    <th width="15%" align="left">Jabatan</th>
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>','<?php echo $row['module']; ?>');"  onmouseout="this.style.background='#fff';">
    <td width="4%" align="center"><?php echo $c=$c+1;?></td>
    <td width="24%"><?php echo $row['nama']; ?></td>
    <td width="18%"><?php echo $row['nip']; ?></td>
    <td width="26%"><?php echo $row['pangkat_golongan']; ?></td>
    <td width="13%"><?php echo $row['bagian']; ?></td>
    <td width="15%"><?php echo $row['jabatan']; ?></td>
  </tr>
  <?php
			}
		  }	  
		  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Data pegawai tidak ditemukan.</p>"; 
	}
}
?>