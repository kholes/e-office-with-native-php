<?php
session_start();
include "../lib/lib.php";
include "../class/trxoutput.cls.php";
$db=new Db();
$db->conDb();
$trxout=new Trxoutput();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$trxout->getLike($cari);
		tabel($data);
	break;
	case 'getRekap':
		$dataR=array('mtgl'=>tgl_ind_to_eng($_POST['mtgl']),'htgl'=>tgl_ind_to_eng($_POST['htgl']));
		$x=$trxout->getRekap($dataR);	
		tabel($x);
	break;
}
function tabel($data){
include "../class/pegawai.cls.php";
$pegawai=new Pegawai();
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="4%">NO</th>
    <th width="27%" align="left">TANGGAL</th>
    <th width="29%" align="left">PENGGUNA</th>
    <th width="40%" align="left">PENYIMPAN BARANG</th>
    <?php
			  if ($data!=0){
				foreach($data as $row){	  	
			  ?>
  </tr>
	<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
    <td width="4%" align="center"><?php echo $c=$c+1;?></td>
    <td width="27%"><?php echo getTanggal($row['tanggal']); ?></td>
    <td width="29%"><?php echo $pegawai->getField('nama',$row['id_pegawai']); ?></td>
    <td width="40%"><?php echo  $pegawai->getField('nama',$row['id_user']); ?></td>
  </tr>
  <?php
				}
			  }	  
			  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Tidak ada transaksi.</p>"; 
	}
}
?>