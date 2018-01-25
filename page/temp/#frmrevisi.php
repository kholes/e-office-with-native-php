<?php
$id=$_GET['id'];
$about=$mailint->getField('about',$id);
$message=$mailint->getField('message',$id);
$file01=$mailint->getField('file01',$id);
$file02=$mailint->getField('file02',$id);
$file03=$mailint->getField('file03',$id);
$file04=$mailint->getField('file04',$id);
$file05=$mailint->getField('file05',$id);
$ext01=$mailint->getField('ext01',$id);
$ext02=$mailint->getField('ext02',$id);
$ext03=$mailint->getField('ext03',$id);
$ext04=$mailint->getField('ext04',$id);
$ext05=$mailint->getField('ext05',$id);
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
	<div id="head">&raquo; REVISI SURAT INTERNAL</div>
		<form method="post" action="<?php echo $link; ?>&m=frev" enctype="multipart/form-data" id="email">
			<span id="infSender">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="frm">
				<tr>
					<td width="22%" class="frm">DARI</td>
					<td colspan="78%" class="frm"><?php echo $id;?>
						<input type="hidden" name="id" value="<?php echo $id;?>" />
						<input type="hidden" name="type" value="<?php echo $type;?>" />
						<input type="text" readonly="" style="background:none; border:none; width:100%" value="<?php echo $pegawai->getField('jabatan',$logid);?>">					</td>
					<input type="hidden" name="mfrom" id="dari" style="width:100%;" value="<?php echo $logid;?>">			
				</tr>
				<tr>
					<td width="22%">KEPADA</td>
			  	  <td width="758" colspan="4">
					<input type="text" name="mto" id="mto" style="width:100%" value="<?php //echo $mto;?>" /></td>						
				</tr>
				<tr>
					<td width="22%">PERIHAL</td>
				  	<td width="758" colspan="4"><input type="text" name="about" style="width:100%" id="about" value="<?php echo $about;?>" /></td>						
				</tr>
				<tr>
					<td class="frm">KETERANGAN</td>
					<td colspan="4"><textarea name="message" id="message" rows="3" style="width:100%"><?php echo $message;?></textarea></td>
				</tr>
				<tr>
					<td width="22%">FILE SURAT (DOC/PDF)</td>
				  <td width="758">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="29%"><input type="file" name="surat01[]" id="surat01[]" multiple="multiple" /></td>
							<td width="57%">
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
						    <input type="hidden" name="ext01" value="<?php echo $ext01;?>" /></td>
							<td width="14%"><?php if($file01!=''){?><input type="checkbox" name="ck01" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat02[]" id="surat02" multiple="multiple" /></td>
							<td><?php 
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
							  <input type="hidden" name="ext02" value="<?php echo $ext02;?>" /></td><td width="14%"><?php if($file02!=''){?><input type="checkbox" name="ck02" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat03[]" id="surat03" multiple="multiple" /></td>
							<td><?php 
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
							  <input type="hidden" name="ext03" value="<?php echo $ext03;?>" /></td><td width="14%"><?php if($file03!=''){?><input type="checkbox" name="ck03" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat04[]" id="surat04" multiple="multiple" /></td>
							<td><?php 
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
							<td width="14%"><?php if($file04!=''){?><input type="checkbox" name="ck04" /> Hapus<?php }?></td>
						  </tr>
						  <tr>
							<td><input type="file" name="surat05[]" id="surat01" multiple="multiple" /></td>
							<td><?php 
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
							<td width="14%"><?php if($file05!=''){?><input type="checkbox" name="ck05" /> Hapus<?php }?></td>
						  </tr>
				    </table>
				  </td>
				</tr>
			</table>
			</span>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="btn frm" colspan="2" align="right">
					<input type="button" name="Kembali" id="Kembali" class="btn" value="Kembali" onclick="self.history.back();" />&nbsp;
					<input type="button" name="kirim" id="kirim" class="btn" value="Kirim" onclick="cekForm();" /></td>				
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
	$noid=$logid.$date->format('YmdGis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile01 = count ($_FILES['surat01']['name']);   
	for ($i = 0; $i < $numfile01; $i++){
		$tmpsurat01 = $_FILES['surat01']['tmp_name'][$i];
		$surattype01 = $_FILES['surat01']['type'][$i];
		$suratsize01 = $_FILES['surat01']['size'][$i];
		$suratname01 = $_FILES['surat01']['name'][$i];
		$extsurat01 = getext($suratname01);
		$newsuratname01=$noid."_01".".".$extsurat01;
		$destsurat01= $path['dirname'] . '/draft/' . $newsuratname01;
	}
	$numfile02 = count ($_FILES['surat02']['name']);   
	for ($i = 0; $i < $numfile02; $i++){
		$tmpsurat02 = $_FILES['surat02']['tmp_name'][$i];
		$surattype02 = $_FILES['surat02']['type'][$i];
		$suratsize02 = $_FILES['surat02']['size'][$i];
		$suratname02 = $_FILES['surat02']['name'][$i];
		$extsurat02 = getext($suratname02);
		$newsuratname02=$noid."_02".".".$extsurat02;
		$destsurat02= $path['dirname'] . '/draft/' . $newsuratname02;
	}
	$numfile03 = count ($_FILES['surat03']['name']);   
	for ($i = 0; $i < $numfile03; $i++){
		$tmpsurat03 = $_FILES['surat03']['tmp_name'][$i];
		$surattype03 = $_FILES['surat03']['type'][$i];
		$suratsize03 = $_FILES['surat03']['size'][$i];
		$suratname03 = $_FILES['surat03']['name'][$i];
		$extsurat03 = getext($suratname03);
		$newsuratname03=$noid."_03".".".$extsurat03;
		$destsurat03= $path['dirname'] . '/draft/' . $newsuratname03;
	}
	$numfile04 = count ($_FILES['surat04']['name']);   
	for ($i = 0; $i < $numfile04; $i++){
		$tmpsurat04 = $_FILES['surat04']['tmp_name'][$i];
		$surattype04 = $_FILES['surat04']['type'][$i];
		$suratsize04 = $_FILES['surat04']['size'][$i];
		$suratname04 = $_FILES['surat04']['name'][$i];
		$extsurat04 = getext($suratname04);
		$newsuratname04=$noid."_04".".".$extsurat04;
		$destsurat04= $path['dirname'] . '/draft/' . $newsuratname04;
	}
	$numfile05 = count ($_FILES['surat05']['name']);   
	for ($i = 0; $i < $numfile05; $i++){
		$tmpsurat05 = $_FILES['surat05']['tmp_name'][$i];
		$surattype05 = $_FILES['surat05']['type'][$i];
		$suratsize05 = $_FILES['surat05']['size'][$i];
		$suratname05 = $_FILES['surat05']['name'][$i];
		$extsurat05 = getext($suratname05);
		$newsuratname05=$noid."_05".".".$extsurat05;
		$destsurat05= $path['dirname'] . '/draft/' . $newsuratname05;
	}
			if($extsurat01!=''){
				$oldmail01=$mailint->getField('file01',$id);
				if (file_exists($oldmail01)) { unlink ($oldmail01);}					
				$newsuratname01=$id."_01".".".$extsurat01;
				$destsurat01= $path['dirname'] . '/draft/' . $newsuratname01;
				move_uploaded_file($tmpsurat01, $_SERVER['DOCUMENT_ROOT'] . $destsurat01);
				$filesurat01='draft/'.$newsuratname01;
			}else{
				if($_POST['ck01']){
					$oldmail01=$mailint->getField('file01',$id);
					if (file_exists($oldmail01)) { unlink ($oldmail01);}					
					$filesurat01='';
					$extsurat01='';
				}else{
					$filesurat01=$_POST['file01'];
					$extsurat01=$_POST['ext01'];
				}
			}
			if($extsurat02!=''){
				$oldmail02=$mail->getField('mail_file02',$id);
				if (file_exists($oldmail02)) { unlink ($oldmail02);}					
				$newsuratname02=$id."_02".".".$extsurat02;
				$destsurat02= $path['dirname'] . '/draft/' . $newsuratname02;
				move_uploaded_file($tmpsurat02, $_SERVER['DOCUMENT_ROOT'] . $destsurat02);
				$filesurat02='draft/'.$newsuratname02;
			}else{
				if($_POST['ck02']){
					$oldmail02=$mailint->getField('file02',$id);
					if (file_exists($oldmail02)) { unlink ($oldmail02);}					
					$filesurat02='';
					$extsurat02='';
				}else{
					$filesurat02=$_POST['file02'];
					$extsurat02=$_POST['ext02'];
				}
			}
			if($extsurat03!=''){
				$oldmail03=$mail->getField('mail_file03',$id);
				if (file_exists($oldmail03)) { unlink ($oldmail03);}					
				$newsuratname03=$id."_03".".".$extsurat03;
				$destsurat03= $path['dirname'] . '/draft/' . $newsuratname03;
				move_uploaded_file($tmpsurat03, $_SERVER['DOCUMENT_ROOT'] . $destsurat03);
				$filesurat03='draft/'.$newsuratname03;
			}else{
				if($_POST['ck03']){
					$oldmail03=$mailint->getField('file03',$id);
					if (file_exists($oldmail03)) { unlink ($oldmail03);}					
					$filesurat03='';
					$extsurat03='';
				}else{
					$filesurat03=$_POST['file03'];
					$extsurat03=$_POST['ext03'];
				}
			}
			if($extsurat04!=''){
				$oldmail04=$mail->getField('mail_file04',$id);
				if (file_exists($oldmail04)) { unlink ($oldmail04);}					
				$newsuratname04=$id."_04".".".$extsurat04;
				$destsurat04= $path['dirname'] . '/draft/' . $newsuratname04;
				move_uploaded_file($tmpsurat04, $_SERVER['DOCUMENT_ROOT'] . $destsurat04);
				$filesurat04='draft/'.$newsuratname04;
			}else{
				if($_POST['ck04']){
					$oldmail01=$mailint->getField('file04',$id);
					if (file_exists($oldmail04)) { unlink ($oldmail04);}					
					$filesurat04='';
					$extsurat04='';
				}else{
					$filesurat04=$_POST['file04'];
					$extsurat04=$_POST['ext04'];
				}
			}
			if($extsurat05!=''){
				$oldmail05=$mail->getField('mail_file05',$id);
				if (file_exists($oldmail05)) { unlink ($oldmail05);}					
				$newsuratname05=$id."_05".".".$extsurat05;
				$destsurat05= $path['dirname'] . '/draft/' . $newsuratname05;
				move_uploaded_file($tmpsurat05, $_SERVER['DOCUMENT_ROOT'] . $destsurat05);
				$filesurat05='draft/'.$newsuratname05;
			}else{
				if($_POST['ck05']){
					$oldmail05=$mailint->getField('file05',$id);
					if (file_exists($oldmail05)) { unlink ($oldmail05);}					
					$filesurat05='';
					$extsurat05='';
				}else{
					$filesurat05=$_POST['file05'];
					$extsurat05=$_POST['ext05'];
				}
			}
			$mfrom=$_POST['mfrom'];
			$mto=substr($_POST['mto'],-3);
			$status='rev';
			$data=array('id'=>$id,'mfrom'=>$mfrom,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'file01'=>$filesurat01,'file02'=>$filesurat02,'file03'=>$filesurat03,'file04'=>$filesurat04,'file05'=>$filesurat05,'ext01'=>$extsurat01,'ext02'=>$extsurat02,'ext03'=>$extsurat03,'ext04'=>$extsurat04,'ext05'=>$extsurat05,'status'=>$status);
			//print_r($data);
			$mailint->updateData($id,$data);
			header("location:$link&m=int&type=in");
}
?>

