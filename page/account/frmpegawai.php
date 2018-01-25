<?php
$cari=$_GET['cari'];
if (isset($cari)){
	include "../lib/lib.php";
	include "../class/pegawai.cls.php";
	$db=new Db();
	$db->conDb();
	$peg=new Pegawai();
	$xb=$peg->getLike('nama',$cari);
	if($xb!=''){
		foreach($xb as $row){
			echo $row['nama'].", ".$row['id']."\n";
		}
	}
}else{
	include "class/golongan.cls.php";
	$jabatan=new Jabatan();
	$golongan=new Golongan();
	$link='?p='.encrypt_url('account');
	$ide=$_GET['ide'];
	$linkdata='page/account/pegawaidata.php';	
	if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
	?>
<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'btn',
			cache:false,
			success:function(data){
				$('#p-main').html(data);
			}
		});
	});
	$(document).ready(function(){ 
		$('#cari').keydown(function(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'btn=Cari&cari='+$('#cari').val(),
				cache:false,
				success:function(data){
					$('#p-main').html(data);
				}
			});
		});
	});
	$(document).ready(function(){ 
		$('#hapus').click(function(){
			$.ajax({
				type:'post',
				url:'<?php echo $link;?>&m=fpeg',
				data:'btn=Hapus&id='+$('#id').val()+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=fpeg';
				}
			});
		});
	});
	function viewDetail(id){
		window.location='<?php echo $link; ?>&m=fpeg&ide='+id;
	}
	function add(){
		window.location='<?php echo $link; ?>';
	}
	function prev_file(id){
		var prev=null;
		if (prev==null){
			prev=open('page/prev_file.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1100,height=1600');
		}
	}
</script>
	<div class="p-wrapper">
		<div class="content">
		<div style="clear:both; padding-top:30px;"></div>
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a href="<?php echo $link;?>&m=fpeg">(+) Data Pegawai</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
			<form method="post" action="<?php echo $link; ?>&m=fpeg" enctype="multipart/form-data">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
						<tr>
							<td width="163">User Login</td>
							<td width="249">
							<select name="user">
							  <option selected="selected" value="<?php echo $pegawai->getField('id',$ide); ?>">
							  <?php echo $user->getField('login_id',$pegawai->getField('id',$ide)); ?></option>
							  <?php
								$u=$user->getAll();
								foreach($u as $ur){
									echo "<option value='".$ur['id_user']."'>".$ur['login_id']."</option>";
								}
								?>
						  </select>				  
						  </td>
				  		  <td width="174">&nbsp;</td>
				  		  <td width="178">Pangkat/Golongan</td>
				  		  <td width="225">
						  <select style="width:100%;" name="pangkat_golongan">
						  	<?php if(isset($ide)){
						  	?>
							<option value="<?php echo $pegawai->getField('pangkat_golongan',$ide);?>" selected="selected"><?php echo $pegawai->getField('pangkat_golongan',$ide);?></option>
							<?php
							}
							?>
						  	<?php 
							$dp=$pangkat->getAll();
							foreach($dp as $rp){
							?>
								<option value="<?php echo $rp['id'];?>"><?php echo $rp['id'];?></option>
							<?php
							}
							?>
						  </select>
						  </td>
						</tr>
						<tr>
							<td>Nama pegawai </td>
							<td><input style="width:100%;" type="text" name="nama" id="nama" value="<?php echo $pegawai->getField('nama',$ide); ?>" /></td>
				  		  <td>&nbsp;</td>
				  		  <td>Jabatan</td>
				  		  <td>
						  <select style="width:100%;" name="jabatan">
						  	<?php if(isset($ide)){
						  	?>
							<option value="<?php echo $pegawai->getField('jabatan',$ide);?>" selected="selected"><?php echo $pegawai->getField('jabatan',$ide);?></option>
							<?php
							}
							?>
						  	<?php 
							$dj=$jabatan->getAll();
							foreach($dj as $rj){
							?>
								<option value="<?php echo $rj['id'];?>"><?php echo $rj['id'];?></option>
							<?php
							}
							?>
						  </select>
						  </td>
						  </tr>
						  <tr>
							<td width="163">NIP</td>
							<td width="249">
							  <input style="width:100%;" type="hidden" name="id" id="id" value="<?php echo $ide; ?>">
						    <input style="width:100%;" type="text" name="nip" id="nip" value="<?php echo $pegawai->getField('nip',$ide); ?>" />						</td>
				  		  <td>&nbsp;</td>
				  		  <td>Sub</td>
				  		  <td>
						  <select style="width:100%;" name="bagian">
						  	<?php if(isset($ide)){
						  	?>
							<option value="<?php echo $pegawai->getField('bagian',$ide);?>" selected="selected"><?php echo $pegawai->getField('bagian',$ide);?></option>
							<?php
							}
							?>
						  	<?php 
							$ds=$sub->getAll();
							foreach($ds as $rs){
							?>
								<option value="<?php echo $rs['id'];?>"><?php echo $rs['id'];?></option>
							<?php
							}
							?>
						  </select>
						  </td>
						  </tr>
						</table>
					<div id="p-main"></div>
					<div class="head_content" style="box-shadow:none;" >
					<input type="submit" name="btn"  value="<?php echo $btn; ?>" />
					<input type="button" name="hapus" id="hapus" value="Hapus" />
					</div>
			</form>
	</body>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id=$_POST['id'];
		switch ($_POST['btn']){
			case 'Simpan':
				$level=$user->getField('level',$_POST['user']);
				$userid=kdauto('pegawai','');
				$data=array('user'=>$_POST['user'],'nama'=>$_POST['nama'],'nip'=>$_POST['nip'],'pangkat_golongan'=>$_POST['pangkat_golongan'],'jabatan'=>$_POST['jabatan'],'bagian'=>$_POST['bagian'],'level'=>$level);
				$pegawai->addData($data);		
				header("location:$link&m=fpeg");	
			break;
			case 'Edit':
				$level=$user->getField('level',$_POST['user']);
				$data=array('user'=>$_POST['user'],'nama'=>$_POST['nama'],'nip'=>$_POST['nip'],'pangkat_golongan'=>$_POST['pangkat_golongan'],'jabatan'=>$_POST['jabatan'],'bagian'=>$_POST['bagian'],'level'=>$level);
				//print_r($data);
				$pegawai->updateData($id,$data);		
				header("location:$link&m=fpeg");	
			break;		
			case 'Hapus':
				$pegawai->delData($id);
				header("location:$link&m=fpeg");	
			break;		
		}
	}
}	
?>