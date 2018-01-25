<?php 
include "../../lib/lib.php";
include "../../class/dtklasifikasi.cls.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$klas=new Dtklasifikasi();
$link='?p='.encrypt_url('surat');
$linkdata='page/surat/entrisuratdata.php';
$id=$_GET['id'];
if(!isset($id)){
	$val='Simpan';
	$btn='addKlas();';
}else{
	$val='Ubah';
	$btn='editKlas();';
}
?>
<link href="../../css/calendar.css" rel="stylesheet" type="text/css" />
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
function addKlas(){
$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=addKlas&id='+$('#nmr').val()+'&kategori='+$('#kategori').val()+'',cache :false,success:function (data){ window.location='<?php echo $link;?>&get=klasi';}});
}
function editKlas(){
$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=editKlas&id='+$('#nmr').val()+'&kategori='+$('#kategori').val()+'',cache :false,success:function (data){ window.location='<?php echo $link;?>&get=klasi';}});
}
function hapusKlas(){
$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=hapusKlas&id='+$('#nmr').val()+'&kategori='+$('#kategori').val()+'',cache :false,success:function (data){ window.location='<?php echo $link;?>&get=klasi';}});
}
function viewDetail(id){
window.location='<?php echo $link; ?>&get=klasi&ide='+id;
}
function newKlas(){
$('#nmr').val('');
$('#kategori').val('');
$('#nmr').focus();
}
$(document).ready(function(){
$('#batal').click(function(){
tb_remove();
});
});
</script>
<body>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">KLASIFIKASI SURAT</h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
	  <div id="thick-frm">
				<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
					<tr>
						<td width="21%" class="frm">Nomor</td>
						<td width="75%" class="frm"><input type="text" name="nmr" id="nmr"  style="width:30%;"  value="<?php echo $id;?>"/></td>
						<td width="4%" class="frm">&nbsp;</td>
					</tr>
					<tr>
						<td class="frm">Klasifikasi Surat</td>
						<td class="frm"><input type="text" name="kategori" id="kategori"  style="width:100%;" value="<?php echo $klas->getField('klasifikasi',$id);?>"  /></td>
						<td class="frm">&nbsp;</td>
					</tr>
				</table>
	  </div>
	</div>
	<div id="thick-bottom">
		<div id="thick-menu">
			<input type="button" onClick="hapusKlas();" value="Hapus">
			<input type="button" onClick="<?php echo $btn;?>" value="<?php echo $val;?>">
		</div>
	</div>
</div>
</body>