<?php 
$act=$_GET['act'];
$id=$_GET['id'];
if($act=='edit'){
	$val='EDIT';
	$mail_date=tgl_eng_to_ind($mail->getField('mail_date',$id));
	$btn='Ubah';
	$nourut=$mail->getField('mail_index',$id);
	$ext=$mail->getField('mail_file01_type',$id);
	$file=$mail->getField('mail_file01',$id);
	$name=substr(substr(substr(substr($file,6),0,-strlen($ext)),0,-1),0,-14).".".$ext;
}else{
	$val='REGISTRASI';
	$mail_date=$date->format('d-m-Y');
	$btn='Kirim';
	$a=$mail_out->getLast();
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
}
?>
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
		var id='<?php echo $id;?>';
		var type='<?php echo $act;?>';
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getKode&tb=in&klasi='+noin+'&id='+id+'&type='+type,
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
		var type='<?php echo $act;?>';
		if(type=='edit'){
			$('#entri').submit();
		}else{
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
    }
	function getFileExtension(filename) {
		return /[^.]+$/.exec(filename);
	}	
</script>
<div class="p-wrapper">
<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
		<div id="label-form">
			<li class="fa fa-file">   <label>SURAT MASUK</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
	<form method="post" action="<?php echo $link; ?>&m=fsuratmasuk" enctype="multipart/form-data" id="entri">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
				<td colspan="7">
				<input type="hidden" name="dari" id="dari" style="width:100%;" value="<?php echo $logid;?>">
				<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">			</td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold">1. KEPADA</p></td>
				<td  class="frm" colspan="0">
				<?php 
					function cek($inputname,$v,$data,$id){
						$cek='checked';
						$pegawai=new Pegawai();
						$x=explode(',',$data);
						$n=sizeof($x);
						if($v==$x[0] or $v==$x[1] or $v==$x[2] or $v==$x[3] or $v==$x[4] or $v==$x[5] or $v==$x[6] or $v==$x[7] or $v==$x[8] or	$v==$x[9] or $v==$x[10]){$cek="checked";}else{$cek="";}
						echo "<li><input name='$inputname"."[]' type='checkbox' value='$v' class='ksi' $cek >&nbsp;".$pegawai->getField('jabatan',$v)."</li>";
					}
					$kkr=$pegawai->getWhere('level','KKR');
					if($kkr!=array()){
						$data=$mail->getField('mto',$id);
						foreach($kkr as $row){
							$inputname='mto';
							$value=$row['id'];
							$class=$mail;
							cek($inputname,$value,$data,$id);
						}
					}
					$ksi=$pegawai->getWhere('level','KTU');
					if($ksi!=array()){
						$data=$mail->getField('mto',$id);
						foreach($ksi as $row){
							$inputname='mto';
							$value=$row['id'];
							$class=$mail;
							cek($inputname,$value,$data,$id);
						}
					}
					?>
				</td>
				<td>&nbsp;</td>
				<td><p style="font-weight:bold">2. NOMOR URUT</p></td>
				<td><input type="text" name="mail_index" id="mail_index" value="<?php echo $nourut;?>" style="width:40px;" /></td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold">3. NO.SURAT</p></td>
				<td width="270" class="frm">
			  <input type="text" name="mail_no" id="mail_no" style="width:100%;" value="<?php echo $mail->getField('mail_no',$id);?>" />		  </td>
				<td width="17" class="frm">&nbsp;</td>
			  <td width="101" class="frm"><p style="font-weight:bold">4. TANGGAL SURAT</p></td>
				<td width="200" class="frm">
			  <input type="text" class="tgl" name="mail_date" id="mail_date" 
					value="<?php echo $mail_date; ?>"  onclick="return showCalendar('mail_date', 'dd-mm-y')"/>		  </td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold">5. KLASIFIKASI</p></td>
				<td>
					<select name="mail_codeindex" id="mail_codeindex" onchange="getKode();" style="width:100%;">
						<?php if($act=='edit'){ ?>
						<option value="<?php echo $mail->getField('mail_codeindex',$id);?>" selected="selected">
						<?php echo $mail->getField('mail_codeindex',$id);?> | <?php echo $index->getField('keterangan',$mail->getField('mail_codeindex',$id));?>					
						</option>
						<?php
						}
						$x=$index->getAll();
						foreach($x as $row){
							echo "<option value=".$row['id']."><b>".$row['id']."</b> | ".$row['keterangan']."</option>";
						}
						?>
					</select>			</td>
				<td>&nbsp;</td>
				<td><p style="font-weight:bold">6. KODE KLASIFIKASI</p></td>
				<td width="200" class="frm"><span id="infKode"></span></td>
			</tr>
			<tr>
			  <td width="214" style="vertical-align:top"><p style="font-weight:bold">7. DARI</p></td>
				<td class="frm" colspan="4"><input type="text" name="mail_from" id="mail_from" value="<?php echo $mail->getField('mail_from',$id);?>" style="width:99%;"></td>
			</tr>
			<tr>
			  <td width="214" style="vertical-align:top"><p style="font-weight:bold">8. UNTUK</p></td>
				<td class="frm" colspan="4"><input type="text" name="mail_to" id="mail_to" style="width:99%;" value="<?php echo $mail->getField('mail_to',$id);?>"></td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold;">9. RINGKASAN/URAIAN</p></td>
				<td colspan="4" class="frm"><textarea name="mail_about" id="elm1" style="height:100px; width:99%;">
				  <?php echo $mail->getField('mail_about',$id);?></textarea>	
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold">10. FILE SURAT(PDF)</p></td>
				<td style="vertical-align:top"><input type="file" name="surat[]" id="surat" multiple="multiple" /></td>
				<td style="vertical-align:top">
				<?php
				switch($mail->getField('mail_file01_type',$id)){
					case 'pdf':
						echo "<a href='".$mail->getField('mail_file01',$id)."' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='".$mail->getField('mail_file01',$id)."' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='".$mail->getField('mail_file01',$id)."' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='".$mail->getField('mail_file01',$id)."' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='".$mail->getField('mail_file01',$id)."' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
				}
				?>
				<input type="hidden" name="file01" value="<?php echo $mail->getField('mail_file01',$id);?>" />
				<input type="hidden" name="ext01" value="<?php echo $mail->getField('mail_file01_type',$id);?>" />
				</td>
				<td colspan="2" style="vertical-align:middle">
				<?php echo $name;?>
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top"><p style="font-weight:bold">11. LAMPIRAN (Dokumen besar/Barang)</p></td>
			  <td class="frm" colspan="4"><textarea name="mail_attc" id="mail_attc" style="width:99%;"><?php echo $mail->getField('mail_attc',$id);?></textarea></td>
			</tr>
		</table>
	  <div class="head_content" style="box-shadow:none;" >
			<input type="hidden" name="btn" value="<?php echo $btn; ?>">
			<input type="button" name="tombol" id="tombol" class="btn" value="<?php echo $btn; ?>" />			
	    &nbsp;</div>
	</form>	
</div>
</div>
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
			$newsuratname=substr($suratname,0,-$trim).$date->format('Ymd').$G.$date->format('is').".".$extsurat;
			$filesurat='inbox/'.$newsuratname;
			$n_mto=sizeof($_POST['mto']);
			for($i_mto=0;$i_mto<$n_mto;$i_mto++){
				$mto=$_POST['mto'][$i_mto];
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$_POST['content'],'content_disposisi'=>$_POST['content_disposisi'],'mail_index'=>$_POST['mail_index'],'mail_no'=>$_POST['mail_no'],'mail_date'=>tgl_ind_to_eng($_POST['mail_date']),'mail_from'=>$_POST['mail_from'],'mail_to'=>$_POST['mail_to'],'mail_code'=>$_POST['codeindex'],'mail_codeindex'=>$_POST['mail_codeindex'],'mail_about'=>$_POST['mail_about'],'mail_status'=>'new','mail_file01'=>$filesurat,'mail_file01_type'=>$extsurat,'mail_attc'=>$_POST['mail_attc'],'replay'=>$noid);
				$add=$mail->addData($data);
				$add=$mail_out->addData($data);
			}
			if($add){
				$destsurat= $path['dirname'] . '/inbox/' . $newsuratname;
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			}
			header("location:$link&m=min_out");		
		break;
		case 'Ubah':
			$oldmail=$mail->getField('mail_file01',$id);
			$oldtrim=strlen($mail->getField('mail_file01_type',$id));
			$datefile=substr(substr(substr(substr($oldmail,6),0,-$oldtrim),0,-1),-14);
			
			if($extsurat!=''){
				if (file_exists($oldmail)) { unlink ($oldmail);}
				$newsuratname=substr($suratname,0,-$trim).$datefile.".".$extsurat;
				$destsurat= $path['dirname'] . '/inbox/' . $newsuratname;
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
				$file='inbox/'.$newsuratname;
				$ext=$extsurat;
			}else{
				$file=$mail->getField('mail_file01',$id);
				$ext=$mail->getField('mail_file01_type',$id);
			}
			$mto=implode(",", $_POST['mto']);
			$status=$mail->getField('mail_status',$id);
			$type=$mail->getField('mail_type',$id);
			
			$idx=substr(substr($id,0,-3),3);
			$datax=$mail->getLike('id',$idx);
			foreach($datax as $row){
				//echo $row['id']."<br><br><br>";
				$data=array('mto'=>$row['mto'],'content'=>$_POST['content'],'disposisi_content'=>$_POST['disposisi_content'],'mail_type'=>$row['mail_type'],'mail_index'=>$_POST['mail_index'],'mail_no'=>$_POST['mail_no'],'mail_date'=>tgl_ind_to_eng($_POST['mail_date']),'mail_from'=>$_POST['mail_from'],'mail_to'=>$_POST['mail_to'],'mail_code'=>$_POST['codeindex'],'mail_codeindex'=>$_POST['mail_codeindex'],'mail_about'=>$_POST['mail_about'],'mail_status'=>$status,'mail_file01'=>$file,'mail_file01_type'=>$ext,'mail_attc'=>$_POST['mail_attc']);
				$mail->updateData($row['id'],$data); //Update semua data dengan id yang sama.
			}
			header("location:$link&m=min&o=out");	
		break;		
	}
}
?>