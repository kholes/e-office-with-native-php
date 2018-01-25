<?php
$linkdata='page/account/subdata.php';
$ide=$_GET['ide'];
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
		$('#hapus').click(function(){
			$.ajax({
				type:'post',
				url:'<?php echo $link;?>&m=fsub',
				data:'btn=Hapus&ide=<?php echo $_GET['ide'];?>',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=fsub';
				}
			});
		});
	});
	function viewDetail(id){
		window.location='<?php echo $link; ?>&m=fsub&ide='+id;
	}
	</script>
	<div class="p-wrapper">
		<div class="content">
		<div style="clear:both; padding-top:30px;"></div>
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a href="<?php echo $link; ?>&m=fsub">(+) Data Sub / Bagian </a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
				<form method="post" action="<?php echo $link; ?>&m=fsub" enctype="multipart/form-data">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
					  <tr>
						<td width="138"><p style="font-weight:bold">Sub / Bagian  </p></td>
						<td width="300"><input type="hidden" name="ide" id="ide" value="<?php echo $ide; ?>" /><input type="text" name="id" id="id" value="<?php echo $ide; ?>" style="width:100%;" /></td>
						<td width="551">&nbsp;</td>
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
	$ide=$_POST['ide'];
	switch ($_POST['btn']){
		case 'Simpan':
			$data=array('id'=>$id);
			$sub->addData($data);		
			header("location:$link&m=fsub");	
		break;
		case 'Edit':
			$data=array('id'=>$id);
			$sub->updateData($ide,$data);		
			header("location:$link&m=fsub");	
		break;		
		case 'Hapus':
			mysql_query('delete from jabatan where id="$id"');
			$sub->delData($ide);
			header("location:$link&m=fsub");	
		break;		
	}
}
?>