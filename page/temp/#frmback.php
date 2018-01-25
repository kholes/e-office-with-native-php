<?php
$id=$_GET['id'];
?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		$("#mto").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
		//$('#kirim').click(function(){$('#email').submit();});
	});
	function cekForm(){
		var mto=$('#mto').val();
		if(mto==''){
			alert("Ma'af tujuan masih kosong, tujuan harus diisi untuk langsung dikirimkan.");
			$('#mto').focus();
			return;
		}else{
			$('#email').submit();
		}
	}
	function getId(){
		var data=$('#mto').val();
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getId&data='+data,
			cache :false,
			success:function (res){
				var ob=eval(res);
				$('#idmto').val(ob[0]);
				if(ob[3]!='STF'){$('#mto').val(ob[1]);}else{$('#mto').val(ob[2]);}
				$('#about').focus();
			}
		});
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div id="head">&raquo; KEMBALIKAN SURAT INTERNAL </div>
		<form method="post" action="<?php echo $link; ?>&m=ffwdint" enctype="multipart/form-data" id="email">
		  <span id="infSender">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="frm">
            <?php echo $opsi;?>
            <tr>
              <td width="22%" class="frm">DARI</td>
              <td colspan="78%" class="frm">
			  <input type="hidden" name="id" value="<?php echo $id;?>" />
              <input name="text" type="text" style="background:none; border:none; width:100%" value="<?php echo $pegawai->getField('jabatan',$logid);?>" readonly="">
              </td>
              <input type="hidden" name="mfrom" id="dari" style="width:100%;" value="<?php echo $logid;?>">
            </tr>
            <tr>
              <td width="22%">KEPADA</td>
              <td width="758" colspan="4"><input type="text" name="mto" id="mto" style="width:100%" value="<?php //echo $mto;?>" /></td>
            </tr>
            <tr>
              <td width="22%">PERIHAL</td>
              <td width="758" colspan="4"><input type="text" name="about" style="width:100%" id="about" value="<?php echo $mailint->getField('about',$id);?>" /></td>
            </tr>
            <tr>
              <td class="frm">KETERANGAN</td>
              <td colspan="4"><textarea name="message" id="message" rows="3" style="width:100%"><?php echo $mailint->getField('message',$id);?></textarea></td>
            </tr>
          </table>
		  </span>
		  <table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="btn frm" colspan="2" align="right">
					<input type="hidden" name="btn" value="<?php echo $btn;?>">
					<input type="button" name="Kembali" id="Kembali" class="btn" value="Kembali" onClick="self.history.back();" />&nbsp;<input type="button" name="kirim" id="kirim" class="btn" value="Kirim" onClick="cekForm();" /></td>				
				</tr>
		  </table>
		</form>
	</div>
</div>
<script>
$('#mto').keypress(function(e){
	if(e.keyCode==13){
		$('#about').focus()
	}
});
$('#about').keypress(function(e){
	if(e.keyCode==13){
		$('#message').focus()
	}
});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$mfrom=$_POST['mfrom'];
	$mto=substr($_POST['mto'],-3);
	$status='rev';
	$data=array('id'=>$id,'mfrom'=>$mfrom,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'status'=>$status);
	$mailint->forwardData($id,$data);
	header("location:$link&m=int&type=out");
}
?>

