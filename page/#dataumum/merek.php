<?php
$link='?p='.encrypt_url('dataumum');
$linkdata='page/dataumum/dtmerek.php';
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
			window.location='<?php echo $link; ?>&ide='+id;
		}
		function add(){
			window.location='<?php echo $link; ?>';
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<a href="<?php echo $link;?>&m=mrk"><h3>+ TAMBAH DATA MEREK</h3></a>
		</div>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
				<tr>
					<td width="179"><strong style="font-size:16px; font-weight:bold">Nama Merek </strong></td>
					<td width="821">
						<input type="text" name="merek" id="merek" value="<?php echo $merek->getField('merek',$ide); ?>" />
					</td>
				</tr>
			</table>
			<div id="p-main">
			</div>
			<div class="head_content">
				<input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" style="float:right"  />
				<input type="button" name="hapus" id="hapus" value="Hapus"/>					
			</div>
		</form>
		
<script>
	$(document).ready(function(){
		$('#merek').focus();
	});
	$('#merek').keydown(function(e){
		if (e.keyCode==13){
			if($('#merek').val()==''){
				alert('Merek tidak boleh kosong');
				return;
			}else{
				$('#p-frm').submit();
			}
		}
	});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Simpan':
			$id=kode('dtmerek','');
			$data=array('id'=>$id,'merek'=>$_POST['merek']);
			$merek->addData($data);		
			header("location:$link");	
		break;
		case 'Edit':
			$data=array('merek'=>$_POST['merek']);
			$merek->updateData($id,$data);		
			header("location:$link");	
		break;		
		case 'Hapus':
			$merek->delData($id);
			header("location:$link");	
		break;		
	}
}
?>
