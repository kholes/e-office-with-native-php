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
	$btn='Teruskan';
}
?>
<script>
	$(document).ready(function(){
		$('#tombol').click(function(){
			$('#email').submit();
		});
	});
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>SURAT MASUK</a></li>
			<li class="active"><?php echo $val;?></li>
		</ul>
	</h3>
	<div class="c10"></div>
		<form method="post" action="<?php echo $link; ?>&m=ffwd" enctype="multipart/form-data" id="email" name="MyForm">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
				<tr>
					<td width="156" style="vertical-align:top;"><p style="font-weight:bold;">Kepada</p></td>
				  	<td width="833" colspan="4">				
					<style>#ck li{ float:left; width:300px;}</style>
					<ul id="ck">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<li><input type="checkbox" name="sel" id="sel" onclick="cek();" /><label for="sel"> Pilih semua</label></li>
					<li>&nbsp;</li>
					<div style="clear:both; width:100%; height:10px;"></div>
					<?php 
					$bagian=$pegawai->getField('bagian',$logid);					
 					function cek($inputname,$v,$data,$id){
						$cek='checked';
						$pegawai=new Pegawai();
						$x=explode(',',$data);
						$n=sizeof($x);
						if($v==$x[0] or $v==$x[1] or $v==$x[2] or $v==$x[3] or $v==$x[4] or $v==$x[5] or $v==$x[6] or $v==$x[7] or $v==$x[8] or	$v==$x[9] or $v==$x[10] or $v==$x[11] or $v==$x[12]){$cek="checked";}else{$cek="";}
						echo "<li><input name='$inputname"."[]' type='checkbox' value='$v' id='$v' class='ksi' $cek ><label for='$v'>&nbsp;".$pegawai->getField('nama',$v)."</label></li>";
					}
					$ksi=$pegawai->getBagian($bagian);
					if($ksi!=array()){
						$data=$mail->getField('mto',$id);
						foreach($ksi as $row){
							$inputname='pilih';
							$value=$row['id'];
							$class=$mail;
							cek($inputname,$value,$data,$id);
						}
					}
					?>					
					</td>						
				</tr>
				<tr>
					<td width="156" style="vertical-align:top"><p style="font-weight:bold;">Instruksi</p></td>
				  	<td width="833" colspan="4">
						<textarea name="content" id="elm1" rows="3" style="width:100%"><?php echo $mail->getField('content',$id);?></textarea>					
					</td>						
				</tr>
			</table>
			<div class="head_content" style="box-shadow:none;" >
				<input type="hidden" name="btn" value="<?php echo $btn; ?>" />
				<input type="button" id="tombol" value="<?php echo $btn;?>">
				&nbsp;
				<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
			</div>
		</form>
	</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$replay=$mail->getField('replay',$id);
	switch($_POST['btn']){
		case 'Teruskan':
			$n_mto=sizeof($_POST['pilih']);
			for($i_mto=0;$i_mto<$n_mto;$i_mto++){
				$mto=$_POST['pilih'][$i_mto];
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$_POST['content'],'mail_index'=>$mail->getField('mail_index',$id),'mail_no'=>$mail->getField('mail_no',$id),'mail_date'=>$mail->getField('mail_date',$id),'mail_from'=>$mail->getField('mail_from',$id),'mail_to'=>$mail->getField('mail_to',$id),'mail_code'=>$mail->getField('mail_code',$id),'mail_codeindex'=>$mail->getField('mail_codeindex',$id),'mail_about'=>$mail->getField('mail_about',$id),'mail_file01'=>$mail->getField('mail_file01',$id),'mail_file01_type'=>$mail->getField('mail_file01_type',$id),'mail_status'=>'prc','replay'=>$replay,'mail_limit'=>$mail->getField('mail_limit',$id));
				$add=$mail->addData($data);
				$add=$mail_out->addData($data);
			}
			if($add){
				header("location:$link&m=min_out");
			}		
		break;
		case 'Ubah':
			$n_mto=sizeof($_POST['pilih']);
			for($i_mto=0;$i_mto<$n_mto;$i_mto++){
				$mto=$_POST['pilih'][$i_mto];
				$noid=$logid.$date->format('Ymd').$G.$date->format('is').$mto;
				$data=array('id'=>$noid,'tanggal'=>$date->format('Y-m-d G:i:s'),'mfrom'=>$logid,'mto'=>$mto,'content'=>$_POST['content'],'mail_index'=>$mail->getField('mail_index',$id),'mail_no'=>$mail->getField('mail_no',$id),'mail_date'=>$mail->getField('mail_date',$id),'mail_from'=>$mail->getField('mail_from',$id),'mail_to'=>$mail->getField('mail_to',$id),'mail_code'=>$mail->getField('mail_code',$id),'mail_codeindex'=>$mail->getField('mail_codeindex',$id),'mail_about'=>$mail->getField('mail_about',$id),'mail_file01'=>$mail->getField('mail_file01',$id),'mail_file01_type'=>$mail->getField('mail_file01_type',$id),'mail_status'=>'prc','replay'=>$replay,'mail_limit'=>$mail->getField('mail_limit',$id));
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