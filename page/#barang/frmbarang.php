<?php
$act=$_GET['act'];
if(isset($act)){
	$ide=$act;
	$id_barang=$act;
	$btn='Edit';
	$barcode=$dtbarang->getField('barcode',$ide);
	$nama=$dtbarang->getField('nama',$ide);
	$kategori=$dtbarang->getField('kategori',$ide);
	$merek=$dtbarang->getField('merek',$ide);
	$satuan=$dtbarang->getField('satuan',$ide);
	$stok=$dtbarang->getField('stok',$ide);
	$minstok=$dtbarang->getField('minstok',$ide);
}else{
	$btn='Simpan';
	$id_barang=kodebrg('dtbarang','KPHB');
}
?>
<script>
$(document).ready(function(){
	$('#tombol').click(function(){
		$('#MyForm').submit();
	});
	$('#hapus').click(function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo $link;?>&m=fbrg',
			data: 'btn=Hapus&id=<?php echo $ide;?>',
			cache: false,
			success: function(res){
				alert(res);
			}
		});		
	});
});
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>BARANG</a></li>
				<li class="active">REGISTRASI</li>
			</ul>
		</h3>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link; ?>&m=fbrg" enctype="multipart/form-data" id="MyForm">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
			  <td width="192"><label>ID Barang</label></td>
			  <td width="270"><input type="text" name="id" id="id" value="<?php echo $id_barang; ?>" readonly="" />      </td>
			  <td width="463">&nbsp;</td>
			</tr>
			<tr>
			  <td width="192"><label>Kode Batang </label></td>
			  <td width="270"><input type="text" name="barcode" id="barcode" value="<?php echo $barcode; ?>" onchange="getData();" />      </td>
			  <td width="463"><em>*/Kosongkan jika tidak ada kode barcode</em></td>
			</tr>
			<tr>
			  <td width="192"><label>Kategori Barang</label></td>
			  <td width="270"><select name="kategori" id="kategori">
				  <option value="<?php echo $kategori; ?>" selected="selected"> <?php echo $dtkategori->getField('kategori',$kategori); ?> </option>
				  <?php
									$kat=$dtkategori->getAll();
									foreach($kat as $row){
									echo "<option value='".$row['id']."'>".$row['kategori']."</option>";
									}
									?>
				</select>      </td>
			</tr>
			<tr>
			  <td width="192"><label>Merek</label></td>
			  <td width="270"><select name="merek">
				  <option value="<?php echo $merek; ?>" selected="selected"> <?php echo $dtmerek->getField('merek',$merek); ?> </option>
				  <?php
									$mrk=$dtmerek->getAll();
									foreach($mrk as $row){
									echo "<option value='".$row['id']."'>".$row['merek']."</option>";
									}
									?>
				</select>      </td>
			</tr>
			<tr>
			  <td width="192"><label>Nama Barang</label></td>
			  <td width="270"><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" />      </td>
			</tr>
			<tr>
			  <td width="192"><label>Satuan</label></td>
			  <td width="270"><select name="satuan">
				  <option value="<?php echo $satuan; ?>" selected="selected"> <?php echo $dtsatuan->getField('satuan',$satuan); ?> </option>
				  <?php
									$sat=$dtsatuan->getAll();
									foreach($sat as $row){
									echo "<option value='".$row['id']."'>".$row['satuan']."</option>";
									}
									?>
				</select>      </td>
			</tr>
			<tr>
			  <td width="192"><label>Stok Awal</label></td>
			  <td width="270"><input type="text" name="stok" id="stok" value="<?php echo $stok; ?>"  />      </td>
			</tr>
			<tr>
			  <td width="192"><label>Min-stok</label></td>
			  <td width="270"><input type="text" name="minstok" id="minstok" value="<?php echo $minstok; ?>"  />      </td>
			</tr>
  		</table>
			<div class="head_content" style="box-shadow:none;" >
<input type="hidden" name="btn" id="btn" value="<?php echo $btn; ?>" />
				  <input type="button" name="batal" id="batal" value="Kembali" onclick="self.history.back();" style="float:right" />
			  <input type="button" name="tombol" id="tombol" value="<?php echo $btn; ?>" />			</div>
		</form>
	</div>
</div>
<script>
	$('#barcode').keydown(function(e){
		if (e.keyCode==13){
			$('#nama').focus();
		}
	});
	$('#nama').keydown(function(e){
		if (e.keyCode==13){
			if($('#nama').val()==''){
				alert('Nama barang tidak boleh kosong');
				return;
			}else{
				$('#kategori').focus();
			}
		}
	});
	$('#kategori').keydown(function(e){
		if (e.keyCode==13){
			$('#merek').focus();
		}
	});
	$('#merek').keydown(function(e){
		if (e.keyCode==13){
			$('#satuan').focus();
		}
	});
	$('#satuan').keydown(function(e){
		if (e.keyCode==13){
			$('#stok').focus();
		}
	});
	$('#stok').keydown(function(e){
		if (e.keyCode==13){
			if($('#stok').val()==''){
				$('#stok').val('0');
				$('#minstok').focus();
			}else{
				$('#minstok').focus();
			}
		}
	});
	$('#minstok').keydown(function(e){
		if (e.keyCode==13){
			if($('#minstok').val()==''){
				$('#minstok').val('0');
				$('#frmBarang').submit();
			}else{
				$('#frmBarang').submit();
			}
		}
	});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Simpan':
			$data=array('id'=>$_POST['id'],'barcode'=>$_POST['barcode'],'kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'merek'=>$_POST['merek'],'satuan'=>$_POST['satuan'],'stok'=>$_POST['stok'],'minstok'=>$_POST['minstok']);
			$dtbarang->addData($data);		
			header("location:$link&m=fbrg");
		break;
		case 'Edit':
			$data=array('id'=>$_POST['id'],'barcode'=>$_POST['barcode'],'kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'merek'=>$_POST['merek'],'satuan'=>$_POST['satuan'],'stok'=>$_POST['stok'],'minstok'=>$_POST['minstok']);
			$dtbarang->updateData($id,$data);		
			header("location:$link&m=dtbrg");
		break;		
		case 'Hapus':
			$dtbarang->delData($act);
			header("location:$link&m=dtbrg");
		break;		
	}
}
?>