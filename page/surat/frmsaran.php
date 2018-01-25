<?php 
$id=$_GET['id'];
/*
if(isset($_GET['type'])){$type=$_GET['type'];}else{$type='new';}
$file=$mail->getField('mail_file',$id);
switch($type){
	case 'reg':
		$mto=$pegawai->getField('nama',$idmto);
		$content=$mail->getField('content',$id);
		$mail_to=$mail->getField('mail_to',$id);
		$mail_from=$mail->getField('mail_from',$id);
		$mail_about=$mail->getField('mail_about',$id);
	break;
}
*/
?>
<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	$(document).ready(function(){
		$('#tombol').click(function(){
			$('#email').submit();
		});
	});
</script>
<div class="p-wrapper" style="min-height:50px;">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>SURAT MASUK  </a></li>
			<li class="active">SARAN DISPOSISI</li>
		</ul>
	</h3>		
	<div class="c10"></div>
	<form method="post" action="<?php echo $link; ?>&m=saran_mail" enctype="multipart/form-data" id="email">
		<input type="hidden" name="id" value="<?php echo $id;?>" />
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
			<tr>
				<td width="22%" style="vertical-align:top">
					<p style="font-weight:bold">SARAN UNTUK DISPOSISI </p>
				</td>
				<td width="78%" style="padding:5px 0px;">
				<textarea id="elm1" name="content" rows="3" style="margin:0;padding:0;width:100%"><?php echo $content;?></textarea>
				</td>
			</tr>
		</table>
		<div class="c10"></div>
		<div class="c10"></div>
		<div class="head_content" style="box-shadow:none;" >
			<input type="hidden" name="btn" value="Kirim">
			<input type="button" name="tombol" id="tombol" value="Kirim" />			
			&nbsp;
			<input type="button" name="kembali" value="Kembali" onclick="history.back();" style="float:right;" />			
		</div>
	</form>
	</div>
</div>
<script>
$('#mto').keypress(function(e){
	if(e.keyCode==13){
		getId();
	}
});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	switch ($_POST['btn']){
		case 'Kirim':
			$id=substr($_POST['id'],0,-3);
			$data=$mail->getLike('id',$id);
			foreach($data as $row){
				$datax=array('id'=>$row['id'],'content'=>$_POST['content']);
				$mail->saranReg($datax);
			}
			header("location:$link&m=min&o=in");
		break;
	}
}
?>

