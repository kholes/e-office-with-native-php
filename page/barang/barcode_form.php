<?php
$linkdata='page/barang/barcodeprc.php';
?>
<script>
	$(document).ready(function(){
		getBrg();
		getTemp();
		$('#add').click(function(){addTemp();});
	});
	function prn(){
		var prnbarkode=null;
		if (prnbarkode==null){
			prnbarkode=open('page/barang/barcode_print.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=750,height=600');
		}
	}
	function getBrg(){
		$.ajax({
			type: 'POST',
			url: '<?php echo $linkdata;?>',
			data: 'btn=getBrg&kategori='+$("#kategori").val(),
			cache: false,
			success: function(data){
				$('#infBrg').html(data);
			}
		});		
	}
	function getTemp(){
		$.ajax({
			type: 'POST',
			url: '<?php echo $linkdata;?>',
			data: 'btn=getTemp',
			cache: false,
			success: function(data){
				$('#infTemp').html(data);
			}
		});		
	}
	function addTemp(){
		$.ajax({
			type: 'POST',
			url: '<?php echo $linkdata;?>',
			data: 'btn=addTemp&id_brg='+$('#brg').val()+'&qty='+$('#qty').val(),
			cache: false,
			success: function(data){
				getTemp();
			}
		});			
	}
	function editTemp(id){
		$.ajax({
			type: 'POST',
			url: '<?php echo $linkdata;?>',
			data: 'btn=editTemp&id_brg='+id+'&qty='+$('#qty'+id).val(),
			cache: false,
			success: function(data){
				getTemp();
			}
		});			
	}
	function delTemp(id){
		$.ajax({
			type: 'POST',
			url: '<?php echo $linkdata;?>',
			data: 'btn=delTemp&id_brg='+id,
			cache: false,
			success: function(data){
				getTemp();
			}
		});				
	}
</script>
<?php
	$ide=$_GET['id_brg'];
	$qtye=$_GET['qty'];
?>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-barcode">   <label>CETAK BARCODE</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
	  <tr>
		<td width="150"><label>Kategori Barang</label></td>
		<td width="651">
		<?php
		$x=$dtkategori->getAll();
		echo "<select name='kategori' id='kategori' onChange='getBrg();'>";
		foreach($x as $row){
			echo "<option value='$row[id]'>$row[kategori]</option>";
		}
		echo "</select>";
		?>		</td>
	  </tr>
	  <tr>
		<td><label>Nama Barang</label></td>
		<td><span id="infBrg"></span></td>
	  </tr>
	  <tr>
		<td><label>Jumlah Cetak</label></td>
		<td>
			<input type="text" name="qty" id="qty" value="" style="width:20px;">
			<input type="button" name="add" id="add" value="Tambah" />
	    </td>
	  </tr>
	</table>
	<div class="c10"></div>
	<div id="infTemp"></div>
	<div class="head_content" style="box-shadow:none;" >&nbsp;
	  <input type="button" name="prn" id="prn" onclick="prn();" value="Cetak Barcode" style="float:right" />
	<div style="clear:both;"></div>
	</div>
</div>	
</div>