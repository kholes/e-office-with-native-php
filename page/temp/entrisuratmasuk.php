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
		var noin=document.getElementById('noindex').value;
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
<div id="head-mail" style="color:#F84407;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<th align="left">REGISTRASI SURAT MASUK</th>
	</table>
</div>								
<form method="post" action="<?php echo $link; ?>&get=new" enctype="multipart/form-data" id="entri">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="btn frm" colspan="7"><input type="hidden" name="id" id="id" value="<?php echo $ide; ?>"></td>
		</tr>
		<tr>
			<td valign="top" class="frm">KEPADA</td>
			<td  class="frm" colspan="4">
				<ul>
					<li>
						<input type="checkbox" name="tujuan[]" id="tujuan" value="KKR" checked="checked">
						<?php echo $jabatan->getField('jabatan','KKR'); ?>									
					</li>
					<li>
						<input type="checkbox" name="tujuan[]" id="tujuan" value="KTU">
						<?php echo $jabatan->getField('jabatan','KTU'); ?>										
					</li>	
				</ul>							
			</td>
		</tr>
		<tr>
			<td valign="top" class="frm">NO.SURAT</td>
			<td width="282" class="frm">
				<input type="text" name="nosurat" id="nosurat" style="width:100%;" value="" />						  
			</td>
			<td width="66" class="frm">&nbsp;</td>
			<td width="112" class="frm">TANGGAL</td>
			<td width="232" class="frm">
				<input type="text" class="tgl" name="tanggal" id="tanggal" 
				value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/>
			</td>
		</tr>
		<tr>
			<td class="frm">KLASIFIKASI</td>
			<td class="frm">
				<select name="noindex" id="noindex" onchange="getKode();">
					<?php
					$x=$klas->getAll();
					foreach($x as $row){
						echo "<option value=".$row['id'].">".$row['klasifikasi']."</option>";
					}
					?>
				</select>							
			</td>
			<td class="frm">&nbsp;</td>
			<td class="frm">KODE KLASIFIKASI</td>
			<td width="232" class="frm"><span id="infKode"></span></td>
		</tr>
		<tr>
			<td width="280" class="frm">DARI</td>
			<td class="frm" colspan="4"><input type="text" name="dari" id="dari" style="width:95%;"></td>
		</tr>
		<tr>
			<td class="frm">RINGKASAN / URAYAN</td>
			<td colspan="4" class="frm">
				<textarea name="rangkuman" id="rangkuman" style="width:95%; height:100px;"></textarea>
			</td>
		</tr>
		<tr>
			<td class="frm">FILE SURAT(PDF) </td>
			<td class="frm"><input type="file" name="surat[]" id="surat" multiple="multiple" /></td>
			<td class="frm">&nbsp;</td>
		</tr>
		<tr>
			<td class="frm">LAMPIRAN(Dokumen besar / Barang) </td>
			<td class="frm" colspan="2"><input type="checkbox" id="lampiranbesar" /> Lokasi penyimpanan dokumen/barang</td>
		</tr>
		<tr>
			<td class="frm">&nbsp;</td>
			<td class="frm" colspan="4">
				<span id="infLampiran">
					<textarea name="lampiran" id="lampiran" style="width:95%; height:100px;"></textarea>
				</span>						
			</td>
		</tr>
		<tr>
			<td class="btn frm" colspan="7" align="right">
				<input type="hidden" name="btn" value="<?php echo $btn; ?>">
				<input type="button" name="tombol" id="tombol" class="btn" value="<?php echo $btn; ?>" />						
			</td>				
		</tr>
	</table>
</form>	
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$nourut=urutauto('dtsuratmasuk',$date->format('Y'));
	echo $noid=$date->format('Ymdhis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$newsuratname="inbox_".$noid.".".$extsurat;
		$destsurat= $path['dirname'] . '/surat/inbox/' . $newsuratname;
	}
	$numfile = count ($_FILES['lampiran']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmplampiran = $_FILES['lampiran']['tmp_name'][$i];
		$lampirantype = $_FILES['lampiran']['type'][$i];
		$lampiransize = $_FILES['lampiran']['size'][$i];
		$lampiranname = $_FILES['lampiran']['name'][$i];
		$extlampiran = getext($lampiranname);
		$newlampiranname="lampiran_".$noid.".".$extlampiran;
		$destlampiran= $path['dirname'] . '/surat/inbox/lampiran/' . $newlampiranname;  
	}
	switch ($_POST['btn']){
		case 'Simpan':
			move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			$filesurat='surat/inbox/'.$newsuratname;
			if ($lampiranname!=''){
				$filelampiran= 'surat/inbox/lampiran/' . $newlampiranname;
				move_uploaded_file($tmplampiran, $_SERVER['DOCUMENT_ROOT'] . $destlampiran);
			}else{
				$lampiran='';
			}
			$tuj=$_POST['tujuan'];
			$jtuj=count($tuj);
			for ($i=0;$i<$jtuj;++$i){$rtuj.="$tuj[$i],";}
			$tujuan=substr("$rtuj",0,strlen($rtuj)-1);
			$data=array('id'=>$noid,'nourut'=>$nourut,'nosurat'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'dari'=>$_POST['dari'],'tujuan'=>$tujuan,'kode'=>$_POST['kode'],'noindex'=>$_POST['noindex'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$filesurat,'lampiran'=>$_POST['lampiran'],'status'=>'new');
			//$surat->addData($data);
			//header("location:$link");		
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