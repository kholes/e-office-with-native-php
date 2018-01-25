			<div id="head-mail">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<th align="left">&raquo; Data Klasifikasi Surat</th>
				</table>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
				<th align="left">NOMOR</th>
				<th align="left">KLASIFIKASI SURAT </th>
				<?php
				$x=$klas->getAll();
				foreach($x as $row){
				?>			  
				<tr onMouseOver="this.style.background='#eee';this.style.cursor='pointer';"  onmouseout="this.style.background='#fff';">
					<td width="9%" class="mail"><?php echo $row['id']; ?></td>
					<td width="91%" class="mail"><a class="thickbox" href="page/entrisuratklasifikasi.php?id=<?php echo $row['id'];?>&width=300 height=300"><?php echo $row['klasifikasi']; ?></a></td>
				</tr>
				<?php
				}
				?>
			</table>		
