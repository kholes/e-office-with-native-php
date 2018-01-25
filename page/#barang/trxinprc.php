<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/trxinput.cls.php";
include "../../class/trxoutput.cls.php";
include "../../class/barangkeluar.cls.php";
include "../../class/user.cls.php";
include "../../class/dtmerek.cls.php";
include "../../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$trx=new Trxinput();
$merek=new Dtmerek();
$satuan=new Dtsatuan();
$trxout=new Trxoutput();
$dtbarang=new Dtbarang();
$barangkeluar=new Barangkeluar();
$tbinput='tempinput'.$logid;
$tboutput='tempoutput'.$logid;
$tbreq='tempreq'.$logid;
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	$req=$_POST['req'];
	switch($req){
		case 'delItem':
			$id=$_POST['id'];
			$del=$trx->delData($id);
			if($del){
				echo "Data ".$id.", Sudah terhapus.";
			}
			
		break;
		case 'caridata':
			$key=$_POST['key'];
			if($key!=''){
				$x=$trx->getSrc('nama',$key);
				if($x!=array()){
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
					<th width="16%" align="left">KODE BARANG</th>
					<th width="19%" align="left">NAMA BARANG</th>
					<th width="26%" align="left">MEREK</th>
					<th width="25%" align="left">JUMLAH STOK</th>
					<th width="14%" align="center">SATUAN</th>
					<?php
					foreach($x as $row){
					?>
					<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>');"  onMouseOut="this.style.background='#fff';">
						<td width="30%"><?php echo $row['id'];?></td>
						<td width="30%"><?php echo $row['nama'];?></td>
						<td width="17%"><?php echo $merek->getField('merek',$row['merek']);?></td>
						<td width="12%" align="center"><?php echo $row['stok'];?></td>
						<td width="18%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
					</tr>
					<?php
					}
					?>
				</table>
			<?php
			}else{
				echo "<p class='pesan'>Data tidak ditemukan...</p>";
			}
				}
		break;
		case 'cekTemp':
			echo $sql=$trx->cekTemp();
		break;
		case 'clearTemp':
			$trx->clearTemp($tbinput);
		break;
		case 'trxHead':
			$temp=$trx->getTemp();
			if($temp!=array()){
				$suplayer=substr($_POST['suplayer'],0,3);
				$data=array('id'=>$_POST['id'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'nota'=>$_POST['nota'],'suplayer'=>$suplayer,'diskon'=>$_POST['diskon'],'total'=>$_POST['total'],'id_user'=>$logid);
				$trxHead=$trx->addData($data);
				if($trxHead){
					$temp=$trx->getTemp();
					foreach($temp as $row){
						$data=array('idt'=>$_POST['id'],'id'=>$row['id'],'kode'=>$row['kode'],'nama'=>$row['nama'],'harga_beli'=>$row['harga_beli'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon']);
						$trx->addItem($data);
						$oldstok=$dtbarang->getField('stok',$row['id']);
						$newstok=$oldstok+$row['qty'];
						$dtstok=array('harga_beli'=>$row['harga_beli'],'stok'=>$newstok);
						$dtbarang->updateStok($row['id'],$dtstok);
					}
					$trx->clearTemp($tbinput);
				}
				return true;
			}else{
				echo "Data barang masih kosong";
				return false;
			}
		break;
		case 'getTemp':
			$sql=$trx->getTemp();
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="3%">No</th>
					<th width="12%" align="left">Kode</th>
					<th width="47%" align="left">Nama barang </th>
					<th width="12%" align="right">Harga beli </th>
					<th width="6%" align="center">Qty</th>
					<th width="8%" align="right">Diskon</th>
					<th width="12%" align="right">Jumlah</th>
				<?php
				foreach($sql as $row){	  	
				?>
				<tr onMouseOver="this.style.cursor='pointer';" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');">
					<td width="3%" style="vertical-align:middle;" align="center"><?php echo $c=$c+1;?></td>
					<td width="12%" style="vertical-align:middle;"><?php echo $row['kode']; ?></td>
					<td width="47%" style="vertical-align:middle;"><?php echo $row['nama']; ?></td>
					<td width="12%" style="vertical-align:middle;" align="right"><?php echo format_angka($row['harga_beli']); ?></td>
					<td width="6%" style="vertical-align:middle;" align="center"><?php echo $row['qty']; ?></td>
					<td width="8%" style="vertical-align:middle;" align="right"><?php echo format_angka($row['diskon']); ?></td>
					<td width="12%" style="vertical-align:middle;" align="right"><?php echo format_angka($row['jumlah']); ?></td>
				</tr>
				<?php
				}	  
				?>
					<th colspan="6" align="left"><h2>Total (Rp)</h2></th>
					<th align="right">
						<h2><?php echo format_angka($trx->getTotalTemp());?></h2>
					</th>
			</table>
			<?php
			}
		break;
		case 'getDetail':
			$id=$_POST['id'];
			$sql=$trx->getDetail($id);
			if($sql!=array($sql)){
			?>
			<div class="pesan-detail" style="margin-left:15px;"><b></b>
			<div id="conten-detail">
				<table width="99%" border="0" cellspacing="0" cellpadding="0" class="table" style="margin:auto">
					<th width="12%" align="left">Kode Barang</th>
					<th width="47%" align="left">Nama barang </th>
					<th width="12%" align="right">Harga beli </th>
					<th width="6%" align="center">Qty</th>
					<th width="8%" align="right">Diskon</th>
					<th width="12%" align="right">Jumlah</th>
				<?php
				foreach($sql as $row){	  	
				?>
				<tr onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');">
					<td width="12%" style="vertical-align:middle"><?php echo $row['id']; ?></td>
					<td width="47%" style="vertical-align:middle"><?php echo $row['nama']; ?></td>
					<td width="12%" align="right" style="vertical-align:middle"><?php echo format_angka($row['harga_beli']); ?></td>
					<td width="6%" align="center" style="vertical-align:middle"><?php echo $row['qty']; ?></td>
					<td width="8%" align="right" style="vertical-align:middle"><?php echo format_angka($row['diskon']); ?></td>
					<td width="12%" align="right" style="vertical-align:middle"><?php echo format_angka($row['jumlah']); ?></td>
				</tr>
				<?php
				}	  
				?>
			</table>
			</div>
				<div style="border-top:1px solid #ccc; margin-top:5px; padding:5px;">
					<input type="button" value="Tutup" onclick="viewHide('<?php echo $id;?>');" style="float:right;">
					<div style="clear:both;"></div>
				</div>
			</div>		
			<?php
			}
		break;
		case 'addTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$cekid=$trx->getField('id',$_POST['id']);
			if($cekid==""){
				$add=$trx->addTemp($data);
				if($add){
					$x=$trx->getTemp();
				}
			}else{
				$oldQty=$trx->getField('qty',$cekid);
				$qty=$oldQty+$_POST['qty'];
				$jumlah=$qty*$_POST['harga_beli'];
				$data=array('harga_beli'=>$_POST['harga_beli'],'qty'=>$qty,'jumlah'=>$jumlah,'diskon'=>$_POST['diskon']);
				$upqty=$trx->updateTemp($cekid,$data);
			}
		break;
		case 'updTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$trx->updateTemp($data);		
		break;
		case 'delTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
			$trx->deleteTemp($data);		
		break;
		case 'viewdata':
			$sql=$trxout->getAll();
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="16%" align="left">KODE BARANG</th>
				<th width="19%" align="left">NAMA BARANG</th>
				<th width="26%" align="left">MEREK</th>
				<th width="25%" align="left">JUMLAH STOK</th>
				<th width="14%" align="center">SATUAN</th>
				<?php
				foreach($sql as $row){
				?>
				<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>');"  onMouseOut="this.style.background='#fff';">
					<td width="30%"><?php echo $row['id'];?></td>
					<td width="30%"><?php echo $row['nama'];?></td>
					<td width="17%"><?php echo $merek->getField('merek',$row['merek']);?></td>
					<td width="12%" align="center"><?php echo $row['stok'];?></td>
					<td width="18%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
				</tr>
				<?php
				}
				?>
			</table>
		<?php
		}else{
			echo "<p class='pesan'>Data tidak ditemukan...</p>";
		}
	break;
	}
}
?>
