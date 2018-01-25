<?php
$g=$_GET['g'];
$id=$_GET['ide'];
if(isset($id)){
	$btn='Edit';
}

?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		$("#obkepada").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
	});
	$(document).ready(function(){
		$("#repsurat").autocomplete("page/surat/srcsuratmasuk.php", {
			selectFirst: true
		});
	});
	function getId(){
		var data=$('#obkepada').val();
		var ob=eval(data);
		$('#kepada').val(ob[0]);
		$('#obkepada').val(ob[1]);
		$('#uraian').focus();
	}
	$(document).ready(function(){
		$('#idrep').hide();
		$('#jenis').click(function(){
			var x=document.getElementById('jenis').checked;
			if(x==true){
				$('#idrep').show();
				$('#idrep').focus();
			}
			if(x==false){
				$('#idrep').hide();
			}
		});
	});
	$(document).ready(function(){
		$('#tombol').click(function(){
			var sts='<?php echo $btn;?>';
			if(sts!='Edit'){
				cekForm();
			}else{
				if ('files' in surat){
					for (var i = 0; i < surat.files.length; i++) {
						var fileSurat = surat.files[i];
							
						var namaSurat=fileSurat.name;
						var ukuranSurat=fileSurat.size;
						var tipeSurat=fileSurat.type;
					}
				}
				var suratExt;
				suratExt=getFileExtension(namaSurat);
				if(suratExt!='undefined'){
					if(suratExt!="docx" && suratExt!="doc" && suratExt!="pdf"){
						alert("Extensi file tidak sesuai, gunakan file : PDF / DOC / DOCX.");
					}else{
						$('#entri').submit();
					}
				}else{
					$('#entri').submit();
				}		
			}
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
<div class="p-wrapper">
<div class="content">
<div id="head">&raquo; SURAT KELUAR</div>
<form method="post" action="<?php echo $link; ?>&m=fdraftsurat" enctype="multipart/form-data" id="entri">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="196" class="frm">Dari</td>
			<td colspan="4" class="frm">
				<input type="text" class="pasif" readonly="" name="nama_user" id="nama_user" style="width:100%;" value="<?php echo $pegawai->getField('nama',$logid);?>">	</td>
				<input type="hidden" name="dari" id="dari" style="width:100%;" value="<?php echo $logid;?>">			
				<td width="1"></td>
		</tr>
		<tr>
			<td class="frm">Jenis Surat </td>
	  		<td width="145" class="frm"><input type="checkbox" name="jenis" id="jenis" style="margin:5px 0px;" value="balasan" /> Surat Balasan		  
      	  <input type="hidden" name="id" value="<?php echo $id;?>" /></td>
			<td width="217"><p style="color:#FF0000; font-style:italic;"> *) No. Surat untuk surat balasan</p></td>						
		  <td width="412" class="frm"><input type="text" name="idrep" id="idrep" style="width:100%" /></td>
		</tr>
		<tr>
			<td class="frm">Kepada</td>
			<td class="frm" colspan="4">
				<input type="hidden" name="kepada" id="kepada" style="width:100%" />			
				<input type="text" name="obkepada" id="obkepada" style="width:100%" onchange="getId();" onblur="getId();" />			
			</td>						
		</tr>
		<tr>
			<td class="frm">Ringkasan / Uraian</td>
			<td colspan="4"><textarea id="uraian" name="uraian" rows="1" style="width:100%"><?php echo $suratkeluar->getField('uraian',$id);?></textarea></td>
		</tr>
		<tr>
			<td class="frm">Keterangan / Pesan</td>
			<td colspan="4"><textarea id="keterangan" name="keterangan" rows="3" style="width:100%"><?php echo $suratkeluar->getField('keterangan',$id);?></textarea></td>
		</tr>
		<tr>
			<td>Data/File Surat (DOC/PDF)</td>
			<td colspan="3">
				<span class="frm">
				  <input type="file" name="surat[]" id="surat" multiple="multiple" />
				</span>			</td>
		</tr>
		<tr>
			<td class="btn frm" colspan="7" align="right">
				<input type="hidden" name="btn" value="<?php echo $btn; ?>">
				<input type="button" name="tombol" id="tombol" class="btn" value="<?php echo $btn; ?>" />			</td>				
		</tr>
	</table>
</form>	
</div>
</div>
<script>
	$('#tujuan').keydown(function(e){
		if (e.keyCode==13){
			$('#kangkuman').focus();
		}
	});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$noid=$date->format('YmdGis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$newsuratname="outbox_".$noid.".".$extsurat;
		$destsurat= $path['dirname'] . '/surat/outbox/' . $newsuratname;
	}
	switch ($_POST['btn']){
		case 'Simpan':
			move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			$filesurat='surat/outbox/'.$newsuratname;
			$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d'),'jenis'=>$_POST['jenis'],'idrep'=>$_POST['idrep'],'dari'=>$_POST['dari'],'tujuan'=>$_POST['kepada'],'noindex'=>$_POST['noindex'],'kode'=>$_POST['kode'],'uraian'=>$_POST['uraian'],'keterangan'=>$_POST['keterangan'],'surat'=>$filesurat,'lampiran'=>$_POST['lampiran'],'logid'=>$pegawai->getField('jabatan',$logid));
			$add=$suratkeluar->addData($data);
			if($add){
				if($_POST['jenis']=='balasan'){
					$data=array('status'=>'prc','idrep'=>$noid,'id'=>$_POST['idrep']);
					$surat->updateRep($data);
				}
			}
			header("location:$link");		
		break;
		case 'Edit':		
			for ($i = 0; $i < $numfile; $i++){
				$tmpsurat = $_FILES['surat']['tmp_name'][$i];
				$surattype = $_FILES['surat']['type'][$i];
				$suratsize = $_FILES['surat']['size'][$i];
				$suratname = $_FILES['surat']['name'][$i];
				$extsurat = getext($suratname);
				$newsuratname="outbox_".$id.".".$extsurat;
				$destsurat= $path['dirname'] . '/surat/outbox/' . $newsuratname;
			}
			$oldsurat=$suratkeluar->getField('surat',$id);
			$newsurat='surat/outbox/'.$newsuratname;
			$oldlocation=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$oldsurat;
			if ($suratname!=''){
				if (file_exists($oldlocation)) { unlink ($oldlocation);}
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
				$data=array('dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'uraian'=>$_POST['uraian'],'keterangan'=>$_POST['keterangan'],'surat'=>$newsurat,'status'=>'proses');
				$rev=$suratkeluar->updateRevisi($id,$data);	
			}else{
				$data=array('dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'uraian'=>$_POST['uraian'],'keterangan'=>$_POST['keterangan'],'surat'=>$oldsurat);
				$suratkeluar->updateRevisi($id,$data);	
			}
			header("location:$link");	
		break;		
		case 'Hapus':
			$surat=$suratkeluar->getField('surat',$id);
				$lampiran=$suratkeluar->getField('lampiran',$id);
				$suratkeluar->delData($id);
				if (file_exists($suratkeluar)) { unlink ($suratkeluar);}
				if (file_exists($lampiran)) { unlink ($lampiran);}	
			break;		
	}
}
?>