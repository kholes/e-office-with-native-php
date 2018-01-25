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
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>KIB E</a></li>
			<li class="active"><?php echo $val;?></li>
		</ul>
	</h3>
	<div class="c10"></div>
	<form method="post" action="<?php echo $link;?>&m=fkibe">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
		  <tr>
			<td width="17%"><label>Nama / Jenis Barang</label></td>
			<td width="36%">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="text" name="nama" value="<?php echo $dtkibe->getField('nama',$id);?>">
			</td>
			<td width="3%">&nbsp;</td>
			<td width="17%"><label>Kondisi Barang</label></td>
			<td width="27%">
			<select name="kondisi">
			  <option value="<?php echo $kondisi=$dtkibe->getField('kondisi',$id);?>" selected="selected"><?php switch($kondisi){ case 'B':echo 'BAIK';break;case 'KB':echo 'KURANG BAIK';break;case 'RB':echo 'RUSAK BERAT';break;};?></option>
			
			  <option value="B">BAIK</option>
			  <option value="KB">KURANG BAIK</option>
			  <option value="RB">RUSAK BERAT</option>
			</select>		
			</td>
		  </tr>
		  <tr>
			<td><label>Kode Barang</label></td>
			<td><input type="text" name="kode" value="<?php echo $dtkibe->getField('kode',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>No.Register</label></td>
			<td><input type="text" name="register" value="<?php echo $dtkibe->getField('register',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Judul Buku</label></td>
			<td><input type="text" name="judul" value="<?php echo $dtkibe->getField('judul',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Spesifikasi</label></td>
			<td><input type="text" name="spesifikasi" value="<?php echo $dtkibe->getField('spesifikasi',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Asal Daerah</label></td>
			<td><input type="text" name="daerah" value="<?php echo $dtkibe->getField('daerah',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Pencipta</label></td>
			<td><input type="text" name="pencipta" value="<?php echo $dtkibe->getField('pencipta',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Bahan</label></td>
			<td><input type="text" name="bahan" value="<?php echo $dtkibe->getField('bahan',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Jenis Buku</label></td>
			<td><input type="text" name="jenis" value="<?php echo $dtkibe->getField('jenis',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Ukuran</label></td>
			<td><input type="text" name="ukuran" value="<?php echo $dtkibe->getField('ukuran',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Renovasi</label></td>
			<td><input type="text" name="renovasi" value="<?php echo $dtkibe->getField('renovasi',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Jumlah</label></td>
			<td><input type="text" name="jumlah" value="<?php echo $dtkibe->getField('jumlah',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Tahun Cetak /Beli</label></td>
			<td><input type="text" name="thn_cetak" value="<?php echo $dtkibe->getField('thn_cetak',$id);?>"></td>
		  </tr>
		  <tr>
			<td><label>Asal usul</label></td>
			<td><input type="text" name="asalusul" value="<?php echo $dtkibe->getField('asalusul',$id);?>"></td>
			<td>&nbsp;</td>
			<td><label>Keterangan</label></td>
			<td><input type="text" name="keterangan" value="<?php echo $dtkibe->getField('keterangan',$id);?>" /></td>
		  </tr>
		  <tr>
			<td><label>Harga</label></td>
			<td><input type="text" name="harga" value="<?php echo $dtkibe->getField('harga',$id);?>"></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>
		<div class="head_content" style="box-shadow:none;" >
			<input type="submit" name="btn" value="<?php echo $btn;?>">
			<input type="submit" name="btn" value="Hapus">
			&nbsp;
			<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
		</div>
	</form>
	</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Registrasi':
			$data=array('id'=>kodebrg('dtkibe','KIBE'),'nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'kondisi'=>$_POST['kondisi'],'register'=>$_POST['register'],'judul'=>$_POST['judul'],'spesifikasi'=>$_POST['spesifikasi'],'daerah'=>$_POST['daerah'],'pencipta'=>$_POST['pencipta'],'bahan'=>$_POST['bahan'],'jenis'=>$_POST['jenis'],'ukuran'=>$_POST['ukuran'],'renovasi'=>$_POST['renovasi'],'jumlah'=>$_POST['jumlah'],'thn_cetak'=>$_POST['thn_cetak'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan']);
			$dtkibe->addData($data);
			//print_r($data);
			header("location:$link&m=fkibe");
		break;
		case 'Edit':
			$data=array('nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'kondisi'=>$_POST['kondisi'],'register'=>$_POST['register'],'judul'=>$_POST['judul'],'spesifikasi'=>$_POST['spesifikasi'],'daerah'=>$_POST['daerah'],'pencipta'=>$_POST['pencipta'],'bahan'=>$_POST['bahan'],'jenis'=>$_POST['jenis'],'ukuran'=>$_POST['ukuran'],'renovasi'=>$_POST['renovasi'],'jumlah'=>$_POST['jumlah'],'thn_cetak'=>$_POST['thn_cetak'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan']);
			$dtkibe->updateData($id,$data);		
			header("location:$link&m=repkibe");	
		break;		
		case 'Hapus':
			$dtkibe->delData($id);
			header("location:$link&m=repkibe");	
		break;		
	}
}
?>
