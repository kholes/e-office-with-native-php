<script>
	$(document).ready(function(){
		$('#key').keypress(function(e){
			if(e.keyCode==13){cari();}		
		});
	});
	function cari(){
		window.location="<?php echo $link;?>&m=pengajuanref&c="+$('#key').val()+"&s=<?php echo $s;?>&i=<?php echo $s;?>";
	}
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'req=viewStokOut',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
				$('#key').focus();
			}
		});
	});
	function sendData(id,stok){
		var stok=$('#stok'+id).val();
		if(stok<1){alert ("Stok barang kosong!");return;}
		var qty = prompt("Masukan Jumlah Barang", "1");
		//if(parseInt(qty) >= parseInt(stok)){alert("Permintaan anda "+qty+", terlalu banyak, jumlah stok "+stok+" tidak cukup!");return;}
			if(qty!=null){
				if (parseInt(qty) > parseInt(stok)) {
					alert("Jumlah stok tidak cukup");
					$("#barcode").val('');
					return;
				}else{
					$.ajax({
						type:'post',
						url:'<?php echo $linkdata;?>',
						data:'req=addTemp&id='+id+'&qty='+qty,
						cache :false,
						success:function (data){
							window.location="<?php echo $link;?>&m=pengajuanform";
						}
					});	
				}
			}
		}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-folder-open">   <label>DATA BARANG</label></li>
			<a onclick="history.back();"><li class="fa fa-undo icon-small" style="float:right"></li></a>
			<li style="float:right;"><input type="text" class="cri" name="key" id="key" value="<?php echo $_GET['c'];?>" style="width:200px;"></li>
		</div>
		<div class="c"></div>
		
<?php
$c=$_GET['c'];
if(!isset($c)){
	$sql=$dtbarang->getAll($s,$i);
}else{
	$sql=$dtbarang->getLike($c,$s,$i);
}
if ($sql!=array()){
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <th width="31%" align="left">NAMA BARANG</th>
    <th width="33%" align="left">MEREK</th>
    <th width="15%" align="center">SATUAN</th>
    <th width="6%" align="center">STOK</th>
  </tr>
</table>
<div style="display:block;height:300px; overflow:auto;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <?php
					foreach($sql as $row){
					?>
    <tr style="border-bottom:1px solid #ccc" onmouseover="this.style.background='#ccc';this.style.cursor='pointer';" onclick="sendData('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
      <td width="31%"><?php echo $dtbarang->getField('nama',$row['id']);?></td>
      <td width="33%"><?php echo $merek->getField('merek',$row['merek']);?></td>
      <td width="15%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
      <td width="6%" align="center"><?php 				
						$x=$barangmasuk->get_total_trx($row['id']);
						$y=$barangkeluar->get_total_trx($row['id']);
						$sisa_stok=$x-$y;
						?>
          <input name="text" type="text" disabled="disabled" id="stok<?php echo $row['id'];?>" style="background:#fff; border:none; text-align:center; width:20px;" value="<?php echo $sisa_stok;?>" />
      </td>
    </tr>
    <?php
					}
					?>
  </table>
</div>

<?php
}
?>
</div>
</div>
<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
