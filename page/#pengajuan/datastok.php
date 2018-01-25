<script>
	$(document).ready(function(){
		$('#key').keypress(function(e){
			if(e.keyCode==13){cari();}		
		});
	});
	function cari(){
		window.location="<?php echo $link;?>&m=ds&c="+$('#key').val()+"&s=<?php echo $s;?>&i=<?php echo $s;?>";
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
		var qty = prompt("Masukan Jumlah Barang", "1");
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
							window.location="<?php echo $link;?>&m=fp";
						}
					});	
				}
			}
		}
</script>
<div class="p-wrapper">
	<div class="content">
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>PENGAJUAN</a></li>
				<li class="active">DATA BARANG</li>
			</ul>
		</h3>
		<div class="c10"></div>
		<div style="background:#ccc; padding:5px 5px;">
			<input type="button" name="cari" value="Cari" onclick="cari();" />
			<input type="text" class="cri" name="key" id="key" value="<?php echo $_GET['c'];?>" style="width:200px;">
		</div>
		<div class="c10"></div>
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
<div style="display:block;height:300px; overflow:auto;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
		<th width="14%" align="left"><a href="<?php echo $link;?>&m=ds&s=barcode&i=<?php echo $i;?>">KODE BARANG</a></th>
		<th width="32%" align="left"><a href="<?php echo $link;?>&m=ds&s=nama&i=<?php echo $i;?>">NAMA BARANG</a></th>
		<th width="20%" align="left"><a href="<?php echo $link;?>&m=ds&s=merek&i=<?php echo $i;?>">MEREK</a></th>
		<th width="19%" align="center"><a href="<?php echo $link;?>&m=ds&s=stok&i=<?php echo $i;?>">JUMLAH STOK</a></th>
		<th width="15%" align="center"><a href="<?php echo $link;?>&m=ds&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
		<?php
		foreach($sql as $row){
		?>
		<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>','<?php echo $row['stok'];?>');"  onMouseOut="this.style.background='#fff';">
			<td width="14%"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
			<td width="32%"><?php echo $row['nama'];?></td>
			<td width="20%"><?php echo $merek->getField('merek',$row['merek']);?></td>
			<td width="19%" align="center"><?php echo $row['stok'];?></td>
			<td width="15%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<?php
}
?>
	<div class="head_content" style="box-shadow:none;" >&nbsp;
	<input type="button" name="kembai" id="kembali" value="Kembali" style="float:right" onclick="history.back();">
	<div style="clear:both;"></div>
	</div>	
</div>
</div>
<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
</script>
