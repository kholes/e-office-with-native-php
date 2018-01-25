<script>
	function ViewDetail(id){
		window.location='<?php echo $link; ?>&m=kiba_frm&act=edit&id='+id;
	}
	function historyA(id){
		window.location='<?php echo $link; ?>&m=rhis&id='+id;
	}
	function prnA(){
		var prnbarkode=null;
		if (prnbarkode==null){
			prnbarkode=open('page/asettetap/kiba_prn.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
	function prncodeA(){
		var pp = prompt("Masukan jumlah per-halaman, Maximum load 83 Code", "30");
		var prncode=null;
		if (prncode==null){
			prncode=open('page/asettetap/kiba_prn_barcode.php?pp='+pp,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h1 align="center">KARTU INVENTARIS BARANG (KIB) A </h1>
			<h2 align="center">TANAH</h2>
		</div>
		<div class="c10"></div>
		<div class="view-data">
<?php
$data=$dtkiba->getAll();
if($data!=array()){
?>
<div align="center">
<table width="99%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td rowspan="3" class="th">No.</td>
		<td rowspan="3" class="th">ID Barang</td>
		<td rowspan="3" class="th">Jenis / Nama Barang</td>
		<td colspan="2" class="th">Nomor</td>
		<td rowspan="3" class="th">Luas (M2)</td>
		<td rowspan="3" class="th">Tahun</td>
		<td rowspan="3" class="th">Letak / Alamat</td>
		<td colspan="3" class="th">Status Tanah</td>
		<td rowspan="3" class="th">Penggunaan</td>
		<td rowspan="3" class="th">Asal-usul</td>
		<td rowspan="3" class="th">Harga (Rp.)</td>
		<td rowspan="3" class="th">Keterangan</td> 
	</tr>
	<tr>
		<td rowspan="2" class="th">Kode Barang</td>
		<td rowspan="2" class="th">Register</td>
		<td rowspan="2" class="th">Hak</td>
		<td colspan="2" class="th">Sertifikat</td>
	</tr>
	<tr>
		<td class="th">Tanggal</td>
		<td class="th">Nomor</td>
	</tr>
	<?php 
	foreach($data as $row){
		switch($row['kondisi']){
			case 'B':
				$bgr='white';
			break;
			case 'KB':
				$bgr='#FF7800';
			break;
			case 'RB':
				$bgr='#E60C0C';
			break;
		}
	?>
	<tr onMouseOver="this.style.color='#ff0000';this.style.cursor='pointer'" onmouseout="this.style.color='#000';" onclick="ViewDetail('<?php echo $row['id'];?>');" bgcolor="<?php echo $bgr;?>">
		<td><?php echo $ca=$ca+1;?></td>
		<td><?php echo $row['id'];?></td>
		<td><?php echo $row['nama'];?></td>
		<td><?php echo $row['kode'];?></td>
		<td><?php echo $row['register'];?></td>
		<td><?php echo $row['luas'];?></td>
		<td><?php echo $row['tahun'];?></td>
		<td><?php echo $row['alamat'];?></td>
		<td><?php echo $row['hak_sertifikat'];?></td>
		<td><?php echo $row['tgl_sertifikat'];?></td>
		<td><?php echo $row['no_sertifikat'];?></td>
		<td><?php echo $row['penggunaan'];?></td>
		<td><?php echo $row['asalusul'];?></td>
		<td align="right"><?php echo format_angka($row['harga']);?></td>
		<td><?php echo $row['keterangan'];?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="13">T O T A L  N I L A I  A S E T</td>
		<td colspan="2" align="right"><?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>		
</table>
</div>
<div class="c10"></div>
<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
	<tr>
		<td width="17%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai intra comptable</td>
		<td width="12%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkiba->getTotal());?></td>
		<td width="44%" rowspan="2" align="center" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;"><?php echo terbilang($dtkiba->getTotal());?></td>
		<td width="15%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
		<td width="12%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>
	<tr>
		<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
		<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkiba->getTotal());?></td>
	</tr>
</table>
<?php
}
?>
</div>
<script>
	function setfocus(){$('#cari').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
<div class="head_content" style="box-shadow:none;" >
<input type="button" name="prn" id="prn" onClick="prnA();" value="Cetak">
<input type="button" name="prn" id="prn" onClick="prncodeA();" value="Cetak Barcode">
</div>
</div></div>
