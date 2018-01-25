<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtkibb.cls.php';
$db=new Db();
$db->conDb();
$dtkibb=new Dtkibb();
$encode="CODE128";
$height="50";
$scale="2";
$bgcolor="#FFFFFF";
$color="#000000";
$file="";
$type="PNG";
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css">


<div style=" display:block; width:1250px; margin: auto;">
<h1 align="center">KARTU INVENTARIS BARANG (KIB) B</h1>
<h2 align="center">PERALATAN DAN MESIN</h2>
<br />
<div class="c10"></div>
<br />
<?php
$data=$dtkibb->getAll();
if($data!=array()){
?>
<table width="1247" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="3%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">No.</td>
		<td width="5%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">ID Barang</td>
		<td width="4%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kode</td>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Jenis Barang/Nama Barang</td>
		<td width="8%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Merek/Type</td>
		<td width="10%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Ukuran/cc</td>
		<td width="5%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Bahan</td>
		<td width="3%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Thn .Beli</td>
		<td colspan="5" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Asal-usul Cara perolehan</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Harga (Rp)</td>
		<td width="8%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Ket. </td>
	</tr>
	<tr>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Pabrik</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Rangka</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Mesin</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Polisi</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">BPKB</td>
	</tr>
	<?php 
	$data=$dtkibb->getAll();
	foreach($data as $row){
	?>
	<tr>
		<td style="border:1px solid #333;"><?php echo $c=$c+1;?></td>
		<td style="border:1px solid #333;"><?php echo $row['id'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['nama'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['merek'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['ukuran'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['bahan'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['thn_beli'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_pabrik'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_rangka'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_mesin'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_polisi'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['no_bpkb'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['asalusul'];?></td>
		<td style="border:1px solid #333;" align="right"><?php echo format_angka($row['harga']);?></td>
		<td style="border:1px solid #333;"><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="14">T O T A L &nbsp;&nbsp;&nbsp;N I L A I &nbsp;&nbsp;&nbsp;A S E T</td>
		<td colspan="2"><?php echo rupiah($dtkibb->getTotal());?></td>
	</tr>		
</table>
<div class="c10"></div>
<table width="1247" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai Intra comptable</td>
		<td width="12%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibb->getTotal());?></td>
		<td width="44%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;"><?php echo terbilang($dtkibb->getTotal());?></td>
		<td width="15%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td width="12%" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibb->getTotal());?></td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibb->getTotal());?></td>
	</tr>
</table>
<?php
}
?>
</div>






</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>