<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'req=getPengajuan',
			cache:false,
			success:function(data){
				$('#infPengajuan').html(data);
			}
		});
	});
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
	function terima(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=editProses&id='+id,
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
<?php
$sql=$pengajuan->getKirim();
if($sql!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0">
	<th align="left">TGL.PENGAJUAN</th>
	<th align="left">TUJUAN</th>
	<th align="left">TGL.PENGESAHAN</th>
	<th align="left">KETERANGAN</th>
	<th align="center">STATUS</th>
    <?php
	foreach ($sql as $row){
	?>
    <tr onmouseover="this.style.color='#666';this.style.cursor='pointer';" onclick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
    	<td width="13%" style="padding:5px;"><?php echo getTanggal($row['tanggal']);?></td>
        <td width="23%" style="padding:5px;"><?php echo $jabatan->getField('jabatan',$row['pejabat']);?></td>
        <td width="18%" style="padding:5px;"><?php if($row['tgl_terima']=='0000-00-00'){ echo "";}else{ echo getTanggal($row['tgl_terima']);}?></td>
        <td width="40%" style="padding:5px;"><?php echo $row['keterangan'];?></td>
        <td width="6%" align="center" style="padding:5px;">
		<?php 
		$sts=$row['status'];
		switch ($sts){
			case 'pesan':
				$bgcolor='#EF3636';
			break;
			case 'terima':
				$bgcolor='#132486';			
			break;
			case 'proses':
				$bgcolor='#6CDBB3';
			break;
			case 'kirim':
				$bgcolor='#0F724E';
			break;
		}
		echo "<p style='background:$bgcolor; padding:5px; text-transform:uppercase; font-weight:bold;' align='center'>$sts</p>";
		?>		</td>
  </tr>
      <tr>
        <td colspan="6" align="left" style="border:none;">
			<span id="infItem<?php echo $row['id'];?>"></span>
			</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Belum ada pengajuan barang.</p>";
	}
	?>