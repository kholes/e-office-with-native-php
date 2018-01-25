<?php
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/dtkategori.cls.php";
include "../../class/dtmerek.cls.php";
include "../../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$dtbarang=new Dtbarang();
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$dtsatuan=new Dtsatuan();

$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<div id="menu">
	<a onClick="window.print();"><img src="../../img/print.png"></a> 
	<a href="barangxls.php"><img src="../../img/xls-icon.png" align="right" /></a>
</div>
<?php
if(isset($c)){$data=$dtbarang->getLike($c,$s,$i);}else{$data=$dtbarang->getAll($s,$i);}
if ($data!=array()){
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<script>
function viewDetail(id){
	window.location='<?php echo $link;?>&m=fbrg&act='+id;
}
</script>
<h3>KANTOR PENGHUBUNG PEMERINTAH</h3>
<h3>PROVINSI SUMATERA BARAT</h3>
<br />
<h3 align="center">LAPORAN STOK BARANG</h3>
<h3 align="center">ATK DAN CETAKAN / PENGADAAN PERIODE  </h3>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <th width="4%">NO</th>
    <th width="6%" align="left">KODE</th>
    <th width="34%" align="left">NAMA</th>
    <th width="24%" align="left">MEREK</th>
    <th width="8%">JUMLAH </th>
    <th width="8%">BELANJA  </th>
    <th width="8%">PENGGUNAAN</th>
    <th width="8%"> STOK</th>
    <th width="8%"> FISIK</th>
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
	<tr>
    <td width="4%" align="center"><?php echo $c=$c+1;?></td>
    <td width="6%"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
    <td width="34%"><?php echo $row['nama']; ?></td>
    <td width="24%"><?php echo $dtmerek->getField('merek',$row['merek']); ?></td>
    <td width="8%" align="center"><?php echo $row['stok']; ?></td>
    <td width="8%" align="center">
	<?php 
	$in=mysql_query("select sum(qty) as jum_masuk from dtbarangmasukitem where id='{$row['id']}'");
	while($rowin=mysql_fetch_assoc($in)){echo $total_in=$rowin['jum_masuk'];} 
	?>	
	</td>
    <td width="8%" align="center">
	<?php 
	$out=mysql_query("select sum(qty) as jum_masuk from dtbarangkeluaritem where id='{$row['id']}'");
	while($rowout=mysql_fetch_assoc($out)){echo $total_out=$rowout['jum_masuk'];} 
	?>	</td>
    <td width="8%" align="center"><?php echo $total_in-$total_out; ?></td>
    <td width="8%" align="center">&nbsp;</td>
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
?>