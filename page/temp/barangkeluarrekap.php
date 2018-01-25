<script>
$(document).ready(function(){ 
	$('#cari').keydown(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'btn=Cari&cari='+$('#cari').val(),
			cache:false,
			success:function(data){
				$('#p-main').html(data);
			}
		});
	});
});
$(document).ready(function(){ 
	$('#view').click(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'btn=getRekap&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val(),
			cache:false,
			success:function(data){
				$('#p-main').html(data);
			}
		});
	});
});
</script>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
		<div class="p-head">
			<div class="p-head-c">
				<div id="right">
					Cari &raquo;
					<input type="text" name="cari" id="cari">
				</div>
				<div id="left">
					<?php include 'barangkeluarmenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<form id="p-frm">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="9%">Mulai </td>
			<td width="15%"><input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('mtgl', 'dd-mm-y')"/></td>
			<td width="2%">s/d</td>
			<td width="15%"><input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('htgl', 'dd-mm-y')"/></td>
			<td width="59%"><input type="button" id="view" value="Cari Data"></td>
		  </tr>
		</table>
		</form>
		<div id="p-main">
		</div>
	</div>
</body>
