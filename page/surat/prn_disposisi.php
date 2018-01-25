<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmail_in.cls.php";
include "../../class/pegawai.cls.php";
include "../../class/user.cls.php";
include "../../class/dtindex.cls.php";
$link='?p='.encrypt_url('surat');
$linkdata="page/surat/prc_mail.php";
$db=new Db();
$db->conDb();
$mail=new Mail();
$pegawai=new Pegawai();
$user=new User();
$index=new Dtindex();
$logid=decrypt_url($_SESSION['id_user']);
$level=$user->getField('level',$logid);

$id=$_GET['id'];
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<script>
	function getReport(){
		window.location='<?php echo $link; ?>&m=report&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val()+'';
	}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" valign="middle" style="height:50px;"><h2>LEMBAR DISPOSISI</h2></td>
  </tr>
  <tr>
    <td width="35%" valign="top" style="padding:5px;"><p><strong>Indeks :</strong></p>
      <p><?php echo $index->getField('keterangan',$mail->getField('mail_codeindex',$id));?></p>    </td>
    <td width="15%" align="center" valign="top" style="padding:5px;"><p><strong>Kode</strong></p>
    <p><?php if($mail->getField('mail_code',$id)!=''){echo $mail->getField('mail_code',$id);}else{echo $mail->getField('mail_codeindex',$id);}?></p>	</td>
    <td width="27%" align="center" valign="top" style="padding:5px;"><p><strong>No.Urut</strong></p>
    <p><?php echo $mail->getField('mail_index',$id);?></p></td>
    <td width="23%" align="center" valign="top" style="padding:5px;"><p><strong>Tgl.Penyelesaian</strong></p>
    <p><?php if($mail->getField('mail_limit',$id)!='0000-00-00'){echo getTanggal($mail->getField('mail_limit',$id));}?></p></td>
  </tr>
  <tr>
    <td colspan="4" style="padding:5px;">
	  <p><strong>Perihal / Isi Ringkasan :</strong></p>
	  <p> <?php echo $mail->getField('mail_about',$id);?>
        </p></td>
  </tr>
  <tr>
    <td style="padding:5px;">
	<p><strong>Asal Surat</strong></p>
    <p><?php echo $mail->getField('mail_from',$id);?></p>
	</td>
    <td align="center" style="padding:5px;">
	<p><strong>Tanggal</strong></p>
    <p><?php if($mail->getField('mail_date',$id)!='0000-00-00'){echo getTanggal($mail->getField('mail_date',$id));}?></p>
	</td>
    <td align="center" style="padding:5px;">
	<p><strong>Nomor</strong></p>
    <p><?php echo $mail->getField('mail_no',$id);?></p>
	</td>
    <td align="center" valign="top" style="padding:5px;">
	<p><strong>Lampiran</strong></p>
    <p><?php echo $mail->getField('mail_attc',$id);?></p>
	</td>
  </tr>
  <tr>
    <td style="height:300px;padding:5px;" valign="top"><p><strong>Diajukan / Diteruskan</strong></p>
    <p><em>Yth. 
	<?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis'");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo "<li style='padding:0px; margin:0px; margin-left:10px;'>".$pegawai->getField('jabatan',$mail->getField('mto',$rdis['id']))."</li>";
					echo "<br>";
				}
				?>
	</em></p>
	</td>
    <td colspan="3" valign="top" style="padding:5px;" align="center">
	<p align="center"><strong>Instruksi / Informasi</strong></p>
	<p><em><?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis' limit 1");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $rdis['content_disposisi'];
					echo "<br>";
				}
				?></em></p>
    <p><em><?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis' limit 1");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $rdis['content'];
					echo "<br>";
				}
				?></em></p>
	</td>
  </tr>
</table>
		<div id="menu">
		  <a onclick="window.print();"><img src="../../img/print.png"></a>
	  	</div>	
