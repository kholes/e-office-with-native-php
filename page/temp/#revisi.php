<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/suratkeluar.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$suratkeluar=new Suratkeluar();
$user=new User();
$peg=new Pegawai();
$logid=decrypt_url($_SESSION['id_user']);
$id=$_GET['id'];
?>
<head>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
	$('#kirim').click(function(){
		$.ajax({
			type:'post',
			url:'page/surat/mailprc.php',
			data:'btn=revisi&id=<?php echo $_GET['id'];?>&keterangan='+$('#keterangan').val(),
			cache:false,
				success:function(data){
					window.location.reload();
					tb_remove();
			}
		});
	});
</script>


<div id="thick-wrapper">
<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">Revisi Surat Keluar</h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
		<div id="thick-frm">
		<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
			<tr>
				<td><p style="font-weight:bold">Tujuan</p></td>
				<td><?php echo $suratkeluar->getField('tujuan',$id);?></td>
			</tr>
			<tr>
				<td><p style="font-weight:bold">Ringkasan/Uraian</p></td>
				<td><?php echo $suratkeluar->getField('uraian',$id);?></td>
			</tr>
			<tr>
				<td width="25%" valign="top"><p style="font-weight:bold">Instruksi Revisi</p></td>
				<td width="75%" class="detail" style="border:none;">
					<textarea name="keterangan" id="keterangan" style=" width:100%;height:150px;"><?php echo $suratkeluar->getField('keterangan',$id);?></textarea>
				</td>
			</tr>
		</table>
		</div>
	</div>
	<div id="thick-bottom">
		<div id="thick-menu">
		<input type="button" name="kirim" class="btn" id="kirim" value="Kirim">
		</div>
	</div>
</form>
</div>
</body>