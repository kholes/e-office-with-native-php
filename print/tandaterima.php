<?php
include "../lib/lib.php";
include "../class/trxreq.cls.php";
include "../class/dtbarang.cls.php";
include "../class/pegawai.cls.php";
include "../class/dtsatuan.cls.php";
include "../class/jabatan.cls.php";
$db=new Db();
$db->conDb();
$brg=new Dtbarang();
$peg=new Pegawai();
$jab=new Jabatan();
$sat=new Dtsatuan();
$trx=new Trxreq();
$id=$_GET['id'];
$hed=$trx->getRow($id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
table,td{text-align:center;}
</style>
</head>

<body>
<div class="header" align="center">
<h2>SURAT TANDA TERIMA BARANG</h2>
<h2>KANTOR PENGHUBUNG PEMERINTAH PROVINSI SUMATERA BARAT</h2>
</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="4%" rowspan="2">NO</td>
		<td width="26%" rowspan="2">NAMA BARANG </td>
		<td width="14%" rowspan="2">KODE</td>
		<td width="12%" rowspan="2">SATUAN</td>
		<td colspan="2">BANYAKNYA</td>
		<td width="27%" rowspan="2">KETERANGAN</td>
	  </tr>
	  <tr>
		<td width="8%">ANGKA</td>
		<td width="9%">HURUF</td>
	  </tr>
	  <tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
		<td>7</td>
	  </tr>
		<?php
		$d=$trx->getDetail($id);
		foreach($d as $row){
		?>
	  <tr>
		<td><?php echo $c=$c+1;?></td>
		<td><?php echo $row['nama']; ?></td>
		<td><?php echo $row['kode']; ?></td>
		<td><?php echo $sat->getField('satuan',$brg->getField('satuan',$row['id'])); ?></td>
		<td><?php echo $row['jum_pengajuan']; ?></td>
		<td><?php echo terbilang($row['jum_pengajuan']); ?></td>
		<td><?php echo $row['keterangan']; ?></td>
	  </tr>
	  	<?php
	  	}	
	  	?>
	</table>
<div class="footer">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%">PEMOHON</td>
    <td width="22%">TU</td>
    <td width="27%">GUDANG</td>
    <td width="32%">PENERIMA</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach($hed as $data); ?>
  <tr>
    <td>( <?php echo $peg->getField('nama',$data['pemesan']); ?> )</td>
    <td>( <?php echo $peg->getField('nama',$data['pengesahan']); ?> )</td>
    <td>( <?php echo $peg->getField('nama',$data['staf']); ?> )</td>
    <td>( <?php echo $data['pemesan']; ?> )</td>
  </tr>
</table>

</div>
</body>
</html>
