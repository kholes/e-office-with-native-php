<?php
include "../../lib/lib.php";
include "../../class/dtbarangmasuk.cls.php";
include "../../class/dtbarangkeluar.cls.php";
include "../../class/dttoko.cls.php";
include "../../class/pegawai.cls.php";
include "../../class/pengajuan.cls.php";
include "../../class/dtsatuan.cls.php";
include "../../class/dtbarang.cls.php";

$db=new Db();
$db->conDb();
$barangmasuk=new Dtbarangmasuk();
$barangkeluar=new Dtbarangkeluar();
$toko=new Dttoko();
$pegawai=new Pegawai();
$dtbarang=new Dtbarang();
$satuan=new Dtsatuan();
$pengajuan=new Pengajuan();
$link=$_SERVER['PHP_SELF'];
$id=$_GET['id'];
$sql=$barangkeluar->getItem($id);
if($sql!=array()){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DETAIL PERMINTAAN BARANG</title>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
</head>
<body>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>
<h3 align="center" style="padding:10px 0"><u>TANDA TERIMA BARANG</u></h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
		  <td width="21%" align="left" style="border:none;"><strong>NO. PENAGJUAN</strong></td>
		  <td width="26%" align="left" style="border:none;">: <?php echo $id; ?></td>
		  <td width="16%" style="border:none;">&nbsp;</td>
		  <td width="17%" align="left" style="border:none;"><strong>TANGGAL</strong></td>
		  <td width="20%" style="border:none;">: <?php echo getTanggal($barangkeluar->getHeadField('tanggal',$id)); ?></td>
		</tr>
		<tr>
			<td align="left" style="border:none;"><strong>PENGAJUAN OLEH </strong></td>
			<td align="left" style="border:none;">: <?php echo $pegawai->getField('jabatan',$barangkeluar->getHeadField('pemohon',$id)); ?></td>
			<td style="border:none;">&nbsp;</td>
			<td align="left" style="border:none;">&nbsp;</td>
		  <td width="20%" style="border:none;">&nbsp;</td>
		</tr>
	</table>
		<div style="clear:both; height:10px;"></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
	<tr>
		<td><strong>NO</strong></td>
		<td "42%" align="left"><strong>NAMA BARANG</strong> </td>
		<td width="7%" align="left"><strong>SATUAN</strong></td>
		<td width="7%" align="center"><strong>JUMLAH</strong></td>
		<td width="47%" align="left"><strong>KETERANGAN</strong></td>
	</tr>
	<?php
	foreach($sql as $row){	  	
	?>
	<tr>
		<td width="3%" align="center"><?php echo $c=$c+1;?></td>
		<td width="43%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
		<td width="7%" align="left"><?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?></td>
		<td width="7%" align="center"><?php echo $row['qty']; ?></td>
 		<td width="47%" align="left"><?php echo $row['keterangan']; ?></td>
	</tr>
	<?php
	}	  
	?>
</table>
	<div style="clear:both; height:10px;"></div>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
		  <td width="23%" align="center" style="border:none;"><p>PENERIMA BARANG </p></td>
		  <td width="58%" align="center" style="border:none;"><p>&nbsp;</p></td>
		  <td width="19%" align="center" style="border:none;"><p>PENYIMPAN BARANG </p></td>
		</tr>
		<tr>
			<td style="border:none;">&nbsp;</td>
			<td style="border:none;">&nbsp;</td>
			<td style="border:none;">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" style="border:none;"><p>( __________________ )</p></td>
			<td align="center" style="border:none;"><p>&nbsp;</p></td>
			<td align="center" style="border:none;"><p>( <?php echo $pegawai->getField('nama',$barangkeluar->getHeadField('id_user',$id)); ?> )</p></td>
		</tr>
	</table>
<?php
}else{
	echo "<p class='pesan'>Belum ada barang yang akan dipesan.</p>";
}
?>
</body>
</html>