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
</script>
<?php
include "class/trxinput.cls.php";
$trx=new Trxinput();
?>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head">
	  <h3>APLIKASI PENGAJUAN BARANG</h3>
	</div>
	<div class="p-wrapper">
		<div class="p-form-head">
			<div id="src-head" align="right">
			</div>
				<?php include 'permohonanmenu.php'; ?>
			</div>
			<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="23%">KEPADA</td>
					<td width="19%" align="right"><select name="pejabat" id="pejabat">
                      <option value="KTU" selected="selected">KASUBAG TATA USAHA</option>
                      <option value="KKR">KEPALA KANTOR</option>
                    </select></td>
					<td width="20%">&nbsp;</td>
					<td width="14%">NO. PENGAJUAN</td>
					<td width="24%" align="right"><input type="text" name="id" id="id" value="<?php echo kode('dtpermohonan',''.$logid.'.02.'.$bln.'.');?>" readonly=""></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<td>TANGGAL</td>
					<td align="right"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
				  </tr>
				  <tr>
					<td><input type="button" name="simpan" id="simpan" value="Simpan" onClick="sendData();"></td>
					<td align="right">&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input name="batal" id="batal" type="button" value="Batal" />					</td>
				  </tr>
				</table>
			</form>
			<div id="p-main">
				<span id="inf-permohonan"></span>
			</div>
			<div id="p-status">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="4%"><div class="total">NO. </div></td>
                  <td width="34%"><div class="total"><?php echo kode_trx('dtpermohonan',''.$logid.'02'.$bln.'.');?></div></td>
                  <td width="24%">&nbsp;</td>
                  <td width="19%">&nbsp;</td>
                  <td width="19%" align="right"><div class="total"></div></td>
                </tr>
              </table>
			</div>
	</div>
</body>
