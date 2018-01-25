<?php
include "class/level.cls.php";
$level=new Level();
$linkdata='page/account/userdata.php';
$ide=$_GET['ide'];
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
?>
<script>
	function hapus(id){
		$.ajax({
			type:'post',
			url:'<?php echo $link; ?>&m=fuser',
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
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'btn',
			cache:false,
			success:function(data){
				$('#p-main').html(data);
				$('#user').focus();
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
				url:'<?php echo $link;?>&m=fuser',
				data:'btn=Hapus&id='+$('#id').val()+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=fuser';
				}
			});
		});
	});
	function viewDetail(id){
		window.location='<?php echo $link; ?>&m=fuser&ide='+id;
	}
	function add(){
		window.location='<?php echo $link; ?>&m=fuser';
	}
	
	</script>
	<div class="p-wrapper">
		<div class="content">
		<div style="clear:both; padding-top:30px;"></div>
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a href="<?php echo $link; ?>&m=fuser">(+) Tambah Pengguna</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
				<form method="post" action="<?php echo $link; ?>&m=fuser" enctype="multipart/form-data">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
					  <tr>
						<td width="97"><p style="font-weight:bold">User ID</p></td>
						<td width="199">
						<input type="text" name="user" id="user" value="<?php echo $user->getField('login_id',$ide); ?>" maxlength="50" />
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">						</td>
						<td width="147"><span style="font-weight:bold">Level</span></td>
						<td width="202"><p style="font-weight:bold">
						  <select name="level" style="width:100%">
                            <?php 
							if(isset($_GET['ide'])){
								echo $lev=$user->getField('level',$ide);
							?>
                            <option value="<?php echo $lev;?>" selected="selected"> <?php echo $level->getField('id',$lev);?> </option>
                            <?php
						  }
							$x=$level->getAll();
							foreach($x as $row){
								echo "<option value='".$row['id']."'>".$row['id']."</option>";
							}
						?>
                          </select>
						</p></td>
						<td width="344">&nbsp;</td>
					  </tr>
					  <tr>
						<td><p style="font-weight:bold">Password</p></td>
						<td><input type="password" name="password" id="password" value="<?php echo $user->getField('password',$ide); ?>" maxlength="50" /></td>
						<td><span style="font-weight:bold">Status</span></td>
						<td><p style="font-weight:bold">
						  <select name="status" style="width:100%">
                            <option value="<?php echo $user->getField('status',$ide);?>" selected="selected">
                            <?php 
							$sts=$user->getField('status',$ide);
							if($sts!=0){echo "AKTIF";}else{echo "NON-AKTIF";}
							?>
                            </option>
                            <option value="1">AKTIF</option>
                            <option value="0">NON-AKTIF</option>
                          </select>
						</p></td>
						<td>&nbsp;</td>
					  </tr>
					</table>
					<div id="p-main"></div>
					<div class="head_content" style="box-shadow:none;" >
						<input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" />
						<input type="button" name="hapus" id="hapus" value="Hapus" />
					</div>
				</form>
</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Simpan':
			$id=kode('user','');
			$data=array('id_user'=>$id,'user'=>$_POST['user'],'password'=>$_POST['password'],'level'=>$_POST['level'],'status'=>$_POST['status'],'themesid'=>$_POST['themesid']);
			$user->addData($data);		
			header("location:$link&m=fuser");	
		break;
		case 'Edit':
			$oldpass=$user->getField('password',$id);
			$newpass=$_POST['password'];
			if($oldpass!=$newpass){ $password=md5($newpass);}else{$password=$oldpass;}
			$data=array('user'=>$_POST['user'],'password'=>$password,'level'=>$_POST['level'],'status'=>$_POST['status'],'themesid'=>$_POST['themesid']);
			$user->updateData($id,$data);		
			header("location:$link&m=fuser");	
		break;		
		case 'Hapus':
			$user->delData($id);
			header("location:$link&m=fuser");	
		break;		
	}
}
?>