<?php
$themes=new Themes();
$link='?p='.encrypt_url('themes');
$idx=$_GET['ide'];
$ide=decrypt_url($idx);
if(isset($idx)){$btn='Edit';}else{$btn='Simpan';}
if(!isset($idx)){
	$nama = $themes->getField('nama',$thid);
	$wall = $themes->getField('wall',$thid);
	$head= $themes->getField('head',$thid);
	$button = $themes->getField('button',$thid);
	$form = $themes->getField('form',$thid);
	$th = $themes->getField('th',$thid);   // warna abu-abu
	$td1 = $themes->getField('td1',$thid);   // warna abu-abu
	$td2 = $themes->getField('td2',$thid);  // warna putih
}else{
	$nama = $themes->getField('nama',$ide);
	$wall = $themes->getField('wall',$ide);
	$head= $themes->getField('head',$ide);
	$button = $themes->getField('button',$ide);
	$form = $themes->getField('form',$ide);
	$th = $themes->getField('th',$ide);   // warna abu-abu
	$td1 = $themes->getField('td1',$ide);   // warna abu-abu
	$td2 = $themes->getField('td2',$ide);  // warna putih
}
?>
<script>
	function hapus(id){
		$.ajax({
			type:'post',
			url:'<?php echo $link; ?>',
			data:'btn=Hapus&id='+id+'',
			beforeSend: function(data){$("#load").fadeIn(1000,0).html('<img src="img/spinner.gif">Proses...')},	
			cache :false,
			success:function (data){
				$('#load').fadeOut('slow');
				location.reload();
				$('#inf').html(data);	
			}
		});
	}
</script>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head"><h3>THEMA SETTING  &raquo;</h3><a href="<?php echo $link; ?>"><img src="img/add.png"></a></div>
	<div class="p-wrapper">
			<div class="p-form">
				<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
					<table width="397" border="0" cellspacing="0" cellpadding="0">
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179">Nama Thema </td>
						<td width="218">
						<input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" /></td>
					  </tr>
					  <tr>
						<td width="179">Warna Latar</td>
						<td width="218">
						<input type="text" name="wall" value="<?php echo $wall; ?>" class="color">
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Latar Judul</td>
						<td width="218">
						<input type="text" name="head" value="<?php echo $head; ?>" class="color">
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Tombol</td>
						<td width="218">
						<input type="text" name="button" id="button" value="<?php echo $button; ?>" class="color" />
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Latar Form</td>
						<td width="218">
						<input type="text" name="form" id="form" value="<?php echo $form; ?>" class="color" />
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Latar Tabel Head</td>
						<td width="218">
						<input type="text" name="th" id="th" value="<?php echo $th; ?>" class="color" />
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Baris Tabel kolom 1</td>
						<td width="218">
						<input type="text" name="td1" id="td1" value="<?php echo $td1; ?>" class="color" />
						</td>
					  </tr>
					  <tr>
						<td width="179">Warna Baris Tabel kolom 2</td>
						<td width="218">
						<input type="text" name="td2" id="td2" value="<?php echo $td2; ?>" class="color" />
						</td>
					  </tr>
					  <tr>
						<td class="btn" colspan="2" ><input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" /></td>
					  </tr>
					</table>
				</form>
		</div>
	<div class="data-hed">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <th width="4%">No</th>
	  <th width="86%" align="left">Themes</th>
	  <th width="10%">&nbsp;</th>
	</table>
	</div>
	<div class="p-data">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <?php
	  $data=$themes->getAll();
	  if ($data!=0){
	  	foreach($data as $row){	  	
			if ($counter % 2 == 0)$warna = $warnaGenap; else $warna = $warnaGanjil;
	  ?>
	  <tr bgcolor="<?php echo $warna; ?>">
		<td align="center" width="4%"><?php echo $c=$c+1;?></td>
		<td width="86%"><?php echo $row['nama']; ?></td>
		<td align="right">
			<a class="edit" href="<?php echo $link; ?>&ide=<?php echo encrypt_url($row['id']);?>"><img src="img/edit.png" /></a>
			<a onClick="hapus('<?php echo $row['id'];?>');"><img src="img/hapus.png" /></a>
		</td>
	  </tr>
	  <?php
	  		$counter++;
	  	}
	  }	  
	  ?>
	</table>
	</div>
	<span id="load"></span>
	</div>
</body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$data=array('nama'=>$_POST['nama'],'wall'=>$_POST['wall'],'head'=>$_POST['head'],'form'=>$_POST['form'],'button'=>$_POST['button'],'th'=>$_POST['th'],'td1'=>$_POST['td1'],'td2'=>$_POST['td2']);
	switch ($_POST['btn']){
		case 'Simpan':
			$themes->addData($data);		
			header("location:$link");	
		break;
		case 'Edit':
			$themes->updateData($id,$data);		
			header("location:$link");	
		break;		
		case 'Hapus':
			$themes->delData($id);
			header("location:$link");	
		break;		
	}
}
?>