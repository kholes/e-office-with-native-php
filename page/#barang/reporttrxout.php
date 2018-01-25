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
	function cetakrep(id){
		var repout=null;
		if (repout==null){
			repout=open('page/barang/prnrepout.php?mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val(),'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	$(document).ready(function(){
		$('#cek').click(function(){
			window.location='<?php echo $link;?>&m=rbrgk&cari&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'';
		});
	});
	function viewDetail(id){
		$.ajax({
			type: 'POST',
			url: '<?php echo $trxoutprc;?>',
			data: 'req=getDetail&id='+id+'',
			success: function(res){
				$('#detail'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#detail'+id).fadeOut('slow');
	}
	function prnOrder(id){
		var order=null;
		if (order==null){
			order=open('page/barang/prnorder.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=850,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>LAPORAN</a></li>
				<li class="active">BARANG KELUAR</li>
			</ul>
		</h3>
		<div class="c10"></div>
		<div style="background:#ccc; padding:5px 5px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="6%"><label>Tanggal </label></td>
				<td width="17%">
				<input type="text" class="mtgl" name="mtgl" id="mtgl" value="<?php echo $mtgl;?>"  onClick="return showCalendar('mtgl', 'dd-mm-y')"/>
				</td>
			  <td width="2%" align="center"><label>s/d</label></td>
			  <td width="17%">
			  <input type="text" class="htgl" name="htgl" id="htgl" value="<?php echo $htgl; ?>"  onClick="return showCalendar('htgl', 'dd-mm-y')"/>
			  </td>
			  <td width="58%" align="left"><input type="button" name="cari" id="cek" value="Cek" />
			  </td>
			</tr>
		</table>
		</div>
<?php
$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
$data=$trxout->getRekap($r,$s,$i);
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<style>
.btn{font-size:14px; color:#770000; font-weight:bold;}
.btn:hover{color:#FF0000;}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <th width="3%" align="center">NO</th>
    <th width="15%" align="left" style="padding:7px 0 7px 10px;"><a href="<?php echo $link;?>&m=rbrgk&cari&s=id&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO. TRANSAKSI</a></th>
    <th width="19%" align="left" style="padding:7px 0 7px 10px;"><a href="<?php echo $link;?>&m=rbrgk&cari&s=tanggal&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TANGGAL</a></th>
    <th width="49%" align="left" style="padding:7px 0 7px 10px;"><a href="<?php echo $link;?>&m=rbrgk&cari&s=id_pegawai&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">PENGGUNA BARANG </a></th>
	<th width="14%">&nbsp;</th>
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
	<tr onMouseOver="this.style.cursor='pointer';">
    <td width="3%" align="center"><?php echo $c=$c+1;?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="15%"><?php echo $row['id']; ?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="19%"><?php echo getTanggal($row['tanggal']); ?></td>
    <td onClick="viewDetail('<?php echo $row['id'];?>');" width="49%"><?php echo $pegawai->getField('bagian',$row['pemohon']); ?></td>
	<td align="right"><a class="btn" onclick="prnOrder('<?php echo $row['id'];?>');">Cetak</a></td>
  </tr>
  <tr>
  	<td style="border:none; padding:0; margin:0;">&nbsp;</td>
  	<td colspan="4" style="border:none; padding:0; margin:0;"><span id="detail<?php echo $row['id'];?>"></span></td>
  </tr>
	<?php
		}
	}	  
	?>
</table>
<?php
}else{ 
	echo "<p class='pesan'>Tidak ada transaksi.</p>"; 
}
?>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="cetakrep();">
		<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onclick="history.back();">
		<div style="clear:both;"></div>
</div>
</div>