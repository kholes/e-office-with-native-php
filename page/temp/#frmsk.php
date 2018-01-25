<?php
$id=$_GET['id'];
$noindex=$sk->lastIndexout();
//$draft=$mailint->getField('draft_from',$id);
$bag=$pegawai->getField('bagian',$draft);
?>
<script>
	$(document).ready(function(){
		getKode();
		$("#repsurat").autocomplete("page/surat/srcsuratmasuk.php", {
			selectFirst: true
		});
	});
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
	function kirim(){
		$('#entri').submit();
	}
	function getKode(){
		var noin=document.getElementById('mail_codeindex').value;
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getKode&klasi='+noin,
			cache :false,
			success:function (data){
				$('#infKode').html(data);
				getNoSurat();			
			}
		});
	}
	function getNoSurat(){
		var noindex=document.getElementById('mail_codeindex').value;
		var kode=document.getElementById('mail_code').value;
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
<div id="head">&raquo; REGISTRASI SURAT KEPUTUSAN </div>
<form method="post" action="<?php echo $link; ?>&m=fsk" enctype="multipart/form-data" id="entri">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="frm">KLASIFIKASI</td>
			<td class="frm">
				<select name="mail_codeindex" id="mail_codeindex" onChange="getKode();" style="width:100%">
					<?php
					$x=$klas->getAll();
					foreach($x as $row){
						echo "<option value=".$row['id']."><b>".$row['id']."</b> | ".$row['klasifikasi']."</option>";
					}
					?>
				</select>				
				</td>
			<td class="frm"><input type="hidden" name="id" id="id" value="<?php echo $id;?>" /></td>
			<td class="frm">INDEX </td>
			<td width="232" class="frm"><span id="infKode"></span></td>
		</tr>
		<tr>
			<td valign="top" class="frm">NOMOR</td>
			<td width="266" class="frm"><input type="text" name="sindex" id="sindex" style="width:30px; font-weight:bold;" value="" />/
				<input type="text" name="surut" id="surut" style="width:50px; font-weight:bold;" value="<?php echo $noindex;?>" />
				/					
				<input type="text" name="sbag" id="sbag" style="width:60px; font-weight:bold;" value="SK/TU/V" />
			  -					
				<input type="text" name="sthn" id="sthn" style="width:50px; font-weight:bold;" value="<?php echo $date->format('Y');?>" />			</td>
			<td width="177" class="frm">&nbsp;</td>
			<td width="112" class="frm">TGL.SURAT</td>
			<td width="232" class="frm">
				<input type="text" class="tgl" name="mail_date" id="mail_date" 
				value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('mail_date', 'dd-mm-y')"/>			</td>
		</tr>
		<tr>
			<td width="185" class="frm">DARI</td>
			<td class="frm" colspan="4"><input type="text" name="mail_from" id="mail_from" value="KANTOR PENGHUBUNG PROVINSI SUMATERA BARAT" style="width:100%;"></td>
		</tr>
		<tr>
			<td width="185" class="frm">TUJUAN</td>
			<td class="frm" colspan="4"><input type="text" name="mail_to" id="mail_to" style="width:100%;" value="<?php echo $mail->getField('mail_to',$id);?>"></td>
		</tr>
		<tr>
			<td class="frm">URAIAN</td>
			<td colspan="4"><textarea id="mail_about" name="mail_about" rows="5" style="width:100%"><?php echo $mail->getField('mail_about',$id);?></textarea></td>
		</tr>
		<tr>
			<td class="frm">FILE SURAT(PDF) </td>
			<td class="frm"><input type="file" name="surat[]" id="surat" multiple="multiple" /></td>
			<td class="frm" colspan="3"><a href="<?php echo $mail->getField('mail_file',$id);?>" target="_blank"><h3><?php echo substr($mail->getField('mail_file',$id),6);?></h3></a></td>
		</tr>
		<tr>
			<td class="frm">LAMPIRAN (Dokumen besar/Barang) </td>
		  <td class="frm" colspan="4"><textarea name="mail_attc" id="mail_attc" style="width:100%;"><?php echo $mail->getField('mail_attc',$id);?></textarea></td>
		</tr>
		<tr>
			<td class="btn frm" colspan="7" align="right">
				<input type="hidden" name="btn" value="<?php echo $btn; ?>">
				<input type="button" name="tombol" id="tombol" class="btn" onClick="kirim();" value="<?php echo $btn; ?>" />			</td>				
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
	$id=$logid.$date->format('YmdGis');
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['surat']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpsurat = $_FILES['surat']['tmp_name'][$i];
		$surattype = $_FILES['surat']['type'][$i];
		$suratsize = $_FILES['surat']['size'][$i];
		$suratname = $_FILES['surat']['name'][$i];
		$extsurat = getext($suratname);
		$newsuratname=$id.".".$extsurat;
		$destsurat= $path['dirname'] . '/outbox/sk/' . $newsuratname;
		$suratname='outbox/sk/'.$newsuratname;
	}
	switch ($_POST['btn']){
		case 'Simpan':
			$filesurat='outbox/sk/'.$newsuratname;
			$nosurat=$_POST['sindex']."/".$_POST['surut']."/".$_POST['sbag']."-".$_POST['sthn'];
			$data=array('id'=>$id,'fdate'=>$date->format('Y-m-d'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$_POST['content'],'mail_type'=>'out','mail_index'=>$_POST['surut'],'mail_no'=>$nosurat,'mail_date'=>tgl_ind_to_eng($_POST['mail_date']),'mail_from'=>$_POST['mail_from'],'mail_to'=>$_POST['mail_to'],'mail_code'=>$_POST['mail_code'],'mail_codeindex'=>$_POST['mail_codeindex'],'mail_about'=>$_POST['mail_about'],'mail_status'=>'end','mail_file01'=>$filesurat,'mail_file01_type'=>$extsurat,'mail_attc'=>$_POST['mail_attc'],'draft_from'=>$logid);
			$add=$sk->addData($data);
			if($add){
				$replay=$mailint->getField('replay',$id);
				$sk->setStatus($replay,'end');
				//$mailint->setStatus($id,'end');
				move_uploaded_file($tmpsurat, $_SERVER['DOCUMENT_ROOT'] . $destsurat);
			}
			header("location:$link&m=sk");		
		break;
	}
}
?>