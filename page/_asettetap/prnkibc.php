<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtkibc.cls.php';
$db=new Db();
$db->conDb();
$dtkibc=new Dtkibc();
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
<h1 align="center">KARTU INVENTARIS BARANG (KIB) C </h1>
<h2 align="center">GEDUNG DAN BANGUNAN </h2>
<br />
<div class="c10"></div>
<br />
<?php
$data=$dtkibc->getAll();
if($data!=array()){
?>
<table width="1247" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="3%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">No.</td>
		<td width="5%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">ID Barang</td>
		<td width="4%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kode</td>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Jenis Barang/Nama Barang</td>
		<td width="8%" colspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
		<td width="10%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kondisi</td>
		<td width="5%" colspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kons.Bang</td>
		<td width="3%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Luas Lantai(M2) </td>
		<td width="3%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Letak/Lokasi </td>
		<td colspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Dokumen Ged.</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Luas(M2)</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Status Tanah</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">No/Kode Tanah</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Asal- usul</td>
		<td width="6%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Harga (Rp)</td>
		<td width="8%" rowspan="2" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;">Ket. </td>
	</tr>
	<tr>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Kode Barang</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Reg</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Btingkat/Tdk</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Beton/Tdk</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Tanggal</td>
		<td width="5%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Nomor</td>
	</tr>
	<?php 
	$data=$dtkibc->getAll();
	foreach($data as $row){
	?>
	<tr>
		<td style="border:1px solid #333;"><?php echo $c=$c+1;?></td>
		<td style="border:1px solid #333;"><?php echo $row['id'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['nama'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['register'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kondisi'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['tingkat'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['beton'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['luas_lantai'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['lokasi'];?></td>
		<td style="border:1px solid #333;"><?php echo tgl_eng_to_ind($row['tanggal']);?></td>
		<td style="border:1px solid #333;"><?php echo $row['nomor'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['luas_tanah'];?></td>
		<td style="border:1px solid #333;" align="right"><?php echo $row['status_tanah'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['kode_tanah'];?></td>
		<td style="border:1px solid #333;"><?php echo $row['asalusul'];?></td>
		<td style="border:1px solid #333;"><?php echo format_angka($row['harga']);?></td>
		<td style="border:1px solid #333;"><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="14">T O T A L &nbsp;&nbsp;&nbsp;N I L A I &nbsp;&nbsp;&nbsp;A S E T</td>
		<td colspan="5" align="right"><?php echo rupiah($dtkibc->getTotal());?></td>
	</tr>		
</table>
<div class="c10"></div>
<table width="1247" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="17%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai Intra comptable</td>
		<td width="12%" rowspan="2" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibc->getTotal());?></td>
		<td width="44%" rowspan="2" colspan="3" align="center" style="border:1px solid #333; background:#aaa; font-weight:bold;"><?php echo terbilang($dtkibc->getTotal());?></td>
		<td width="15%" style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td width="12%" style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibc->getTotal());?></td>
	</tr>
	<tr>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">Total nilai</td>
		<td style="border:1px solid #333; background:#aaa; font-weight:bold;">: <?php echo rupiah($dtkibc->getTotal());?></td>
	</tr>
</table>
<?php
}
?>
</div>






</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>