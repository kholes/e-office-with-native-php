<?php
	$ide=$_GET['ide'];
	if(isset($_GET['ide'])){
		$btn='edit';
	}else{
		$btn='simpan';
	}
?>
<script>
	$(document).ready(function(){
		viewIndex();
		clearForm();
		$('#nmr').focus();
		$('#cariIndex').keyup(function(e){
			$.ajax({
				type: 'POST',
				url:'<?php echo $linksetting;?>',
				data: 'btn=viewIndex&val='+$('#cariIndex').val(),
				success: function(data){
					$('#infData').html(data);
				}
			});		
		});
	});
	function cekTombol(){
		switch($('#btn').val()){
			case 'Simpan':
				addIndex();
			break;
			case 'Ubah':
				editIndex();
			break;
		}
	}
	function clearForm(){
		viewIndex();		
		$('#nmr').val('');
		$('#keterangan').val('');
		$('#btn').val('Simpan');
		$('#hapus').val('');
		$('#nmr').focus();
	}
	function viewIndex(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=viewIndex',
			success: function(data){
				$('#infData').html(data);
			}
		});		
	}
	function getRow(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=getRowIndex&id='+id,
			success: function(data){
				ob=eval(data);
				$('#nmr').val(ob[0]);
				$('#keterangan').val(ob[1]);
				$('#btn').val('Ubah');
				$('#hapus').val('Hapus');
			}
		});		
	}
	function addIndex(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=addIndex&id='+$('#nmr').val()+'&keterangan='+$('#keterangan').val(),
			success: function(data){
				alert(data);
				clearForm();
			}
		});		
	}
	function editIndex(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=editIndex&id='+$('#nmr').val()+'&keterangan='+$('#keterangan').val(),
			success: function(data){
				clearForm();
			}
		});		
	}
	function deleteIndex(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=deleteIndex&id='+$('#nmr').val(),
			success: function(data){
				clearForm();
			}
		});		
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a onclick="clearForm();">INDEX SURAT (+)</a></li>
			<li class="active">REGISTRASI</li>
		</ul>
	</h3>
	<form method="post" action="<?php echo $link; ?>&m=fklasi" enctype="multipart/form-data" id="MyForm">
		<div class="c10"></div>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
				<td width="18%"><p style="font-size:14px; font-weight:bold;">Nomor</p></td>
			  <td width="82%"><input type="text" name="nmr" id="nmr"  style="width:30%;"  value="" /></td>
			</tr>
			<tr>
				<td><p style="font-size:14px; font-weight:bold;">Keterangan</p></td>
				<td><input type="text" name="keterangan" id="keterangan"  style="width:100%;" value="" /></td>
			</tr>
		</table>
		<div class="c10"></div>
		<div style="padding:3px; background:#ccc; text-align:right;">Cari 
		<input type="text" name="cariIndex" id="cariIndex" value="">
		</div>
		<div id="infData">
		</div>	
		<div class="head_content" style="box-shadow:none;" >
			<input type="button" name="btn" id="btn" value="" onclick="cekTombol();">
			<input type="button" name="hapus" id="hapus" value="" onclick="deleteIndex();">
			&nbsp;
			<input name="button" style="float:right" type="button" onclick="self.history.back();" value="Kembali" />				
		</div>
	</form>
</div>
</div>
