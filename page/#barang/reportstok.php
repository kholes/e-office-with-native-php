<?php
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/dtkategori.cls.php";
include "../../class/dtmerek.cls.php";
include "../../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$dtsatuan=new Dtsatuan();
$dtmerek=new Dtmerek();
$dtkategori=new Dtkategori();
$dtbarang=new Dtbarang();
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='stok';}
if(isset($c)){
	$data=$dtbarang->getLike($c,$s,$i);
}else{
	$data=$dtbarang->getAll($s,$i);
}
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<script>
function viewDetail(id){
	window.location='<?php echo $link;?>&m=fbrg&act='+id;
}
</script>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl01">
		<th width="2%"><strong>NO</strong></th>
		<th width="6%" align="left"><strong>KODE</strong></th>
		<th width="25%" align="left"><strong>KATEGORI</strong></th>
		<th width="33%" align="left"><strong>NAMA BARANG</strong></th>
		<th width="10%" align="left"><strong>MEREK</strong></th>
		<th width="5%"><strong>STOK</strong></th>
		<th width="4%"><strong>MIN</strong></th>
		<th width="7%" align="left"><strong>SATUAN</strong></th>
		<?php
		if ($data!=0){
			foreach($data as $row){	  	
		?>
		<tr>
		<td width="2%" align="center"><?php echo $c=$c+1;?></td>
		<td width="6%"><?php echo $row['barcode']; ?></td>
		<td width="25%"><?php echo $dtkategori->getField('kategori',$row['kategori']); ?></td>
		<td width="33%"><?php echo $row['nama']; ?></td>
		<td width="10%"><?php echo $dtmerek->getField('merek',$row['merek']); ?></td>
		<td width="5%" align="center"><?php echo $row['stok']; ?></td>
		<td width="4%" align="center"><?php echo $row['minstok']; ?></td>
		<td width="7%"><?php echo $dtsatuan->getField('satuan',$row['satuan']); ?></td>
	  </tr>
	  <?php
			}
		}	  
	  ?>
	</table>
<div id="menu">
  <a onclick="window.print();"><img src="../../img/print.png"></a>
</div>	
