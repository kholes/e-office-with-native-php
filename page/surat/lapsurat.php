<script>
	$(document).ready(function(){
		getData();	
	});
	function getPropertis(id,tb){
		$.ajax({
			type:'post',url:'<?php echo $prcdata; ?>',data:'btn=getPropertis&id='+id+'&tb='+tb,cache :false,success:function (data){
				$('#detail'+id).show().html(data);
			}
		});
	}
	function getData(){
		$.ajax({
			type: 'POST',
			url:'<?php echo $prcdata;?>',
			data: 'btn=getData&data='+$('#data').val()+'&transaksi='+$('#transaksi').val()+'&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val(),
			success: function(data){
				$('#infData').html(data);
			}
		});		
	}
	function prn_report(){
		var prn_rep=null;
		if (prn_rep==null){
			prn_rep=open('page/surat/prn_report.php?s=<?php echo $_GET['s'];?>&i=<?php echo $_GET['i'];?>&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val(),'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	function prn_disposisi(id){
		var prn_dis=null;
		if (prn_dis==null){
			prn_dis=open('page/surat/prn_disposisi.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=900,height=600');
		}
	}
	function prn_history(id){
		var prn_dis=null;
		if (prn_dis==null){
			prn_dis=open('page/surat/prn_history.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=900,height=600');
		}
	}
	function getReport(){
		window.location='<?php echo $link; ?>&m=report&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val()+'';
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>TRANSAKSI SURAT</a></li>
			</ul>
		</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">
		<form method="post" action="<?php echo $link; ?>&m=fint" enctype="multipart/form-data" id="email">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="107"><p style="font-weight:bold">Data Surat </p></td>
			  	  <td width="197">
				  <select name="data" id="data">
				  	<option value="External">External</option>
				  	<option value="Internal">Internal</option>
				  </select>
				  </td>	
				  <td width="245">&nbsp;</td>					
				  <td width="125"><p style="font-weight:bold">Mulai Tanggal</p></td>					
				  <td width="146" align="right">
				  <input type="text" name="mtgl" id="mtgl" onclick="return showCalendar('mtgl', 'dd-mm-y')" value="<?php echo $date->format('d-m-Y');?>" />
				  </td>					
				</tr>
				<tr>
				  <td width="107"><p style="font-weight:bold">Transaksi</p></td>
				  	<td width="197">
					<select name="transaksi" id="transaksi">
                      <option value="Surat Masuk">Surat Masuk</option>
                      <option value="Surat Keluar">Surat Keluar</option>
                    </select>
					</td>						
					<td>&nbsp;</td>					
					<td><p style="font-weight:bold">Sampai Tanggal</p></td>					
					<td align="right">
					<input type="text" name="stgl" id="stgl" onclick="return showCalendar('stgl', 'dd-mm-y')" value="<?php echo $date->format('d-m-Y');?>"/>					
					</td>					
				</tr>
			</table>
			<div class="head_content" style="box-shadow:none; text-align:right">&nbsp;
				<input type="button" name="btn" value="Tampilkan" onclick="getData();" />
			</div>
		</form>
		</div>
		<div id="infData"></div>
	</div>
</div>
