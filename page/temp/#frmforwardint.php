<?php
$id=$_GET['id'];
$file01=$mailint->getField('file01',$id);
$ext01=$mailint->getField('ext01',$id);
$name01=substr(substr(substr(substr($file01,6),0,-strlen($ext01)),0,-1),0,-20);
$file02=$mailint->getField('file02',$id);
$ext02=$mailint->getField('ext02',$id);
$name02=substr(substr(substr(substr($file02,6),0,-strlen($ext02)),0,-1),0,-20);
$file03=$mailint->getField('file03',$id);
$ext03=$mailint->getField('ext03',$id);
$name03=substr(substr(substr(substr($file03,6),0,-strlen($ext03)),0,-1),0,-20);
$file04=$mailint->getField('file04',$id);
$ext04=$mailint->getField('ext04',$id);
$name04=substr(substr(substr(substr($file04,6),0,-strlen($ext04)),0,-1),0,-20);
$file05=$mailint->getField('file05',$id);
$ext05=$mailint->getField('ext05',$id);
$name05=substr(substr(substr(substr($file05,6),0,-strlen($ext05)),0,-1),0,-20);
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
	<div class="head_content">&raquo; MENERUSKAN SURAT</div>
		<form method="post" action="<?php echo $link; ?>&m=ffwdint" enctype="multipart/form-data" id="email">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="frm">
            <?php echo $opsi;?>
            <tr>
              <td width="22%" style="vertical-align:top"><p style="font-weight:bold;">DARI</p></td>
              <td colspan="78%">
			  <input type="hidden" name="id" value="<?php echo $id;?>" />
              <input name="text" type="text" style="background:none; border:none; width:100%" value="<?php echo $pegawai->getField('jabatan',$logid);?>" readonly="">
              </td>
              <input type="hidden" name="mfrom" id="dari" style="width:100%;" value="<?php echo $logid;?>">
            </tr>
            <tr>
              <td width="22%" style="vertical-align:top"><p style="font-weight:bold;">KEPADA</p></td>
              <td width="758" colspan="4"><input type="text" name="mto" id="mto" style="width:100%" value="<?php //echo $mto;?>" /></td>
            </tr>
            <tr>
              <td width="22%" style="vertical-align:top"><p style="font-weight:bold;">PERIHAL</p></td>
              <td width="758" colspan="4"><input type="text" name="about" style="width:100%" id="about" value="<?php echo $mailint->getField('about',$id);?>" /></td>
            </tr>
            <tr>
              <td style="vertical-align:top"><p style="font-weight:bold;">KETERANGAN</p></td>
              <td colspan="4"><textarea name="message" id="message" rows="3" style="width:100%"><?php echo $mailint->getField('message',$id);?></textarea></td>
            </tr>
				<tr>
				  <td width="22%" style="vertical-align:top"><p style="font-weight:bold">FILE SURAT (DOC/PDF)</p></td>
				  <td width="758">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="38%"><input type="file" name="surat01[]" id="surat01[]" multiple="multiple" /></td>
							<td width="4%" style="vertical-align:middle">
							<?php 
							switch($ext01){
								case 'pdf':
									echo "<a href='".$file01."' target='_blank'><img src='img/pdf-icon.png'/></a>";
								break;
								case 'xls':
									echo "<a href='".$file01."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'xlsx':
									echo "<a href='".$file01."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'doc':
									echo "<a href='".$file01."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
								case 'docx':
									echo "<a href='".$file01."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
							}
							?>
						    <input type="hidden" name="file01" value="<?php echo $file01;?>" />
						    <input type="hidden" name="ext01" value="<?php echo $ext01;?>" />
							</td>
							<td width="47%"><?php echo $name01.".".$ext01;?></td>
							<td width="11%"><?php if($file01!=''){?>
						    <input type="checkbox" name="ck01" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat02[]" id="surat02" multiple="multiple" /></td>
							<td style="vertical-align:middle"><?php 
							switch($ext02){
								case 'pdf':
									echo "<a href='".$file02."' target='_blank'><img src='img/pdf-icon.png'/></a>";
								break;
								case 'xls':
									echo "<a href='".$file02."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'xlsx':
									echo "<a href='".$file02."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'doc':
									echo "<a href='".$file02."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
								case 'docx':
									echo "<a href='".$file02."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
							}
							?>
							  <input type="hidden" name="file02" value="<?php echo $file02;?>" />
							  <input type="hidden" name="ext02" value="<?php echo $ext02;?>" />
							  </td>
							<td><?php echo $name02.".".$ext02;?></td>
							  <td width="11%"><?php if($file02!=''){?>
							    <input type="checkbox" name="ck02" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat03[]" id="surat03" multiple="multiple" /></td>
							<td style="vertical-align:middle"><?php 
							switch($ext03){
								case 'pdf':
									echo "<a href='".$file03."' target='_blank'><img src='img/pdf-icon.png'/></a>";
								break;
								case 'xls':
									echo "<a href='".$file03."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'xlsx':
									echo "<a href='".$file03."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'doc':
									echo "<a href='".$file03."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
								case 'docx':
									echo "<a href='".$file03."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
							}
							?>
							  <input type="hidden" name="file03" value="<?php echo $file03;?>" />
							  <input type="hidden" name="ext03" value="<?php echo $ext03;?>" /></td>
							<td><?php echo $name03.".".$ext03;?></td>
							  <td width="11%"><?php if($file03!=''){?>
							    <input type="checkbox" name="ck03" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat04[]" id="surat04" multiple="multiple" /></td>
							<td style="vertical-align:middle"><?php 
							switch($ext04){
								case 'pdf':
									echo "<a href='".$file04."' target='_blank'><img src='img/pdf-icon.png'/></a>";
								break;
								case 'xls':
									echo "<a href='".$file04."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'xlsx':
									echo "<a href='".$file04."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'doc':
									echo "<a href='".$file04."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
								case 'docx':
									echo "<a href='".$file04."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
							}
							?>
							  <input type="hidden" name="file04" value="<?php echo $file04;?>" />
						    <input type="hidden" name="ext04" value="<?php echo $ext04;?>" /></td>
							<td><?php echo $name04.".".$ext04;?></td>
							<td width="11%"><?php if($file04!=''){?>
						    <input type="checkbox" name="ck04" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat05[]" id="surat01" multiple="multiple" /></td>
							<td style="vertical-align:middle"><?php 
							switch($ext05){
								case 'pdf':
									echo "<a href='".$file05."' target='_blank'><img src='img/pdf-icon.png'/></a>";
								break;
								case 'xls':
									echo "<a href='".$file05."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'xlsx':
									echo "<a href='".$file05."' target='_blank'><img src='img/xls-icon.png'/></a>";
								break;
								case 'doc':
									echo "<a href='".$file05."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
								case 'docx':
									echo "<a href='".$file05."' target='_blank'><img src='img/doc-icon.png'/></a>";
								break;
							}
							?>
							  <input type="hidden" name="file05" value="<?php echo $file05;?>" />
						    <input type="hidden" name="ext05" value="<?php echo $ext05;?>" /></td>
							<td><?php echo $name05.".".$ext05;?></td>
							<td width="11%"><?php if($file05!=''){?>
						    <input type="checkbox" name="ck05" /> Hapus<?php }?></td>
						  </tr>
				    </table>
				  </td>
				</tr>          </table>
		  <table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="btn frm" colspan="2" align="right">
					<input type="hidden" name="btn" value="<?php echo $btn;?>">
					<input type="button" name="Kembali" id="Kembali" class="btn" value="Kembali" onclick="self.history.back();" />&nbsp;<input type="button" name="kirim" id="kirim" class="btn" value="Kirim" onclick="cekForm();" /></td>				
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
	$status='new';
	$data=array('id'=>$id,'tgl_fwd'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$mfrom,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'status'=>$status);
	//print_r($data);
	//$mailint->forwardData($id,$data);
	//header("location:$link&m=int&type=out");
	print_r($data);
}
?>

