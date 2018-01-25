<script>
	$(document).ready(function(){
		getKode();
	});
	$(document).ready(function(){
		$('#infLampiran').hide();
		$('#lampiranbesar').click(function(){
			var x=document.getElementById('lampiranbesar').checked;
			if(x==true){
				$('#infLampiran').show();
			}
			if(x==false){
				$('#infLampiran').hide();
			}
		});
	});
	function getKode(){
		var noin=document.getElementById('mail_codeindex').value;
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getKode&klasi='+noin,
			cache :false,
			success:function (data){
				$('#infKode').html(data);
			}
		});
	}
	$(document).ready(function(){
		$('#tombol').click(function(){
			cekForm();
		});
	});
	function cekForm(){
		if ('files' in surat){
			for (var i = 0; i < surat.files.length; i++) {
				var fileSurat = surat.files[i];
					
				var namaSurat=fileSurat.name;
				var ukuranSurat=fileSurat.size;
				var tipeSurat=fileSurat.type;
			}
		}
        var message = "";
		if(surat.value==''){
			alert('File surat tidak boleh kosong.');
		}else{
			var suratExt;
			suratExt=getFileExtension(namaSurat);
			if(suratExt!="docx" && suratExt!="doc" && suratExt!="pdf"){
				alert("Extensi file tidak sesuai, gunakan file : PDF / DOC / DOCX.");
			}else{
				$('#entri').submit();
			}		
		}		
    }
	function getFileExtension(filename) {
		return /[^.]+$/.exec(filename);
	}	
</script>
<?php
$id=$_GET['id'];
?>
<div class="p-wrapper">
<div class="content">
<div id="head">&raquo; REGISTRASI SURAT MASUK</div>
	<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data">
		<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
			<tr>
				<td width="25%" valign="top" class="detail" style="border:none;"><p style="font-weight:bold;">Surat dari</p></td>
				<td width="75%"><input type="text" name="mail_from" id="mail_from" value="<?php echo $mail->getField('mail_from',$id);?>" style="width:100%"></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Ringkasan</p></td>
				<td><input type="text" name="mail_about" value="<?php echo $mail->getField('mail_about',$id);?>" style="width:100%"></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Di Tujukan </p></td>
				<td class="list-ksi detail">
				<ul>
					<?php 
					$ksi=$pegawai->getWhere('level','KSI');
					$ktu=$pegawai->getWhere('level','KTU');
					foreach($ktu as $n){
						echo "<li><input type='checkbox' value='".$n['id']."' class='ksi' checked /> ".$n['jabatan']."</li>";
					}
					foreach($ksi as $row){
						echo "<li><input type='checkbox' value='".$row['id']."' class='ksi' /> ".$row['jabatan']."</li>";
					}
					?>
				</ul>
				</td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Instruksi</p></td>
				<td style="border:none;" class="detail"><textarea name="forward_note" id="forward_note" style="height:100px;"></textarea></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Batas waktu</p></td>
				<td><input type="text" name="mail_limit" id="mail_limit" value=""  onclick="return showCalendar('mail_limit', 'dd-mm-y')"/></td>
			</tr>
		</table>
		<div id="thick-menu"><input type="button" name="btn" class="btn" id="dispos" value="Disposisi"></div>
</form>	
</div></div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$noid=$logid.$date->format('YmdGis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$newsuratname=$noid.".".$extsurat;
		$destsurat= $path['dirname'] . '/draft/' . $newsuratname;
	}
	switch ($_POST['btn']){
		case 'Simpan':
			$filesurat='draft/'.$newsuratname;
			$to=$_POST['mto'];
			$nt=count($to);
			for ($i=0;$i<$nt;++$i){$rt.="$to[$i],";}
			$mto=substr("$rt",0,strlen($rt)-1);
			$data=array('id'=>$noid,'fdate'=>$date->format('Y-m-d'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$_POST['content'],'mail_type'=>'reg','mail_index'=>$_POST['mail_index'],'mail_no'=>$_POST['mail_no'],'mail_date'=>tgl_ind_to_eng($_POST['mail_date']),'mail_from'=>$_POST['mail_from'],'mail_to'=>$_POST['mail_to'],'mail_code'=>$_POST['mail_code'],'mail_codeindex'=>$_POST['mail_codeindex'],'mail_about'=>$_POST['mail_about'],'mail_status'=>'new','mail_file'=>$filesurat,'mail_attc'=>$_POST['mail_attc']);
			$add=$mail->addData($data);
			if($add){
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			}
			header("location:$link&m=mout");		
		break;
		case 'Edit':
			$oldsurat=$surat->getField('surat',$id);
			$newsurat='surat/inbox/'.$suratname;
			$oldlampiran=$surat->getField('lampiran',$id);
			$newlampiran= 'surat/inbox/lampiran/' . $lampiranname;		
			if ($suratname!=''){
				if($lampiranname!=''){
					if (file_exists($oldsurat)) { unlink ($oldsurat);}
					if (file_exists($oldlampiran)) { unlink ($oldlampiran);}
					move_uploaded_file($tmpimg, $_SERVER['DOCUMENT_ROOT'] . $destimg);
					move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
					$data=array('nosurat'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'noindex'=>$_POST['noindex'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$newsurat,'lampiran'=>$_POST['lampiran']);
					$surat->updateData($id,$data);	
				}else{
					if (file_exists($oldsurat)) { unlink ($oldsurat);}
					move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
					$data=array('nosurat'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'noindex'=>$_POST['noindex'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$newsurat,'lampiran'=>$oldlampiran);
					$surat->updateData($id,$data);	
				}
			}else{
				if($lampiranname!=''){
					if (file_exists($oldlampiran)) { unlink ($oldlampiran);}
					move_uploaded_file($tmplampiran, $_SERVER['DOCUMENT_ROOT'] . $destlampiran);
					$data=array('nosurat'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'noindex'=>$_POST['noindex'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$oldsurat,'lampiran'=>$_POST['lampiran']);
					$surat->updateData($id,$data);	
				}else{
					$data=array('nosurat'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'noindex'=>$_POST['noindex'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$oldsurat,'lampiran'=>$_POST['lampiran']);
					$surat->updateData($id,$data);						
				}
			}
			header("location:$link");	
		break;		
		case 'Hapus':
			$surat=$surat->getField('surat',$id);
				$lampiran=$surat->getField('lampiran',$id);
				$surat->delData($id);
				if (file_exists($surat)) { unlink ($surat);}
				if (file_exists($lampiran)) { unlink ($lampiran);}	
			break;		
	}
}
?>