<?php
include '../../lib/lib.php';
include '../../class/dtkiba.cls.php';
include '../../class/dtkibb.cls.php';
include '../../class/dtkibc.cls.php';
include '../../class/dtkibe.cls.php';
$db=new Db();
$db->conDb();
$dtkiba=new Dtkiba();
$dtkibb=new Dtkibb();
$dtkibc=new Dtkibc();
$dtkibe=new Dtkibe();
$id=$_GET['id'];
$mtgl=tgl_ind_to_eng($_GET['mtgl']);
$stgl=tgl_ind_to_eng($_GET['stgl']);
$kategori=$_GET['kategori'];
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<div style=" display:block; width:1000px; margin: auto;">

<div style=" display:block; width:100%;">
  <h2 align="center">CATATAN TRANSAKSI PERAWATAN </h2>
	<h3 align="center">
	  <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo "TANAH DAN BANGUNAN";
					break;
					case 'KIBB':
						echo "PERALATAN DAN MESIN";
					break;
					case 'KIBC':
						echo "GEDUNG DAN BANGUNAN";
					break;
					case 'KIBE':
						echo "BUKU DAN LAINNYA";
					break;
				}
			?>
	</h3>
	<br /><br /><br />
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th width="19%" id="thick-th" align="left" style="border:none;">KODE BARANG </th>
			<th width="34%" id="thick-th" align="left" style="border:none;">: 
			<?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('kode',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('kode',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('kode',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('kode',$id);
					break;
				}
			?>
			</th>
			<th width="8%" id="thick-th" align="left" style="border:none;">&nbsp;</th>
			<th width="22%" id="thick-th" align="left" style="border:none;">THN.PEMBELIAN</th>
			<th width="17%" id="thick-th" align="left" style="border:none;">: 
			<?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('tahun',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('thn_beli',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('tanggal',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('thn_cetak',$id);
					break;
				}
			?>
			</th>
		</tr>
		<tr>
			<th width="19%" id="thick-th" align="left" style="border:none;">NAMA BARANG  </th>
			<th width="34%" id="thick-th" align="left" style="border:none;">: 
			  <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('nama',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('nama',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('nama',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('nama',$id);
					break;
				}
			?>			</th>
			<th width="8%" id="thick-th" align="left" style="border:none;">&nbsp;</th>
			<th width="22%" id="thick-th" align="left" style="border:none;">MEREK / TYPE / SPEK </th>
			<th width="17%" id="thick-th" align="left" style="border:none;">: 
		    <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('luas',$id)."(M2)";
					break;
					case 'KIBB':
						echo $dtkibb->getField('merek',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('luas_lantai',$id)."(M2)";
					break;
					case 'KIBE':
						echo $dtkibc->getField('judul',$id);
					break;
				}
			?></td>
		</tr>
	</table>
	<br>
	<?php
	if(!isset($_GET['bln'])){
		$param="dtperawatan where id_barang='$id'";
	}else{
		$tgl=$_GET['thn'].'-'.$_GET['bln'];
		$param="dtperawatan where id_barang='$id' and tanggal like '%$tgl%'";
	}
	$sql=mysql_query("select * from $param");
	$tsql=mysql_query("select sum(harga) as total from $param");
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
			<th width="3%" id="thick-th">NO</th>
			<th width="12%" id="thick-th" align="left">TANGGAL</th>
			<th width="21%" id="thick-th" align="left">JENIS</th>
			<th width="31%" id="thick-th" align="left">KETERANGAN</th>
			<th width="16%" id="thick-th" align="left">SPAREPART</th>
			<th width="6%" id="thick-th" align="left">STATUS</th>
			<th width="11%" align="right" id="thick-th">BIAYA</th>
		<?php
		while($row=mysql_fetch_assoc($sql)){
		?>
		<tr>
			<td align="center"><?php echo $c=$c+1;?></td>
			<td><?php echo getTanggal($row['tanggal']);?></td>
			<td><?php echo $row['jenis'];?></td>
			<td><?php echo $row['keterangan'];?></td>
			<td><?php echo $row['sparepart'];?></td>
			<td><?php echo $row['status'];?></td>
			<td align="right"><?php echo format_angka($row['harga']);?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="6">TOTAL BIAYA</td>
			<td align="right">
			<?php 
			while($data=mysql_fetch_assoc($tsql)){
				echo rupiah($data['total']);
			}
			?>
			</td>
		</tr>		
	</table>
	<div class="c10"></div>
	<div id="head"></div>
</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>