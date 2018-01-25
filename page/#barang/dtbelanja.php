<script>
function cetakrepin(id){
	var repin=null;
	if (repin==null){
		repin=open('page/barang/prnrepin.php?mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val(),'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
	}
}
$(document).ready(function(){
	$('#cek').click(function(){
		window.location='<?php echo $link;?>&m=rbrgm&cari&mtgl='+$('#mtgl').val()+'&htgl='+$('#htgl').val()+'';
	});
	$('#detail'+id).hide();
});
function viewDetail(id){
	$.ajax({
		type: 'POST',
		url: '<?php echo $trxinprc;?>',
		data: 'req=getDetail&id='+id+'',
		success: function(res){
			$('#detail'+id).fadeIn('slow').html(res);
		}
	});		
}
function viewHide(id){
	$('#detail'+id).fadeOut('slow');
}
</script>
<?php
if(isset($_GET['cari'])){
	$mtgl=$_GET['mtgl'];
	$htgl=$_GET['htgl'];
}else{
	$mtgl=$date->format('d-m-Y');;
	$htgl=$date->format('d-m-Y');;
}
?>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>LAPORAN</a></li>
				<li class="active">BELANJA BARANG </li>
			</ul>
		</h3>
		<div class="c10"></div>
		<?php
$data=$trxin->getRekapData($s,$i);
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <th width="14%" align="left"><a href="<?php echo $link;?>&m=rbrgm&cari&s=id&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO. TRANSAKSI</a></th>
    <th width="9%" align="left"><a href="<?php echo $link;?>&m=rbrgm&cari&s=tanggal&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TANGGAL</a></th>
    <th width="11%" align="left"><a href="<?php echo $link;?>&m=rbrgm&cari&s=nota&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">NO.NOTA</a></th>
    <th width="34%" align="left"><a href="<?php echo $link;?>&m=rbrgm&cari&s=suplayer&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TOKO / SUPLAYER</a></th>
    <th width="9%" align="center"><a href="<?php echo $link;?>&m=rbrgm&cari&s=total&i=<?php echo $i;?>&mtgl=<?php echo $mtgl;?>&htgl=<?php echo $htgl;?>">TOTAL (Rp) </a></th>
    <?php
	if ($data!=0){
		foreach($data as $row){	  	
	?>
	<tr onMouseOver="this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');">
    <td width="14%"><?php echo $row['id']; ?></td>
    <td width="9%"><?php echo getTanggal($row['tanggal']); ?></td>
    <td width="11%"><?php echo $row['nota']; ?></td>
    <td width="34%"><?php echo $toko->getField('nama',$row['suplayer']); ?></td>
    <td width="9%" align="right"><?php echo format_angka($row['total']); ?></td>
  </tr>
  <tr>
  	<td colspan="6" style="border:none; padding:0; margin:0;"><span id="detail<?php echo $row['id'];?>"></span></td>
  </tr>
	<?php
		}
	}	  
	?>
  	<th colspan="4" align="center"><h3>Total</h3></th>
	<th align="right"><h3><?php echo format_angka($trxin->getRekapTotal($r));?></h3></th>
</table>
<?php
}
?>
		<div class="head_content" style="box-shadow:none;" >&nbsp;
		<input type="button" name="cetak" id="cetak" value="Cetak" onClick="cetakrepin();">
		<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onClick="history.back();">
		<div style="clear:both;"></div>
</div>
</div>