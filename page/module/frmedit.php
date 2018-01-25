<?php
$ide=$_GET['ide'];
?>
	<script>
		$(document).ready(function(){
			$('#edit').click(function(){
				$('#MyForm').submit();
			});
		});
	</script>
	<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" id="MyForm">
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
				<input type="hidden" name="btn" id="btn" value="Edit" />
				<input type="button" name="edit" id="edit" value="Edit" />
				<input type="button" name="hapus" id="hapus" value="Hapus" />
				<input type="button" name="batal" id="batal" value="Batal" />
	</form>
