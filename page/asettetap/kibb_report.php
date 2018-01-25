<?php
$id=$_GET['id'];
?>
<script>
	function ViewDetail(id){
		window.location='<?php echo $link; ?>&m=kibb_frm&act=edit&id='+id;
	}
	function historyB(id){
		window.location='<?php echo $link; ?>&m=rhis&id='+id;
	}
	function prnB(){
		var prnbarkode=null;
		if (prnbarkode==null){
			prnbarkode=open('page/asettetap/kibb_prn.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1247,height=600');
		}
	}
	function prncodeB(){
		var pp = prompt("Masukan jumlah per-halaman, Maximum load 83 Code", "30");
		var prncode=null;
		if (prncode==null){
			prncode=open('page/asettetap/kibb_prn_barcode.php?pp='+pp,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h1 align="center">KARTU INVENTARIS BARANG (KIB) B </h1>
			<h2 align="center">PERALATAN DAN MESIN</h2>
		</div>
		<div class="c10"></div>
		<div class="view-data">
		<?php
		$data=$dtkibb->getAll();
		if($data!=array()){
		?>
		<div align="center">
		<table width="99%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="2%" rowspan="2" class="th">No</td>
				<td width="5%" rowspan="2" class="th">ID Barang</td>
				<td width="14%" rowspan="2" class="th">Jenis Barang/Nama Barang</td>
				<td width="3%" rowspan="2" class="th">No.  Reg </td>
				<td width="16%" rowspan="2" class="th">Merek/Type</td>
				<td width="5%" rowspan="2" class="th">Ukuran / cc</td>
				<td width="4%" rowspan="2" class="th">Bahan</td>
				<td width="4%" rowspan="2" class="th">Thn .Beli</td>
				<td colspan="5" class="th" align="center">Nomor</td>
				<td width="7%" rowspan="2" class="th">Asal-usul Cara perolehan</td>
				<td width="7%" rowspan="2" class="th">Harga (Rp)</td>
				<td width="9%" rowspan="2" class="th">Ket.</td>
			</tr>
			<tr>
				<td width="4%" class="th">Pabrik</td>
				<td width="6%" class="th">Rangka</td>
				<td width="5%" class="th">Mesin</td>
				<td width="4%" class="th">Polisi</td>
				<td width="5%" class="th">BPKB</td>
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
				<td><?php echo $cb=$cb+1;?></td>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['nama'];?></td>
				<td><?php echo $row['register'];?></td>
				<td><?php echo $row['merek'];?></td>
				<td><?php echo $row['ukuran'];?></td>
				<td><?php echo $row['bahan'];?></td>
				<td><?php echo $row['thn_beli'];?></td>
				<td><?php echo $row['no_pabrik'];?></td>
				<td><?php echo $row['no_rangka'];?></td>
				<td><?php echo $row['no_mesin'];?></td>
				<td><?php echo $row['no_polisi'];?></td>
				<td><?php echo $row['no_bpkb'];?></td>
				<td><?php echo $row['asalusul'];?></td>
				<td align="right"><?php echo format_angka($row['harga']);?></td>
				<td><?php echo $row['keterangan'];?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="14">T O T A L  N I L A I  A S E T</td>
				<td colspan="2"><?php echo rupiah($dtkibb->getTotal());?></td>
			</tr>		
		</table>
		</div>
		<div class="c10"></div>
		<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
			<tr>
				<td width="17%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai Intra comptable</td>
				<td width="12%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibb->getTotal());?></td>
				<td width="44%" rowspan="2" align="center" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;"><?php echo terbilang($dtkibb->getTotal());?></td>
				<td width="15%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
				<td width="12%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibb->getTotal());?></td>
			</tr>
			<tr>
				<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
				<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibb->getTotal());?></td>
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
		<input type="button" name="prn" id="prn" onClick="prnB();" value="Cetak">
		<input type="button" name="prn" id="prn" onClick="prncodeB();" value="Cetak Barcode">
	</div>
</div>
