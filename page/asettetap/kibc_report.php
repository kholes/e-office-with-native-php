<script>
	function ViewDetail(id){
		window.location='<?php echo $link; ?>&m=kibc_frm&act=edit&id='+id;
	}
	function historyC(id){
		window.location='<?php echo $link; ?>&m=rhis&id='+id;
	}
	function prnC(){
		var prnbarkode=null;
		if (prnbarkode==null){
			prnbarkode=open('page/asettetap/kibc_prn.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
	function prncodeC(){
		var pp = prompt("Masukan jumlah per-halaman, Maximum load 83 Code", "30");
			var prncode=null;
			if (prncode==null){
				prncode=open('page/asettetap/kibc_prn_barcode.php?pp='+pp,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
			}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h1 align="center">KARTU INVENTARIS BARANG (KIB) C </h1>
			<h2 align="center">GEDUNG DAN BANGUNAN</h2>
		</div>
		<div class="c10"></div>
		<div class="view-data">
			<?php
			$data=$dtkibc->getAll();
			if($data!=array()){
			?>
			<div align="center">
			<table width="99%" cellpadding="0" cellspacing="0" id="tbl">
				<tr>
					<td width="3%" rowspan="2" class="th">No.</td>
					<td width="6%" rowspan="2" class="th">ID.ASET</td>
					<td width="5%" rowspan="2" class="th">Jenis / Nama Barang</td>
					<td colspan="2" class="th">Nomor</td>
					<td width="5%" rowspan="2" class="th">KOND</td>
					<td colspan="2" class="th">KONS BANG</td>
					<td width="4%" rowspan="2" class="th">Luas lantai (M2) </td>
					<td width="20%" rowspan="2" class="th">LETAK/LOKASI</td>
					<td colspan="2" class="th">Dok Gedung </td>
					<td width="4%" rowspan="2" class="th">Luas (M2)</td>
					<td width="5%" rowspan="2" class="th">Status Tanah</td>
					<td width="4%" rowspan="2" class="th">Kode Tanah </td>
					<td width="4%" rowspan="2" class="th">Asal-usul</td>
					<td width="5%" rowspan="2" class="th">Harga (Rp.)</td>
					<td width="3%" rowspan="2" class="th">Ket.</td> 
				</tr>
				<tr>
					<td width="5%" class="th">Kode Barang</td>
					<td width="5%" class="th">Register</td>
					<td width="6%" class="th">Btingkat</td>
					<td width="5%" class="th">Beton</td>
					<td width="6%" class="th">Tanggal</td>
					<td width="5%" class="th">Nomor</td>
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
				<tr onMouseOver="this.style.color='#ff0000';this.style.cursor='pointer';" onmouseout="this.style.color='#000';" onclick="ViewDetail('<?php echo $row['id'];?>');" bgcolor="<?php echo $bgr;?>">
					<td><?php echo $cc=$cc+1;?></td>
					<td><?php echo $row['id'];?></td>
					<td><?php echo $row['nama'];?></td>
					<td><?php echo $row['kode'];?></td>
					<td><?php echo $row['register'];?></td>
					<td><?php echo $row['kondisi'];?></td>
					<td><?php echo $row['tingkat'];?></td>
					<td><?php echo $row['beton'];?></td>
					<td><?php echo $row['luas_lantai'];?></td>
					<td><?php echo $row['lokasi'];?></td>
					<td><?php echo tgl_eng_to_ind($row['tanggal']);?></td>
					<td><?php echo $row['nomor'];?></td>
					<td><?php echo $row['luas_tanah'];?></td>
					<td><?php echo $row['status_tanah'];?></td>
					<td><?php echo $row['kode_tanah'];?></td>
					<td><?php echo $row['asalusul'];?></td>
					<td><?php echo format_angka($row['harga']);?></td>
					<td><?php echo $row['keterangan'];?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="12">T O T A L  N I L A I  A S E T</td>
					<td colspan="6" align="right"><?php echo rupiah($dtkibc->getTotal());?></td>
				</tr>		
			</table>
			</div>
			<div class="c10"></div>
			<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
				<tr>
					<td width="17%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai intra comptable</td>
					<td width="12%" rowspan="2" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibc->getTotal());?></td>
					<td width="44%" rowspan="2" align="center" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;"><?php echo terbilang($dtkibc->getTotal());?></td>
					<td width="15%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
					<td width="12%" style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibc->getTotal());?></td>
				</tr>
				<tr>
					<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">Total nilai</td>
					<td style="background:#666; color:#fff; font-weight:bold; text-transform:uppercase;">: <?php echo rupiah($dtkibc->getTotal());?></td>
				</tr>
			</table>
		</div>
		<div class="head_content" style="box-shadow:none;" >
		<input type="button" name="prn" id="prn" onClick="prnC();" value="Cetak">
		<input type="button" name="prn" id="prn" onClick="prncodeC();" value="Cetak Barcode">
		</div>
		<?php
		}else{
			echo "<h3 align='center' style='color:red;border:1px solid red;padding:10px; margin:10px;'>Data masih kosong</h3>";
		}
		?>
	</div>
</div>
<script>
	function setfocus(){$('#cari').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
