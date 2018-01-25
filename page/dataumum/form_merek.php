<?php
$link='?p='.encrypt_url('dataumum');
$linkdata='page/dataumum/dataumumprc.php';
$ide=$_GET['ide'];
?>
<script>
		var ide='<?php echo $ide;?>';
		$(document).ready(function(){
			get_all_merek();
			$('#edit_btn').hide();
			if(ide!=''){$('#edit_btn').show();$('#save_btn').hide();}
		});
		function save(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=save_merek&id='+id+'&merek='+$('#merek').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formmerek';
				}
			});
		}
		function edit(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=edit_merek&id='+id+'&merek='+$('#merek').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formmerek';
				}
			});
		}
		function hapus(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=del_merek&id='+id+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formmerek';
				}
			});
		}
		function get_all_merek(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=get_all_merek',
				cache:false,
				success:function(data){
					$('#p-main').html(data);
				}
			});		
		}
		function get_data(id){
			window.location='<?php echo $link; ?>&m=formmerek&ide='+id;
		}
	</script>
	<div class="p-wrapper">
		<div class="content">
			<div id="label-form">
				<li class="fa fa-tags">   <a onclick="window.location='<?php echo $link;?>&m=formmerek'">TAMBAH DATA MEREK</a></li>
				<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
			</div>
			<div class="c"></div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
					<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					<tr>
						<td width="179"><strong style="font-size:16px; font-weight:bold">Nama Merek </strong></td>
						<td width="821">
							<input type="text" name="merek" id="merek" value="<?php echo $merek->getField('merek',$ide); ?>" />
							<input type="button" id="edit_btn" value="Edit" onclick="edit('<?php echo $ide;?>');" style="float:right" />
							<input type="button" id="save_btn" value="Simpan" onclick="save();" style="float:right" />
						</td>
					</tr>
				</table>
			<div id="p-main"></div>
		</div>
	</div>
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
