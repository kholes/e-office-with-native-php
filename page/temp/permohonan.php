<script>
		$(document).ready(function(){
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=viewPermohonanTemp',
				cache:false,
				success:function(data){
					$('#inf-permohonan').html(data);
				}
			});
		});
		function upQty(id){
			var qty=document.getElementById('qty'+id).value;
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=upQtyPermohonan&id='+id+'&qty='+qty,
				cache:false,
				success:function(data){
					$('#inf-permohonan').html(data);
				}
			});
		}
		function sendPermohonan(){
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=sendPermohonan&id='+$('#id').val()+'&tgl_permohonan='+$('#tgl_permohonan').val()+'&pejabat='+$('#pejabat').val(),
				cache:false,
				success:function(data){
					clearTemp();
					//window.location.reload();
				}
			});			
		}
		$(document).ready(function(){
			$('#batal').click(function(){
				clearTemp();
			});
		});
		function clearTemp(){
			$.ajax({
				type:'post',
				url:'ajaxtemp.php',
				data:'req=clearTempPermohonan',
				cache:false,
				success:function(data){
					$('#inf-permohonan').html(data);
				}
			});			
		}
</script>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head">
      <div class="p-head-c">
        <div id="right">
		&nbsp;
        </div>
        <div id="left">
			<?php include 'permohonanmenu.php'; ?>
        </div>
      </div>
	</div>
	<div class="p-wrapper">
		<div style="margin-top:-40px;">
			<form method="post" id="p-frm" action="<?php echo $link; ?>" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<th colspan="6" align="center"><h3>FORM PENGAJUAN  BARANG</h3></th>
						<tr>
							<td class="btn" colspan="6" >&nbsp;</td>
				  		</tr>
				  <tr>
					<td width="23%">TANGGAL</td>
					<td width="19%" align="left"><input type="text" class="tgl_permohonan" name="tgl_permohonan" id="tgl_permohonan" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tgl_permohonan', 'dd-mm-y')"/></td>
					<td width="20%">&nbsp;</td>
					<td width="14%">NO. PENGAJUAN</td>
					<td width="24%" align="right"><input type="text" name="id" id="id" value="<?php echo kode_trx('dtpermohonan',$logid.'02',$logid);?>" readonly=""></td>
				  </tr>
				  <tr>
					<td>KEPADA</td>
					<td align="left"><select name="pejabat" id="pejabat">
                      <option value="KTU" selected="selected">KASUBAG TATA USAHA</option>
                      <option value="KKR">KEPALA KANTOR</option>
                    </select></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
				  	<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="6" align="right">
					<input type="button" onClick="sendPermohonan()" value="Kirim Pengajuan">
					<input type="button" name="batal" id="batal" value="Batal">					
					</td>
				  </tr>
				</table>
			</form>
			</div>
			<div id="p-main">
				<span id="inf-permohonan"></span>
			</div>
	</div>
</body>
<script>
$(document).ready(function(){
	$('.qty').keypress(function(e){
		var e=window.event || e
		var keyunicode=e.charCode || e.keyCode
		return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==46)? true:false
	});
});
</script>