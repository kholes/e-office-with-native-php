<?php
session_start();
include "../../lib/lib.php";
include "../../class/surat.cls.php";
include "../../class/user.cls.php";
include "../../class/dtklasifikasi.cls.php";
include "../../class/dtkode.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$logid=decrypt_url($_SESSION['id_user']);
$surat=new Surat();
$user=new User();
$klasi=new Dtklasifikasi();
$pegawai=new Pegawai();
$kode=new Dtkode();
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
	case '':
		switch ($level){
			case 'KKR':
				$data=$surat->getMailKkr($sts,$level,'tanggal');			
				tabel($data);
			break;
			case 'KTU':
				$data=$surat->getMailKtu($sts,$level);
				tabel($data);
			break;
			case 'KSI':
				$data=$surat->getMailKsi($sts,$level);
				tabel($data);
			break;
			case 'SKR':
				$data=$surat->getMailSkr($sts,$level);
				tabel($data);
			break;
		}
	break;
	case 'getRem':
		echo $rem=$surat->getRem($level);
	break;
	case 'getCount':
		$sts=$_POST['sts'];
		switch ($level){
			case 'KKR':
				$new=$surat->getCountKkr($sts,$level);			
			break;
			case 'KTU':
				$new=$surat->getCountKtu($sts,$level);			
			break;
			case 'KSI':
				$new=$surat->getCountKsi($sts,$logid);			
			break;
			case 'SKR':
				$new=$surat->getCountSkr($sts,$level);			
			break;
		}
		if($new==''){
			$new='0';
		}
		echo $new.' ';		
	break;
	case 'viewDetail':
		$id=$_POST['id'];
		?>
		<div style="padding:10px;">
		<table width="100%" cellpadding="0" cellspacing="0" class="detail-surat">
			<tr>
				<td width="19%" valign="top">TANGGAL MASUK </td>
				<td width="1%" >: </td>
				<td width="80%"><?php echo getTanggal($surat->getField('tanggal',$id));?></td>
			</tr>
			<tr>
				<td valign="top" >NO.URUT</td>
				<td>: </td>
				<td><p style="text-align:justify"><?php echo $surat->getField('nourut',$id);?></p></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">NO.SURAT</td>
				<td class="list-ksi detail" >: </td>
				<td><p style="text-align:justify"><?php echo $surat->getField('nosurat',$id);?></p></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">KLASIFIKASI</td>
				<td>: </td>
				<td class="list-ksi detail" ><p style="text-align:justify"><?php echo $klasi->getField('klasifikasi',$surat->getField('noindex',$id));?></p></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">KODE</td>
				<td>: </td>
				<td class="list-ksi detail" ><p style="text-align:justify"><?php echo $kode->getField('keterangan',$surat->getField('kode',$id));?></p></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">DARI</td>
				<td>: </td>
				<td ><p style="text-align:justify"><?php echo $surat->getField('dari',$id);?></p></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">RINGKASAN/URAIAN</td>
				<td>: </td>
			    <td  class="detail"><?php echo $surat->getField('rangkuman',$id);?></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">DISPOSISI OLEH </td>
				<td>: </td>
			    <td  class="detail"><?php echo $pegawai->getField('jabatan',$surat->getField('pejabat_dis',$id));?></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">TANGGAL DISPOSISI </td>
				<td>: </td>
			    <td  class="detail"><?php echo getTanggal($surat->getField('tgl_dis',$id));?></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">PENERIMA DISPOSISI </td>
				<td>: </td>
			    <td  class="detail">
				<?php 
				//echo $surat->getField('disposisi',$id);
				$x=explode(',',$surat->getField('disposisi',$id)); 
				$n=sizeof($x);
				for($i=0;$i<$n;$i++){
					echo "<p>".$pegawai->getField('jabatan',$x[$i])."</p>";
				}
				?>
				</td>
			</tr>
			<tr>
				<td valign="top"  class="detail">BATAS WAKTU SURAT</td>
				<td>: </td>
			    <td  class="detail"><h3 style="color:#FF0000;"><?php echo getTanggal($surat->getField('bataswaktu',$id));?></h3></td>
			</tr>
			<tr>
				<td valign="top"  class="detail">INSTRUKSI DISPOSISI </td>
				<td>: </td>
			    <td  class="detail"><?php echo $surat->getField('catatan',$id);?></td>
			</tr>
		</table>
		<div class="c10"></div>
		<div style=" text-align:right;" class="detail-menu">
			<div class="work">
				<a class="thickbox" href="page/surat/detail.php?height=400 width=200&id=<?php echo $id; ?>">
					<img src="img/surat-detail.png" class="media" alt="" />
					<div class="caption">
						<div class="work_title">
							<h1>DETAIL</h1>
						</div>
					</div>
				</a>		
			</div>
			<div class="work">
				<a class="thickbox" href="page/surat/disposisi.php?height=400 width=200&id=<?php echo $id; ?>">
					<img src="img/dis.png" class="media" alt=""/>
					<div class="caption">
						<div class="work_title">
							<h1>DISPOSISI</h1>
						</div>
					</div>
				</a>		
			</div>
			<div class="work">
				<a class="thickbox" href="page/surat/lampiran.php?height=400 width=200&id=<?php echo $id; ?>">
					<img src="img/file-lampiran.png" alt="" class="media"/>
					<div class="caption">
						<div class="work_title">
							<h1>LAMPIRAN</h1>
						</div>
					</div>
				</a>		
			</div>
			<div class="work">
				<a href="<?php echo $surat->getField('surat',$id);?>" target="_blank">
					<img src="img/file-open.png" class="media" alt=""/>
					<div class="caption">
						<div class="work_title">
							<h1>F I L E</h1>
						</div>
					</div>
				</a>		
			</div>
		</div>
		<?php
	break;
	case 'Simpan':
		$data=array('surat'=>$_POST['surat'],'id'=>$_POST['id']);
		$surat->addData($data);
		$data=$surat->getAll();
		tabel($data);
	break;
	case 'Edit':
		$data=array('surat'=>$_POST['surat'],'id'=>$_POST['id']);
		$surat->updateData($id,$data);		
		$data=$surat->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$surat->delData($id);
		$data=$surat->getAll();	
		tabel($data);
	break;
	case 'hapusKlas':
		$id=$_POST['id'];
		$klasi->delData($id);
	break;
	case 'addKode':
		$data=array('id'=>$_POST['id'],'klasifikasi'=>$_POST['klasifikasi'],'keterangan'=>$_POST['keterangan']);
		$kode->addData($data);
	break;
	case 'editKode':
		$data=array('id'=>$_POST['id'],'klasifikasi'=>$_POST['klasifikasi'],'keterangan'=>$_POST['keterangan']);
		$kode->updateData($_POST['id'],$data);
	break;
	case 'hapusKode':
		$kode->delData($_POST['id']);
	break;
	case 'getKode':
		$kls=$_POST['klasi'];
		?>
		<select name="kode" id="kode"  style="width:100%" onchange="getNoSurat();" onblur="getNoSurat();">
		<?php
		$x=$kode->getWhere('klasifikasi',$kls);
		foreach($x as $row){
			echo "<option value=".$row['id']."><b>".$row['id']."</b> | ".$row['keterangan']."</option>";
		}
		?>
		</select>
		<?php
	break;	
	case 'getNoSurat':
			$kode=$_POST['kode'];
			$klas=$_POST['noindex'];
			$bag=$pegawai->getField('bagian',$logid);
			if($kode!=''){$noindex=$kode;}else{$noindex=$klas;}
			$thn=$date->format('Y');
			$bln=$date->format('m');
			$data=array('0'=>$noindex,'1'=>$bag,'2'=>$thn);
			echo json_encode($data);
	break;	
}
?>
