<?php
$id=$_GET['id'];
$act=$_GET['act'];
if(isset($act)){
	switch($act){
		case 'edit':
			$btn='Edit';
			$val='EDIT';
		break;
	}
}else{
	$btn='Registrasi';
	$val='REGISTRASI';
}
?>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-file-text">   <label>REGISTRASI KIB B</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
	<div class="c10"></div>
<form method="post" action="<?php echo $link;?>&m=fkibb">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
	  <tr>
		<td width="19%"><label>Nama / Jenis Barang</label></td>
		<td width="32%">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="text" name="nama" value="<?php echo $dtkibb->getField('nama',$id);?>">
		</td>
		<td width="4%">&nbsp;</td>
		<td width="14%"><label>Kondisi Barang</label></td>
		<td width="31%">
		<select name="kondisi">
          <option value="<?php echo $kondisi=$dtkibb->getField('kondisi',$id);?>" selected="selected"><?php switch($kondisi){ case 'B':echo 'BAIK';break;case 'KB':echo 'KURANG BAIK';break;case 'RB':echo 'RUSAK BERAT';break;};?></option>
		
          <option value="B"><label>BAIK</label></option>
          <option value="KB"><label>KURANG BAIK</label></option>
          <option value="RB"><label>RUSAK BERAT</label></option>
        </select>		
		</td>
	  </tr>
	  <tr>
		<td><label>Kode Barang</label></td>
		<td><input type="text" name="kode" value="<?php echo $dtkibb->getField('kode',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>No.Register</label></td>
		<td><input type="text" name="register" value="<?php echo $dtkibb->getField('register',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>Merek / Type</label></td>
		<td><input type="text" name="merek" value="<?php echo $dtkibb->getField('merek',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Ukuran</label></td>
		<td><input type="text" name="ukuran" value="<?php echo $dtkibb->getField('ukuran',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>Bahan</label></td>
		<td><input type="text" name="bahan" value="<?php echo $dtkibb->getField('bahan',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Tahun Beli</label></td>
		<td><input type="text" name="thn_beli" value="<?php echo $dtkibb->getField('thn_beli',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>No. Pabrik</label></td>
		<td><input type="text" name="no_pabrik" value="<?php echo $dtkibb->getField('no_pabrik',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>No. Ranggka</label></td>
		<td><input type="text" name="no_rangka" value="<?php echo $dtkibb->getField('no_rangka',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>No. Mesin</label></td>
		<td><input type="text" name="no_mesin" value="<?php echo $dtkibb->getField('no_mesin',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>No. Polisi</label></td>
		<td><input type="text" name="no_polisi" value="<?php echo $dtkibb->getField('no_polisi',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>No. BPKB</label></td>
		<td><input type="text" name="no_bpkb" value="<?php echo $dtkibb->getField('no_bpkb',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Asal Usul</label></td>
		<td><input type="text" name="asalusul" value="<?php echo $dtkibb->getField('asalusul',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>Harga</label></td>
		<td><input type="text" name="harga" value="<?php echo $dtkibb->getField('harga',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Keterangan</label></td>
		<td><input type="text" name="keterangan" value="<?php echo $dtkibb->getField('keterangan',$id);?>"></td>
	  </tr>
	</table>
	  <div class="head_content" style="box-shadow:none;" >
				<input type="submit" name="btn" value="<?php echo $btn;?>">
				<input type="submit" name="btn" value="Hapus">
		  &nbsp;</div>
	  </form>
	</div>
</div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Registrasi':
			$data=array('id'=>kodebrg('dtkibb','KIBB'),'nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'merek'=>$_POST['merek'],'ukuran'=>$_POST['ukuran'],'bahan'=>$_POST['bahan'],'thn_beli'=>$_POST['thn_beli'],'no_pabrik'=>$_POST['no_pabrik'],'no_rangka'=>$_POST['no_rangka'],'no_mesin'=>$_POST['no_mesin'],'no_polisi'=>$_POST['no_polisi'],'no_bpkb'=>$_POST['no_bpkb'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'kondisi'=>$_POST['kondisi']);
			$dtkibb->addData($data);
			header("location:$link&m=fkibb");
		break;
		case 'Edit':
			$id=$_POST['id'];
			$data=array('nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'merek'=>$_POST['merek'],'ukuran'=>$_POST['ukuran'],'bahan'=>$_POST['bahan'],'thn_beli'=>$_POST['thn_beli'],'no_pabrik'=>$_POST['no_pabrik'],'no_rangka'=>$_POST['no_rangka'],'no_mesin'=>$_POST['no_mesin'],'no_polisi'=>$_POST['no_polisi'],'no_bpkb'=>$_POST['no_bpkb'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'kondisi'=>$_POST['kondisi']);
			$dtkibb->updateData($id,$data);	
			header("location:$link&m=repkibb");	
		break;		
		case 'Hapus':
			$dtkibb->delData($id);
			header("location:$link&m=repkibb");	
		break;		
	}
}
?>
