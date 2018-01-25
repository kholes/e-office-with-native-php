<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtkiba.cls.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkibc.cls.php";
include "../../class/dtkibe.cls.php";
include "../../class/dtperawatan.cls.php";
$db=new Db();
$db->conDb();
$dtkiba=new Dtkiba();
$dtkibb=new Dtkibb();
$dtkibc=new Dtkibc();
$dtkibe=new Dtkibe();
$perawatan=new Dtperawatan();

$kib=$_GET['kib'];
$id=$_GET['id'];
$bln=$_GET['bln'];
$thn=$_GET['thn'];
if($bln=='all'){$periode=$thn;}else{$periode=$thn."-".$bln;}
switch($kib){
	case 'KIBA':$dtkib=$dtkiba;break;
	case 'KIBB':$dtkib=$dtkibb;break;
	case 'KIBC':$dtkib=$dtkibc;break;
	case 'KIBE':$dtkib=$dtkibe;break;
}
if($id!='all'){
	$sql=mysql_query("select * from dtperawatanitem where id='$id' and tanggal like '%$periode%' order by tanggal");
	$stotal=mysql_query("select sum(harga) as jumlah from dtperawatanitem where id='$id' and tanggal like '%$periode%'");
}else{
	$sql=mysql_query("select * from dtperawatanitem where tanggal like '%$periode%' order by tanggal");
	$stotal=mysql_query("select sum(harga) as jumlah from dtperawatanitem where tanggal like '%$periode%'");
}
while($rtotal=mysql_fetch_array($stotal)){$total=$rtotal['jumlah'];}
?>
<link rel="stylesheet" type="text/css" href="../../css/aset.css">
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
<body onLoad="window.print();">
<div align="center">
	<div class="c10"></div>
	<div class="c10"></div>
	<h2>LAPORAN PERWATAN ASET (<?php echo $kib;?>)</h2>
	<h2>PERIODE <?php echo getBulan($bln);?> TAHUN <?php echo $thn;?></h2>
	<table border="0" cellpadding="0" cellspacing="0" class="tabel" width="99%">
		<th width="11%" align="left">TANGGAL</th>
		<th width="18%" align="left">NAMA BARANG</th>
		<th width="20%" align="left">PEKERJAAN</th>
		<th width="23%" align="left">SPAREPART</th>
		<th width="11%" align="center">STATUS</th>
		<th width="17%" align="right">BIAYA/HARGA</th>
		<?php
			while($row=mysql_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo getTanggal($row['tanggal']);?></td>
			<td><?php echo $dtkib->getField('nama',$row['id'])."&nbsp".$dtkib->getField('merek',$row['id'])."&nbsp".$dtkib->getField('no_polisi',$row['id']);?></td>
			<td><?php echo $row['jenis'];?></td>
			<td><?php echo $row['sparepart'];?></td>
			<td align="center"><?php echo get_status($row['status']);?></td>
			<td align="right"><?php echo rupiah($row['harga']);?></td>
		</tr>
		<?php
		}
		?>
		<th colspan="5" align="left">TOTAL BIAYA PERAWATAN</th>
		<th colspan="2" align="right"><?php echo rupiah($total);?></th>
	</table>
	<div id="menu">
	<a onclick="window.print();"><li class="fa fa-print icon"></li></a>
	</div>
</div>
</body>