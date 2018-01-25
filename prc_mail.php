<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmail_in.cls.php";
include "../../class/dtmail_in_out.cls.php";
include "../../class/dtmail_out.cls.php";
include "../../class/dtsk.cls.php";
include "../../class/dtmail_int.cls.php";
include "../../class/dtmail_int_out.cls.php";
//include "../../class/surat.cls.php";
include "../../class/user.cls.php";
include "../../class/suratkeluar.cls.php";
include "../../class/dtindex.cls.php";
include "../../class/dtklasifikasi.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$logid=decrypt_url($_SESSION['id_user']);
$mail=new Mail();
$mail_out=new Mail_out();
$mailout=new Mailout();
$sk=new Sk();
$mailint=new Mailint();
$mailint_out=new Mailint_out();
//$surat=new Surat();
$suratkeluar=new Suratkeluar();
$user=new User();
$pegawai=new Pegawai();
$index=new Dtindex();
$klasifikasi=new Dtklasifikasi();
$link='?p='.encrypt_url('surat');
$btn=$_POST['btn'];
$id=$_POST['id'];
$cari=$_POST['cari'];
$sts=$_POST['sts'];
$level=$user->getField('level',$logid);
switch($btn){
	case 'Cari':
		$data=$surat->getLike($cari);
		tabel($data);
	break;
	case 'getIn':
		 $c=$mail->getIn($logid);	
		 if($c!='0'){
		 	echo "<img src='img/warning-star.png'/>";
		 }			
		//echo 			
	break;
	case 'getRun':
	?>
		<marquee behavior="alternate" scrollamount="3" onMouseOver="this.setAttribute('scrollamount', 0, 0);" onMouseOut="this.setAttribute('scrollamount', 3, 0);" onMouseDown="this.stop();" onMouseUp="this.start();" style="float:right;">
			<h3 class="text-blink" style="color:#000; opacity:1; letter-spacing:2px;">
			<?php 
				$sq=mysql_query("select id from mail where mfrom like '%$logid%' and status in('new')");
				$c=mysql_num_rows($sq);
				if($c>0){
					while($row=mysql_fetch_assoc($sq))
					$id=$row['id'];
					echo "<img src='img/mail-new.png' /><a class='text-blink' style='font-size:14px;' href='".$link."&m=int&type=in&sts=new'> Anda mempunyai ( ".$c." ) surat internal yang belum diproses</a>";
				}
			?>
			</h3>
			<h3 class="text-blink" style="color:#000; opacity:1; letter-spacing:2px;">
			<?php 
				$sq=mysql_query("select id from dtmail where mto like '%$logid%' and mail_status in('dis')");
				$c=mysql_num_rows($sq);
				if($c>0){
					while($row=mysql_fetch_assoc($sq))
					$id=$row['id'];
					echo "<img src='img/mail-new.png' /><a class='text-blink' style='font-size:14px;' href='".$link."&m=int&type=in&sts=new'>( ".$c." ) Surat masuk yang belum diproses</a>";
				}
			?>
			</h3>
		</marquee>
	<?php
	break;
	case 'getOut':
		 $c=$mail->getOut($logid);	
		 if($c!='0'){
		 	echo "<img src='img/warning-star.png'/>";
		 }			
		//echo $mail->getOut($logid);			
	break;
	case 'getSk':
		 echo $sk->getSk();			
	break;
	case 'getNewOut':
		 echo $mail->getNewOut($logid);			
	break;
	case 'getDis':
		 echo $mail->getDis($logid);			
	break;
	case 'getDisOut':
		 echo $mail->getDisOut($logid);			
	break;
	case 'getPrcOut':
		 echo $mail->getPrcOut($logid);			
	break;
	case 'getEndOut':
		 echo $mail->getEndOut($logid);			
	break;
	case 'getPrc':
		 echo $mail->getPrc($logid);			
	break;
	case 'getRem':
		 echo $mail->getRem($logid);			
	break;
	case 'getRevIn':
		 echo $mail->getRevIn($logid);			
	break;
	case 'getRev':
		 echo $mail->getRev($logid);			
	break;
	case 'getApp':
		 echo $mail->getApp($logid);			
	break;
	case 'getReq':
		 echo $mail->getReq($logid);			
	break;
	case 'infReg':
		 echo $mailint->getReg($logid);			
	break;
	case 'infInt':
		 $c=$mailint->getNew($logid);	
		 if($c!='0'){
		 	echo "<img src='img/warning-star.png'/>";
		 }			
	break;
	case 'infIntIn':
		 echo $mailint->getIn($logid);	
	break;
	case 'infIntOut':
		 echo $mailint->getOut($logid);	
	break;
	case 'infIntRev':
		 echo $mailint->getRev($logid);	
	break;
	case 'infIntDis':
		 echo $mailint->getDis($logid);	
	break;
	case 'revisi':
		$id=$_POST['id'];
		$keterangan=$_POST['keterangan'];
		$suratkeluar->revisi($id,$keterangan);
	break;
	case 'ajukan':
		$id=$_POST['id'];
		$kkrid=$pegawai->getWhere('level','KKR');
		foreach($kkrid as $jab)
		$suratkeluar->pengajuan($id,$jab['jabatan']);
	break;
	case 'disetujui':
		$id=$_POST['id'];
		$suratkeluar->disetujui($id);
	break;
	case 'hapus':
		$dt=$_POST['dt'];
		$id=$_POST['id'];
		switch ($dt){
			case'in':$mail->hapus($id);break;
			case'out':$mail_out->hapus($id);break;
		}
	break;
	case 'hapus_int':
		$id=$_POST['id'];
		$val=$mailint->getField('file01',$id);
		$data=$mailint->getWhere('file01',$val);
		$n=sizeof($data);
		if($n<2){
			foreach($data as $row){
				if (file_exists("../../".$row['file01'])) { unlink ("../../".$row['file01']);}					
				if (file_exists("../../".$row['file02'])) { unlink ("../../".$row['file02']);}					
				if (file_exists("../../".$row['file03'])) { unlink ("../../".$row['file03']);}					
				if (file_exists("../../".$row['file04'])) { unlink ("../../".$row['file04']);}					
				if (file_exists("../../".$row['file05'])) { unlink ("../../".$row['file05']);}					
				$mailint->hapus($id);
			}
		}else{
			$mailint->hapus($id);
		}
	break;
	case 'getTujuan':
		$val=substr($_POST['val'],-3);
		echo $pegawai->getField('bagian',$val);
	break;
	case 'getRevisi':
		$id=$_POST['id'];
		?><?php
	break;
	case 'updateStatus':
		$bts=$surat->getField('bataswaktu',$id);
		if($bts!='0000-00-00'){
			$surat->updateStatus($_POST['id'],'prc');
		}else{
			$surat->updateStatus($_POST['id'],'fin');
		}
	break;
	case 'getId':
		$data=$_POST['data'];
		$id=substr($data,-3);
		$row=array('0'=>$id,'1'=>$pegawai->getField('jabatan',$id),'2'=>$pegawai->getField('nama',$id),'3'=>$pegawai->getField('level',$id));
		echo json_encode($row);
	break;
	case 'getKode':
		$tb=$_POST['tb'];
		$kls=$_POST['klasi'];
		$id=$_POST['id'];
		//echo $mailout->getField('codeindex',$id);
		$type=$_POST['type'];
		switch($tb){
			case'in':$val=$mail->getField('mail_code',$id);break;
			case'out':$val=$mailout->getField('codeindex',$id);break;
		}
		?>
		<select name="codeindex" id="codeindex"  style="width:100%" onchange="getNoSurat();" onblur="getNoSurat();">
			<?php if($type=='edit'){ ?>
			<option value="<?php echo $val;?>">
			<?php echo $val;?> | <?php echo $klasifikasi->getField('keterangan',$val);?>
			</option>
			<?php
			}
			$x=$klasifikasi->getWhere('idindex',$kls);
			foreach($x as $row){
				echo "<option value=".$row['id']."><b>".$row['id']."</b> | ".$row['keterangan']."</option>";
			}
			?>
		</select>
		<?php
	break;	
	case 'getRep':
		$kepada=$_POST['kepada'];
		?>
		<input type="text" name="idrep" id="idrep" />
		<?php
	break;
	case 'getNoSurat':
			$kode=$_POST['kode'];
			$index=$_POST['noindex'];
			if($kode!=''){$noindex=$kode;}else{$noindex=$klas;}
			$thn=$date->format('Y');
			$bln=$date->format('m');
			$data=array('0'=>$noindex,'1'=>$bag,'2'=>$thn);
			echo json_encode($data);
	break;	
	case 'delete_mail':
		$id=$_POST['id'];
		$draft=$mail->getField("draft_from",$id);
		if($draft==$logid){
			$file=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mail->getField('mail_file01',$id);
			if (file_exists($file)) { unlink ($file);}					
			$del=$mail->del($id);
		}else{
			echo "Surat hanya bisa dihapus oleh pengirim pertama/pembuat draft.";
		}
	break;
	case 'delete_mailint':
		$id=$_POST['id'];
		$draft=$mailint->getField("draft_from",$id);
		if($draft==$logid){
			$file01=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mailint->getField('file01',$id);
			$file02=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mailint->getField('file02',$id);
			$file03=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mailint->getField('file03',$id);
			$file04=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mailint->getField('file04',$id);
			$file05=$_SERVER['DOCUMENT_ROOT'].'/eoffice/'.$mailint->getField('file05',$id);
			if (file_exists($file01)) { unlink ($file01);}					
			if (file_exists($file02)) { unlink ($file02);}					
			if (file_exists($file03)) { unlink ($file03);}					
			if (file_exists($file04)) { unlink ($file04);}					
			if (file_exists($file05)) { unlink ($file05);}					
			$del=$mailint->del($id);
		}else{
			echo "Surat hanya bisa dihapus oleh pengirim pertama/pembuat draft.";
		}
	break;
	case 'viewDetailInt':
		$id=$_POST['id'];
		$set_in=$mailint->setReading($id,$date->format('Y-m-d G:i:s'));
		if($set_in){
			$set_out=$mailint_out->setReading($id,$date->format('Y-m-d G:i:s'));
		}
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="conten-detail">
			  <tr>
				<td width="21%"><p>1. TANGGAL</p></td>
				<td width="1%"><p>:</p></td>
				<td colspan="2"><p>
					<?php echo getTanggal($mailint->getField('tanggal',$id));?>&nbsp;&nbsp;Jam : <?php echo getJam($mailint->getField('tanggal',$id));?></p>
				</td>
			  </tr>
			  <tr>
				<td width="21%"><p>2. DARI</p></td>
				<td width="1%"><p>:</p></td>
				<td colspan="2"><p>
				<?php 
					if($pegawai->getField('level',$mailint->getField('mfrom',$id))=='STF'){
						echo $pegawai->getField('nama',$mailint->getField('mfrom',$id))." / ".$pegawai->getField('jabatan',$mailint->getField('mfrom',$id));
					}else{
						echo $pegawai->getField('jabatan',$mailint->getField('mfrom',$id));				
					}
				?>				
				</p>
				</td>
			  </tr>
			  <tr>
				<td><p>3. PRIHAL SURAT</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mailint->getField('about',$id);?></p></td>
			  </tr>
			  <tr>
				<td><p>4. KETERANGAN</p></td>
				<td><p>:</p></td>
			  	<td colspan="2">
					<p>
					<div class="text-content"><?php echo $mailint->getField('message',$id);?></div>
					</p>
				</td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>5. LAMPIRAN FILE</p></td>
				<td><p>:</p></td>
				<td colspan="2">
					<table cellpadding="0" cellspacing="0" border="0" width="80%">
						<?php
						for($i=1;$i<5;$i++){
						$f="file0".$i;
						$x="ext0".$i;
						$ext=$mailint->getField($x,$id);
						$link=$mailint->getField($f,$id);
						$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-17);
						?>
						<tr>
							<td width="25">
							<?php 
								switch($ext){
									case 'pdf':
										echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
									break;
									case 'xls':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'xlsx':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'doc':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'docx':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'jpg':
										echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
									break;
									case 'png':
										echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
									break;
								}
							?>							
							</td>
							<td width="560" style="vertical-align:middle;">
							<?php
								switch($ext){
									case 'pdf':
										echo $file.".".$ext;
									break;
									case 'xls':
										echo $file.".".$ext;
									break;
									case 'xlsx':
										echo $file.".".$ext;
									break;
									case 'doc':
										echo $file.".".$ext;
									break;
									case 'docx':
										echo $file.".".$ext;
									break;
									case 'jpg':
										echo $file.".".$ext;
									break;
									case 'png':
										echo $file.".".$ext;
									break;
								}
							?>							
							</td>
						</tr>
						<?php
						}
						?>
					</table>				
				</td>
			  </tr>
			  <?php
		  		$replay=$mailint->getField('replay',$id);
		  		if($replay!=''){
				?>
			  <tr>
			  	<td style="background:#E5E5E5;" colspan="4"><h3 style="padding:5px;color:#004A95; font-weight:bold">SURAT BALASAN </h3></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>1. SURAT BALASAN UNTUK</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mail->getField('mail_from',$replay);?></p></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>2. URAIAN</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mail->getField('mail_about',$replay);?></p></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>3. FILE SURAT</p></td>
				<td><p>:</p></td>
				<td width="3%">
				<?php 
				$link=$mail->getField('mail_file01',$replay);
				$ext=$mail->getField('mail_file01_type',$replay);
				switch($ext){
					case 'pdf':
						echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
				?>				</td>
				<td width="75%" style="vertical-align:middle">
				<?php 
					$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
					switch($ext){
						case 'pdf':
							echo $file.".".$ext;
						break;
						case 'xls':
							echo $file.".".$ext;
						break;
						case 'xlsx':
							echo $file.".".$ext;
						break;
						case 'doc':
							echo $file.".".$ext;
						break;
						case 'docx':
							echo $file.".".$ext;
						break;
						case 'jpg':
							echo $file.".".$ext;
						break;
						case 'png':
							echo $file.".".$ext;
						break;
					}
				?>				
				</td>
			  </tr>
				<?php
				}
				?>
		  </table>
		</div>
		<div id="menu-detail">&nbsp;
			<?php
				switch($level){
					case 'KKR':
						?><a onclick="back_mail('<?php echo $id;?>')">Kembalikan</a>
						<a onclick="approved_mail('<?php echo $id;?>')">Setujui</a><?php
					break;
					case 'KTU':
						?><a onclick="back_mail('<?php echo $id;?>')">Kembalikan</a>
						<a onclick="forward_mail_int('<?php echo $id;?>')">Teruskan</a><?php
					break;
					case 'KSI':
						?><a onclick="back_mail('<?php echo $id;?>')">Kembalikan</a>
						<a onclick="forward_mail_int('<?php echo $id;?>')">Teruskan</a><?php
					break;
					case 'STF':
						?><a onclick="forward_mail_int('<?php echo $id;?>')">Kirim ulang</a><?php
					break;
					case 'SKR':
						?><a onclick="registrasi_mail('<?php echo $id;?>')">Registrasi</a><?php
					break;
				}
				?>
				<div style="float:right;">
					<a onclick="hapus_int('<?php echo $id;?>');">Hapus</a>
					<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>
				</div>
		</div>
		<?php
	break;
	case 'viewDetailInt_out':
		$id=$_POST['id'];
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="conten-detail">
			  <tr>
				<td width="21%"><p>1. TANGGAL</p></td>
				<td width="1%"><p>:</p></td>
				<td colspan="2"><p>
					<?php echo getTanggal($mailint_out->getField('tanggal',$id));?>&nbsp;&nbsp;Jam : <?php echo getJam($mailint_out->getField('tanggal',$id));?></p>
				</td>
			  </tr>
			  <tr>
				<td width="21%"><p>2. DARI</p></td>
				<td width="1%"><p>:</p></td>
				<td colspan="2"><p>
				<?php 
					if($pegawai->getField('level',$mailint_out->getField('mfrom',$id))=='STF'){
						echo $pegawai->getField('nama',$mailint_out->getField('mfrom',$id))." / ".$pegawai->getField('jabatan',$mailint_out->getField('mfrom',$id));
					}else{
						echo $pegawai->getField('jabatan',$mailint_out->getField('mfrom',$id));				
					}
				?>				
				</p>
				</td>
			  </tr>
			  <tr>
				<td><p>3. PRIHAL SURAT</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mailint_out->getField('about',$id);?></p></td>
			  </tr>
			  <tr>
				<td><p>4. KETERANGAN</p></td>
				<td><p>:</p></td>
			  	<td colspan="2">
					<p>
					<div class="text-content"><?php echo $mailint_out->getField('message',$id);?></div>
					</p>
				</td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>5. LAMPIRAN FILE</p></td>
				<td><p>:</p></td>
				<td colspan="2">
					<table cellpadding="0" cellspacing="0" border="0" width="80%">
						<?php
						for($i=1;$i<5;$i++){
						$f="file0".$i;
						$x="ext0".$i;
						$ext=$mailint_out->getField($x,$id);
						$link=$mailint_out->getField($f,$id);
						$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-17);
						?>
						<tr>
							<td width="25">
							<?php 
								switch($ext){
									case 'pdf':
										echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
									break;
									case 'xls':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'xlsx':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'doc':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'docx':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'jpg':
										echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
									break;
									case 'png':
										echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
									break;
								}
							?>							
							</td>
							<td width="560" style="vertical-align:middle;">
							<?php
								switch($ext){
									case 'pdf':
										echo $file.".".$ext;
									break;
									case 'xls':
										echo $file.".".$ext;
									break;
									case 'xlsx':
										echo $file.".".$ext;
									break;
									case 'doc':
										echo $file.".".$ext;
									break;
									case 'docx':
										echo $file.".".$ext;
									break;
									case 'jpg':
										echo $file.".".$ext;
									break;
									case 'png':
										echo $file.".".$ext;
									break;
								}
							?>							
							</td>
						</tr>
						<?php
						}
						?>
					</table>				
				</td>
			  </tr>
			  <?php
		  		$replay=$mailint_out->getField('replay',$id);
		  		if($replay!=''){
				?>
			  <tr>
			  	<td style="background:#E5E5E5;" colspan="4"><h3 style="padding:5px;color:#004A95; font-weight:bold">SURAT BALASAN </h3></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>1. SURAT BALASAN UNTUK</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mail->getField('mail_from',$replay);?></p></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>2. URAIAN</p></td>
				<td><p>:</p></td>
				<td colspan="2"><?php echo $mail->getField('mail_about',$replay);?></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>3. FILE SURAT</p></td>
				<td><p>:</p></td>
				<td width="3%">
				<?php 
				$link=$mail->getField('mail_file01',$replay);
				$ext=$mail->getField('mail_file01_type',$replay);
				switch($ext){
					case 'pdf':
						echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
				?>				</td>
				<td width="75%" style="vertical-align:middle">
				<?php 
					$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
					switch($ext){
						case 'pdf':
							echo $file.".".$ext;
						break;
						case 'xls':
							echo $file.".".$ext;
						break;
						case 'xlsx':
							echo $file.".".$ext;
						break;
						case 'doc':
							echo $file.".".$ext;
						break;
						case 'docx':
							echo $file.".".$ext;
						break;
						case 'jpg':
							echo $file.".".$ext;
						break;
						case 'png':
							echo $file.".".$ext;
						break;
					}
				?>				
				</td>
			  </tr>
				<?php
				}
				?>
		  </table>
		</div>
			<div id="menu-detail">&nbsp;
				<div style="float:right;">
					<?php if($level!='SKR'){?>
					<a onclick="hapus_int('<?php echo $id;?>');">Hapus</a>
					<?php }?>
					<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>
				</div>
			</div>			
		</div>
		<?php
	break;
	case 'viewDetailIn':
		$id=$_POST['id'];
		$set_in=$mail->setReading($id,$date->format('Y-m-d G:i:s'));
		if($set_in){
			//$id_out=substr($id,0,3).'1'.substr($id,3);
			$set_out=$mail_out->setReading($id,$date->format('Y-m-d G:i:s'));
		}
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail">
				<table width="100%" cellpadding="0" cellspacing="0" id="conten-detail">
					<tr>
						<td><p>1. NO.SURAT</p></td>
					  <td width="1%"><p>:</p></td>
						<td>
							<p>
							<?php 
							if($mail->getField('mail_no',$id)=='')echo "Belum diregistrasi.";
							else echo $mail->getField('mail_no',$id); 
							?>					
							</p>
						</td>
					</tr>
					<tr>
					  <td width="15%"><p>2. TGL.MASUK</p></td>
						<td><p>:</p></td>
					  <td width="84%"><p><?php echo getTanggal($mail->getField('tanggal',$id));?></p></td>
					</tr>
					<tr>
					  <td width="15%"><p>3. TGL.SURAT</p></td>
						<td><p>:</p></td>
					  <td width="84%"><p><?php echo getTanggal($mail->getField('mail_date',$id));?></p></td>
					</tr>
					<tr>
						<td><p>4. DARI</p></td>
						<td><p>:</p></td>
						<td><P><?php echo $mail->getField('mail_from',$id);?></P></td>
					</tr>
					<tr>
						<td><p>5. URAIAN</p></td>
						<td><p>:</p></td>
						<td><?php echo $mail->getField('mail_about',$id);?></td>
					</tr>
					<tr>
						<td><p>6. PESAN</p></td>
						<td><p>:</p></td>
						<td>
						<div class="text-content">
						<?php 
						if($mail->getField('content',$id)!=''){
							echo $mail->getField('content',$id);
						}else{
							echo "-";
						}
						?>
						</div>
						</td>
					</tr>
			  <tr>
				<td style="vertical-align:top;">7. LAMPIRAN FILE</td>
				<td>:</td>
				<td>
					<table cellpadding="0" cellspacing="0" border="0" width="80%">
						<?php
						for($i=1;$i<5;$i++){
						$f="mail_file0".$i;
						$x="mail_file0".$i."_type";
						$ext=$mail->getField($x,$id);
						$link=$mail->getField($f,$id);
						$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
						?>
						<tr>
							<td width="25">
							<?php 
								switch($ext){
									case 'pdf':
										echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
									break;
									case 'xls':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'xlsx':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'doc':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'docx':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
								}
							?>							
							</td>
							<td width="560" style="vertical-align:middle;">
							<?php
								switch($ext){
									case 'pdf':
										echo $file.".".$ext;
									break;
									case 'xls':
										echo $file.".".$ext;
									break;
									case 'xlsx':
										echo $file.".".$ext;
									break;
									case 'doc':
										echo $file.".".$ext;
									break;
									case 'docx':
										echo $file.".".$ext;
									break;
								}
							?>							
							</td>
						</tr>
						<?php
						}
						?>
					</table>				
				</td>
			  </tr>				
			  </table>
			</div>
			<?php
				if($mail->getField('mail_status',$id)=='dis'){
			?>
			<h3 style="padding:5px; background:#E5E5E5; color:#004A95; font-weight:bold">LEMBAR DISPOSISI</h3>
			<div id="conten-detail">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
					  <td width="17%"><p>1. TANGGAL</p></td>
						<td width="1%">:</td>
						<td width="82%">
						<p>
						<?php 
						$limit=$mail->getField('tanggal',$id);
						if($limit!='0000-00-00'){
							echo getTanggal($mail->getField('tanggal',$id));
						}
						?>						
						</p>
					  </td>
					</tr>
					<tr>
						<td><p>2. INSTRUKSI</p></td>
						<td>:</td>
						<td>
							<span style="color:#FF0000;">
								<?php echo $mail->getField('content_disposisi',$id);?>
							</span>
						</td>
					</tr>
					<tr>
						<td><p>3. BATAS WAKTU </p></td>
						<td>:</td>
						<td>
						<p> 
						<span style="color:#FF0000;">
						<?php 
							$limit=$mail->getField('mail_limit',$id);
							if($limit!='0000-00-00'){
								echo getTanggal($mail->getField('mail_limit',$id));
							}
							?>
						</span>	
						</p>
						</td>
					</tr>
				</table>
			</div>
			<?php }?>
			<div id="menu-detail">
					<?php if($level!='STF' and $level!='KKR' and $level!='SKR'){?>
					<a onclick="forward_mailin('<?php echo $id;?>');">Teruskan</a>
					<?php }?>
					<?php if($level=='SKR'){?>
					<a onclick="edit_mail('<?php echo $id;?>');">Ubah</a>
					<?php }?>
					<?php if($level=='KKR' or $level=='KTU'){?>
					<a onclick="disposisi_mail('<?php echo $id;?>');">Disposisi</a>
					<?php }?>
					<?php if($level=='KTU'){?>
					<a onclick="saran_mail('<?php echo $id;?>');">Saran Disposisi</a>
					<?php }?>
					<?php if($level=='STF'){?>
					<a onclick="replay_mail('<?php echo $id;?>');">Proses/Balas</a>
					<?php }?>
					<div style="float:right;">
						<a onclick="hapus_in('<?php echo $id;?>','in');">Hapus</a>
						<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>					
					</div>
		  </div>
		</div>	
	<?php
	break;
	case 'viewDetailIn_out':
		$id=$_POST['id'];
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail">
				<table width="100%" cellpadding="0" cellspacing="0" id="conten-detail">
					<tr>
						<td><p>1. NO.SURAT</p></td>
					  <td width="1%"><p>:</p></td>
						<td>
							<p>
							<?php 
							if($mail_out->getField('mail_no',$id)=='')echo "Belum diregistrasi.";
							else echo $mail_out->getField('mail_no',$id); 
							?>					
							</p>
						</td>
					</tr>
					<tr>
					  <td width="15%"><p>2. TGL.MASUK</p></td>
						<td><p>:</p></td>
					  <td width="84%"><p><?php echo getTanggal($mail_out->getField('tanggal',$id));?></p></td>
					</tr>
					<tr>
					  <td width="15%"><p>3. TGL.SURAT</p></td>
						<td><p>:</p></td>
					  <td width="84%"><p><?php echo getTanggal($mail_out->getField('mail_date',$id));?></p></td>
					</tr>
					<tr>
						<td><p>4. DARI</p></td>
						<td><p>:</p></td>
						<td><P><?php echo $mail_out->getField('mail_from',$id);?></P></td>
					</tr>
					<tr>
						<td><p>5. URAIAN</p></td>
						<td><p>:</p></td>
						<td><?php echo $mail_out->getField('mail_about',$id);?></td>
					</tr>
					<tr>
						<td><p>6. PESAN</p></td>
						<td><p>:</p></td>
						<td>
						<div class="text-content">
						<?php 
						if($mail_out->getField('content',$id)!=''){
							echo $mail_out->getField('content',$id);
						}else{
							echo "-";
						}
						?>
						</div>
						</td>
					</tr>
			  <tr>
				<td style="vertical-align:top;">7. LAMPIRAN FILE</td>
				<td>:</td>
				<td>
					<table cellpadding="0" cellspacing="0" border="0" width="80%">
						<?php
						for($i=1;$i<5;$i++){
						$f="mail_file0".$i;
						$x="mail_file0".$i."_type";
						$ext=$mail_out->getField($x,$id);
						$link=$mail_out->getField($f,$id);
						$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
						?>
						<tr>
							<td width="25">
							<?php 
								switch($ext){
									case 'pdf':
										echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
									break;
									case 'xls':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'xlsx':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'doc':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'docx':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
								}
							?>							
							</td>
							<td width="560" style="vertical-align:middle;">
							<?php
								switch($ext){
									case 'pdf':
										echo $file.".".$ext;
									break;
									case 'xls':
										echo $file.".".$ext;
									break;
									case 'xlsx':
										echo $file.".".$ext;
									break;
									case 'doc':
										echo $file.".".$ext;
									break;
									case 'docx':
										echo $file.".".$ext;
									break;
								}
							?>							
							</td>
						</tr>
						<?php
						}
						?>
					</table>				
				</td>
			  </tr>				
			  </table>
			</div>
			<?php
				if($mail_out->getField('mail_status',$id)=='dis'){
			?>
			<h3 style="padding:5px; background:#E5E5E5; color:#004A95; font-weight:bold">LEMBAR DISPOSISI</h3>
			<div id="conten-detail">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
					  <td width="17%"><p>1. TANGGAL</p></td>
						<td width="1%">:</td>
						<td width="82%">
						<p>
						<?php 
						$limit=$mail_out->getField('tanggal',$id);
						if($limit!='0000-00-00'){
							echo getTanggal($mail_out->getField('tanggal',$id));
						}
						?>						
						</p>
					  </td>
					</tr>
					<tr>
						<td><p>2. INSTRUKSI</p></td>
						<td>:</td>
						<td>
							<span style="color:#FF0000;">
								<?php echo $mail_out->getField('content_disposisi',$id);?>
							</span>
						</td>
					</tr>
					<tr>
						<td><p>3. BATAS WAKTU </p></td>
						<td>:</td>
						<td>
						<p> 
						<span style="color:#FF0000;">
						<?php 
							$limit=$mail_out->getField('mail_limit',$id);
							if($limit!='0000-00-00'){
								echo getTanggal($mail_out->getField('mail_limit',$id));
							}
							?>
						</span>	
						</p>
						</td>
					</tr>
				</table>
			</div>
			<?php }?>
			<div id="menu-detail">&nbsp;
				<?php 
				if($mail_out->getField('reading',$id)=='0000-00-00 00:00:00'){ 
					$sts=$mail_out->getField('mail_status',$id);
					switch($sts){
						case 'new':
						?><a onclick="edit_mail('<?php echo $id;?>');">Ubah</a><?php
						break;
						case 'dis':
						?><a onclick="edit_disposisi('<?php echo $id;?>');">Ubah</a><?php
						break;
						case 'prc':
						?><a onclick="edit_forward('<?php echo $id;?>');">Ubah</a><?php
						break;
					}
				}
				?>
				<div style="float:right;">
					<a onclick="hapus_in('<?php echo $id;?>','out');">Hapus</a>
					<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>					
				</div>
		  </div>
		</div>	
	<?php
	break;
	case 'viewDetailOut':
		$id=$_POST['id'];
		?>
		<div class="pesan-detail"><b></b>
			<div id="conten-detail">
				<table width="100%" cellpadding="0" cellspacing="0" id="conten-detail">
					<tr>
						<td><p>1. NO.SURAT</p></td>
					  <td width="0%"><p>:</p></td>
						<td colspan="2">
							<p>
							<?php 
							if($mailout->getField('nosurat',$id)=='')echo "Belum diregistrasi.";
							else echo $mailout->getField('nosurat',$id); 
							?>					
							</p>
						</td>
					</tr>
					<tr>
					  <td width="18%"><p>2. TANGGAL </p></td>
						<td><p>:</p></td>
					  <td colspan="2"><p><?php echo getTanggal($mailout->getField('tanggal',$id));?></p></td>
					</tr>
					<tr>
					  <td width="18%"><p>3. TGL.SURAT</p></td>
						<td><p>:</p></td>
					  <td colspan="2"><p><?php echo getTanggal($mailout->getField('tgl_surat',$id));?></p></td>
					</tr>
					<tr>
						<td><p>4. DARI</p></td>
						<td><p>:</p></td>
						<td colspan="2"><P><?php echo $pegawai->getField('jabatan',$mailout->getField('dari',$id))."-".$pegawai->getField('nama',$mailout->getField('dari',$id));?></P></td>
					</tr>
					<tr>
						<td><p>5. URAIAN</p></td>
						<td><p>:</p></td>
						<td colspan="2"><p><?php echo $mailout->getField('uraian',$id);?></p></td>
					</tr>
			  <tr>
				<td style="vertical-align:top;">7. LAMPIRAN FILE</td>
				<td><p>:</p></td>
				<td colspan="2">
					<?php
					$file=substr($mailout->getField('file',$id),7);
					$link=$mailout->getField('file',$id);
					$ext=substr($file,-3);
					?>
					<table cellpadding="0" cellspacing="0" border="0" width="80%">
						<tr>
							<td width="25">
							<?php 
								switch($ext){
									case 'pdf':
										echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
									break;
									case 'xls':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'xlsx':
										echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
									break;
									case 'doc':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
									case 'docx':
										echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
									break;
								}
							?>							
							</td>
							<td width="560" style="vertical-align:middle;">
							<p><?php echo substr($file,0,-18);?></p>							
							</td>
						</tr>
					</table>				
				</td>
			  </tr>				
			  <?php
				$replay=$mailout->getField('replay',$id);
		  		if($replay!=''){
				?>
			  <tr>
			  	<td style="background:#E5E5E5;" colspan="4"><h3 style="padding:5px;color:#004A95; font-weight:bold">SURAT BALASAN </h3></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>1. SURAT BALASAN UNTUK</p></td>
				<td><p>:</p></td>
				<td colspan="2"><p><?php echo $mail->getField('mail_from',$replay);?></p></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>2. URAIAN</p></td>
				<td><p>:</p></td>
				<td colspan="2"><?php echo $mail->getField('mail_about',$replay);?></td>
			  </tr>
			  <tr>
				<td style="vertical-align:top;"><p>3. FILE SURAT</p></td>
				<td><p>:</p></td>
				<td width="3%">
				<?php 
				$link=$mail->getField('mail_file01',$replay);
				$ext=$mail->getField('mail_file01_type',$replay);
				switch($ext){
					case 'pdf':
						echo "<a href='$link' target='_blank'><img src='img/pdf-icon.png'/></a>";
					break;
					case 'xls':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'xlsx':
						echo "<a href='$link' target='_blank'><img src='img/xls-icon.png'/></a>";
					break;
					case 'doc':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'docx':
						echo "<a href='$link' target='_blank'><img src='img/doc-icon.png'/></a>";
					break;
					case 'jpg':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
					case 'png':
						echo "<a href='$link' target='_blank'><img src='img/img-icon.png'/></a>";
					break;
				}
				?>				</td>
				<td width="79%" style="vertical-align:middle">
				<?php 
					$file=substr(substr(substr(substr($link,6),0,-strlen($ext)),0,-1),0,-14);
					switch($ext){
						case 'pdf':
							echo $file.".".$ext;
						break;
						case 'xls':
							echo $file.".".$ext;
						break;
						case 'xlsx':
							echo $file.".".$ext;
						break;
						case 'doc':
							echo $file.".".$ext;
						break;
						case 'docx':
							echo $file.".".$ext;
						break;
						case 'jpg':
							echo $file.".".$ext;
						break;
						case 'png':
							echo $file.".".$ext;
						break;
					}
				?>				</td>
			  </tr>
				<?php
				}
				?>
			  </table>
			</div>
			<div id="menu-detail">
				<a onclick="edit_mail_out('<?php echo $id;?>');">Ubah</a>
				<div style="float:right;">
					<a onclick="hapus('<?php echo $id;?>');">Hapus</a>
					<a onclick="viewHide('<?php echo $id;?>');">Tutup</a>					
				</div>
		  </div>		
	</div>	
	<?php
	break;
}
?>
