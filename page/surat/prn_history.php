<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmail_in.cls.php";
include "../../class/pegawai.cls.php";
include "../../class/user.cls.php";
include "../../class/dtindex.cls.php";
include "../../class/dtklasifikasi.cls.php";
$link='?p='.encrypt_url('surat');
$linkdata="page/surat/prc_mail.php";
$db=new Db();
$db->conDb();
$data=new Mail();
$pegawai=new Pegawai();
$user=new User();
$index=new Dtindex();
$klasifikasi=new Dtklasifikasi();
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
<h3 align="center"><u>HISTORY SURAT</u></h3><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="24%">ID. Surat </td>
				<td width="1%">:</td>
				<td width="75%"><?php echo $data->getField('id',$id);?></td>
			  </tr>
			  <tr>
				<td width="24%">No. Surat</td>
				<td width="1%">:</td>
				<td width="75%"><?php echo $data->getField('mail_no',$id);?></td>
			  </tr>
			  <tr>
				<td>Tanggal masuk </td>
				<td>:</td>
				<td><?php echo $data->getField('tanggal',$id);?></td>
			  </tr>
			  <tr>
				<td>No. Urut</td>
				<td>:</td>
				<td><?php echo $data->getField('mail_index',$id);?></td>
			  </tr>
			  <tr>
				<td>Kode. Klasifikasi</td>
				<td>:</td>
				<td><?php echo $data->getField('mail_codeindex',$id)." | ".$index->getField('keterangan',$data->getField('mail_codeindex',$id));;?></td>
			  </tr>
			  <tr>
				<td>Klasifikasi</td>
				<td>:</td>
				<td><?php echo $data->getField('mail_code',$id)." | ".$klasifikasi->getField('keterangan',$data->getField('mail_code',$id));?></td>
			  </tr>
			  <tr>
				<td>Lokasi penyimpanan Hardcopy</td>
				<td>:</td>
				<td><?php echo "BINDEX NO : ".$data->getField('mail_codeindex',$id)." - ".$data->getField('mail_index',$id);?></td>
			  </tr>
			  <tr>
				<td>Lokasi penyimpanan Softcopy</td>
				<td>:</td>
				<td><?php echo $_SERVER['DOCUMENT_ROOT']."/eoffice/".$data->getField('mail_file01',$id);?></td>
			  </tr>
			  <tr>
				<td>Pembuat</td>
				<td>:</td>
				<td><?php echo $pegawai->getField('nama',$data->getField('mfrom',$id)).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mfrom',$id));?></td>
			  </tr>
			  <tr>
				<td>Ditujukan untuk </td>
				<td>:</td>
				<td><?php echo $pegawai->getField('nama',$data->getField('mto',$id)).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mto',$id));?></td>
			  </tr>
			  <tr>
				<td>Di disposisikan kepada </td>
				<td>:</td>
				<td>
				<?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis'");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo "<li style='padding:0px; margin:0px; margin-left:10px;'>".$pegawai->getField('nama',$data->getField('mto',$rdis['id'])).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mto',$rdis['id']))."</li>";
					echo "<br>";
				}
				?>
				</td>
			  </tr>
			  <tr>
				<td>Disposisi oleh </td>
				<td>:</td>
				<td>
				<?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis' limit 1");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $pegawai->getField('nama',$data->getField('mfrom',$rdis['id'])).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mfrom',$rdis['id'])).", pada tanggal : ".getTanggal($rdis['tanggal']);
					echo "<br>";
				}
				?>
				</td>
			  </tr>
			  <tr>
				<td>Diteruskan kepada </td>
				<td>:</td>
				<td><?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='prc'");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $pegawai->getField('nama',$data->getField('mto',$rdis['id'])).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mto',$rdis['id']));
					echo "<br>";
				}
				?></td>
			  </tr>
			  <tr>
				<td>Diteruskan oleh</td>
				<td>:</td>
				<td>
				<?php 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='prc' limit 1");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $pegawai->getField('nama',$data->getField('mfrom',$rdis['id'])).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mfrom',$rdis['id'])).", pada tanggal : ".getTanggal($rdis['tanggal']);
					echo "<br>";
				}
				?></td>
			  </tr>
			</table>
		<div id="menu">
		  <a onclick="window.print();"><img src="../../img/print.png"></a>
	  	</div>	
