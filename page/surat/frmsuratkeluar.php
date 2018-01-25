<?php
$id=$_GET['id'];
$act=$_GET['act'];
$replay=$mailint->getField('replay',$id);
if($act=='edit'){
	$val='EDIT';
	$btn='Ubah';
	//Isi variable edit
	$surut=$mailout->getField('nourut',$id);
	$n_surut=strlen($surut)+1;
	$sbag=substr(substr(substr($mailout->getField('nosurat',$id),0,-5),4),$n_surut);
	$sthn=substr($mailout->getField('nosurat',$id),-4);
	$sindex=substr($mailout->getField('nosurat',$id),0,3);
}else{
	$val='REGISTRASI';
	$btn='Kirim';
	$a=$mailout->getLast();
	$replay=$replay;
	if($a==''){
		$nourut=$xy='001';
	}else{
		$n=strlen($nourut);
		if($n>3){
			$x=substr($a,0,-1);
			$xy=$x+1;
		}else{
			$xy=$a+1;
		}
		if(strlen($xy)==1){$nourut='00'.$xy;}
		if(strlen($xy)==2){$nourut='0'.$xy;}	
		if(strlen($xy)==3){$nourut=$xy;}
	}
	//Isi variable Reg
	$surut=$nourut;
	$sthn=$date->format('Y');

}
?>
<script>
	$(document).ready(function(){
		getKode();
		$("#dari").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
		//$("#repsurat").autocomplete("page/surat/srcsuratmasuk.php", {selectFirst: true});
	});
	function getTujuan(val){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getTujuan&val='+val,
			cache :false,
			success:function (data){
				$('#sbag').val(data);
			}
		});		
	}
	/*
	$(document).ready(function(){
		$('#infNo').hide();
		$('#jenis').click(function(){
			var x=document.getElementById('jenis').checked;
			if(x==true){
				$('#infNo').show();
				$('#repsurat').focus();
			}
			if(x==false){
				$('#infNo').hide();
			}
		});
	});
	*/
	function kirim(){
		$('#entri').submit();
	}
	function getKode(){
		var noin=document.getElementById('klasifikasi').value;
		var type='<?php echo $act;?>';
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getKode&id=<?php echo $_GET['id'];?>&klasi='+noin+'&type='+type+'&tb=out',
			cache :false,
			success:function (data){
				$('#infKode').html(data);
				getNoSurat();			
			}
		});
	}
	function getNoSurat(){
		var noindex=document.getElementById('klasifikasi').value;
		var kode=document.getElementById('codeindex').value;
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getNoSurat&noindex='+noindex+'&kode='+kode,
			cache :false,
			success:function (data){
				var obData=eval(data);
				$('#sindex').val(obData[0]);
				//$('#surut').val('');
				//$('#sbag').val(obData[1]);
				$('#sthn').val(obData[2]);
			}
		});
	}
</script>
<div class="p-wrapper">
<div class="content">
		<div id="label-form">
			<li class="fa fa-file">   <label>SURAT KELUAR</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
	<form method="post" action="<?php echo $link; ?>&m=fsuratkeluar" enctype="multipart/form-data" id="entri">
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
		<input type="hidden" name="replay" value="<?php echo $replay;?>" />
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
			<td style="vertical-align:top"><p style="font-weight:bold">1. JENIS SURAT</p></td>
			  <td style="vertical-align:top">
					<select name="jenis" id="jenis">
						<?php 
						if($act=='edit'){
							echo "<option value='".$mailout->getField('jenis',$id)."' selected='selected'>".$mailout->getField('jenis',$id)."</option>"; 
						}
						?>
						<option value="UMUM">UMUM</option>
						<option value="SPPD">SPPD</option>
						<option value="SPT">SPT</option>
						<option value="SK">SK</option>
					</select></td>
			    <td class="frm">&nbsp;</td>
		    <td class="frm">&nbsp;</td>
			<td width="188"></td>
		</tr>
		<tr>
		  <td width="169" style="vertical-align:top"><p style="font-weight:bold">2. DARI</p></td>
			<td colspan="4"><input type="text" name="dari" id="dari" value="<?php echo $mailout->getField('dari',$id);?>" style="width:100%;"></td>
		</tr>
		<tr>
			<td width="169" style="vertical-align:top"><p style="font-weight:bold">3. TUJUAN</p></td>
			<td class="frm" colspan="4"><input type="text" name="tujuan" id="tujuan" style="width:100%;" value="<?php echo $mailout->getField('tujuan',$id);?>"></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><p style="font-weight:bold; vertical-align:top">4. URAIAN</p></td>
			<td colspan="4"><textarea id="uraian" name="uraian" rows="5" style="width:100%"><?php echo $mailout->getField('uraian',$id);?></textarea></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><p style="font-weight:bold">6. KLASIFIKASI</p></td>
			<td class="frm">
				<select name="klasifikasi" id="klasifikasi" onchange="getKode();" style="width:100%">
					<?php if($act=='edit'){ ?>
					<option value="<?php echo $mailout->getField('klasifikasi',$id);?>" selected="selected">
					<?php echo $mailout->getField('klasifikasi',$id);?> | <?php echo $index->getField('keterangan',$mailout->getField('klasifikasi',$id));?>					
					</option>
					<?php
					}
					$x=$index->getAll();
					foreach($x as $row){
						echo "<option value=".$row['id']."><b>".$row['id']."</b> | ".$row['keterangan']."</option>";
					}
					?>
				</select>				</td>
			<td class="frm">&nbsp;</td>
			<td><p style="font-weight:bold">7. INDEX</p></td>
			<td width="188" class="frm"><span id="infKode"></span></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><p style="font-weight:bold">8. NO.SURAT</p></td>
			<td width="221" class="frm"><input type="text" name="sindex" id="sindex" style="width:30px; font-weight:bold;" value="<?php echo $surut;?>" />/
				<input type="text" name="surut" id="surut" style="width:50px; font-weight:bold;" value="<?php echo $surut;?>" />
				/					
				<input type="text" name="sbag" id="sbag" style="width:50px; font-weight:bold;" value="<?php echo $sbag;?>" />
			  -					
		  <input type="text" name="sthn" style="width:50px; font-weight:bold;" value="<?php echo $sthn; ?>" />			</td>
			<td width="17" class="frm">&nbsp;</td>
		  <td width="207" class="frm"><p style="font-weight:bold">9. TGL.SURAT</p></td>
			<td width="188" class="frm">
		  		<input type="text" class="tgl" name="tgl_surat" id="tgl_surat" 
				value="<?php if($id==''){echo $date->format('d-m-Y');}else{echo tgl_eng_to_ind($mailout->getField('tgl_surat',$id));} ?>"  onclick="return showCalendar('tgl_surat', 'dd-mm-y')"/>			</td>
		</tr>
		<tr>
			<td style="vertical-align:top"><p style="font-weight:bold">9. FILE SURAT (PDF)</p></td>
			<td class="frm"><input type="file" name="surat[]" id="surat" multiple="multiple" /></td>
			<td class="frm">
			<?php
			$file=$mailout->getField('file',$id);
			if($file!=''){
				echo "<a href='".$mailout->getField('file',$id)."' target='_blank'><img src='img/pdf-icon.png'/></a>";
			}
			?>			
			</td>
			<td style="vertical-align:middle">
				<h3><?php echo substr($mailout->getField('file',$id),7);?></h3>			
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;"><p style="font-weight:bold;">10. LAMPIRAN<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<em>Dokumen besar/barang</em>)</p></td>
		  <td class="frm" colspan="4"><textarea name="lampiran" id="lampiran" style="width:100%;"><?php echo $mailout->getField('lampiran',$id);?></textarea></td>
		</tr>
		<tr>
			<td class="btn frm" colspan="7" align="right">		</td>				
		</tr>
	</table>
	<div class="head_content" style="box-shadow:none;" >
		<input type="hidden" name="btn" value="<?php echo $btn; ?>">
		<input type="button" name="tombol" id="tombol" onclick="kirim();" value="<?php echo $btn; ?>" />
	</div>
</form>	
</div>
</div>
<script>
$('#dari').keypress(function(e){
	if(e.keyCode==13){
		$('#tujuan').focus();
		getTujuan($('#dari').val());
	}
});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$trim=strlen($extsurat)+1;

	}
	switch ($_POST['btn']){
		case 'Kirim':
			$dari=substr($_POST['dari'],-3);
			$newsuratname=substr($suratname,0,-$trim).$date->format('Ymd').$G.$date->format('is').".".$extsurat;
			$filesurat='outbox/'.$newsuratname;
			$nosurat=$_POST['sindex']."/".$_POST['surut']."/".$_POST['sbag']."-".$_POST['sthn'];
			$noid=$logid.'1'.$date->format('Ymd').$G.$date->format('is').'000';

			$data=array('id'=>$noid,'nourut'=>$_POST['surut'],'jenis'=>$_POST['jenis'],'tanggal'=>$date->format('Y-m-d G:i:s'),'klasifikasi'=>$_POST['klasifikasi'],'codeindex'=>$_POST['codeindex'],'nosurat'=>$nosurat,'tgl_surat'=>tgl_ind_to_eng($_POST['tgl_surat']),'dari'=>$dari,'tujuan'=>$_POST['tujuan'],'uraian'=>$_POST['uraian'],'file'=>$filesurat,'lampiran'=>$_POST['lampiran'],'replay'=>$_POST['replay']);
			//print_r($data);
			$add=$mailout->addData($data);
			if($add){
				$destsurat= $path['dirname'] . '/outbox/' . $newsuratname;
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			}
			header("location:$link&m=mout");		
		break;
		case 'Ubah':
			$oldmail=$mailout->getField('file',$id);
			$oldtrim=3;
			$datefile=substr(substr(substr(substr($oldmail,6),0,-$oldtrim),0,-1),-14);
			
			if($extsurat!=''){
				if (file_exists($oldmail)) { unlink ($oldmail);}
				$newsuratname=substr($suratname,0,-$trim).$datefile.".".$extsurat;
				$destsurat= $path['dirname'] . '/outbox/' . $newsuratname;
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
				$file='outbox/'.$newsuratname;
			}else{
				$file=$mailout->getField('file',$id);
			}
			$nosurat=$_POST['sindex']."/".$_POST['surut']."/".$_POST['sbag']."-".$_POST['sthn'];
			$data=array('nourut'=>$_POST['surut'],'jenis'=>$_POST['jenis'],'klasifikasi'=>$_POST['klasifikasi'],'codeindex'=>$_POST['codeindex'],'nosurat'=>$nosurat,'tgl_surat'=>tgl_ind_to_eng($_POST['tgl_surat']),'dari'=>$_POST['dari'],'tujuan'=>$_POST['tujuan'],'uraian'=>$_POST['uraian'],'file'=>$file,'lampiran'=>$_POST['lampiran'],'replay'=>$_POST['replay']);
			$update=$mailout->updateData($id,$data);
			if($update){
				header("location:$link&m=min_out");		
			}
		break;		
	}
}
?>