	<script type="text/javascript" src="js/autocomplete.js"></script>		
	<script>
		$(document).ready(function(){
			$("#pegawai").autocomplete("srcpegawai.php", {
				selectFirst: true
			});
		});
		$(document).ready(function(){
			$("#pegawai").focus();
		});
		$(document).ready(function(){
			$("#simpan").click(function(){
				addOut();	
			});
		});
		function addData(){
			var chkArray = [];
			$(".ksi:checked").each(function() {
				chkArray.push($(this).val());
			});
			var dis;
			dis = chkArray.join(",") + '';
			$.ajax({
				type: 'POST',
				url: '<?php echo $linkdata;?>',
				data: 'req=addData&id='+$('#id').val()+'&tanggal='+$('#tanggal').val(),
				cache: false,
				success: function(res){
					//alert(res);
					window.location="<?php echo $link; ?>&m=pengajuanform";
				}
			});	
		}
		$(document).ready(function(){
			$("#batal").click(function(){
				clearTemp();
			});
		});
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $linkdata;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infTemp').html(res);
				}
			});		
		});
		function upQty(id){
			var qty = prompt("Masukan Jumlah Barang", "1");
			if (qty != null) {
				$.ajax({
					type:'post',
					url:'<?php echo $linkdata;?>',
					data:'req=upQtyOut&id='+id+'&qty='+qty,
					cache :false,
					success:function (data){
						window.location="<?php echo $link; ?>&m=fbrgk";
					}
				});	
			}				
		}
		$(document).ready(function(){
			$('#frmhead').slideDown();
		});
		function clearTemp(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $barangkeluarprc;?>',
				data: 'req=clearTempOut',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
					window.location="<?php echo $link; ?>&m=fbrgk";
				}
			});		
		}
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: '<?php echo $linkdata;?>',
				data: 'req=getTemp',
				cache: false,
				success: function(res){
					$('#infItem').html(res);
				}
			});		
		});
	</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-folder-open">   <label>PENGAJUAN BARANG</label></li>
			<a onclick="history.back();"><li class="fa fa-undo icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<div style="background:#ccc; padding:5px 5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
                  <td width="10%"><label>TANGGAL</label></td>
                    <td width="32%" align="left"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
                    <td width="24%">&nbsp;</td>
                  <td width="15%"><label>NO. PENGAJUAN</label></td>
                  <td width="19%" align="right"><input class="pasif" type="text" name="id" id="id" value="<?php echo kode_trx('dtpengajuan',$logid);?>" readonly="" /></td>
                </tr>
			</table>
		</div>
		<span id="infTemp"></span>
	  <div class="head_content" style="box-shadow:none;" >
	    <input name="button" type="button" onclick="addData()" value="Kirim" />
	  </div>	
	</div>
</div>