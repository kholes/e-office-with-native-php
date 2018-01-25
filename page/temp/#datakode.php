<div id="head-mail">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<th align="left">&raquo; Input Data Kode Surat</th>
	</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
	<th align="center">NOMOR</th>
	<th align="left">KLASIFIKASI</th>
	<th align="left">KETERANGAN</th>
	<?php
	$x=$kode->getAll();
	foreach($x as $row){
	?>			  
	<tr onMouseOver="this.style.background='#eee';this.style.cursor='pointer';" onmouseout="this.style.background='#fff';">
		<td width="7%" class="mail" align="center"><?php echo $row['id']; ?></td>
		<td width="28%" class="mail"><?php echo $klas->getField('klasifikasi',$row['klasifikasi']); ?></td>
		<td width="65%" class="mail"><a class="thickbox" href="page/entrisuratkode.php?id=<?php echo $row['id'];?>&width=300 height=300"><?php echo $row['keterangan']; ?></a></td>
	</tr>
	<?php
	}
	?>
</table>