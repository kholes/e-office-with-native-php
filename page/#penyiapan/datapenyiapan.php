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
	function kirim(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=kirimBarang&id='+id+'&tanggal='+$('#tanggal').val(),
			success: function(data){
				//alert(data);
				prnOrder(id);
				window.location.reload();
			}
		});				
	}
	function setPenerima(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=setPenerima&id='+id+'&penerima='+$('#penerima').val()+'&tanggal='+$('#tanggal').val(),
			success: function(data){
				//alert(data);
				window.location.reload();
			}
		});				
	}
	function prnOrder(id){
		var order=null;
		if (order==null){
			order=open('page/barang/prnorder.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=850,height=600');
		}
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
	function deleteItem(idt,id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=deleteItem&idt='+idt+'&id='+id,
			success: function(data){
				//alert(data);
				location.reload();
			}
		});				
	}
</script>
<?php
$sql=mysql_query("select * from dtpengajuan where status in('2','3','4') order by pemohon");
while($x=mysql_fetch_assoc($sql))
$data[]=$x;
if($data!=array()){
?>
<table width="100%" cellpadding="0" cellspacing="0">
	<th align="left" style="padding:7px 0 7px 10px;">ID.PENGAJUAN</th>
	<th align="left" style="padding:7px 0 7px 10px;">PEMOHON</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.PENGAJUAN</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.DITERIMA</th>
	<th align="left" style="padding:7px 0 7px 10px;">TGL.DISETUJUI</th>
	<th align="left" style="margin-left:10px;">PENERIMA BARANG</th>
	<th align="center">STATUS</th>
    <?php
	foreach ($data as $row){
	?>
    <tr onmouseover="this.style.color='red';this.style.cursor='pointer';" onclick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
    	<td width="14%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;"><?php echo $row['id'];?></td>
        <td width="16%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;"><?php echo $pegawai->getField('jabatan',$row['pemohon']);?></td>
    	<td width="16%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;">
			<?php 
			if($row['tgl_pengajuan']!='0000-00-00'){echo getTanggal($row['tgl_pengajuan']);}else{echo '-';}
			?>		</td>
    	<td width="14%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;">
			<?php 
			if($row['tgl_diterima']!='0000-00-00'){echo getTanggal($row['tgl_diterima']);}else{echo '-';}
			?>		</td>
    	<td width="15%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;">
			<?php 
			if($row['tgl_disetujui']!='0000-00-00'){echo getTanggal($row['tgl_disetujui']);}else{echo '-';}
			?>		</td>
        <td width="18%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px 0 0 10px;"><?php echo $row['penerima'];?></td>
        <td width="7%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc; color:#fff;"><?php 
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