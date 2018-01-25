<?php
session_start();
include "../lib/lib.php";
include "../class/user.cls.php";
include "../class/asettetaphis.cls.php";
include "../class/asettetap.cls.php";
$db=new Db();
$db->conDb();
$his=new Asettetaphis();
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
		<h2 class="l">PEMBAHARUAN ASET INVENTARIS </h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
	<div id="thick-frm">
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" id="MyForm">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
			<tr>
				<td width="392">Kode Aset </td>
				<td width="580">
					<input style="width:100%" type="text" name="kode" id="kode"  />
				</td>
			</tr>
			<tr>
				<td width="392">Tanggal </td>
				<td width="580">
					<input style="width:100%" type="text" class="tgl" name="tanggal" id="tanggal" onClick="return showCalendar('tanggal', 'dd-mm-y')"/>
				</td>
			</tr>
			<tr>
				<td width="392">Jenis Perubahan </td>
				<td width="580">
					<input style="width:100%" type="text" name="jenis" id="jenis"/>
				</td>
			</tr>
			<tr>
						  <td width="392">Nama Sparepart / Bahan </td>
						  <td width="580"><input style="width:100%" type="text" name="sparepart" id="sparepart"></td>
						</tr>
						<tr>
						  <td width="392">Biaya / Harga </td>
						  <td width="580"><input style="width:100%" type="text" name="harga" id="harga" value="<?php echo $his->getField('harga',$id); ?>"></td>
						</tr>
						<tr>
						  <td width="392">Status</td>
						  <td width="580"><select name="status" style="width:100%">
							<option value="<?php echo $his->getField('status',$id); ?>"><?php echo $his->getField('status',$id); ?></option>
							<option value="AKTIF">AKTIF</option>
							<option value="ASET TDAK BERMANFAAT">ASET TDAK BERMANFAAT</option>
							<option value="HAPUS">HAPUS</option>
						  </select></td>
						</tr>
						<tr>
						  <td width="392">Keterangan</td>
						  <td width="580"><input style="width:100%" type="text" name="keterangan" id="keterangan" >                      </td>
						</tr>
						<tr>
						  <td width="392">Nama Pelaksan</td>
						  <td width="580"><input style="width:100%" type="text" name="pelaksana" id="pelaksana">                      		</td>
						</tr>
					  </table>
					  <input type="hidden" name="btn" value="Simpan Pembaruan">
					</form>
		</div>
	</div>
	<div id="thick-bottom">
	  <div id="thick-menu"><span class="btn frm">
	  <input type="button" name="btn" onclick="<?php echo $btn; ?>" id="btn" value="Simpan" />
	    </span></div>
	</div>
</div>
