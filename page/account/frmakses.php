<?php
include "class/level.cls.php";
$level=new Level();
$ide=$_GET['ide'];
$linkdata='page/account/aksesdata.php';
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
function cek($nama,$value,$mod){
	$level=new Level();	
	$ide=$_GET['ide'];
	$id=$ide;
	$oldmod=$level->getField('module',$id);
	$data=explode(',',$oldmod);
	$cdata=count($data);
	if($value==$data[0] or $value==$data[1] or $value==$data[2] or $value==$data[3] or $value==$data[4] or $value==$data[5] or $value==$data[6] or $value==$data[7] or $value==$data[8] or	$value==$data[9] or	$value==$data[10] or $value==$data[11] or $value==$data[12] or	$value==$data[13] or $value==$data[14] or $value==$data[15] or $value==$data[20] or $value==$data[21] or $value==$data[22] or $value==$data[23] or $value==$data[24] or $value==$data[25] or $value==$data[26] or $value==$data[27] or $value==$data[28] or $value==$data[29] or $value==$data[30]){$cek="checked";}else{$cek="";}
	echo "<li><input name='$nama"."[]' type='checkbox' value='$value' $cek >&nbsp;$mod</li>";
}
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
	function prev_file(id){
		var prev=null;
		if (prev==null){
			prev=open('page/prev_file.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1100,height=1600');
		}
	}
	$(document).ready(function(){ 
		$('#hapus').click(function(){
			$.ajax({
				type:'post',
				url:'<?php echo $link;?>',
				data:'btn=Hapus&id='+$('#id').val()+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>';
				}
			});
		});
	});
	function viewDetail(id){
		window.location='<?php echo $link; ?>&m=fakses&ide='+id;
	}
</script>
	<div class="p-wrapper">
		<div class="content">
		<div style="clear:both; padding-top:30px;"></div>
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a href="<?php echo $link; ?>&m=fakses">(+) Hak Akses</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
				<form method="post" action="<?php echo $link; ?>&m=fakses" enctype="multipart/form-data">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
					  <tr>
						<td width="84">Level ID </td>
						<td width="313"><input type="text" name="id" id="id" value="<?php echo $ide; ?>"></td>
					  </tr>
					  <tr>
						<td>Akses Module</td>
						<td>
						<ul>
						<?php 
						$mdl=$module->getAll();
						foreach($mdl as $row){
							echo "<li>".cek('module',$row['id'],$row['nama'])."</li>";
						}
						?>
						</ul>						
						</td>
					  </tr>
					</table>
				<div id="p-main">
				</div>
				<div class="head_content" style="box-shadow:none;" >
<input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" />
					    <input type="button" name="hapus" id="hapus" value="Hapus" /></div>
				</form>
</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$mod=$_POST['module'];
	$jmod=count($mod);
	for ($i=0;$i<$jmod;++$i){$rmod.="$mod[$i],";}
	$module=substr("$rmod",0,strlen($rmod)-1);
	switch ($_POST['btn']){
		case 'Simpan':
			$data=array('id'=>$_POST['id'],'module'=>$module);
			$level->addData($data);		
			print_r($data);
			header("location:$link&m=fakses");	
		break;
		case 'Edit':
		 echo $id;
			$data=array('id'=>$_POST['id'],'module'=>$module);
			$level->updateData($id,$data);		
			header("location:$link&m=fakses");	
		break;		
		case 'Hapus':
			$level->delData($id);
			header("location:$link&m=fakses");	
		break;		
	}
}
?>