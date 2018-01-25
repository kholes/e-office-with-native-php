<?php
include "../../lib/lib.php";
include "../../class/trxinput.cls.php";
include "../../class/dttoko.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$trxin=new Trxinput();
$toko=new Dttoko();
$pegawai=new Pegawai();
$link=$_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CETAK LAPORAN PEMBELIAN BARANG</title>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
</head>
<body>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>
<?php
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
$mtgl=$_GET['mtgl'];
$htgl=$_GET['htgl'];
$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
$data=$trxin->getRekap($r,$s,$i);
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div id="header">
<h2>REKAPITULASI BELANJA BARANG CETAKAN</h2>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
		<th width="14%" style="border:none" colspan="2" align="left">NO. TRANSAKSI</th>
		<th width="26%" style="border:none" align="left">: <?php echo $row['id']; ?></th>
		<th width="17%" style="border:none" colspan="3" align="left">TOTAL (Rp.) </th>
		<th width="21%" style="border:none" align="left">: <?php echo format_angka($row['total']); ?></th>
	<?php
	$sql=$trxin->getDetail($row['id']);
	if($sql!=array($sql)){
		foreach($sql as $data){	  	
	?>
	<tr>
		<td width="3%" align="center"><?php echo $n=$n+1;?></td>
		<td width="12%"><?php if($data['kode']!=''){echo $data['kode'];}else{echo $data['id'];} ?></td>
		<td width="47%"><?php echo $data['nama']; ?></td>
		<td width="12%" align="right"><?php echo format_angka($data['harga_beli']); ?></td>
		<td width="6%" align="center"><?php echo $data['qty']; ?></td>
		<td width="8%" align="right"><?php echo format_angka($data['diskon']); ?></td>
		<td width="12%" align="right"><?php echo format_angka($data['jumlah']); ?></td>
	</tr>
	<?php
		}	  
	}else{
		echo "<p class='pesan'></p>";
	}
	}
}	  
?>
  	<th colspan="6" align="center"><h3>GRAND TOTAL </h3></th>
	<th align="right"><h3><?php echo format_angka($trxin->getRekapTotal($r));?></h3></th>
</table>
<?php
}else{ 
	echo "<p class='pesan'>Tidak ada transaksi.</p>"; 
}
?>
</body>
</html>
