<?php
switch($level){
	case 'KKR':$sts='1';$set_sts='2';break;
	case 'KTU':$sts='0';$set_sts='1';break;
}
?>
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
	function upQty(idt,id){
		var qty = prompt("Masukan Jumlah Barang", "1");
		if (qty != null) {
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'req=updateQtyItem&idt='+idt+'&id='+id+'&qty='+qty,
				cache :false,
				success:function (data){
					//alert(data);
					location.reload();
				}
			});	
		}				
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
	function kirim(id){
		$.ajax({
			type: 'POST',
			url:'<?php echo $linkdata;?>',
			data: 'req=kirimBarang&id='+id+'&tanggal='+$('#tanggal'+id).val(),
			success: function(data){
				//alert($('#tanggal'+id).val());
				//window.location.reload();
				prnOrder(id);
			}
		});				
	}
	function prnOrder(id){
		var order=null;
		if (order==null){
			order=open('page/barang/prnorder.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=850,height=600');
		}
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
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>PENGAJUAN</a></li>
				<li class="active">MONITORING</li>
			</ul>
		</h3>
		<div class="c10"></div>
<?php
switch($level){
	case 'STF':
		$sql=$pengajuan->getPengajuan($logid);
	break;
	case 'KSI':
		$sql=$pengajuan->getPengajuan($logid);
	break;
	case 'KTU':
		if(isset($_GET['get'])){
			$sql=$pengajuan->getAll();
		}else{
			$sql=$pengajuan->getPenerimaan();
		}
	break;
	case 'KKR':
		if(isset($_GET['get'])){
			$sql=$pengajuan->getAll();
		}else{
			$sql=$pengajuan->getPersetujuan();
		}
	break;
	case 'STB':
		if(isset($_GET['get'])){
			$sql=$pengajuan->getAll();
		}else{
			$sql=$pengajuan->getPenyiapan();
		}
	break;
}
if($sql!=array()){
?>
<table width="99%" cellpadding="0" cellspacing="0" class="table" style="margin:auto;">
	<th align="left">NO</th>
	<th align="left">PEMOHON</th>
	<th align="left">TGL.PENGAJUAN</th>
	<th align="left">TGL.DITERIMA</th>
	<th align="left">TGL.DISETUJUI</th>
	<th align="left">KETERANGAN</th>
	<th align="center">PENERIMA BARANG</th>
	<th align="center">STATUS</th>
    <?php
	foreach ($sql as $row){
	?>
    <tr onmouseover="this.style.color='red';this.style.cursor='pointer';" onclick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>" bgcolor="<?php echo $warna;?>" onmouseout="this.style.color='#000';">
    	<td width="5%"><?php echo $row['id'];?></td>
        <td width="15%"><?php echo $pegawai->getField('jabatan',$row['pemohon']);?></td>
    	<td width="16%">
			<?php 
			if($row['tgl_pengajuan']!='0000-00-00'){echo getTanggal($row['tgl_pengajuan']);}else{echo '-';}
			?>		</td>
    	<td width="14%">
			<?php 
			if($row['tgl_diterima']!='0000-00-00'){echo getTanggal($row['tgl_diterima']);}else{echo '-';}
			?>		</td>
    	<td width="14%">
			<?php 
			if($row['tgl_disetujui']!='0000-00-00'){echo getTanggal($row['tgl_disetujui']);}else{echo '-';}
			?>		</td>
        <td width="13%"><?php echo $row['keterangan'];?></td>
        <td width="16%">
		<?php 
			if($row['penerima']!=''){
				echo $row['penerima'];
			}else{
				
			}
		?>		</td>
        <td width="7%" align="center">
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
		?>        </td>
  </tr>
      <tr>
				<td colspan="8">
					<div style="width:100%" id="infItem<?php echo $row['id'];?>"></div>
				</td>
      </tr>
      <?php $counter ++; } ?>
    </table>
	<?php
	}else{
		echo "<p class='pesan'>Data pengajuan masih kosong..</p>";
	}
	?>
</div>
</div>