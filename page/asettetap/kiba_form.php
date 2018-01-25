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
		<div class="page-top">
		<div id="label-form">
			<li class="fa fa-file-text">   <label>REGISTRASI KIB A</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		</div>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link;?>&m=fkiba">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			  <tr>
				<td width="18%"><label>Nama / Jenis Barang</label></td>
				<td width="31%">
				<input type="hidden" name="id" value="<?php echo $dtkiba->getField('id',$id);?>">
				<input type="text" name="nama" value="<?php echo $dtkiba->getField('nama',$id);?>">
				</td>
				<td width="4%">&nbsp;</td>
				<td width="18%"><label>Kondisi Barang</label></td>
				<td width="29%">
				<select name="kondisi" width="100%">
				  <option value="<?php echo $kondisi=$dtkiba->getField('kondisi',$id);?>" selected="selected"><?php switch($kondisi){ case 'B':echo 'BAIK';break;case 'KB':echo 'KURANG BAIK';break;case 'RB':echo 'RUSAK BERAT';break;};?></option>
				
				  <option value="B"><label>BAIK</label></option>
				  <option value="KB"><label>KURANG BAIK</label></option>
				  <option value="RB"><label>RUSAK BERAT</label></option>
				</select></td>
			  </tr>
			  <tr>
				<td><label>Kode</label></td>
				<td><input type="text" name="kode" value="<?php echo $dtkiba->getField('kode',$id);?>"></td>
				<td>&nbsp;</td>
				<td><label>No.Register</label></td>
				<td><input type="text" name="register" value="<?php echo $dtkiba->getField('register',$id);?>"></td>
			  </tr>
			  <tr>
				<td><label>Luas</label></td>
				<td><input type="text" name="luas" value="<?php echo $dtkiba->getField('luas',$id);?>"></td>
				<td>&nbsp;</td>
				<td><label>Tahun</label></td>
				<td><input type="text" name="tahun" value="<?php echo $dtkiba->getField('tahun',$id);?>"></td>
			  </tr>
			  <tr>
				<td><label>Letak / Alamat</label></td>
				<td><input type="text" name="alamat" value="<?php echo $dtkiba->getField('alamat',$id);?>" /></td>
				<td>&nbsp;</td>
				<td><label>No.Sertifikat</label></td>
				<td><input type="text" name="no_sertifikat" value="<?php echo $dtkiba->getField('no_sertifikat',$id);?>" /></td>
			  </tr>
			  <tr>
				<td><label>Hak</label></td>
				<td><input type="text" name="hak_sertifikat" value="<?php echo $dtkiba->getField('hak_sertifikat',$id);?>"></td>
				<td>&nbsp;</td>
				<td><label>Asal Usul</label></td>
				<td><input type="text" name="asalusul" value="<?php echo $dtkiba->getField('asalusul',$id);?>" /></td>
			  </tr>
			  <tr>
				<td><label>Tanggal Setifikat</label></td>
				<td><input type="text" name="tgl_sertifikat" value="<?php echo $dtkiba->getField('tgl_sertifikat',$id);?>"></td>
				<td>&nbsp;</td>
				<td><label>Keterangan</label></td>
				<td><input type="text" name="keterangan" value="<?php echo $dtkiba->getField('keterangan',$id);?>" /></td>
			  </tr>
			  <tr>
				<td><label>Penggunaan</label></td>
				<td><input type="text" name="penggunaan" value="<?php echo $dtkiba->getField('penggunaan',$id);?>"></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td><label>Harga / Nilai aset</label></td>
				<td><input type="text" name="harga" value="<?php echo $dtkiba->getField('harga',$id);?>"></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
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
		$data=array('id'=>kodebrg('dtkiba','KIBA'),'nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'luas'=>$_POST['luas'],'tahun'=>$_POST['tahun'],'alamat'=>$_POST['alamat'],'hak_sertifikat'=>$_POST['hak_sertifikat'],'tgl_sertifikat'=>$_POST['tgl_sertifikat'],'no_sertifikat'=>$_POST['no_sertifikat'],'penggunaan'=>$_POST['penggunaan'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'kondisi'=>$_POST['kondisi']);
		$dtkiba->addData($data);
		header("location:$link&m=fkiba");
	break;
	case 'Edit':
		$id=$_POST['id'];
		$data=array('nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'luas'=>$_POST['luas'],'tahun'=>$_POST['tahun'],'alamat'=>$_POST['alamat'],'hak_sertifikat'=>$_POST['hak_sertifikat'],'tgl_sertifikat'=>$_POST['tgl_sertifikat'],'no_sertifikat'=>$_POST['no_sertifikat'],'penggunaan'=>$_POST['penggunaan'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'kondisi'=>$_POST['kondisi'],'idkir'=>$_POST['idkir']);
		$dtkiba->updateData($id,$data);
		header("location:$link&m=repkiba");
	break;		
	case 'Hapus':
		$dtkiba->delData($id);
		header("location:$link&m=repkiba");	
	break;		
}
		}
		?>