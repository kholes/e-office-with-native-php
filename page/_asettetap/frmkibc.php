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
			<li><a>KIB C</a></li>
			<li class="active"><?php echo $val;?></li>
		</ul>
	</h3>
	<div class="c10"></div>
<form method="post" action="<?php echo $link;?>&m=fkibc">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
	  <tr>
		<td width="19%"><label>Nama / Jenis Barang</label></td>
		<td width="34%">
		<input type="hidden" name="id" value="<?php echo $dtkibc->getField('id',$id);?>">
		<input type="text" name="nama" value="<?php echo $dtkibc->getField('nama',$id);?>">		</td>
		<td width="3%">&nbsp;</td>
		<td width="16%"><label>Kode</label></td>
		<td width="28%">
		<input type="text" name="kode" value="<?php echo $dtkibc->getField('kode',$id);?>" /></td>
	  </tr>
	  <tr>
		<td><label>No.Register</label></td>
		<td><input type="text" name="register" value="<?php echo $dtkibc->getField('register',$id);?>" /></td>
		<td>&nbsp;</td>
		<td><label>Kondisi</label></td>
		<td><select name="kondisi">
          <option value="<?php echo $kondisi=$dtkibc->getField('kondisi',$id);?>" selected="selected">
            <?php switch($kondisi){ case 'B':echo 'BAIK';break;case 'KB':echo 'KURANG BAIK';break;case 'RB':echo 'RUSAK BERAT';break;};?>
          </option>
          <option value="B">BAIK</option>
          <option value="KB">KURANG BAIK</option>
          <option value="RB">RUSAK BERAT</option>
        </select></td>
	  </tr>
	  <tr>
		<td><label>Bertingkat</label></td>
		<td>
			<input type="radio" name="tingkat" value="Bertingkat" checked="checked" /> <label>Bertingkat</label>
			<input type="radio" name="tingkat" value="Tidak" /> <label>Tidak</label>
			</td>
		<td>&nbsp;</td>
		<td><label>Beton</label></td>
		<td>
			<input type="radio" name="beton" value="Beton" checked="checked" /><label>Beton</label>
			<input type="radio" name="beton" value="Tidak" /><label>Tidak</label></td>
	  </tr>
	  <tr>
		<td><label>Letak / Lokasi</label></td>
		<td><textarea name="lokasi"><?php echo $dtkibc->getField('lokasi',$id);?></textarea></td>
		<td>&nbsp;</td>
		<td><label>Luas bangunan (M2)</label></td>
		<td><input type="text" name="luas_lantai" value="<?php echo $dtkibc->getField('luas_lantai',$id);?>" /></td>
	  </tr>
	  <tr>
		<td><label>Tanggal</label></td>
		<td><span class="frm">
		  <input type="text" class="tgl" name="tanggal" id="tanggal" value="<?php echo tgl_eng_to_ind($dtkibc->getField('tanggal',$id));?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/>
		</span></td>
		<td>&nbsp;</td>
		<td><label>Nomor</label></td>
		<td><input type="text" name="nomor" value="<?php echo $dtkibc->getField('nomor',$id);?>" /></td>
	  </tr>
	  <tr>
		<td><label>Luas tanah (M2)</label></td>
		<td><input type="text" name="luas_tanah" value="<?php echo $dtkibc->getField('luas_tanah',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Status tanah</label></td>
		<td><input type="text" name="status_tanah" value="<?php echo $dtkibc->getField('status_tanah',$id);?>" /></td>
	  </tr>
	  <tr>
		<td><label>Kode tanah</label></td>
		<td><input type="text" name="kode_tanah" value="<?php echo $dtkibc->getField('kode_tanah',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Asal-usul</label></td>
		<td><input type="text" name="asalusul" value="<?php echo $dtkibc->getField('asalusul',$id);?>" /></td>
	  </tr>
	  <tr>
		<td><label>Harga</label></td>
		<td><input type="text" name="harga" value="<?php echo $dtkibc->getField('harga',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Keterangan</label></td>
		<td><input type="text" name="keterangan" value="<?php echo $dtkibc->getField('keterangan',$id);?>" /></td>
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
			$data=array('id'=>kodebrg('dtkibc','KIBC'),'nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'kondisi'=>$_POST['kondisi'],'tingkat'=>$_POST['tingkat'],'beton'=>$_POST['beton'],'lokasi'=>$_POST['lokasi'],'luas_lantai'=>$_POST['luas_lantai'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'nomor'=>$_POST['nomor'],'luas_tanah'=>$_POST['luas_tanah'],'status_tanah'=>$_POST['status_tanah'],'kode_tanah'=>$_POST['kode_tanah'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan']);
			$dtkibc->addData($data);
			header("location:$link&m=fkibc");
		break;
		case 'Edit':
			$id=$_POST['id'];
			$data=array('nama'=>$_POST['nama'],'kode'=>$_POST['kode'],'register'=>$_POST['register'],'kondisi'=>$_POST['kondisi'],'tingkat'=>$_POST['tingkat'],'beton'=>$_POST['beton'],'lokasi'=>$_POST['lokasi'],'luas_lantai'=>$_POST['luas_lantai'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'nomor'=>$_POST['nomor'],'luas_tanah'=>$_POST['luas_tanah'],'status_tanah'=>$_POST['status_tanah'],'kode_tanah'=>$_POST['kode_tanah'],'asalusul'=>$_POST['asalusul'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'idkir'=>$_POST['idkir']);
			$dtkibc->updateData($id,$data);
			header("location:$link&m=repkibc");
		break;		
		case 'Hapus':
			$dtkibc->delData($id);
			header("location:$link&m=repkibc");	
		break;		
	}
}
?>
