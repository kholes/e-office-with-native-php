<?php
include "class/dtsatuan.cls.php";
$satuan=new Dtsatuan();
$linkdata='page/dataumum/dtsatuan.php';
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
					url:'<?php echo $link;?>&m=sat',
					data:'btn=Hapus&id='+$('#id').val()+'',
					cache :false,
					success:function (data){
						window.location='<?php echo $link; ?>&m=sat';
					}
				});
			});
		});
			function viewDetail(id){
			window.location='<?php echo $link; ?>&m=sat&ide='+id;
		}
		function add(){
			window.location='<?php echo $link; ?>&m=sat';
		}
	</script>
<div class="head_content"><a href="<?php echo $link;?>&m=sat"><h3>+ TAMBAH DATA SATUAN</h3></a></div>
				<form method="post" action="<?php echo $link; ?>&m=sat" enctype="multipart/form-data">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179"><p style="font-size:16px; font-weight:bold;">Nama Satuan</p></td>
						<td width="821">
						<input type="text" name="satuan" id="satuan" value="<?php echo $satuan->getField('satuan',$ide); ?>" />
						</td>
					  </tr>
					</table>
						<div id="p-main">
						</div>				
					<div class="head_content">
					<input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" style="float:right" />
				    <input type="button" name="hapus" id="hapus" value="Hapus" />				
					</div>
				</form>
	<script>
		function setfocus(){$('#satuan').focus();}
		document.onkeydown = function(e){setfocus();}
		$(document).ready(function(){
			$('#satuan').focus();
		});
		$('#satuan').keydown(function(e){
			if (e.keyCode==13){
				if($('#satuan').val()==''){
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
			$id=kode('dtsatuan','');
			$data=array('id'=>$id,'satuan'=>$_POST['satuan']);
			$satuan->addData($data);		
			header("location:$link&m=sat");	
		break;
		case 'Edit':
			$data=array('satuan'=>$_POST['satuan']);
			$satuan->updateData($id,$data);		
			header("location:$link&m=sat");	
		break;		
		case 'Hapus':
			$satuan->delData($id);
			header("location:$link&m=sat");	
		break;		
	}
}
?>
