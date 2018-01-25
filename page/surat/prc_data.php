<?php
session_start();
include "../../lib/lib.php";

include "../../class/dtmail_in.cls.php";
include "../../class/dtmail_in_out.cls.php";
include "../../class/dtmail_out.cls.php";
include "../../class/dtmail_int.cls.php";
include "../../class/dtmail_int_out.cls.php";
include "../../class/user.cls.php";
include "../../class/suratkeluar.cls.php";
include "../../class/dtindex.cls.php";
include "../../class/dtklasifikasi.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$mailin=new Mail();
$mailin_out=new Mail_out();
$mailout=new Mailout();
$mailint=new Mailint();
$mailint_out=new Mailint_out();
$suratkeluar=new Suratkeluar();
$user=new User();
$pegawai=new Pegawai();


$logid=decrypt_url($_SESSION['id_user']);
$index=new Dtindex();
$klasifikasi=new Dtklasifikasi();
$link='?p='.encrypt_url('surat');
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'getData':
		$data=$_POST['data'];
		$transaksi=$_POST['transaksi'];
		$mtgl=tgl_ind_to_eng($_POST['mtgl']);
		$stgl=tgl_ind_to_eng($_POST['stgl']);
		switch($data){
			case 'Internal':
				switch($transaksi){
					case 'Surat Masuk':
					$sql="dtmail_int where mto='$logid' and tanggal between '$mtgl' and '$stgl'";
					break;
					case 'Surat Keluar':
					$sql="dtmail_int_out where mfrom='$logid' and tanggal between '$mtgl' and '$stgl'";
					break;
					case 'Semua':
					$sql="dtmail_int_out where mto='$logid' and mfrom='$logid' and tanggal between '$mtgl' and '$stgl'";
					break;
				}
			break;
			case 'External':
				switch($transaksi){
					case 'Surat Masuk':
						$sql="dtmail_in where mto='$logid' and mail_date between '$mtgl' and '$stgl'";
					break;
					case 'Surat Keluar':
						$sql="dtmail_in_out where mfrom='$logid' and mail_date between '$mtgl' and '$stgl'";
					break;
					case 'Semua':
						$sql="dtmail_in_out where mto='$logid' and mfrom='$logid' and mail_date between '$mtgl' and '$stgl'";
					break;
				}
			break;
		}
		//echo $sql;
		$x=mysql_query("select * from $sql");
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="12%" align="left">NO.SURAT</th>
			<th width="11%" align="left">TANGGAL</th>
			<th width="14%" align="left">DARI</th>
			<th width="14%" align="left">UNTUK</th>
			<th width="24%" align="left">URAIAN SURAT</th>
			<th width="14%" align="left">DISPOSISI</th>
			<th width="11%" align="center">FILE SURAT</th>
			<?php
			while ($row = mysql_fetch_array($x)) {
			?>			  
			<tr onMouseOver="this.style.background='#eee';" onmouseout="this.style.background='#fff';">
				<td width="12%" style="vertical-align:top;" onMouseOver="this.style.cursor='pointer';this.style.color='red';" onmouseout="this.style.color='#333';" align="left" onclick="getPropertis('<?php echo $row['id'];?>','tbin');"><?php echo $row['mail_no']; ?></td>
				<td width="11%" style="vertical-align:top;"><?php echo getTanggal($row['mail_date']); ?></td>
				<td width="14%" style="vertical-align:top;"><?php echo $row['mail_from']; ?></td>
				<td width="14%" style="vertical-align:top;"><?php echo $row['mail_to']; ?></td>
				<td width="24%" style="vertical-align:top;"><?php echo $row['mail_about']; ?></td>
				<td width="14%" style="vertical-align:top;">
				<?php 
				$id=$row['id']; 
				$sqldis=mysql_query("select * from dtmail_in where replay='$id' and mail_status='dis'");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $pegawai->getField('jabatan',$mailin->getField('mto',$rdis['id']));
					echo "<br>";
				}
				?>
				</td>
				<td width="11%" align="center">
				<?php 
					$ext=$row['mail_file01_type'];
					$link=$row['mail_file01'];
					$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
					switch($ext){
						case 'pdf':
							echo "<a style='color:#333' href='$link' target='_blank'><img src='img/pdf-icon.png'/><br>$file.$ext</a>";
						break;
						case 'xls':
							echo "<a style='color:#333' href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
						break;
						case 'xlsx':
							echo "<a style='color:#333' href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
						break;
						case 'doc':
							echo "<a style='color:#333' href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
						break;
						case 'docx':
							echo "<a style='color:#333' href='$link' target='_blank'><img src='img/doc-icon.png'/><br>$file.$ext</a>";
						break;
					}
				?> 
				</td>
			</tr>
			<tr>
				<td colspan="8"><div style="width:100%;" id="detail<?php echo $row['id'];?>"></div></td>
			</tr>
			<?php
			}
			?>
		</table>		
		<?php
	break;
	case 'getPropertis':
		$id=$_POST['id'];
		$tb=$_POST['tb'];
		switch($tb){
			case 'tbin':$data=$mailin;$table='dtmail_in';break;
			case 'tbout':$data=$mailin_out;$table='dtmail_in_out';break;
		}
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail" style="padding:10px;">
			<h3>History surat</h3>
			<hr />
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
				$sqldis=mysql_query("select * from $table where replay='$id' and mail_status='dis'");
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
				$sqldis=mysql_query("select * from $table where replay='$id' and mail_status='dis' limit 1");
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
				$sqldis=mysql_query("select * from $table where replay='$id' and mail_status='prc'");
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
				$sqldis=mysql_query("select * from $table where replay='$id' and mail_status='prc' limit 1");
				while($rdis=mysql_fetch_assoc($sqldis)){
					echo $pegawai->getField('nama',$data->getField('mfrom',$rdis['id'])).", menjabat sebagai : ".$pegawai->getField('jabatan',$data->getField('mfrom',$rdis['id'])).", pada tanggal : ".getTanggal($rdis['tanggal']);
					echo "<br>";
				}
				?></td>
			  </tr>
			</table>
			</div>
			<div id="menu-detail">&nbsp;
				<a onclick="prn_disposisi('<?php echo $id;?>');">Cetak disposisi</a>
				<a onclick="prn_history('<?php echo $id;?>');">Cetak history</a>
				<div style="float:right;">
					<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>
				</div>
			</div>
		</div>
		<?php	
	break;
}
?>