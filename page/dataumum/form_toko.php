<?php
include "class/dttoko.cls.php";
$toko=new Dttoko();
$link='?p='.encrypt_url('dataumum');
$linkdata='page/dataumum/dataumumprc.php';
$ide=$_GET['ide'];
?>
<script>
		var ide='<?php echo $ide;?>';
		$(document).ready(function(){
			get_all_toko();
			$('#edit_btn').hide();
			if(ide!=''){$('#edit_btn').show();$('#save_btn').hide();}
		});
		function save(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=save_toko&id='+id+'&nama='+$('#nama').val()+'&alamat='+$('#alamat').val()+'&tlp='+$('#tlp').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formtoko';
				}
			});
		}
		function edit(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=edit_toko&id='+id+'&nama='+$('#nama').val()+'&alamat='+$('#alamat').val()+'&tlp='+$('#tlp').val(),
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formtoko';
				}
			});
		}
		function hapus(id){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=del_toko&id='+id+'',
				cache :false,
				success:function (data){
					window.location='<?php echo $link; ?>&m=formtoko';
				}
			});
		}
		function get_all_toko(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=get_all_toko',
				cache:false,
				success:function(data){
					$('#p-main').html(data);
				}
			});		
		}
		function get_data(id){
			window.location='<?php echo $link; ?>&m=formtoko&ide='+id;
		}
	</script>
	<div class="p-wrapper">
		<div class="content">
			<div id="label-form">
				<li class="fa fa-suitcase">   <a onclick="window.location='<?php echo $link;?>&m=formtoko'">TAMBAH DATA REKANAN </a></li>
				<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
			</div>
			<div class="c"></div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
					<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					<tr>
						<td width="179"><strong style="font-size:16px; font-weight:bold">Nama Rekanan </strong></td>
						<td width="821">
							<input type="text" name="nama" id="nama" value="<?php echo $toko->get_field('nama',$ide); ?>" />
						</td>
					</tr>
					<tr>
						<td width="179"><strong style="font-size:16px; font-weight:bold">Alamat </strong></td>
						<td width="821">
							<input type="text" name="alamat" id="alamat" value="<?php echo $toko->get_field('alamat',$ide); ?>" />
						</td>
					</tr>
					<tr>
						<td width="179"><strong style="font-size:16px; font-weight:bold">No.Telepon / HP </strong></td>
						<td width="821">
							<input type="text" name="tlp" id="tlp" value="<?php echo $toko->get_field('tlp',$ide); ?>" />
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
		$('#toko').focus();
	});
	$('#toko').keydown(function(e){
		if (e.keyCode==13){
			if($('#toko').val()==''){
				alert('toko tidak boleh kosong');
				return;
			}else{
				$('#p-frm').submit();
			}
		}
	});
</script>
