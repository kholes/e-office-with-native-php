<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmail.cls.php";
include "../../class/pegawai.cls.php";
include "../../class/user.cls.php";
$link='?p='.encrypt_url('surat');
$linkdata="page/surat/mailprc.php";
$db=new Db();
$db->conDb();
$mail=new Mail();
$peg=new Pegawai();
$user=new User();
$logid=decrypt_url($_SESSION['id_user']);
$level=$user->getField('level',$logid);
$id=$_GET['id'];
if($mail->getField('mto',$id)==$logid){
	if($mail->getField('mail_status',$id)=='new'){
		//$mail->setStatus($id,'opn');
	}
}
?><head>
<script src="js/jquery.corner.js"></script>
<script>
	var lam='<?php echo $lampiran; ?>';
	var sts='<?php echo $status; ?>';
	$(document).ready(function(){
		$('#dis-wrapper,#page').corner('round tr tl bl br 7px');
		if(sts=='dis'){
			tb_remove();
		}
	});
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
			location.reload();
		});
	});
	function forward_mail(id){
		window.location='<?php echo $link;?>&m=fmail&type=fwd&id='+id;
	}
	function replay_mail(id){
		window.location='<?php echo $link;?>&m=fmail&type=rep&id='+id;
	}
	function revisi_mail(id){
		window.location='<?php echo $link;?>&m=fmail&type=rev&id='+id;
	}
	function repair_mail(id){
		window.location='<?php echo $link;?>&m=fmail&type=repair&id='+id;
	}
	function saran_mail(id){
		window.location='<?php echo $link;?>&m=fmail&type=reg&id='+id;
	}
	function edit_mail(id){
		var type='<?php echo $mail->getField('mail_type',$id);?>';
		if(type!='in'){
			window.location='<?php echo $link;?>&m=fmail&type=edit&id='+id;
		}else{
			window.location='<?php echo $link;?>&m=fsuratmasuk&type=edit&id='+id;
		}
	}
	function approve_mail(id){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=approvedMail&id='+id,
			cache :false,
			success:function (data){
				alert(data);
				//tb_remove();
				//window.location='<?php echo $link;?>';
			}
		});
	}
	function delete_mail(id){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=delete&id='+id,
			cache :false,
			success:function (data){
				//alert(data);
				tb_remove();
				window.location='<?php echo $link;?>&m=<?php echo $_GET['p'];?>';
			}
		});
	}
</script>
</head>



<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">INFORMASI SURAT</h2>
		<div class="c"></div>
	</div>
  <div id="form-dis" style="height:250px; overflow:auto;background:#fff; padding:10px 0;">
    <table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
      <tr>
        <td width="27%" valign="top" class="detail" style="border:none;">Tanggal Input </td>
        <td width="1%" style="border:none;">: </td>
        <td width="72%"><?php echo getTanggal($mail->getField('fdate',$id));?></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Pesan</td>
        <td class="list-ksi detail" style="border:none;">: </td>
        <td><p style="text-align:justify"><?php echo $mail->getField('content',$id);?></p></td>
      </tr>
      <tr>
        <td width="27%" valign="top" class="detail" style="border:none;">Tanggal Surat</td>
        <td width="1%" style="border:none;">: </td>
        <td width="72%"><?php echo getTanggal($mail->getField('mail_date',$id));?></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">No. Surat</td>
        <td class="list-ksi detail" style="border:none;">: </td>
        <td><p style="text-align:justify"><?php if($mail->getField('mail_no',$id)=='')echo "Belum diregistrasi.";else echo $mail->getField('mail_no',$id); ?></p></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Surat Dari </td>
        <td>: </td>
        <td style="border:none;"><p style="text-align:justify"><?php echo $mail->getField('mail_from',$id);?></p></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Prihal / Uraian surat </td>
        <td>: </td>
        <td style="border:none;" class="detail"><?php echo $mail->getField('mail_about',$id);?></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">File Surat</td>
        <td>: </td>
        <td style="border:none;" class="detail">												
		<?php 
			$file01=$mail->getField('mail_file01',$id); 
			$file02=$mail->getField('mail_file02',$id); 
			$file03=$mail->getField('mail_file03',$id); 
			$file04=$mail->getField('mail_file04',$id); 
			$file05=$mail->getField('mail_file05',$id); 
			if($file01!=''){
				$filetype01=$mail->getField('mail_file01_type',$id);
				switch($filetype01){
					case 'pdf':
						echo "<a href='$file01' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$file01' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$file01' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$file01' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$file01' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$file01' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'gif':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
			}
			if($file02!=''){
				$filetype02=$mail->getField('mail_file02_type',$id);
				switch($filetype02){
					case 'pdf':
						echo "<a href='$file02' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$file02' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$file02' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$file02' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$file02' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$file02' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'gif':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
			}
			if($file03!=''){
				$filetype03=$mail->getField('mail_file03_type',$id);
				switch($filetype03){
					case 'pdf':
						echo "<a href='$file03' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$file03' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$file03' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$file03' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$file03' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$file03' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'gif':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
			}
			if($file04!=''){
				$filetype04=$mail->getField('mail_file04_type',$id);
				switch($filetype04){
					case 'pdf':
						echo "<a href='$file04' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$file04' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$file04' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$file04' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$file04' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$file04' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'gif':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
			}
			if($file05!=''){
				$filetype05=$mail->getField('mail_file05_type',$id);
				switch($filetype05){
					case 'pdf':
						echo "<a href='$file05' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$file05' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$file05' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$file05' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$file05' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'gif':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$file05' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
			}
		?>
		</a>
 </td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Tanggal Disposisi</td>
        <td>: </td>
        <td style="border:none;" class="detail"><?php 
					$limit=$mail->getField('forward_date',$id);
					if($limit!='0000-00-00'){
						echo getTanggal($mail->getField('forward_date',$id));
					}
				?>        </td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Batas waktu</td>
        <td>: </td>
        <td style="border:none;" class="detail"><h3 style="color:#FF0000;">
            <?php 
					$limit=$mail->getField('mail_limit',$id);
					if($limit!='0000-00-00'){
						echo getTanggal($mail->getField('mail_limit',$id));
					}
				?>
        </h3></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Instruksi Disposisi</td>
        <td>: </td>
        <td style="border:none;" class="detail"><?php echo $mail->getField('forward_note',$id);?></td>
      </tr>
      <tr>
        <td valign="top" style="border:none;" class="detail">Status Surat </td>
        <td>: </td>
        <td style="border:none;" class="detail">
		<?php 
			$sts=$mail->getField('mail_status',$id);
			switch($sts){
				case 'new':
					echo "Baru";
				break;
				case 'opn':
					echo "Sudah dibuka";
				break;
				case 'dis':
					echo "Surat Disposisi";
				break;
				case 'prc':
					echo "Sedang dalam proses untuk dibalas.";
				break;
				case 'rep':
					echo "Selesai dibalas";
				break;
				case 'reg':
					echo "Sudah registrasi";
				break;
				case 'req':
					echo "Proses pengajuan";
				break;
				case 'rev':
					echo "Surat untuk direvisi";
				break;
			}
		?>
		</td>
      </tr>
    </table>
  </div>
	<div id="thick-bottom">
	  <div id="thick-menu">
		<?php 
		$sts=$mail->getField('mail_status',$id);
		$type=$mail->getField('mail_type',$id);
		switch($level){
			case 'KKR':
			if($type=='in'){
			?>
			<a class="thickbox" id="btn" style="color:#fff" href="page/surat/disposisi.php?height=400 width=200&id=<?php echo $id; ?>">DISPOSISI</a>
			<?php }else{ ?>
			<input type="button" name="approve" id="approve" onclick="approve_mail('<?php echo $id;?>');" value="Terima" />
			<input type="button" name="revisi" id="revisi" onclick="revisi_mail('<?php echo $id;?>');" value="Revisi" />
			<input type="button" name="revisi" id="revisi" onclick="repair_mail('<?php echo $id;?>');" value="Perbaiki" />
			<?php
			} 
			break;
			case 'KSI':
			if($sts!='reg' and $sts!='rep'){
			?>
			<input type="button" name="revisi" id="revisi" onclick="revisi_mail('<?php echo $id;?>');" value="Revisi" />
			<input type="button" name="forward" id="forward" onclick="forward_mail('<?php echo $id;?>');" value="Teruskan" />
			<input type="button" name="balas" id="balas" onclick="replay_mail('<?php echo $id;?>');" value="Balas" />
			<input type="button" name="revisi" id="revisi" onclick="repair_mail('<?php echo $id;?>');" value="Perbaiki" />
			<?php
			}
			break;
			case 'SKR':
			if($sts=='new'){ 
			?>
			<input type="button" name="hapus" id="hapus" onclick="delete_mail('<?php echo $id;?>');" value="Hapus" />
			<input type="button" name="edit" id="edit" onclick="edit_mail('<?php echo $id;?>');" value="Ubah" />
			<?php }else{ ?>
			<input type="button" name="registrasi" id="registrasi" onclick="registrasi('<?php echo $id;?>');" value="Registrasi" />
			<input type="button" name="balas" id="balas" onclick="replay_mail('<?php echo $id;?>');" value="Balas" />
			<?php
			}
			break;
			case 'KTU':
			if($sts!='reg' and $sts!='rep'){
			?>
			<input type="button" name="saran" id="saran" onclick="saran_mail('<?php echo $id;?>');" value="Saran Disposisi" />
			<input type="button" name="forward" id="forward" onclick="forward_mail('<?php echo $id;?>');" value="Teruskan" />
			<input type="button" name="revisi" id="revisi" onclick="repair_mail('<?php echo $id;?>');" value="Perbaiki" />
			<input type="button" name="approve" id="approve" onclick="approve_mail('<?php echo $id;?>');" value="Terima" />
			<input type="button" name="revisi" id="revisi" onclick="revisi_mail('<?php echo $id;?>');" value="Revisi" />
			<input type="button" name="balas" id="balas" onclick="replay_mail('<?php echo $id;?>');" value="Balas" />
			<?php
			}
			break;
			case 'STF':
			if($sts!='reg' and $sts!='rep'){
			if($sts=='prc'){
			?>
			<input type="button" name="balas" id="balas" onclick="replay_mail('<?php echo $id;?>');" value="Balas" />
			<?php
			}
			if($sts=='rev'){?>
			<input type="button" name="revisi" id="revisi" onclick="repair_mail('<?php echo $id;?>');" value="Perbaiki" />
			<?php
			}
			}
			break;
		}
		?>
		</div>
	</div>
</div>
</body>