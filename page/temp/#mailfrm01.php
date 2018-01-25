<?php 
$id=$_GET['id'];
if(isset($_GET['type'])){$type=$_GET['type'];}else{$type='new';}
$file=$mail->getField('mail_file',$id);
switch($type){
	case 'rev':
		$idmto=$mail->getField('mfrom',$id);
		$mto=$pegawai->getField('nama',$idmto);
		$content=$mail->getField('content',$id);
		$mail_to=$mail->getField('mail_to',$id);
		$mail_from=$mail->getField('mail_from',$id);
		$mail_about=$mail->getField('mail_about',$id);
		$mail_file01=$mail->getField('mail_file01',$id);
		$mail_file02=$mail->getField('mail_file02',$id);
		$mail_file03=$mail->getField('mail_file03',$id);
		$mail_file04=$mail->getField('mail_file04',$id);
		$mail_file05=$mail->getField('mail_file05',$id);
		$file_type01=$mail->getField('mail_file01_type',$id);
		$file_type02=$mail->getField('mail_file02_type',$id);
		$file_type03=$mail->getField('mail_file03_type',$id);
		$file_type04=$mail->getField('mail_file04_type',$id);
		$file_type05=$mail->getField('mail_file05_type',$id);
	break;
	case 'repair':
		$idmto=$mail->getField('mfrom',$id);
		$mto=$pegawai->getField('nama',$idmto);
		$content=$mail->getField('content',$id);
		$mail_to=$mail->getField('mail_to',$id);
		$mail_from=$mail->getField('mail_from',$id);
		$mail_about=$mail->getField('mail_about',$id);
		$mail_file01=$mail->getField('mail_file01',$id);
		$mail_file02=$mail->getField('mail_file02',$id);
		$mail_file03=$mail->getField('mail_file03',$id);
		$mail_file04=$mail->getField('mail_file04',$id);
		$mail_file05=$mail->getField('mail_file05',$id);
		$file_type01=$mail->getField('mail_file01_type',$id);
		$file_type02=$mail->getField('mail_file02_type',$id);
		$file_type03=$mail->getField('mail_file03_type',$id);
		$file_type04=$mail->getField('mail_file04_type',$id);
		$file_type05=$mail->getField('mail_file05_type',$id);
	break;
	case 'rep':
		$id=$_GET['id'];
		/*
		if($mail_type=='int'){
			$idmto=$mail->getField('mfrom',$id);
			$mto=$pegawai->getField('nama',$idmto);
			$content=$mail->getField('content',$id);
			$mail_to=$mail->getField('mail_to',$id);
			$mail_from=$mail->getField('mail_from',$id);
			$mail_about=$mail->getField('mail_about',$id);
		}
		*/
	break;
	case 'reg':
		//$idmto=$mail->getField('mfrom',$id);
		$mto=$pegawai->getField('nama',$idmto);
		$content=$mail->getField('content',$id);
		$mail_to=$mail->getField('mail_to',$id);
		$mail_from=$mail->getField('mail_from',$id);
		$mail_about=$mail->getField('mail_about',$id);
	break;
}
?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		var type='<?php echo $type;?>';
		if(type=='fwd'){
			$('#infSurat').hide();
		}
		if(type=='rev'){
			//$('#infSender').hide();
		}
		$('#tombol').click(function(){
			$('#email').submit();
		});
		$("#mto").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
	});
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
				$('#mto').val(ob[1]);
				$('#content').focus();
			}
		});
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<form method="post" action="<?php echo $link; ?>&m=fmail" enctype="multipart/form-data" id="email">
			<span id="infSender">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="22%" class="frm">Dari</td>
					<td colspan="78%" class="frm">
						<input type="hidden" name="fwdid" value="<?php echo $id;?>" />
						<input type="hidden" name="type" value="<?php echo $type;?>" />
						<input type="text" readonly="" style="background:none; border:none; width:100%" value="<?php echo $pegawai->getField('jabatan',$logid);?>">	
					</td>
					<input type="hidden" name="mfrom" id="dari" style="width:100%;" value="<?php echo $logid;?>">			
				</tr>
				<tr>
					<td width="214" class="frm">Kepada</td>
					<td width="758" colspan="4" class="frm">
						<input type="text" name="mto" id="mto" style="width:100%" onchange="getId();" value="<?php echo $mto;?>" />	
						<input type="hidden" name="idmto" id="idmto" value="<?php echo $idmto;?>">		
					</td>						
				</tr>
				<tr>
					<td class="frm">Isi pesan </td>
					<td colspan="4"><textarea id="content" name="content" rows="3" style="width:100%"><?php echo $content;?></textarea></td>
				</tr>
			</table>
			</span>			
			<span id="infSurat">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="3"><h2>&raquo; Informasi Surat</h2></td>
				</tr>
				<tr>
					<td width="22%">Surat Dari</td>
					<td colspan="4">
					<input type="text" name="mail_from" id="mail_from" style="width:100%" value="<?php echo $mail_from;?>" />
				  </td>
				</tr>
				<tr>
					<td width="22%">Tujuan Surat</td>
				  <td colspan="4"><input type="text" name="mail_to" id="mail_to" style="width:100%" value="<?php echo $mail_to;?>" /></td>
				</tr>
				<tr>
					<td class="frm">Uraian Surat</td>
					<td colspan="4"><textarea id="mail_about" name="mail_about" rows="3" style="width:100%"><?php echo $mail_about;?></textarea></td>
				</tr>
				<tr>
					<td>File Surat (DOC/PDF)</td>
					<td width="2%">1. </td>
					<td width="76%" colspan="4">
					<input type="file" name="surat01[]" id="surat01" multiple="multiple" />
					&nbsp;&raquo;&nbsp;<?php echo substr($mail_file01,6);?>
					<input type="hidden" name="mail_file01" value="<?php echo $mail_file01;?>" />
					<input type="hidden" name="file_type01" value="<?php echo $file_type01;?>" />							
				  </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>2. </td>
					<td colspan="4">
						<input type="file" name="surat02[]" id="surat01" multiple="multiple" />
						&nbsp;&raquo;&nbsp;<?php echo substr($mail_file02,6);?>
						<input type="hidden" name="mail_file02" value="<?php echo $mail_file02;?>" />
						<input type="hidden" name="file_type02" value="<?php echo $file_type02;?>" />							
								
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>3. </td>
					<td colspan="4">
						<input type="file" name="surat03[]" id="surat01" multiple="multiple" />
						&nbsp;&raquo;&nbsp;<?php echo substr($mail_file03,6);?>
						<input type="hidden" name="mail_file03" value="<?php echo $mail_file03;?>" />
						<input type="hidden" name="file_type03" value="<?php echo $file_type03;?>" />							
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>4. </td>
					<td colspan="4">
						<input type="file" name="surat04[]" id="surat01" multiple="multiple" />
						&nbsp;&raquo;&nbsp;<?php echo substr($mail_file04,6);?>
						<input type="hidden" name="mail_file04" value="<?php echo $mail_file04;?>" />
						<input type="hidden" name="file_type04" value="<?php echo $file_type04;?>" />							
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>5. </td>
					<td colspan="4">
						<input type="file" name="surat05[]" id="surat01" multiple="multiple" />
						&nbsp;&raquo;&nbsp;<?php echo substr($mail_file05,6);?></b>
						<input type="hidden" name="mail_file05" value="<?php echo $mail_file05;?>" />
						<input type="hidden" name="file_type05" value="<?php echo $file_type05;?>" />							
					</td>
				</tr>
			</table>
			</span>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="btn frm" colspan="2" align="right">
						<input type="hidden" name="btn" value="Kirim">
						<input type="button" name="tombol" id="tombol" class="btn" value="Kirim" />			
					</td>				
				</tr>
			</table>
		</form>
	</div>
</div>
<script>
$('#mto').keypress(function(e){
	if(e.keyCode==13){
		getId();
	}
});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$noid=$logid.$date->format('Ymdhis');
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
	switch ($_POST['btn']){
		case 'Kirim':
			$fwdid=$_POST['fwdid'];
			switch($_POST['type']){
				case 'new':
					if($extsurat01!=''){
						move_uploaded_file($tmpsurat01, $_SERVER['DOCUMENT_ROOT'] . $destsurat01);
						$filesurat01='draft/'.$newsuratname01;
					}
					if($extsurat02!=''){
						move_uploaded_file($tmpsurat02, $_SERVER['DOCUMENT_ROOT'] . $destsurat02);
						$filesurat02='draft/'.$newsuratname02;
					}
					if($extsurat03!=''){
						move_uploaded_file($tmpsurat03, $_SERVER['DOCUMENT_ROOT'] . $destsurat03);
						$filesurat03='draft/'.$newsuratname03;
					}
					if($extsurat04!=''){
						move_uploaded_file($tmpsurat04, $_SERVER['DOCUMENT_ROOT'] . $destsurat04);
						$filesurat04='draft/'.$newsuratname04;
					}
					if($extsurat05!=''){
						move_uploaded_file($tmpsurat05, $_SERVER['DOCUMENT_ROOT'] . $destsurat05);
						$filesurat05='draft/'.$newsuratname05;
					}
					//$mail->setStatus($mail->getField('mail_file',$fwdid),'prc');
					$data=array('id'=>$noid,'fdate'=>$date->format('Y-m-d'),'mfrom'=>$logid,'mto'=>$_POST['idmto'],'mail_type'=>'out','content'=>$_POST['content'],'mail_to'=>$_POST['mail_to'],'mail_from'=>$_POST['mail_from'],'mail_about'=>$_POST['mail_about'],'mail_file01'=>$filesurat01,'mail_file01_type'=>$extsurat01,'mail_file02'=>$filesurat02,'mail_file02_type'=>$extsurat02,'mail_file03'=>$filesurat03,'mail_file03_type'=>$extsurat03,'mail_file04'=>$filesurat04,'mail_file04_type'=>$extsurat04,'mail_file05'=>$filesurat05,'mail_file05_type'=>$extsurat05,'mail_status'=>'new','replay_to'=>'','draft_from'=>$logid);
					$mail->addData($data);
				break;
				case 'fwd':
					$type=$mail->getField('mail_type',$fwdid);
					switch($type){
						case 'in':
							$mto=$mail->getField('mto',$fwdid).",".$_POST['idmto'];
							$data=array('id'=>$fwdid,'mto'=>$mto,'content'=>$_POST['content']);
							$mail->forwardIn($data);
						break;
						case 'out':
							//$mto=$mail->getField('mto',$fwdid).",".$_POST['idmto'];
							$app=$mail->getField('approved',$fwdid);
							if($app!=''){$approved=$app.",".$logid;}else{$approved=$logid;}
							$data=array('id'=>$fwdid,'mto'=>$_POST['idmto'],'mfrom'=>$_POST['mfrom'],'content'=>$_POST['content'],'approved'=>$approved);
							$mail->forwardOut($data);
						break;
					}
				break;
				case 'reg':
					$mto=$mail->getField('mto',$fwdid).",".$_POST['idmto'];
					$data=array('id'=>$fwdid,'mto'=>$mto,'content'=>$_POST['content']);
					$mail->saranReg($data);
				break;
				case 'rep':
					if($extsurat01!=''){
						move_uploaded_file($tmpsurat01, $_SERVER['DOCUMENT_ROOT'] . $destsurat01);
						$filesurat01='draft/'.$newsuratname01;
					}
					if($extsurat02!=''){
						move_uploaded_file($tmpsurat02, $_SERVER['DOCUMENT_ROOT'] . $destsurat02);
						$filesurat02='draft/'.$newsuratname02;
					}
					if($extsurat03!=''){
						move_uploaded_file($tmpsurat03, $_SERVER['DOCUMENT_ROOT'] . $destsurat03);
						$filesurat03='draft/'.$newsuratname03;
					}
					if($extsurat04!=''){
						move_uploaded_file($tmpsurat04, $_SERVER['DOCUMENT_ROOT'] . $destsurat04);
						$filesurat04='draft/'.$newsuratname04;
					}
					if($extsurat05!=''){
						move_uploaded_file($tmpsurat05, $_SERVER['DOCUMENT_ROOT'] . $destsurat05);
						$filesurat05='draft/'.$newsuratname05;
					}
					$data=array('id'=>$noid,'fdate'=>$date->format('Y-m-d'),'mfrom'=>$logid,'mto'=>$_POST['idmto'],'mail_type'=>'out','content'=>$_POST['content'],'mail_to'=>$_POST['mail_to'],'mail_from'=>$_POST['mail_from'],'mail_about'=>$_POST['mail_about'],'mail_file01'=>$filesurat01,'mail_file01_type'=>$extsurat01,'mail_file02'=>$filesurat02,'mail_file02_type'=>$extsurat02,'mail_file03'=>$filesurat03,'mail_file03_type'=>$extsurat03,'mail_file04'=>$filesurat04,'mail_file04_type'=>$extsurat04,'mail_file05'=>$filesurat05,'mail_file05_type'=>$extsurat05,'mail_status'=>'new','replay_to'=>$fwdid,'draft_from'=>$logid);
					$mail->addData($data);
				break;
				case 'rev':
					$id=$fwdid;
					if($extsurat01!=''){
						$oldmail01=$mail->getField('mail_file01',$id);
						if (file_exists($oldmail01)) { unlink ($oldmail01);}					
						$newsuratname01=$id."_01".".".$extsurat01;
						$destsurat01= $path['dirname'] . '/draft/' . $newsuratname01;
						move_uploaded_file($tmpsurat01, $_SERVER['DOCUMENT_ROOT'] . $destsurat01);
						$filesurat01='draft/'.$newsuratname01;
					}else{
						$filesurat01=$_POST['mail_file01'];
						$extsurat01=$_POST['file_type01'];
					}
					if($extsurat02!=''){
						$oldmail02=$mail->getField('mail_file02',$id);
						if (file_exists($oldmail02)) { unlink ($oldmail02);}					
						$newsuratname02=$id."_02".".".$extsurat02;
						$destsurat02= $path['dirname'] . '/draft/' . $newsuratname02;
						move_uploaded_file($tmpsurat02, $_SERVER['DOCUMENT_ROOT'] . $destsurat02);
						$filesurat02='draft/'.$newsuratname02;
					}else{
						$filesurat02=$_POST['mail_file02'];
						$extsurat02=$_POST['file_type02'];
					}
					if($extsurat03!=''){
						$oldmail03=$mail->getField('mail_file03',$id);
						if (file_exists($oldmail03)) { unlink ($oldmail03);}					
						$newsuratname03=$id."_03".".".$extsurat03;
						$destsurat03= $path['dirname'] . '/draft/' . $newsuratname03;
						move_uploaded_file($tmpsurat03, $_SERVER['DOCUMENT_ROOT'] . $destsurat03);
						$filesurat03='draft/'.$newsuratname03;
					}else{
						$filesurat03=$_POST['mail_file03'];
						$extsurat03=$_POST['file_type03'];
					}
					if($extsurat04!=''){
						$oldmail04=$mail->getField('mail_file04',$id);
						if (file_exists($oldmail04)) { unlink ($oldmail04);}					
						$newsuratname04=$id."_04".".".$extsurat04;
						$destsurat04= $path['dirname'] . '/draft/' . $newsuratname04;
						move_uploaded_file($tmpsurat04, $_SERVER['DOCUMENT_ROOT'] . $destsurat04);
						$filesurat04='draft/'.$newsuratname04;
					}else{
						$filesurat04=$_POST['mail_file04'];
						$extsurat04=$_POST['file_type04'];
					}
					if($extsurat05!=''){
						$oldmail05=$mail->getField('mail_file05',$id);
						if (file_exists($oldmail05)) { unlink ($oldmail05);}					
						$newsuratname05=$id."_05".".".$extsurat05;
						$destsurat05= $path['dirname'] . '/draft/' . $newsuratname05;
						move_uploaded_file($tmpsurat05, $_SERVER['DOCUMENT_ROOT'] . $destsurat05);
						$filesurat05='draft/'.$newsuratname05;
					}else{
						$filesurat05=$_POST['mail_file05'];
						$extsurat05=$_POST['file_type05'];
					}
					$data=array('id'=>$id,'mfrom'=>$_POST['mfrom'],'mto'=>$_POST['idmto'],'content'=>$_POST['content'],'mail_about'=>$_POST['mail_about'],'mail_file01'=>$filesurat01,'mail_file02'=>$filesurat02,'mail_file03'=>$filesurat03,'mail_file04'=>$filesurat04,'mail_file05'=>$filesurat05,'mail_file01_type'=>$extsurat01,'mail_file02_type'=>$extsurat02,'mail_file03_type'=>$extsurat03,'mail_file04_type'=>$extsurat04,'mail_file05_type'=>$extsurat05,'mail_status'=>'rev');
					$mail->revisiFile($data);
				break;
				case 'repair':
					$id=$fwdid;
					if($extsurat01!=''){
						$oldmail01=$mail->getField('mail_file01',$id);
						if (file_exists($oldmail01)) { unlink ($oldmail01);}					
						$newsuratname01=$id."_01".".".$extsurat01;
						$destsurat01= $path['dirname'] . '/draft/' . $newsuratname01;
						move_uploaded_file($tmpsurat01, $_SERVER['DOCUMENT_ROOT'] . $destsurat01);
						$filesurat01='draft/'.$newsuratname01;
					}else{
						$filesurat01=$_POST['mail_file01'];
						$extsurat01=$_POST['file_type01'];
					}
					if($extsurat02!=''){
						$oldmail02=$mail->getField('mail_file02',$id);
						if (file_exists($oldmail02)) { unlink ($oldmail02);}					
						$newsuratname02=$id."_02".".".$extsurat02;
						$destsurat02= $path['dirname'] . '/draft/' . $newsuratname02;
						move_uploaded_file($tmpsurat02, $_SERVER['DOCUMENT_ROOT'] . $destsurat02);
						$filesurat02='draft/'.$newsuratname02;
					}else{
						$filesurat02=$_POST['mail_file02'];
						$extsurat02=$_POST['file_type02'];
					}
					if($extsurat03!=''){
						$oldmail03=$mail->getField('mail_file03',$id);
						if (file_exists($oldmail03)) { unlink ($oldmail03);}					
						$newsuratname03=$id."_03".".".$extsurat03;
						$destsurat03= $path['dirname'] . '/draft/' . $newsuratname03;
						move_uploaded_file($tmpsurat03, $_SERVER['DOCUMENT_ROOT'] . $destsurat03);
						$filesurat03='draft/'.$newsuratname03;
					}else{
						$filesurat03=$_POST['mail_file03'];
						$extsurat03=$_POST['file_type03'];
					}
					if($extsurat04!=''){
						$oldmail04=$mail->getField('mail_file04',$id);
						if (file_exists($oldmail04)) { unlink ($oldmail04);}					
						$newsuratname04=$id."_04".".".$extsurat04;
						$destsurat04= $path['dirname'] . '/draft/' . $newsuratname04;
						move_uploaded_file($tmpsurat04, $_SERVER['DOCUMENT_ROOT'] . $destsurat04);
						$filesurat04='draft/'.$newsuratname04;
					}else{
						$filesurat04=$_POST['mail_file04'];
						$extsurat04=$_POST['file_type04'];
					}
					if($extsurat05!=''){
						$oldmail05=$mail->getField('mail_file05',$id);
						if (file_exists($oldmail05)) { unlink ($oldmail05);}					
						$newsuratname05=$id."_05".".".$extsurat05;
						$destsurat05= $path['dirname'] . '/draft/' . $newsuratname05;
						move_uploaded_file($tmpsurat05, $_SERVER['DOCUMENT_ROOT'] . $destsurat05);
						$filesurat05='draft/'.$newsuratname05;
					}else{
						$filesurat05=$_POST['mail_file05'];
						$extsurat05=$_POST['file_type05'];
					}
					$data=array('id'=>$id,'mfrom'=>$_POST['mfrom'],'mto'=>$_POST['idmto'],'content'=>$_POST['content'],'mail_about'=>$_POST['mail_about'],'mail_file01'=>$filesurat01,'mail_file02'=>$filesurat02,'mail_file03'=>$filesurat03,'mail_file04'=>$filesurat04,'mail_file05'=>$filesurat05,'mail_file01_type'=>$extsurat01,'mail_file02_type'=>$extsurat02,'mail_file03_type'=>$extsurat03,'mail_file04_type'=>$extsurat04,'mail_file05_type'=>$extsurat05,'mail_status'=>'new');
					$mail->revisiFile($data);
				break;
			}
			header("location:$link&m=mout");		
		break;
	}
}
?>

