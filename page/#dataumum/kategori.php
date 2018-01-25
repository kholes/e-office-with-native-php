<?php
include "class/dtkategori.cls.php";
$dtkategori=new Dtkategori();
$linkdata='page/dataumum/dtkategori.php';
$ide=$_GET['ide'];
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
?>
	<script>
		$(document).ready(function(){ 
			$('#tombol').click(function(){
				$('#p-frm').submit();
			});
		});
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
					url:'<?php echo $link;?>&m=kat',
					data:'btn=Hapus&id='+$('#id').val()+'',
					cache :false,
					success:function (data){
						window.location='<?php echo $link; ?>&m=kat';
					}
				});
			});
		});
			function viewDetail(id){
			window.location='<?php echo $link; ?>&m=kat&ide='+id;
		}
		function add(){
			window.location='<?php echo $link; ?>&m=kat';
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<a href="<?php echo $link;?>&m=kat"><h3>+ TAMBAH DATA KATEGORI</h3></a>
		</div>
				<form method="post" action="<?php echo $link; ?>&m=kat" enctype="multipart/form-data">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179"><p style="font-size:16px;  font-weight:bold;">Nama Kategori</p></td>
						<td width="821">
						<input type="text" name="kategori" id="kategori" value="<?php echo $dtkategori->getField('kategori',$ide); ?>" />
						</td>
					  </tr>
					</table>
				<div id="p-main">
				</div>
				<div class="head_content">
							<input type="hidden" name="btn" id="btn" value="<?php echo $btn; ?>">
							<input type="submit" name="tombol" id="tombol" value="<?php echo $btn; ?>" style="float:right">
							<input type="button" name="hapus" id="hapus" value="Hapus" /></td>
				
				</div>
				</form>
		
	<script>
		$(document).ready(function(){
			$('#kategori').focus();
		});
		$('#kategori').keydown(function(e){
			if (e.keyCode==13){
				if($('#kategori').val()==''){
					alert('Kategori tidak boleh kosong');
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
			$id=kode('dtkategori','');
			$data=array('id'=>$id,'kategori'=>$_POST['kategori']);
			$dtkategori->addData($data);		
			header("location:$link&m=kat");	
		break;
		case 'Edit':
			$data=array('kategori'=>$_POST['kategori']);
			$dtkategori->updateData($id,$data);		
			header("location:$link&m=kat");	
		break;		
		case 'Hapus':
			$dtkategori->delData($id);
			header("location:$link&m=kat");	
		break;		
	}
}
?>
