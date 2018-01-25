<?php
include "../../lib/lib.php";
include "../../class/module.cls.php";
$ide=$_GET['ide'];
$link='?p='.encrypt_url('module');
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
$linkdata='page/moduledata.php';
$module=new Module();
$db=new Db();
$db->conDb();
?>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
		$('#simpan').click(function(){
			$('#MyForm').submit();
		});
	});
</script>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l"> &raquo; Registrasi Module</h2>
		<div class="c"></div>
	</div>
	<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" name="MyForm" id="MyForm">
		<div id="thick-conten">
			<div id="thick-frm">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
					<tr>
						<td width="241">Nama menu </td>
					<td width="731">
						<input type="text" name="nama" id="nama" value="<?php echo $module->getField('nama',$ide); ?>" />
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>" /></td>
				  	</tr>
					<tr>
						<td width="241">URL File </td>
						<td width="731"><input type="file" name="module[]" /></td>
					</tr>
					<tr>
						<td width="241">Icon (PNG) </td>
						<td width="731"><input type="file" name="img[]2" /></td>
					</tr>
			  	</table>
			</div>
		</div>
		<div id="thick-bottom">
		  <div id="thick-menu">								
				<input type="hidden" name="btn" id="btn" value="Simpan" />
				<input type="button" name="simpan" id="simpan" value="Simpan" />
			</div>
		</div>
	</form>
</div>
