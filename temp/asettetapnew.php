<?php
session_start();
include "../lib/lib.php";
include "../class/user.cls.php";
include "../class/asettetap.cls.php";
include "../class/dtkategori.cls.php";
include "../class/dtmerek.cls.php";
$db=new Db();
$db->conDb();
$link='?p='.encrypt_url('asettetap');
$linkdata='page/asettetapdata.php';
$aset=new Asettetap();
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$id=$_GET['id'];
if(!isset($id)){
	$val='Simpan';
	$btn='addKlas();';
}else{
	$val='Ubah';
	$btn='editKlas();';
}
?>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
	$(document).ready(function(){
		$('#btn').click(function(){
			$('#MyForm').submit();
		});
	});
</script>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">REGISTRASI ASET INVENTARIS </h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
		<div id="thick-frm">
			<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data" id="MyForm">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
					<tr>
						<td width="189" class="frm">Kode Aset </td>
						<td width="324" class="frm">
							<input style="width:100%;" type="text" name="kode" id="kode" value="<?php echo $aset->getField('kode',$id); ?>" /></td>
					</tr>
					<tr>
						<td width="189" class="frm">Kategori Aset </td>
						<td width="324" class="frm"><select name="kategori" style="width:100%;">
                          <option value="<?php echo $idkat=$aset->getField('kategori',$id); ?>" selected="selected"> <?php echo $dtkategori->getField('kategori',$idkat); ?> </option>
                          <?php
									$kat=$dtkategori->getAll();
									foreach($kat as $row){
										echo "<option value='".$row['id']."'>".$row['kategori']."</option>";
									}
								?>
                        </select></td>
					</tr>
					<tr>
						<td width="189" class="frm">Merek Barang </td>
						<td width="324" class="frm">
						<select name="merek" style="width:100%;">
							<option value="<?php echo $idmer=$aset->getField('merek',$id); ?>" selected="selected"><?php echo $dtmerek->getField('merek',$idmer); ?></option>
							<?php
							$merek=$dtmerek->getAll();
							foreach($merek as $row){
								echo "<option value='".$row['id']."'>".$row['merek']."</option>";
							}
							?>
						</select>						</td>
					</tr>
					<tr>
						<td width="189" class="frm">Nama Barang </td>
						<td width="324" class="frm"><input style="width:100%;" type="text" name="nama" id="nama" width="95%" value="<?php echo $aset->getField('nama',$id); ?>" />						</td>
					</tr>
					<tr>
						<td width="189" class="frm">Type Barang </td>
						<td width="324" class="frm">
						<input style="width:100%;" type="text" name="type" id="type" value="<?php echo $aset->getField('type',$id); ?>">						</td>
					</tr>
					<tr>
						<td width="189" class="frm">Ukuran Barang </td>
						<td width="324" class="frm">
						<input style="width:100%;" type="text" name="ukuran" id="ukuran" value="<?php echo $aset->getField('ukuran',$id); ?>">						</td>
					</tr>
					<tr>
						<td width="189" class="frm">Bahan</td>
						<td width="324" class="frm">
						<input style="width:100%;" type="text" name="bahan" id="bahan"  value="<?php echo $aset->getField('bahan',$id); ?>">						</td>
								</tr>
								<tr>
								  <td width="189" class="frm">Tahun pemebelian</td>
								  <td width="324" class="frm"><input style="width:100%;" type="text" name="tahun_beli" id="tahun_beli"  value="<?php echo $aset->getField('tahun_beli',$id); ?>">								  </td>
								</tr>
								<tr>
								  <td width="189" class="frm">Asal Usul Perolehan</td>
								  <td width="324" class="frm"><input style="width:100%;" type="text" name="perolehan" id="perolehan" value="<?php echo $aset->getField('perolehan',$id); ?>"></td>
								</tr>
								<tr>
								  <td width="189" class="frm">Nilai Aset </td>
								  <td width="324" class="frm"><input style="width:100%;" type="text" name="harga" id="harga"  value="<?php echo $aset->getField('harga',$id); ?>"></td>
								</tr>
					<tr>
						<td width="189" class="frm">Keterangan</td>
						<td width="324" class="frm"><input style="width:100%;" type="text" name="keterangan" id="keterangan" value="<?php echo $aset->getField('keterangan',$id); ?>"></td>
					</tr>
					<tr>
						<td><span class="frm">No. Pabrik</span></td>
						<td>
							<input style="width:100%;" type="text" name="no_pabrik" id="no_pabrik" value="<?php echo $aset->getField('no_pabrik',$id); ?>">						</td>
					</tr>
					<tr>
						<td>No. Rangka</td>
						<td>
						<input style="width:100%;" type="text" name="no_rangka" id="no_rangka" value="<?php echo $aset->getField('no_rangka',$id); ?>" />						</td>
					</tr>
					<tr>
						<td width="119" class="frm">No. Mesin</td>
						<td width="222" class="frm">
						<input style="width:100%;" type="text" name="no_mesin" id="no_mesin" value="<?php echo $aset->getField('no_mesin',$id); ?>">						</td>
					</tr>
					<tr>
						<td width="119" class="frm">No. Polisi</td>
						<td width="222" class="frm">
						<input style="width:100%;" type="text" name="no_polisi" id="no_polisi" value="<?php echo $aset->getField('no_polisi',$id); ?>">						</td>
					</tr>
					<tr>
						<td width="119" class="frm">No. BPKB</td>
						<td width="222" class="frm">
						<input style="width:100%;" type="text" name="no_bpkb" id="no_bpkb" value="<?php echo $aset->getField('no_bpkb',$id); ?>">						</td>
					</tr>
					<tr>
						<td width="189" class="frm">Status Barang</td>
						<td width="324" class="frm">
						<select name="status" style="width:100%;">
							<option value="<?php echo $aset->getField('status',$id); ?>"><?php echo $aset->getField('status',$id); ?></option>
							<option value="AKTIF">AKTIF</option>
							<option value="ASET TDAK BERMANFAAT">ASET TDAK BERMANFAAT</option>
							<option value="HAPUS">HAPUS</option>
						</select>						</td>
					</tr>
					<tr>
						<td class="btn frm" colspan="5" align="right"><input type="hidden" name="btn" value="Simpan"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="thick-bottom">
	  <div id="thick-menu"><span class="btn frm">
	  <input type="button" name="btn" onclick="<?php echo $btn; ?>" id="btn" value="Simpan" />
	    </span></div>
	</div>
</div>