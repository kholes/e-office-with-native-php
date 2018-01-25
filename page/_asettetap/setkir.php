<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$id=$_GET['id'];
if(!isset($id)){
	$val='Simpan';
	$btn='addKlas();';
}else{
	$val='Ubah';
	$btn='editKlas();';
}
?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		$("#kode").autocomplete("asettetap.php", {
			selectFirst: true
		});
	});
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
	$(document).ready(function(){
		$('#btn').click(function(){
			if($('#kode').val()==''){
				alert('ID aset tidak boleh kosong');return;
			}
			$('#MyForm').submit();
		});
	});
		$(document).ready(function(){
			$("#kode").autocomplete("page/asettetap.php", {
				selectFirst: true
			});
		});
		function hapus(id){
			$.ajax({
				type:'post',
				url:'<?php echo $link; ?>',
				data:'btn=Hapus&id='+id+'',
				beforeSend: function(data){$("#load").fadeIn(1000,0).html('<img src="img/spinner.gif">Proses...')},	
				cache :false,
				success:function (data){
					$('#load').fadeOut('slow');
					location.reload();
					$('#inf').html(data);	
				}
			});
		}
		function clearPage(){
			document.getElementById('kode').focus();
		}
		function submitForm(){
			document.getElementById("hisTrx").submit();
		}
	</script>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">SET. KIR </h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
	<div id="thick-frm">
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" id="MyForm">
			<table border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
			  <tr>
				<td>UNIT KERJA </td>
				<td><input type="text" name="unit" value="KANTOR PENGHUBUNG"></td>
			  </tr>
			  <tr>
				<td width="19%">SUB-SUB UNIT BIDANG </td>
				<td width="20%"><input type="text" name="bidang" ></td>
			  </tr>
			  <tr>
				<td>NAMA RUANGAN </td>
				<td><input type="text" name="ruangan"></td>
			  </tr>
			  <tr>
				<td>KODE LOKASI</td>
				<td><input type="text" name="lokasi"></td>
			  </tr>
			</table>
	  </form>
	  </div>
	</div>
	<div id="thick-bottom">
	  <div id="thick-menu"><span class="btn frm">
	  <input type="button" name="btn" onClick="<?php echo $btn; ?>" id="btn" value="Simpan" />
	    </span></div>
	</div>
</div>
