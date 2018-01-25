<?php
$id=$_GET['id'];
$action=$_GET['act'];
switch($action){
	case '':
		$btn='Registrasi';
		$val='REGISTRASI';
	break;
	case 'replay':
		$btn='Registrasi';
		$val='SURAT BALASAN';
		$replay=$mail->getField('replay',$id);
	break;
	case 'kembalikan':
		$btn='Kembalikan';
		$val='KEMBALIKAN';
		$mfrom=$mailint->getField('mfrom',$id);
		$replay=$mailint->getField('replay',$id);
		$mto=$pegawai->getField('nama',$mfrom)."-".$pegawai->getField('jabatan',$mfrom)."-".$mfrom;
		$about=$mailint->getField('about',$id);
		$message=$mailint->getField('message',$id);
		$file01=$mailint->getField('file01',$id);
		$ext01=$mailint->getField('ext01',$id);
		$name01=substr(substr(substr(substr($file01,6),0,-strlen($ext01)),0,-1),0,-17);
		$file02=$mailint->getField('file02',$id);
		$ext02=$mailint->getField('ext02',$id);
		$name02=substr(substr(substr(substr($file02,6),0,-strlen($ext02)),0,-1),0,-17);
		$file03=$mailint->getField('file03',$id);
		$ext03=$mailint->getField('ext03',$id);
		$name03=substr(substr(substr(substr($file03,6),0,-strlen($ext03)),0,-1),0,-17);
		$file04=$mailint->getField('file04',$id);
		$ext04=$mailint->getField('ext04',$id);
		$name04=substr(substr(substr(substr($file04,6),0,-strlen($ext04)),0,-1),0,-17);
		$file05=$mailint->getField('file05',$id);
		$ext05=$mailint->getField('ext05',$id);
		$name05=substr(substr(substr(substr($file05,6),0,-strlen($ext05)),0,-1),0,-17);	break;
	break;
	case 'setujui':
		$btn='Setujui';
		$val='PERSETUJUAN SURAT';
		$mfrom=$mailint->getField('mfrom',$id);
		$replay=$mailint->getField('replay',$id);
		$mto=$pegawai->getField('nama',$mfrom)."-".$pegawai->getField('jabatan',$mfrom)."-".$mfrom;
		$about=$mailint->getField('about',$id);
		$message=$mailint->getField('message',$id);
		$file01=$mailint->getField('file01',$id);
		$ext01=$mailint->getField('ext01',$id);
		$name01=substr(substr(substr(substr($file01,6),0,-strlen($ext01)),0,-1),0,-17);
		$file02=$mailint->getField('file02',$id);
		$ext02=$mailint->getField('ext02',$id);
		$name02=substr(substr(substr(substr($file02,6),0,-strlen($ext02)),0,-1),0,-17);
		$file03=$mailint->getField('file03',$id);
		$ext03=$mailint->getField('ext03',$id);
		$name03=substr(substr(substr(substr($file03,6),0,-strlen($ext03)),0,-1),0,-17);
		$file04=$mailint->getField('file04',$id);
		$ext04=$mailint->getField('ext04',$id);
		$name04=substr(substr(substr(substr($file04,6),0,-strlen($ext04)),0,-1),0,-17);
		$file05=$mailint->getField('file05',$id);
		$ext05=$mailint->getField('ext05',$id);
		$name05=substr(substr(substr(substr($file05,6),0,-strlen($ext05)),0,-1),0,-17);
	break;
	case 'teruskan':
		$val='MENERUSKAN';
		$btn='Teruskan';
		switch($loglevel){
			case 'STF':
				$idmto=$mailint->getField('mfrom',$id);
				$mto=$pegawai->getField('jabatan',$idmto);
				$opsi="<tr><td><p style='font-weight:bold'>AKSI</p></td><td><select name='jenis'><option value='Proses'>Proses</option></select></td></tr>";
			break;
			case 'KSI' or 'KTU' or 'KKR':
				$idmto=$mailint->getField('mfrom',$id);
				$mto=$pegawai->getField('jabatan',$idmto);
				$opsi="<tr><td>AKSI</td><td><select name='jenis'><option value='Kembalikan' selected='selected'>Kembalikan</option><option value='Revisi'>Revisi</option></select>&nbsp;&nbsp;*/ Kembalikan (Pengguna akan mengembalikan surat untuk di revisi)</td></tr>";
			break;
		}
		$mto='';
		$about=$mailint->getField('about',$id);
		$replay=$mailint->getField('replay',$id);
		$message=$mailint->getField('message',$id);
		$file01=$mailint->getField('file01',$id);
		$ext01=$mailint->getField('ext01',$id);
		$name01=substr(substr(substr(substr($file01,6),0,-strlen($ext01)),0,-1),0,-17);
		$file02=$mailint->getField('file02',$id);
		$ext02=$mailint->getField('ext02',$id);
		$name02=substr(substr(substr(substr($file02,6),0,-strlen($ext02)),0,-1),0,-17);
		$file03=$mailint->getField('file03',$id);
		$ext03=$mailint->getField('ext03',$id);
		$name03=substr(substr(substr(substr($file03,6),0,-strlen($ext03)),0,-1),0,-17);
		$file04=$mailint->getField('file04',$id);
		$ext04=$mailint->getField('ext04',$id);
		$name04=substr(substr(substr(substr($file04,6),0,-strlen($ext04)),0,-1),0,-17);
		$file05=$mailint->getField('file05',$id);
		$ext05=$mailint->getField('ext05',$id);
		$name05=substr(substr(substr(substr($file05,6),0,-strlen($ext05)),0,-1),0,-17);
	break;
}
?>
<script>
	$(document).ready(function(){
		$("#mto").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
	});
	function cekForm(){
		var mto=$('#mto').val();
		if(mto==''){
			if($('#semua:checked').length==0){
				alert("Tujuan masih kosong.");
				$('#mto').focus();
				return;
			}else{
				$('#email').submit();
			}
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
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a>SURAT INTERNAL</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link; ?>&m=fint" enctype="multipart/form-data" id="email">
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<input type="hidden" name="replay" value="<?php echo $replay;?>" />
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
				<tr>
				  <td width="152" style=" vertical-align:top;"><p style="font-weight:bold">1. KEPADA</p></td>
			  	  <td width="707">
				  <?php 
				  if($level!='STF' and $level!='STB' and $level!='STA'){
				  ?>
				  <p style="font-weight:bold"><input type="checkbox" name="semua" id="semua" value="semua" />&nbsp;<label>Semua staff</label></p>
				  <?php
				  }
				  ?>
				  <input type="text" name="mto" id="mto" value="<?php echo $mto;?>" /></td>						
				</tr>
				<tr>
				  <td width="152" style=" vertical-align:top;"><p style="font-weight:bold">2. PERIHAL</p></td>
			  	  <td width="707"><input type="text" name="about" id="about" value="<?php echo $about;?>" /></td>						
				</tr>
				<tr>
					<td style=" vertical-align:top;"><p style="font-weight:bold;">3. ISI PESAN </p></td>					<td><textarea name="message" id="elm1">
				  <?php echo $message;?></textarea></td>

				</tr>
				<tr>
				  <td width="152"><p style="font-weight:bold">4. FILE SURAT (DOC/PDF)</p></td>
				  <td width="707">
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
								case 'jpg':
									echo "<a href='".$file01."' target='_blank'><img src='img/img-icon.png'/></a>";
								break;
								case 'png':
									echo "<a href='".$file01."' target='_blank'><img src='img/img-icon.png'/></a>";
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
								case 'jpg':
									echo "<a href='".$file02."' target='_blank'><img src='img/img-icon.png'/></a>";
								break;
								case 'png':
									echo "<a href='".$file02."' target='_blank'><img src='img/img-icon.png'/></a>";
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
								case 'jpg':
									echo "<a href='".$file03."' target='_blank'><img src='img/img-icon.png'/></a>";
								break;
								case 'png':
									echo "<a href='".$file03."' target='_blank'><img src='img/img-icon.png'/></a>";
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
								case 'jpg':
									echo "<a href='".$file04."' target='_blank'><img src='img/img-icon.png'/></a>";
								break;
								case 'png':
									echo "<a href='".$file04."' target='_blank'><img src='img/img-icon.png'/></a>";
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
								case 'jpg':
									echo "<a href='".$file05."' target='_blank'><img src='img/img-icon.png'/></a>";
								break;
								case 'png':
									echo "<a href='".$file05."' target='_blank'><img src='img/img-icon.png'/></a>";
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
				</tr>
			</table>
			</span>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="btn frm" colspan="2" align="right">
				</tr>
			</table>
			<div class="head_content" style="box-shadow:none;" >
				<input style="float:right;" type="button" name="Kembali" value="Kembali" onclick="self.history.back();" />
				<input type="hidden" name="btn" value="<?php echo $btn;?>">
				<input type="button" name="kirim" value="<?php echo $btn;?>" onclick="cekForm();" />			
			</div>
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
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile01 = count ($_FILES['surat01']['name']);   
	for ($i = 0; $i < $numfile01; $i++){
		$tmpsurat01 = $_FILES['surat01']['tmp_name'][$i];
		$surattype01 = $_FILES['surat01']['type'][$i];
		$suratsize01 = $_FILES['surat01']['size'][$i];
		$suratname01 = $_FILES['surat01']['name'][$i];
		$extsurat01 = getext($suratname01);
		$trim1=strlen($extsurat01)+1;
		$newsuratname01=substr($suratname01,0,-$trim1).$date->format('Ymd').$G.$date->format('is')."_01.".$extsurat01;
		$destsurat01= $path['dirname'] . '/draft/' . $newsuratname01;
	}
	$numfile02 = count ($_FILES['surat02']['name']);   
	for ($i = 0; $i < $numfile02; $i++){
		$tmpsurat02 = $_FILES['surat02']['tmp_name'][$i];
		$surattype02 = $_FILES['surat02']['type'][$i];
		$suratsize02 = $_FILES['surat02']['size'][$i];
		$suratname02 = $_FILES['surat02']['name'][$i];
		$extsurat02 = getext($suratname02);
		$trim2=strlen($extsurat02)+1;
		$newsuratname02=substr($suratname02,0,-$trim2).$date->format('Ymd').$G.$date->format('is')."_02.".$extsurat02;
		$destsurat02= $path['dirname'] . '/draft/' . $newsuratname02;
	}
	$numfile03 = count ($_FILES['surat03']['name']);   
	for ($i = 0; $i < $numfile03; $i++){
		$tmpsurat03 = $_FILES['surat03']['tmp_name'][$i];
		$surattype03 = $_FILES['surat03']['type'][$i];
		$suratsize03 = $_FILES['surat03']['size'][$i];
		$suratname03 = $_FILES['surat03']['name'][$i];
		$extsurat03 = getext($suratname03);
		$trim3=strlen($extsurat03)+1;
		$newsuratname03=substr($suratname03,0,-$trim3).$date->format('Ymd').$G.$date->format('is')."_03.".$extsurat03;
		$destsurat03= $path['dirname'] . '/draft/' . $newsuratname03;
	}
	$numfile04 = count ($_FILES['surat04']['name']);   
	for ($i = 0; $i < $numfile04; $i++){
		$tmpsurat04 = $_FILES['surat04']['tmp_name'][$i];
		$surattype04 = $_FILES['surat04']['type'][$i];
		$suratsize04 = $_FILES['surat04']['size'][$i];
		$suratname04 = $_FILES['surat04']['name'][$i];
		$extsurat04 = getext($suratname04);
		$trim4=strlen($extsurat04)+1;
		$newsuratname04=substr($suratname04,0,-$trim4).$date->format('Ymd').$G.$date->format('is')."_04.".$extsurat04;
		$destsurat04= $path['dirname'] . '/draft/' . $newsuratname04;
	}
	$numfile05 = count ($_FILES['surat05']['name']);   
	for ($i = 0; $i < $numfile05; $i++){
		$tmpsurat05 = $_FILES['surat05']['tmp_name'][$i];
		$surattype05 = $_FILES['surat05']['type'][$i];
		$suratsize05 = $_FILES['surat05']['size'][$i];
		$suratname05 = $_FILES['surat05']['name'][$i];
		$extsurat05 = getext($suratname05);
		$trim5=strlen($extsurat05)+1;
		$newsuratname05=substr($suratname05,0,-$trim5).$date->format('Ymd').$G.$date->format('is')."_05.".$extsurat05;
		$destsurat05= $path['dirname'] . '/draft/' . $newsuratname05;
	}
	switch ($_POST['btn']){
		case 'Registrasi':
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
			if($_POST['semua']=='semua'){
				$bagian=$pegawai->getField('bagian',$logid);
				$all=$pegawai->getWhere('bagian',$bagian);
				foreach($all as $row){
					$mto=$row['id'];
					$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
					$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'about'=>$_POST['about'],'message'=>$_POST['message'],'file01'=>$filesurat01,'ext01'=>$extsurat01,'file02'=>$filesurat02,'ext02'=>$extsurat02,'file03'=>$filesurat03,'ext03'=>$extsurat03,'file04'=>$filesurat04,'ext04'=>$extsurat04,'file05'=>$filesurat05,'ext05'=>$extsurat05,'replay'=>$_POST['replay'],'status'=>'new','reading'=>'');
					$mailint->addData($data);		
					$mailint_out->addData($data);
				}
			}else{
				$mto=substr($_POST['mto'],-3);
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'about'=>$_POST['about'],'message'=>$_POST['message'],'file01'=>$filesurat01,'ext01'=>$extsurat01,'file02'=>$filesurat02,'ext02'=>$extsurat02,'file03'=>$filesurat03,'ext03'=>$extsurat03,'file04'=>$filesurat04,'ext04'=>$extsurat04,'file05'=>$filesurat05,'ext05'=>$extsurat05,'replay'=>$_POST['replay'],'status'=>'new','reading'=>'');
				$mailint->addData($data);		
				$mailint_out->addData($data);
		
			}
			header("location:$link&m=min_int_out");
		break;
		case 'Teruskan':
			if($extsurat01!=''){
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
			if($_POST['semua']=='semua'){
				$bagian=$pegawai->getField('bagian',$logid);
				$all=$pegawai->getWhere('bagian',$bagian);
				foreach($all as $row){
					$mto=$row['id'];
					$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
					$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'file01'=>$filesurat01,'file02'=>$filesurat02,'file03'=>$filesurat03,'file04'=>$filesurat04,'file05'=>$filesurat05,'ext01'=>$extsurat01,'ext02'=>$extsurat02,'ext03'=>$extsurat03,'ext04'=>$extsurat04,'ext05'=>$extsurat05,'replay'=>$mailint->getField('replay',$id),'status'=>'new','reading'=>'');
					$mailint->addData($data);		
					$mailint_out->addData($data);		
				}
			}else{
				$mto=substr($_POST['mto'],-3);
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'file01'=>$filesurat01,'file02'=>$filesurat02,'file03'=>$filesurat03,'file04'=>$filesurat04,'file05'=>$filesurat05,'ext01'=>$extsurat01,'ext02'=>$extsurat02,'ext03'=>$extsurat03,'ext04'=>$extsurat04,'ext05'=>$extsurat05,'replay'=>$mailint->getField('replay',$id),'status'=>'new','reading'=>'');
				$mailint->addData($data);		
				$mailint_out->addData($data);		
			}
			header("location:$link&m=min_int_out");
		break;
		case 'Kembalikan':
				$mto=substr($_POST['mto'],-3);
			if($extsurat01!=''){
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
			$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
			$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'file01'=>$filesurat01,'file02'=>$filesurat02,'file03'=>$filesurat03,'file04'=>$filesurat04,'file05'=>$filesurat05,'ext01'=>$extsurat01,'ext02'=>$extsurat02,'ext03'=>$extsurat03,'ext04'=>$extsurat04,'ext05'=>$extsurat05,'replay'=>$mailint->getField('replay',$id),'status'=>'rev','reading'=>'');
			$mailint->addData($data);		
			$mailint_out->addData($data);		
			header("location:$link&m=min_int_out");
		break;
		case 'Balasan':
			$mto=substr($_POST['mto'],-3);
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
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'about'=>$_POST['about'],'message'=>$_POST['message'],'file01'=>$filesurat01,'ext01'=>$extsurat01,'file02'=>$filesurat02,'ext02'=>$extsurat02,'file03'=>$filesurat03,'ext03'=>$extsurat03,'file04'=>$filesurat04,'ext04'=>$extsurat04,'file05'=>$filesurat05,'ext05'=>$extsurat05,'replay'=>$id,'status'=>'new','reading'=>'');
				$mailint->addData($data);	
				$mailint_out->addData($data);	
			header("location:$link&m=min_int_out");
		break;
		case 'Setujui':
				$mto=substr($_POST['mto'],-3);
			if($extsurat01!=''){
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
			$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
			$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'message'=>$_POST['message'],'about'=>$_POST['about'],'file01'=>$filesurat01,'file02'=>$filesurat02,'file03'=>$filesurat03,'file04'=>$filesurat04,'file05'=>$filesurat05,'ext01'=>$extsurat01,'ext02'=>$extsurat02,'ext03'=>$extsurat03,'ext04'=>$extsurat04,'ext05'=>$extsurat05,'replay'=>$mailint->getField('replay',$id),'status'=>'app','reading'=>'');
			$mailint->addData($data);		
			$mailint_out->addData($data);		
			header("location:$link&m=min_int_out");
		break;
	}
}
?>