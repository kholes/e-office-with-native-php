<?php
include "class/dtsatuan.cls.php";
$satuan=new Dtsatuan();
$linkdata='page/dataumum/dataumumprc.php';
$ide=$_GET['ide'];
?>
	<script>
		function get_all_satuan(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=get_all_satuan',
				cache:false,
				success:function(data){
					$('#p-main').html(data);
				}
			});
		}
		var ide='<?php echo $ide;?>';
		$(document).ready(function(){
			get_all_satuan();
			$('#edit_btn').hide();
			if(ide!=''){$('#edit_btn').show();$('#save_btn').hide();}
		});
		function save(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=save_satuan&id='+id+'&satuan='+$('#satuan').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formsatuan';
				}
			});
		}
		function edit(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=edit_satuan&id='+id+'&satuan='+$('#satuan').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formsatuan';
				}
			});
		}
		function hapus(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=del_satuan&id='+id+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formsatuan';
				}
			});
		}
		function get_data(id){
			window.location='<?php echo $link; ?>&m=formsatuan&ide='+id;
		}
	</script>
	<div class="p-wrapper">
		<div class="content">
			<div id="label-form">
				<li class="fa fa-dropbox">   <a onclick="window.location='<?php echo $link;?>&m=formsatuan'">TAMBAH DATA SATUAN BARANG</a></li>
				<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
			</div>
			<div class="c"></div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179"><p style="font-size:16px; font-weight:bold;">Nama Satuan</p></td>
						<td width="821">
						<input type="text" name="satuan" id="satuan" value="<?php echo $satuan->getField('satuan',$ide); ?>" />
						<input type="button" id="edit_btn" value="Edit" onclick="edit('<?php echo $ide;?>');" style="float:right" />
						<input type="button" id="save_btn" value="Simpan" onclick="save();" style="float:right" />
						</td>
					  </tr>
					</table>
			<div id="p-main"></div>
</div></div>
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
