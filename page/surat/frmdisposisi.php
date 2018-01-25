<?php
$id=$_GET['id'];
$act=$_GET['act'];
if(isset($act)){
	switch($act){
		case 'edit':
			$btn='Ubah';
		break;
	}
}else{
	$btn='Disposisi';
}
?>
<script>
	$(document).ready(function(){
		$("#lain").autocomplete("page/surat/srcpegawai.php", {selectFirst: true});
	});
	$(document).ready(function(){
		$('#kirim').click(function(){
			$('#frmDis').submit();
		});
	});
</script>
<div class="p-wrapper">
<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>SURAT MASUK</a></li>
			<li class="active">FORM DISPOSISI</li>
		</ul>
	</h3>
	<div class="c10"></div>
	<form method="post" action="<?php echo $link;?>&m=dis" id='frmDis' enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
			  <td width="27%" valign="top"><p style="font-weight:bold;">1. KEPADA</p></td>
				<td width="73%" class="list-ksi detail">
				<?php 
				function cek($inputname,$v,$data,$id){
					$cek='checked';
					$pegawai=new Pegawai();
					$x=explode(',',$data);
					$n=sizeof($x);
					if($v==$x[0] or $v==$x[1] or $v==$x[2] or $v==$x[3] or $v==$x[4] or $v==$x[5] or $v==$x[6] or $v==$x[7] or $v==$x[8] or	$v==$x[9] or $v==$x[10]){$cek="checked";}else{$cek="";}
					echo "<li><input name='$inputname"."[]' type='checkbox' value='$v' class='ksi' $cek >&nbsp;".$pegawai->getField('jabatan',$v)."</li>";
				}
				$skr=$pegawai->getWhere('level','SKR');
				if($skr!=array()){
					foreach($skr as $n){
						echo "<li><input type='checkbox' name='mto[]' value='".$n['id']."' class='ksi' checked /> ".$n['jabatan']."</li>";
					}
				}
				$ktu=$pegawai->getWhere('level','KTU');
				if($ktu!=array()){
					foreach($ktu as $n){
						echo "<li><input type='checkbox' name='mto[]' value='".$n['id']."' class='ksi' checked /> ".$n['jabatan']."</li>";
					}
				}
				$ksi=$pegawai->getWhere('level','KSI');
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
				<input type="text" name="lain" id="lain" value="<?php echo $mto;?>" />
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;"><p style="font-weight:bold; vertical-align:top;">2. INSTRUKSI / INFORMASI </p></td>
				<td style="border:none;" class="detail">
				  <textarea name="content_disposisi" id="elm1" class="pesan" style="height:100px;">
				  <?php echo $mail->getField('content_disposisi',$id);?>
				  </textarea>
				</td>
			</tr>
			<tr>
			<td valign="top"><p style="font-weight:bold;">3. BATAS WAKTU </p></td>
				<td>
			  		<input type="text" name="mail_limit" id="mail_limit" value="<?php if($mail->getField('mail_limit',$id)!='0000-00-00 00:00:00'){echo tgl_eng_to_ind($mail->getField('mail_limit',$id));} ?>"  onclick="return showCalendar('mail_limit', 'dd-mm-y')"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
				</td>
			</tr>
		</table>
		<div class="head_content" style="box-shadow:none;" >
			<input type="hidden" name="btn" value="<?php echo $btn; ?>" />
			<input type="button" id="kirim" value="<?php echo $btn;?>">
			&nbsp;
			<input name="button" style="float:right" type="button" class="btn" onclick="self.history.back();" value="Kembali" />				
		</div>
	</form>
</div>
</div>
<script>
$('#lain').keypress(function(e){
	if(e.keyCode==13){
		$('.pesan').focus()
	}
});

</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$replay=$mail->getField('replay',$id);
	switch($_POST['btn']){
		case 'Disposisi':
			$lain=substr($_POST['lain'],-3);
			$n_mto=sizeof($_POST['mto']);
			if($lain!=''){
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$lain;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$lain,'content'=>$mail->getField('content',$id),'content_disposisi'=>$_POST['content_disposisi'],'mail_index'=>$mail->getField('mail_index',$id),'mail_no'=>$mail->getField('mail_no',$id),'mail_date'=>$mail->getField('mail_date',$id),'mail_from'=>$mail->getField('mail_from',$id),'mail_to'=>$mail->getField('mail_to',$id),'mail_code'=>$mail->getField('mail_code',$id),'mail_codeindex'=>$mail->getField('mail_codeindex',$id),'mail_about'=>$mail->getField('mail_about',$id),'mail_file01'=>$mail->getField('mail_file01',$id),'mail_file01_type'=>$mail->getField('mail_file01_type',$id),'mail_status'=>'dis','replay'=>$replay,'mail_limit'=>tgl_ind_to_eng($_POST['mail_limit']));
				$add=$mail->addData($data);
				$add=$mail_out->addData($data);
			}
			for($i_mto=0;$i_mto<$n_mto;$i_mto++){
					$mto=$_POST['mto'][$i_mto];
					$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
					$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$mail->getField('content',$id),'content_disposisi'=>$_POST['content_disposisi'],'mail_index'=>$mail->getField('mail_index',$id),'mail_no'=>$mail->getField('mail_no',$id),'mail_date'=>$mail->getField('mail_date',$id),'mail_from'=>$mail->getField('mail_from',$id),'mail_to'=>$mail->getField('mail_to',$id),'mail_code'=>$mail->getField('mail_code',$id),'mail_codeindex'=>$mail->getField('mail_codeindex',$id),'mail_about'=>$mail->getField('mail_about',$id),'mail_file01'=>$mail->getField('mail_file01',$id),'mail_file01_type'=>$mail->getField('mail_file01_type',$id),'mail_status'=>'dis','replay'=>$replay,'mail_limit'=>tgl_ind_to_eng($_POST['mail_limit']));
					$add=$mail->addData($data);
					$add=$mail_out->addData($data);
			}
			if($add){
				header("location:$link&m=min_out");
			}
		break;
		case 'Ubah':
			$n_mto=sizeof($_POST['mto']);
			for($i_mto=0;$i_mto<$n_mto;$i_mto++){
				$mto=$_POST['mto'][$i_mto];
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$mail->getField('content',$id),'content_disposisi'=>$_POST['content_disposisi'],'mail_index'=>$mail->getField('mail_index',$id),'mail_no'=>$mail->getField('mail_no',$id),'mail_date'=>$mail->getField('mail_date',$id),'mail_from'=>$mail->getField('mail_from',$id),'mail_to'=>$mail->getField('mail_to',$id),'mail_code'=>$mail->getField('mail_code',$id),'mail_codeindex'=>$mail->getField('mail_codeindex',$id),'mail_about'=>$mail->getField('mail_about',$id),'mail_file01'=>$mail->getField('mail_file01',$id),'mail_file01_type'=>$mail->getField('mail_file01_type',$id),'mail_status'=>'dis','replay'=>$replay,'mail_limit'=>tgl_ind_to_eng($_POST['mail_limit']));
				$add=$mail->addData($data);
				$add=$mail_out->addData($data);
			}
			if($add){
				$idx=substr(substr($id,3),0,-3);
				$data_in=$mail->getLike('id',$idx);
				foreach($data_in as $row){
					$del_in=$mail->hapus($row['id']);
				}
				$data_out=$mail_out->getLike('id',$idx);
				foreach($data_out as $row){
					$del_out=$mail_out->hapus($row['id']);
				}
				header("location:$link&m=min_out");
			}
		break;
	}
}
?>
