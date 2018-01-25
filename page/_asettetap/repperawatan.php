<script>
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url:'page/asettetap/prc_aset.php',
			data: 'req=getItem&id='+id+'',
			success: function(res){
				$('#infItem'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#infItem'+id).fadeOut('slow');
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>PERAWATAN</a></li>
		</ul>
	</h3>
		<div class="c5"></div>
		<?php
		$data=$dtperawatan->getAll();
		if($data!=array()){
		?>
			<table width="100%" cellpadding="0" cellspacing="0" class="table">
				<th width="3%" align="left">NO</th>
				<th width="7%" align="left">NO.REG</th>
				<th width="13%" align="left">TANGGAL</th>
				<th width="10%" align="left">KATEGORI</th>
				<th width="16%" align="left">PELAKSANA </th>
				<th width="13%" align="right">TOTAL BIAYA</th>
				<th width="14%" align="left">TGL.DITERIMA</th>
				<th width="14%" align="left">TGL.DISETUJUI</th>
				<th width="10%" align="center">STATUS</th>
				<?php
				foreach($data as $row){
				?>
				<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onMouseOut="this.style.color='#333';" onClick="viewItem('<?php echo $row['id'];?>');">
					<td width="3%" align="center"><?php echo $c=$c+1;?></td>
					<td width="7%"><?php echo $row['id'];?></td>
					<td width="13%"><?php echo getTanggal($row['tanggal']);?></td>
					<td width="10%"><?php echo $row['kategori'];?></td>
					<td width="16%"><?php echo $toko->getField('nama',$row['pelaksana']);?></td>
					<td width="13%" align="right">
					<?php echo format_angka($dtperawatan->getTotalItem($row['id']));?>
					</td>
					<td width="14%"><?php if($row['diterima']!='0000-00-00'){echo $row['diterima'];} ;?></td>
					<td width="14%"><?php if($row['disetujui']!='0000-00-00'){echo $row['disetujui'];} ;?></td>
					<td width="10%" align="center">
					<?php 
		$color='#fff';			
		$sts=$row['status'];
		switch ($sts){
			case '0':
				$bgcolor='#363DBB';
				$sts='PENGAJUAN';
			break;
			case '1':
				$bgcolor='#F08C3B';			
				$color='#fff';			
				$sts='DITERIMA';
			break;
			case '2':
				$color='#fff';			
				$bgcolor='#289835';
				$sts='DISETUJUI';
			break;
			case '3':
				$bgcolor='#2AFF43';
				$sts='PENGIRIMAN';
			break;
			case '4':
				$bgcolor='#AE9EA1';
				$sts='SELESAI';
			break;
			case '6':
				$bgcolor='#A40C28';
				$sts='DIKEMBALIKAN';
			break;
		}
		echo "<p style='background:$bgcolor; color:$color; padding:5px; text-transform:uppercase; font-weight:bold;' align='center'>$sts</p>";
		?>
					</td>
				</tr>
				<tr>
					<td colspan="9">
						<div style="width:100%" id="infItem<?php echo $row['id'];?>"></div>
					</td>
				</tr>
				<?php
				}
				?>
			  </table>
			 <?php
			 }else{
			 	echo "<p class='pesan'>Belum ada data perawatan.</p>";
			 }
			 ?>
		<div class="head_content" style="box-shadow:none;" >
			<input type="button" name="prn" id="prn" onClick="prn();" value="Cetak">
			&nbsp;
			<input type="button" value="Kembali" onClick="history.back();" style="float:right" />
		</div>
	</div>
</div>