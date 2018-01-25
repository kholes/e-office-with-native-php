<?php
include "class/surat.cls.php";
include "class/jabatan.cls.php";
$surat=new Surat();
$jabatan=new Jabatan();
$ide=$_POST['ide'];
$link='?p='.encrypt_url('entrisuratform');
if(isset($idx)){$btn='Edit';}else{$btn='Simpan';}
?>
<script>
	function cekForm(){
		var tanggal=document.getElementById('tanggal');
		var jam=document.getElementById('jam');
		var tujuan=document.getElementById('tujuan');
		var dari=document.getElementById('dari');
		var no=document.getElementById('no');
		var index=document.getElementById('index');
		var rangkuman=document.getElementById('rangkuman');
		var bagian=document.getElementById('bagian');
		var kode=document.getElementById('kode');
		var nobindex=document.getElementById('nobindex');
		var norak=document.getElementById('norak');
		var surat=document.getElementById('surat');
		var lampiran=document.getElementById('lampiran');
		if ('files' in surat){
			for (var i = 0; i < surat.files.length; i++) {
				var fileSurat = surat.files[i];
					
				var namaSurat=fileSurat.name;
				var ukuranSurat=fileSurat.size;
				var tipeSurat=fileSurat.type;
			}
		}
		if ('files' in lampiran){
			for (var i = 0; i < lampiran.files.length; i++) {
				var fileLampiran = lampiran.files[i];
				var namaLampiran =fileLampiran.name;
				var ukuranLampiran =fileLampiran.size;
				var tipeLampiran =fileLampiran.type;
			}
		}
        var message = "";
		if(surat.value==''){
			alert('File surat tidak boleh kosong.');
		}else{
			var suratExt=namaSurat.substr(namaSurat.lastIndexOf('.') + 1).toLowerCase();
			if(suratExt!="docx" && suratExt!="doc" && suratExt!="pdf"){
				alert("Extensi file tidak sesuai, gunakan file : PDF / DOC / DOCX.");
			}else{
				if(lampiran.value==''){
					var n=confirm('File lampiran kosong, apakah akan dilanjutkan?');
					if(n==true){
							//alert("SUBMIT");
							document.getElementById('btn').click();
							//document.forms['entri'].submit();
							//var info = document.getElementById ("info");
							//info.innerHTML = message;
					}else{
						return;
					}
				}else{
					var lampExt=namaLampiran.substr(namaLampiran.lastIndexOf('.') + 1).toLowerCase();
					if(lampExt!="docx" && lampExt!="doc" && lampExt!="pdf"){
						alert("Extensi file tidak sesuai, gunakan file : PDF / DOC / DOCX.");
						return;
					}else{
						document.getElementById('btn').click();
						//document.forms['entri'].submit();
						//var info = document.getElementById ("info");
						//info.innerHTML = message;
					} 				
				}
			}		
		}		
    }
	function hapus(id){
		$.ajax({
			type:'post',
			url:'?p=entrisurat',
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
</script>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head">
              <div class="p-head-c">
		<div id="right">
			Cari &raquo; <input type="text" name="cari" id="cari">
		</div>
		<div id="left">
			<ul>
				<li><a href="?p=<?php echo encrypt_url('entrisuratform');?>">Surat Baru</a></li>
			</ul>
		</div>
		</div>
	</div>
	<div class="p-wrapper">
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" class="p-frm" name="entri" id="entri">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<th colspan="7" align="center"><h3>FORM SURAT MASUK</h3></th>
					<tr>
						<td class="btn" colspan="7" ><input type="hidden" name="id" id="id" value="<?php echo $ide; ?>"></td>
			  </tr>
					<tr>
						<td valign="top">Kepada</td>
						<td colspan="4">
							<li>
								<input type="checkbox" name="tujuan[]" id="tujuan" value="KKR">
						  		<?php echo $jabatan->getField('jabatan','KKR'); ?> 
							</li>
							<li>
								<input type="checkbox" name="tujuan[]" id="tujuan" value="KTU">
							  	<?php echo $jabatan->getField('jabatan','KTU'); ?> 
							</li>
						</td>
					</tr>
				    <tr>
						<td width="261">Dari</td>
					  	<td width="249"><input type="text" name="dari" id="dari" style="width:100%;"></td>
						<td width="127">&nbsp;</td>
						<td width="126">Tanggal</td>
					  	<td width="220">
							<input type="text" class="tgl" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/>
						</td>
				    </tr>
					<tr>
						<td valign="top">No. Surat </td>
						<td>
							<input type="text" name="nosurat" id="nosurat" style="width:100%;" value="" />
						</td>
						<td>&nbsp;</td>
						<td>Jam</td>
						<td><input type="text" name="jam" id="jam" value="<?php echo $jam; ?>"></td>
					</tr>
				    <tr>
						<td>Index</td>
						<td><input type="text" name="index" id="index" style="width:100%;"></td>
				    </tr>
					<tr>
						<td>Isi Surat </td>
						<td colspan="4">Rangkuman Surat :</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="4"><textarea name="rangkuman" id="rangkuman" style="width:100%; height:100px;"></textarea></td>
					</tr>
					<tr>
						<td>Kode</td>
						<td><input type="text" name="kode" id="kode" value=""  style="width:100%;" /></td>
						<td>&nbsp;</td>
						<td>File Surat (PDF) </td>
						<td><input type="file" name="surat[]" id="surat" multiple="multiple" /></td>
					</tr>
					<tr>
						<td>No.Bindex</td>
						<td><input type="text" name="nobindex" id="nobindex"  style="width:100%;"></td>
						<td>&nbsp;</td>
						<td>Lampiran (PDF) </td>
						<td><input type="file" name="lampiran[]" id="lampiran" /></td>
					</tr>
					<tr>
						<td>No.Rak</td>
						<td><input type="text" name="norak" id="norak"  style="width:100%;"></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					  <td class="btn" colspan="7" align="right">
						<input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" /></td>
					</tr>
          </table>
	  </form>
</div>
</body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$timenow=$date->format('Ymdhis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$newsuratname="inbox_".$timenow.".".$extsurat;
		$destsurat= $path['dirname'] . '/surat/' . $newsuratname;
	}
	$numfile = count ($_FILES['lampiran']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmplampiran = $_FILES['lampiran']['tmp_name'][$i];
		$lampirantype = $_FILES['lampiran']['type'][$i];
		$lampiransize = $_FILES['lampiran']['size'][$i];
		$lampiranname = $_FILES['lampiran']['name'][$i];
		$extlampiran = getext($lampiranname);
		$newlampiranname="lampiran_".$timenow.".".$extlampiran;
		$destlampiran= $path['dirname'] . '/surat/lampiran/' . $newlampiranname;  
	}
	switch ($_POST['btn']){
		case 'Simpan':
			move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			$filesurat='surat/'.$newsuratname;
			if ($lampiranname!=''){
				$filelampiran= 'surat/lampiran/' . $newlampiranname;
				move_uploaded_file($tmplampiran, $_SERVER['DOCUMENT_ROOT'] . $destlampiran);
			}else{
				$lampiran='';
			}
			$tuj=$_POST['tujuan'];
			$jtuj=count($tuj);
			for ($i=0;$i<$jtuj;++$i){$rtuj.="$tuj[$i],";}
			$tujuan=substr("$rtuj",0,strlen($rtuj)-1);
			$id=$timenow;
			$data=array('id'=>$id,'no'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jam'=>$_POST['jam'],'dari'=>$_POST['dari'],'tujuan'=>$tujuan,'kode'=>$_POST['kode'],'nobindex'=>$_POST['nobindex'],'norak'=>$_POST['norak'],'index'=>$_POST['index'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$filesurat,'lampiran'=>$filelampiran,'status'=>'1');
			$surat->addData($data);
			header("location:$link");		
		break;
		case 'Edit':
			$oldsurat=$surat->getField('surat',$id);
			$newsurat='surat/'.$suratname;
			$oldlampiran=$surat->getField('lampiran',$id);
			$newlampiran= 'surat/lampiran/' . $lampiranname;		
			if ($suratname!=''){
				if($lampiranname!=''){
					if (file_exists($oldsurat)) { unlink ($oldsurat);}
					if (file_exists($oldlampiran)) { unlink ($oldlampiran);}
					move_uploaded_file($tmpimg, $_SERVER['DOCUMENT_ROOT'] . $destimg);
					move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
					$data=array('no'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jam'=>$_POST['jam'],'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'index'=>$_POST['index'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$newsurat,'lampiran'=>$newlampiran);
					$surat->updateData($id,$data);	
				}else{
					if (file_exists($oldsurat)) { unlink ($oldsurat);}
					move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
					$data=array('no'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jam'=>$_POST['jam'],'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'index'=>$_POST['index'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$newsurat,'lampiran'=>$oldlampiran);
					$surat->updateData($id,$data);	
				}
			}else{
				if($lampiranname!=''){
					if (file_exists($oldlampiran)) { unlink ($oldlampiran);}
					move_uploaded_file($tmplampiran, $_SERVER['DOCUMENT_ROOT'] . $destlampiran);
					$data=array('no'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jam'=>$_POST['jam'],'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'index'=>$_POST['index'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$oldsurat,'lampiran'=>$newlampiran);
					$surat->updateData($id,$data);	
				}else{
					$data=array('no'=>$_POST['nosurat'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jam'=>$_POST['jam'],'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'kode'=>$_POST['kode'],'index'=>$_POST['index'],'rangkuman'=>$_POST['rangkuman'],'surat'=>$oldsurat,'lampiran'=>$oldlampiran);
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