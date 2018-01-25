<?php
if(isset($_GET['cari'])){
	$mtgl=$_GET['mtgl'];
	$htgl=$_GET['htgl'];
}else{
	$mtgl=$date->format('d-m-Y');;
	$htgl=$date->format('d-m-Y');;
}
?>
<script>
	function prev_barang(){
		var print_stockopname=null;
		if (print_stockopname==null){
			print_stockopname=open('page/barang/barang_stockopname_prn.php?mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-check-square-o">   <label>STOCK OPNAME</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<div style="background:#ccc; padding:5px 5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="7%"><label>Tanggal </label></td>
				  <td width="15%"><input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $mtgl;?>"  onclick="return showCalendar('mtgl', 'dd-mm-y')"/></td>
				  <td width="4%" align="center"><label>s/d</label></td>
				  <td width="15%"><input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $htgl; ?>"  onclick="return showCalendar('htgl', 'dd-mm-y')"/></td>
				  <td width="59%" align="left"><input type="button" name="cari" id="cek" value="Cek" onclick="view_data();" />
				  </td>
				</tr>
			</table>
		</div>
		<div id="inf_view"></div>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="prev_barang();">
	</div>
</div>
<script>
	function view_data(){
		$.ajax({
			type: 'POST',
			url: '<?php echo $barangprc;?>',
			data: 'req=view_data&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'',
			success: function(data){
				$('#inf_view').html(data);
			}
		});		
	}
	view_data();
</script>