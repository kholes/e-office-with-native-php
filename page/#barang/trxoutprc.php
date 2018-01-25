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
$tbinput='tempinput'.$logid;
$tboutput='tempoutput'.$logid;
$tbreq='tempreq'.$logid;
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	$req=$_POST['req'];
	switch($req){
		case 'caridata':
			$key=$_POST['key'];
			if($key!=''){
				$x=$trxout->getSrc('nama',$key);
				if($x!=array()){
				?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
					<th width="7%" align="left">KODE</th>
					<th width="39%" align="left">NAMA BARANG</th>
					<th width="20%" align="left">MEREK</th>
					<th width="19%" align="left">JUMLAH STOK</th>
					<th width="15%" align="center">SATUAN</th>
					<?php
					foreach($x as $row){
					?>
					<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>');"  onMouseOut="this.style.background='#fff';">
						<td width="7%"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
						<td width="39%"><?php echo $dtbarang->getField('nama',$row['id']);?></td>
						<td width="20%"><?php echo $merek->getField('merek',$row['merek']);?></td>
						<td width="19%" align="center"><?php echo $row['stok'];?></td>
						<td width="15%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
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
		case 'getTempOut':
			$sql=$trxout->getTemp();
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="3%">No</th>
			<th width="9%" align="left">Kode</th>
			<th width="38%" align="left">Nama barang </th>
			<th width="6%" align="center">Jumlah</th>
			<th width="6%" align="center">Satuan</th>
			<th width="44%" align="left">Keterangan</th>
			<th>&nbsp;</th>
			<?php
				foreach($sql as $row){	  	
			?>
			<tr>
				<td width="3%" style="vertical-align:middle" align="center"><?php echo $c=$c+1;?></td>
				<td width="9%" style="vertical-align:middle"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
				<td width="38%" style="vertical-align:middle"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
				<td width="6%" style="vertical-align:middle" align="center" onmouseover="this.style.cursor='pointer';" onClick="upQty('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><?php echo $row['qty']; ?></td>
				<td width="6%" style="vertical-align:middle" align="center"><?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?></td>
				<td width="44%" style="vertical-align:middle" align="left"><?php echo $row['keterangan']; ?></td>
				<td><a  onclick="delTemp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><img src="img/hapus.png" /></a></td>
			</tr>
			<?php
			}	  
			?>
		</table>
		<?php
		}
		break;
		case 'delTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
			$trxout->deleteTemp($data);
		break;
		case 'clearTempOut':
			$trxout->clearTemp($tboutput);
		break;
		case 'cekStokOut':
			$kode=$_POST['kode'];
			$id=$dtbarang->getCode('id',$kode);
			if($id!=''){
				echo $x=$dtbarang->getCode('stok',$kode);
			}	
		break;
		case 'upQtyOut':
			$id=$_POST['id'];
			$qty=$_POST['qty'];
			$harga=$dtbarang->getField('harga_beli',$id);
			$jumlah=$qty*$harga;
			$data=array('qty'=>$qty,'jumlah'=>$jumlah);
			$upqty=$trxout->updateQty($id,$data);
			$x=$trxout->getTemp();
			viewItemOut($x);
		break;
		case 'updateQtyItem':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'qty'=>$_POST['qty']);
			$trxout->updateQtyItem($data);
		break;
		case 'addItemOut':
			$kode=$_POST['kode'];
			if($kode!=''){
				$id=$dtbarang->getCode('id',$kode);
				$qty=$_POST['qty'];
				$jumlah=$qty*$harga;
				$cekid=$trxout->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode_trx('dtbarangkeluar',$logid),'id'=>$dtbarang->getCode('id',$kode),'kode'=>$kode,'qty'=>$qty,'keterangan'=>'');
					$add=$trxout->addTemp($data);
					if($add){
						$x=$trxout->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$trxout->getField('qty',$cekid);
					$qty=$oldQty+$qty;
					$jumlah=$qty*$harga;
					$data=array('qty'=>$qty,'jumlah'=>$jumlah);
					$upqty=$trxout->updateQty($cekid,$data);
					$x=$trxout->getTemp();
					viewItemOut($x);
				}
			}else{
				$id=$_POST['id'];
				$qty=$_POST['qty'];
				$jumlah=$qty*$harga;
				$cekid=$trxout->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode_trx('dtbarangkeluar',$logid),'id'=>$id,'kode'=>$dtbarang->getField('barcode',$id),'qty'=>$qty,'keterangan'=>'');
					$add=$trxout->addTemp($data);
					if($add){
						$x=$trxout->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$trxout->getField('qty',$id);
					$qty=$oldQty+$qty;
					$data=array('id'=>$id,'qty'=>$qty);
					$trxout->updateQty($data);
				}
			}
		break;
		case 'addOut':
			$idreq=$_POST['pegawai'];
			$pemohon=substr($idreq,-3);
			$id=kode_trx('dtbarangkeluar',$pemohon);
			$data=array('id'=>$id,'id_pengajuan'=>'','tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'pemohon'=>$pemohon,'total'=>$_POST['total'],'id_user'=>$logid);
			$add=$trxout->addData($data);
			if($add){
				$temp=$trxout->getTemp();
				if($temp!=array()){
					foreach($temp as $row){
						$dataitem=array('idt'=>$id,'id'=>$row['id'],'kode'=>$row['kode'],'qty'=>$row['qty'],'keterangan'=>$row['keterangan']);
						$item=$trxout->addItem($dataitem);
						if($item){
							$oldstok=$dtbarang->getField('stok',$row['id']);
							$newstok=$oldstok-$row['qty'];
							$upstok=$dtbarang->stok($row['id'],$newstok);
						}
					}
				}else{
					echo "<p class='pesan'>Data Pesanan masih kosong.</p>";
				}
			}
		break;
		case 'caridataOut':
			$key=$_POST['key'];
			if($key!=''){
				$x=$trxout->getSrc('nama',$key);
				cariBarang($x);
			}
		break;
		case 'getDetail':
			$id=$_POST['id'];
			$sql=$trxout->getDetail($id);
			if($sql!=array($sql)){
			?>
			<div class="pesan-detail"><b></b>
			<div id="conten-detail">
			<table width="99%" border="0" cellspacing="0" cellpadding="0" style="background:#DBDBDB; margin:5px;">
					<th width="5%">NO</th>
					<th width="13%" align="left">KODE</th>
					<th width="62%" align="left">NAMA BARANG </th>
					<th width="11%" align="center">JUMLAH</th>
					<th width="9%" align="left">SATUAN</th>
				    <?php
				foreach($sql as $row){	  	
				?>
				<tr onMouseOver="this.style.cursor='pointer';">
					<td width="5%" align="center"><?php echo $c=$c+1;?></td>
					<td width="13%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
					<td width="62%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
					<td width="11%" align="center" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');"><?php echo $row['qty']; ?></td>
					<td width="9%" onClick="getDetail('<?php echo $row['idt'];?>','<?php echo $row['id'];?>','<?php echo $row['kode'];?>','<?php echo $row['nama'];?>','<?php echo $row['harga_beli'];?>','<?php echo $row['qty'];?>','<?php echo $row['jumlah'];?>','<?php echo $row['diskon'];?>');">
						<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?>					</td>
				</tr>
				<?php
				}	  
				?>
			</table>
			<?php
			}else{
				echo "<p class='pesan'>Data masih kosong</p>";
			}
			?>
			</div>
				<div style="border-top:1px solid #ccc; margin-top:5px; padding:5px;">
					<input type="button" value="Tutup" onclick="viewHide('<?php echo $id;?>');" style="float:right;">
					<div style="clear:both;"></div>
				</div>
			</div>		
		</div>		
		<?php	
		break;
		case 'viewStokOut':
			$sql=$trxout->getStokOut();
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="5%" align="left" style="padding:7px 0 7px 10px;">KODE</th>
				<th width="41%" align="left" style="padding:7px 0 7px 10px;">NAMA BARANG</th>
				<th width="42%" align="left" style="padding:7px 0 7px 10px;">MEREK</th>
				<th width="4%" align="left" style="padding:7px 0 7px 10px;">STOK</th>
				<th width="8%" align="center" style="padding:7px 0 7px 10px;">SATUAN</th>
					<?php
					foreach($sql as $row){
					?>
				<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="sendData('<?php echo $row['id'];?>');"  onMouseOut="this.style.background='#fff';">
		
						<td width="5%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px;"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
						<td width="41%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px;"><?php echo $row['nama'];?></td>
						<td width="42%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px;"><?php echo $merek->getField('merek',$row['merek']);?></td>
						<td width="4%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px;"><?php echo $row['stok'];?></td>
						<td width="8%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc; padding:7px;"><?php echo $satuan->getField('satuan',$row['satuan']);?></td>
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
