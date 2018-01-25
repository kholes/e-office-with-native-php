<?php
$logid=decrypt_url($_SESSION['id_user']);
$loglevel=$user->getField('level',$logid);
switch($loglevel){
	case 'KKR':$sts='1';$set_sts='2';$val_btn='Setuju';break;
	case 'KTU':$sts='0';$set_sts='1';$val_btn='Terima';break;
}
?>
<script>
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=getItem&id='+id+'',
			success: function(res){
				$('#infItem'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#infItem'+id).fadeOut('slow');
	}
	function setStatus(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=setStatus&id='+id+'&set_sts=<?php echo $set_sts;?>&tanggal='+$("#tanggal").val(),
			success: function(data){
				window.location='<?php echo $link;?>';
			}
		});				
	}
	function setTolak(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=setTolak&id='+id,
			success: function(data){
				window.location='<?php echo $link;?>';
			}
		});				
	}
	function editTerima(idt,id,harga){
		var qty=$('#qty'+idt+id).val();
		var keterangan=$('#keterangan'+idt+id).val();
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=editTerima&idt='+idt+'&id='+id+'&qty='+qty+'&keterangan='+keterangan+'&harga='+harga,
			success: function(data){
				alert('Detail pengajuan sudah diubah.');
				//$('#infItem'+id).fadeIn('slow').html(res);
			}
		});				
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>PENGAJUAN</a></li>
				<li class="active">DATA</li>
			</ul>
		</h3>
		<div class="c10"></div>
<?php
$sql=$pengajuan->getPengajuan($sts);
if($sql!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0" class="table">
	<th align="left" style="padding:7px 0 7px 10px;">ID.PENGAJUAN</th>
	<th align="left" style="padding:7px 0 7px 10px;">PEMOHON</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.PENGAJUAN</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.DITERIMA</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.DISETUJUI</th>
	<th align="left" style="padding:7px 0 7px 10px;">KETERANGAN</th>
	<th align="center">PENERIMA BARANG</th>
	<th align="center">STATUS</th>
    <?php
	foreach ($sql as $row){
	?>
    <tr onmouseover="this.style.color='red';this.style.cursor='pointer';" onclick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
    	<td width="13%"><?php echo $row['id'];?></td>
        <td width="9%"><?php echo $pegawai->getField('jabatan',$row['pemohon']);?></td>
    	<td width="14%">
			<?php 
			if($row['tgl_pengajuan']!='0000-00-00'){echo getTanggal($row['tgl_pengajuan']);}else{echo '-';}
			?>		</td>
    	<td width="13%">
			<?php 
			if($row['tgl_diterima']!='0000-00-00'){echo getTanggal($row['tgl_diterima']);}else{echo '-';}
			?>
		</td>
    	<td width="13%">
			<?php 
			if($row['tgl_disetujui']!='0000-00-00'){echo getTanggal($row['tgl_disetujui']);}else{echo '-';}
			?>
		</td>
        <td width="13%"><?php echo $row['keterangan'];?></td>
        <td width="19%"><?php echo $row['penerima'];?></td>
        <td width="6%"><?php 
		$sts=$row['status'];
		switch ($sts){
			case '0':
				$bgcolor='#363DBB';
				$sts='PENGAJUAN';
			break;
			case '1':
				$bgcolor='#F08C3B';			
				$sts='DITERIMA';
			break;
			case '2':
				$bgcolor='#289835';
				$sts='DISETUJUI';
			break;
			case '3':
				$bgcolor='#2AFF43';
				$sts='PENGIRIMAN';
			break;
			case '4':
				$bgcolor='#AE9EA1';
				$sts='PENERIMAAN';
			break;
			case '6':
				$bgcolor='#A40C28';
				$sts='DIKEMBALIKAN';
			break;
		}
		echo "<p style='background:$bgcolor; padding:5px; text-transform:uppercase; font-weight:bold;' align='center'>$sts</p>";
		?></td>
  </tr>
      <tr>
				<td colspan="7" class="col-detail">
					<div style="width:100%" id="infItem<?php echo $row['id'];?>"></div>
				</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Belum ada pengajuan barang.</p>";
	}
	?>