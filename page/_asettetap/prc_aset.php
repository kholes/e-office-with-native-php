<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/dtkiba.cls.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkibc.cls.php";
include "../../class/dtkibe.cls.php";
include "../../class/dtperawatan.cls.php";
$db=new Db();
$db->conDb();
$dtkiba=new Dtkiba();
$dtkibb=new Dtkibb();
$dtkibc=new Dtkibc();
$dtkibe=new Dtkibe();
$perawatan=new Dtperawatan();
$logid=decrypt_url($_SESSION['id_user']);
$id=$_GET['id'];
$req=$_POST['req'];
switch($req){
	case 'getId':
		$kategori=$_POST['kategori'];
		echo kdauto('dtperawatan',$kategori);
	break;
	case 'tambahTemp':
		$idt=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$_POST['id'],'idt'=>$idt,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
		$perawatan->addDataTemp($data);
		//$cekTemp=$perawatan->getTemp($idt,$_POST['id']);
		//if(!$cekTemp){
		//}
	break;
	case 'getTemp':
		$idt=$_POST['idt'];
		$id=$_POST['id'];
		$x=$perawatan->getTemp($idt,$id);
		foreach($x as $data)
		$row=array('0'=>$data['id'],'1'=>$data['jenis'],'2'=>$data['harga'],'3'=>$data['keterangan'],'4'=>tgl_eng_to_ind($data['tanggal']),'5'=>$data['sparepart'],'6'=>$data['status']);
		echo json_encode($row);
	break;
	case 'getAllTemp':
		switch($_POST['act']){
			case 'temp':
				$data=$perawatan->getAllTemp();
			break;
			case 'item':
				$data=$perawatan->getAllItem($_POST['idt']);
			break;
		}
		if($data!=array()){
		?>
		<div style="height:150px; overflow:auto">
		<table cellpadding="0" cellspacing="0" width="100%" class="table">
			<th width="7%" align="left">ID.ASET</th>
			<th width="12%" align="left">TANGGAL</th>
			<th width="6%" align="left">JENIS</th>
			<th width="14%" align="left">SPAREPART</th>
			<th width="8%" align="right">HARGA</th>
			<th width="8%" align="center">STATUS</th>
			<th width="22%" align="left">KETERANGAN</th>
			<th width="4%" align="left">&nbsp;</th>
			<th width="4%" align="left">&nbsp;</th>
			<?php
			foreach($data as $row){
			?>
			<tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo getTanggal($row['tanggal']);?></td>
				<td><?php echo $row['jenis'];?></td>
				<td><?php echo $row['sparepart'];?></td>
				<td align="right"><?php echo format_angka($row['harga']);?></td>
				<td align="center"><?php echo $row['status'];?></td>
				<td><?php echo $row['keterangan'];?></td>
				<td style="vertical-align:middle" align="right">
					<a onclick="getTemp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
						<img src="img/edit.png" />
					</a>
				</td>
				<td style="vertical-align:middle" align="right">
					<a onclick="delTemp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
						<img src="img/hapus.png" />
					</a>
				</td>
			</tr>
			<?php }?>
		</table>
		</div>
		<div style="border:1px solid #ccc; color:#FF0000; background:#CCCCCC; font-size:16px; font-weight:bold; padding:5px; margin-top:15px;">
			<p style="float:left">T O T A L</p>
			<h3 style="float:right"><?php echo format_angka($perawatan->getTotalTemp());?></h3>
			<div style="clear:both"></div>
		</div>
		<?php
		}
	break;
	case 'delTemp':
		$idt=$_POST['idt'];
		$id=$_POST['id'];
		$perawatan->delTemp($idt,$id);
	break;
	case 'editTemp':
		$idt=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$_POST['id'],'idt'=>$idt,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
		$perawatan->editDataTemp($data);
	break;
	case 'addPerawatan':
		$id=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$id,'tanggal'=>tgl_ind_to_eng($_POST['tgl']),'kategori'=>$_POST['kategori'],'pelaksana'=>substr($_POST['pelaksana'],0,3),'stafaset'=>$logid);
		$add=$perawatan->addData($data);
		if($add){
			$temp=$perawatan->getAllTemp();
			foreach($temp as $row){
				$item=array('id'=>$row['id'],'idt'=>$id,'tanggal'=>$row['tanggal'],'jenis'=>$row['jenis'],'sparepart'=>$row['sparepart'],'harga'=>$row['harga'],'status'=>$row['status'],'keterangan'=>$row['keterangan']);
				$addItem=$perawatan->addItem($item);
			}		
			if($addItem){
				$perawatan->clearTemp();
			}
		}
	break;
	case 'getItem':
		$id=$_POST['id'];
		$kategori=$perawatan->getField('kategori',$id);
		$data=$perawatan->getAllItem($id);
		if($data!=array()){
		?>
		<div class="pesan-detail" style="margin-left:20px;"><b></b>
		<div id="conten-detail">
				<div style=" display:block; min-height:20px; padding:2px 5px;margin:5px;">			
			<table cellpadding="0" cellspacing="0" width="100%" class="table">
				<th width="30%" align="left">NAMA ASET</th>
				<th width="14%" align="left">TANGGAL</th>
				<th width="14%" align="left">JENIS</th>
				<th width="14%" align="left">PENGGANTIAN</th>
				<th width="7%" align="right">HARGA</th>
				<th width="7%" align="center">STATUS</th>
				<th width="14%" align="left">KETERANGAN</th>
				<?php
				foreach($data as $row){
					switch($kategori){
						case 'KIBA':$nama=$dtkiba->getField('nama',$row['id']);break;
						case 'KIBB':$nama=$dtkibb->getField('nama',$row['id'])."-".$dtkibb->getField('merek',$row['id']);break;
						case 'KIBC':$nama=$dtkibc->getField('nama',$row['id']);break;
						case 'KIBE':$nama=$dtkibe->getField('nama',$row['id']);break;
					}
				?>
				<tr>
					<td><?php echo $nama;?></td>
					<td><?php echo getTanggal($row['tanggal']);?></td>
					<td><?php echo $row['jenis'];?></td>
					<td><?php echo $row['sparepart'];?></td>
					<td align="right"><?php echo format_angka($row['harga']);?></td>
					<td align="center"><?php switch($row['status']){case 'B':echo 'Baik';break;case 'KB':echo 'Kurang Baik';break;case 'RB':echo 'Rusak Berat';break;}?></td>
					<td><?php echo $row['keterangan'];?></td>
				</tr>
				<?php }?>
			</table>
			</div>
<div style="border-top:1px solid #ccc; margin-top:5px; padding:5px;">
					<?php
					switch($level){
						case 'KKR':
						?>
					<input type="button" name="tolak" value="Tolak" onclick="setTolak('<?php echo $id;?>');" />					
					<input type="button" name="terima" value="<?php echo $val_btn;?>" onclick="setStatus('<?php echo $id;?>');" />
						<?php
						break;
						case 'KTU':
						?>
					<input type="button" name="tolak" value="Tolak" onclick="setTolak('<?php echo $id;?>');" />					
					<input type="button" name="terima" value="<?php echo $val_btn;?>" onclick="setStatus('<?php echo $id;?>');" />
						<?php
						break;
						case 'STB':
						?>
					<input type="button" name="terima" id="terima" value="Proses" onclick="kirim('<?php echo $id;?>');" />				
						<?php
						break;
						case 'KSI':
						?>
						
						<?php
						break;
						case 'STF':
						?>
						
						<?php
						break;
					}
					?>
					<input type="button" name="tutup" value="Tutup" onclick="viewHide('<?php echo $id;?>');" style="float:right;" />
					<div style="clear:both;"></div>
			<?php }?>
				
				</div>		</div>
	</div>			
	<?php
	break;
}
?>
