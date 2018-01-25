<?php
	$ide=$_GET['ide'];
	if(isset($_GET['ide'])){
		$btn='edit';
	}else{
		$btn='simpan';
	}
?>
<script>
	var id='';
	$(document).ready(function(){
		viewKlas();
		clearForm();
		getIndex(id);
		$('#nmr').focus();
		$('#cariKlas').keyup(function(e){
			$.ajax({
				type: 'POST',
				url:'<?php echo $linksetting;?>',
				data: 'btn=viewKlas&val='+$('#cariKlas').val(),
				success: function(data){
					$('#infData').html(data);
				}
			});		
		});
	});
	function cekTombol(){
		switch($('#btn').val()){
			case 'Simpan':
				addKlas();
			break;
			case 'Ubah':
				editKlas();
			break;
		}
	}
	function getIndex(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=getIndex&idindex='+id,
			success: function(data){
				$('#infIndex').html(data);
			}
		});		
	}
	function clearForm(){
		viewKlas();		
		$('#nmr').val('');
		$('#keterangan').val('');
		$('#btn').val('Simpan');
		$('#hapus').val('');
		$('#nmr').focus();
	}
	function viewKlas(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=viewKlas',
			success: function(data){
				$('#infData').html(data);
			}
		});		
	}
	function getRow(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=getRowKlas&id='+id,
			success: function(data){
				ob=eval(data);
				getIndex(ob[0]);
				$('#nmr').val(ob[1]);
				$('#keterangan').val(ob[2]);
				$('#btn').val('Ubah');
				$('#hapus').val('Hapus');
			}
		});		
	}
	function addKlas(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=addKlas&id='+$('#nmr').val()+'&idindex='+$('#idindex').val()+'&keterangan='+$('#keterangan').val(),
			success: function(data){
				clearForm();
			}
		});		
	}
	function editKlas(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=editKlas&id='+$('#nmr').val()+'&idindex='+$('#idindex').val()+'&keterangan='+$('#keterangan').val(),
			success: function(data){
				clearForm();
			}
		});		
	}
	function deleteKlas(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linksetting;?>',
			data: 'btn=deleteKlas&id='+$('#nmr').val(),
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
			<li><a onclick="clearForm();">KLASIFIKASI SURAT (+)</a></li>
			<li class="active">REGISTRASI</li>
		</ul>
	</h3>
		<form method="post" action="<?php echo $link; ?>&m=fkode" enctype="multipart/form-data" id="MyForm">
		<div class="c10"></div>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
				<tr>
					<td width="21%"><p style="font-size:14px; font-weight:bold;">Index</p></td>
					<td width="79%"><span id="infIndex"></span>
				  </td>
		  </tr>
					<tr>
						<td width="21%"><p style="font-size:14px; font-weight:bold;">Nomor</p></td>
					  <td width="79%"><input type="text" name="nmr" id="nmr" value="" /></td>
					</tr>
					<tr>
						<td><p style="font-size:14px; font-weight:bold;">Keterangan</p></td>
						<td><input style="width:100%" type="text" name="keterangan" id="keterangan"  value=""/></td>
					</tr>
				</table>		
			<div class="c10"></div>
			<div style="padding:3px; background:#ccc; text-align:right;">Cari 
			<input type="text" name="cariKlas" id="cariKlas" value="">
			</div>
			<div id="infData">
			</div>	
			<div class="head_content" style="box-shadow:none;" >
				<input type="button" name="btn" id="btn" value="" onclick="cekTombol();">
				<input type="button" name="hapus" id="hapus" value="" onclick="deleteKlas();">
				&nbsp;
				<input name="button" style="float:right" type="button" onclick="self.history.back();" value="Kembali" />				
			</div>
			</form>	
	</div>
</div>
