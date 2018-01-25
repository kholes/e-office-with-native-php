<?php
include '../../lib/lib.php';
include '../../class/dtkibb.cls.php';
$db=new Db();
$db->conDb();
$dtkibb=new Dtkibb();
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<div style=" display:block; width:1000px; margin: auto;">
<?php
$mtgl=tgl_ind_to_eng($_GET['mtgl']);
$stgl=tgl_ind_to_eng($_GET['stgl']);
$kategori=$_GET['kategori'];
?>
	<h2 align="center">DATA PERAWATAN BARANG <?php echo $kategori;?></h2>
	<h3 align="center">Mulai tanggal : <?php echo getTanggal($mtgl); ?> s/d <?php echo getTanggal($stgl); ?></h3>
	<br />
	<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
			<td width="4%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">NO</td>
			<td width="7%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">ID BARANG</td>
			<td width="12%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">TANGGAL</td>
			<td width="15%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">JENIS</td>
			<td width="21%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">KETERANGAN</td>
			<td width="19%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">SPAREPART</td>
			<td width="7%" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">STATUS</td>
			<td width="15%" align="center" style="border:1px solid #333; background:#aaa; color:#fff; font-weight:bold;">BIAYA</td>
		<?php
		$sql=mysql_query("select dtperawatan.*,dtperawatanitem.* from dtperawatan,dtperawatanitem where dtperawatan.id=dtperawatanitem.idt and dtperawatan.kategori like '%$kategori%' and dtperawatanitem.tanggal between '$mtgl' and '$stgl' order by dtperawatan.tanggal");
		while($row=mysql_fetch_assoc($sql)){
		?>
		<tr>
			<td align="center" style="border:1px solid #333;"><?php echo $c=$c+1;?></td>
			<td style="border:1px solid #333;"><?php echo $row['id'];?></td>
			<td style="border:1px solid #333;"><?php echo getTanggal($row['tanggal']);?></td>
			<td style="border:1px solid #333;"><?php echo $row['jenis'];?></td>
			<td style="border:1px solid #333;"><?php echo $row['keterangan'];?></td>
			<td style="border:1px solid #333;"><?php echo $row['sparepart'];?></td>
			<td style="border:1px solid #333;"><?php switch($row['status']){case 'B':echo 'Baik';break;case 'KB':echo 'Kurang Baik';break;case 'RB':echo 'Rusak Berat';break;}?></td>
			<td align="right" style="border:1px solid #333;"><?php echo format_angka($row['harga']);?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="6">TOTAL BIAYA</td>
			<td align="right" colspan="2">
			<?php 
		$tsql=mysql_query("select sum(dtperawatanitem.harga) as total from dtperawatan,dtperawatanitem where dtperawatan.id=dtperawatanitem.idt and dtperawatan.kategori like '%$kategori%' and dtperawatan.tanggal between '$mtgl' and '$stgl' order by dtperawatan.tanggal");
			while($data=mysql_fetch_assoc($tsql)){
				echo rupiah($data['total']);
			}
			?>
			</td>
		</tr>		
	</table>
</div>
</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>