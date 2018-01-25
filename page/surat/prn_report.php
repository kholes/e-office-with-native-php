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

$mtgl=$_GET['mtgl'];
$stgl=$_GET['stgl'];
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<script>
	function getReport(){
		window.location='<?php echo $link; ?>&m=report&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val()+'';
	}
</script>
<div class="c10"></div>
<div class="p-wrapper">
  <div class="content" style="margin-top:20px;">
		<?php
		$mtgl=tgl_ind_to_eng($_GET['mtgl']);
		$stgl=tgl_ind_to_eng($_GET['stgl']);
		?>
		<div class="c10"></div>
		<div id="head-rep">
			<h2 align="center">
				REKAPITULASI SURAT
			</h2>
			<h3 align="center">
			MULAI TANGGAL : <?php echo getTanggal($mtgl);?> - <?php echo getTanggal($stgl);?>
			</h3>
		</div>
		<div class="c10"></div>
		<?php
		$i=$_GET['i'];
		$s=$_GET['s'];
		if($s==''){$s='fdate';}
		if(!isset($i)){$i='0';}
		$statement = "dtmail where fdate between '$mtgl' and '$stgl'";
		switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
		$data = mysql_query("SELECT * FROM $statement order by $s $ix");
		if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
		?>
		<table width="100%" cellpadding="0" cellspacing="0" id="tbl">
			<tr>
			<td width="3%" class="b" align="center">No</td>
			<td width="12%" class="b" align="left"><a href="<?php echo $link; ?>&m=report&s=fdate&i=<?php echo $i;?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>">Tanggal</a></td>
			<td width="6%" class="b" align="center"><a href="<?php echo $link; ?>&m=report&s=mail_index&i=<?php echo $i;?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>">No.Urut</a></td>
			<td width="21%" class="b" align="left"><a href="<?php echo $link; ?>&m=report&s=mail_no&i=<?php echo $i;?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>">No.Surat</a></td>
			<td width="28%" class="b" align="left"><a href="<?php echo $link; ?>&m=report&s=mail_to&i=<?php echo $i;?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>">Tujuan</a></td>
			<td width="30%" class="b" align="left"><a href="<?php echo $link; ?>&m=report&s=mail_about&i=<?php echo $i;?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>">Uraian</a></td>
			</tr>
			<?php
			while($row=mysql_fetch_assoc($data)){
			?>
			<tr>
					<td align="center"><?php echo $c=$c+1;?></td>
					<td><?php echo getTanggal($row['fdate']);?></td>
					<td align="center"><?php echo $row['mail_index'];?></td>
					<td><?php echo $row['mail_no'];?></td>
					<td><?php echo $row['mail_to'];?></td>
					<td><?php echo $row['mail_about'];?></td>
				</tr>
				<?php
				}
				?>
		  </table>
  </div>
</div>
		<div id="menu">
		  <a onclick="window.print();"><img src="../../img/print.png"></a>
	  	</div>	
