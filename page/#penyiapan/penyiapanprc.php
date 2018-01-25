<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/pengajuan.cls.php";
include "../../class/dtsatuan.cls.php";
include "../../class/user.cls.php";
include "../../class/trxoutput.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$trxout=new Trxoutput();
$pengajuan=new Pengajuan();
$satuan=new Dtsatuan();
$dtbarang=new Dtbarang();
$tbpengajuan='temppengajuan'.$logid;
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	$req=$_POST['req'];
	switch($req){
		case 'getTemp':
			$sql=$pengajuan->getTemp();
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
				<th width="2%">No</th>
				<th width="13%" align="left">Kode</th>
				<th width="22%" align="left">Nama barang </th>
				<th width="9%" align="center">Jumlah</th>
				<th width="9%" align="center">Satuan</th>
				<th width="45%" align="left">Keterangan</th>
				<?php
					foreach($sql as $row){	  	
				?>
			<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="upQty('<?php echo $row['id'];?>');" onMouseOut="this.style.background='#fff';">
				<td width="2%" align="center"><?php echo $c=$c+1;?></td>
				<td width="13%"><?php echo $row['kode']; ?></td>
				<td width="22%"><?php echo $row['nama']; ?></td>
				<td width="9%" align="center"><?php echo $row['qty']; ?></td>
				<td width="9%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']); ?></td>
				<td width="45%" align="left"><?php echo $row['keterangan']; ?></td>
			</tr>
			<?php
			}	  
			?>
		</table>
		<?php
			}else{
				echo "<p class='pesan'>Belum ada barang yang akan dipesan.</p>";
			}
		break;
		case 'cekTemp':
			echo $pengajuan->cekTemp();
		break;
		case 'kirimBarang':
			$id=$_POST['id'];
			$status=$pengajuan->getField('status',$id);
			if($status<'3'){
				$pengajuan->getField('status',$id);
				$tanggal=$_POST['tanggal'];
				$data=array('tanggal'=>tgl_ind_to_eng($tanggal),'status'=>'3','staf'=>$logid);
				$order=$pengajuan->setKirim($id,$data);
				if($order){
					$pemohon=$pengajuan->getField('pemohon',$id);
					$idtrx=kode('dtbarangkeluar',$logid);
					$total=$pengajuan->getTotal($id);
					$data=array('id'=>$id,'id_pengajuan'=>$id,'tanggal'=>tgl_ind_to_eng($tanggal),'id_pegawai'=>$pemohon,'total'=>$total,'id_user'=>$logid);
					$add=$trxout->addData($data);
					if($add){
						$temp=$pengajuan->getItem($id);
						if($temp!=array()){
							foreach($temp as $row){
								$dataitem=array('idt'=>$id,'id'=>$row['id'],'barcode'=>$row['barcode'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
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
				}
			}
		break;
		case 'addData':
			$data=array('idt'=>$_POST['id'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'pemohon'=>$logid,'pejabat'=>$_POST['pejabat']);
			$temp=$pengajuan->getTemp();
			if($temp!=array()){
				$add=$pengajuan->addData($data);
				if($add){
					foreach($temp as $row){
						$item=array('idt'=>$_POST['id'],'id'=>$row['id'],'barcode'=>$row['barcode'],'nama'=>$row['nama'],'harga'=>$row['harga'],'qty'=>$row['qty'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
						$pengajuan->addItem($item);
					}	
					$pengajuan->clearTemp();			
				}
			}
		break;
		case 'getItem':
			$id=$_POST['id'];
			?>
		<div class="pesan-detail"><b></b><span id="close"><a onclick="viewHide('<?php echo $id;?>');">X</a></span>
			<h3>&raquo; Detail Permintaan Barang</h3>
			<div id="conten-detail">
			Tanggal :
			<input type="text" class="tgl" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/>
			<?php
			$sql=$pengajuan->getItem($id);
			if($sql!=array()){
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<th width="3%" align="center" style="padding:7px 0 7px 10px;">No</th>
				<th width="36%" align="left" style="padding:7px 0 7px 10px;">Nama barang </th>
				<th width="6%" align="center" style="padding:7px 0 7px 10px;">Jumlah</th>
				<th width="7%" align="center" style="padding:7px 0 7px 10px;">Satuan</th>
				<th width="39%" align="left" style="padding:7px 0 7px 10px;">Keterangan</th>
				<th width="9%">&nbsp;</th>
				<?php
					foreach($sql as $row){	  	
				?>
			<tr onMouseOver="this.style.cursor='pointer';" onClick="upQty('<?php echo $row['id'];?>');">
				<td width="3%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc; padding:10px 0 0 0;"><?php echo $c=$c+1;?></td>
				<td width="36%" style="vertical-align:top; border-bottom:1px solid #ccc; padding:10px 0 0 0;"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
				<td width="6%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc;">
				<input style="width:20px;" type="text" name="jumlah" id="qty<?php echo $row['idt']; ?><?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" onblur="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');" />
				</td>
				<td width="7%" align="center" style="vertical-align:top; border-bottom:1px solid #ccc;"><?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?></td>
				<td width="39%" align="left" style="vertical-align:top; border-bottom:1px solid #ccc;"><input type="text" name="keterangan" id="keterangan<?php echo $row['idt'];?><?php echo $row['id'];?>" value="<?php echo $row['keterangan']; ?>"/></td>
				<td style="vertical-align:top; border-bottom:1px solid #ccc;">
					<a onclick="editTerima('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');">
						<img src="img/edit.png" style="margin-bottom:-5px;" />
					</a>
					<a onclick="deleteItem('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');">
						<img src="img/hapus.png" style="margin-bottom:-5px;" />
					</a>
				</td>
			</tr>
			<?php
			}	  
			?>
			<tr>
				<td align="right" colspan="6">
				<input type="button" name="terima" id="terima" value="Proses" onclick="kirim('<?php echo $id;?>');" />
				</td>
			</tr>
		</table>
	</div>
	<?php
	$sts=$pengajuan->getField('status',$id);
	if($sts>=3){
	?>
	<h3>&raquo; Form Penerimaan Barang</h3>
	<div id="conten-detail">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="21%">Penerima barang :</td>
				<td width="60%"><input type="text" name="penerima" id="penerima" value="<?php ?>" /></td>
				<td width="19%" align="right"><input type="button" value="Simpan" onclick="setPenerima('<?php echo $id;?>');" />
			</tr>
		</table>
	</div>
	<?php
	}
	?>
		<?php
			}else{
				echo "<p class='pesan'>Belum ada barang yang akan dipesan.</p>";
			}
		break;
		case 'setPenerima':
			$data=array('id'=>$_POST['id'],'penerima'=>$_POST['penerima'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']));
			//print_r($data);
			$pengajuan->setPenerima($data);
		break;
		case 'deleteItem':
			$status=$pengajuan->getField('status',$_POST['idt']);
			if($status=='3'||$status=='4'){
				$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
				$stok=$dtbarang->getField('stok',$_POST['id']);
				$qty=$trxout->getFieldDetail('qty',$data);
				if($pengajuan->deleteItem($data)){
					if($trxout->deleteDetail($data)){
						$newQty=$stok+$qty;
						$dtbarang->stok($_POST['id'],$newQty);
					}
				}
			}else{
				$pengajuan->deleteItem($data);
			}
		break;
		case 'editProses':
			$id=$_POST['id'];
			$prc=mysql_query("update dtpengajuan set status='proses' where id='$id'");
		break;
		case 'editTerima':
			$jumlah=$_POST['qty']*$_POST['harga'];
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'qty'=>$_POST['qty'],'jumlah'=>$jumlah,'keterangan'=>$_POST['keterangan']);
			$pengajuan->updateTerima($data);
		break;
		case 'editStatus':
			$data=array('tgl_terima'=>$date->format('Y-m-d'),'pengesahan'=>$logid,'status'=>'terima','id'=>$_POST['id']);
			$pengajuan->updateStatus($data);
		break;
		case 'clearTempOut':
			$pengajuan->clearTemp($tboutput);
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
			$upqty=$pengajuan->updateQty($id,$data);
			$x=$pengajuan->getTemp();
			viewItemOut($x);
		break;
		case 'addTemp':
			$kode=$_POST['kode'];
			if($kode!=''){
				$id=$dtbarang->getCode('id',$kode);
				$qty=$_POST['qty'];
				$harga=$dtbarang->getCode('harga_beli',$kode);
				$jumlah=$qty*$harga;
				$cekid=$pengajuan->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode('dtbarangkeluar',$logid),'id'=>$dtbarang->getCode('id',$kode),'kode'=>$kode,'nama'=>$dtbarang->getCode('nama',$kode),'harga_beli'=>$harga,'qty'=>$qty,'jumlah'=>$jumlah,'diskon'=>'0','keterangan'=>'');
					$add=$pengajuan->addTemp($data);
					if($add){
						$x=$pengajuan->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$pengajuan->getField('qty',$cekid);
					$qty=$oldQty+$qty;
					$jumlah=$qty*$harga;
					$data=array('qty'=>$qty,'jumlah'=>$jumlah);
					$upqty=$pengajuan->updateQty($cekid,$data);
					$x=$pengajuan->getTemp();
					viewItemOut($x);
				}
			}else{
				$id=$_POST['id'];
				$qty=$_POST['qty'];
				$harga=$dtbarang->getField('harga_beli',$id);
				$jumlah=$qty*$harga;
				$cekid=$pengajuan->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode_trx('dtpengajuan',$logid.'02',$logid),'id'=>$id,'kode'=>$dtbarang->getField('barcode',$id),'nama'=>$dtbarang->getField('nama',$id),'harga'=>$harga,'qty'=>$qty,'jumlah'=>$jumlah,'diskon'=>'0','keterangan'=>'');
					$add=$pengajuan->addTemp($data);
					if($add){
						$x=$pengajuan->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$pengajuan->getField('qty',$id);
					$qty=$oldQty+$qty;
					$harga=$dtbarang->getField('harga_beli',$id);
					$jumlah=$qty*$harga;
					$data=array('qty'=>$qty,'jumlah'=>$jumlah);
					$upqty=$pengajuan->updateQty($id,$data);
					$x=$pengajuan->getTemp();
					viewItemOut($x);
				}
			}
		break;
		case 'addOut':
			$id=$_POST['id'];
			$idreq=$_POST['pegawai'];
			$pemohon=substr($idreq,0,3);
			$data=array('id'=>$id,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'id_pegawai'=>$pemohon,'total'=>$_POST['total'],'id_user'=>$logid);
			$add=$pengajuan->addData($data);
			if($add){
				$temp=$pengajuan->getTemp();
				if($temp!=array()){
					foreach($temp as $row){
						$dataitem=array('idt'=>$row['idt'],'id'=>$row['id'],'kode'=>$row['kode'],'qty'=>$row['qty'],'keterangan'=>$row['keterangan']);
						$item=$pengajuan->addItem($dataitem);
						if($item){
							$oldstok=$dtbarang->getField('stok',$row['id']);
							$newstok=$oldstok-$row['qty'];
							$upstok=$dtbarang->stok($row['id'],$newstok);
						}
					}
					if($item){
						$permohonan->updateStatus($idreq,'kirim');
						$barangkeluar->clearTemp('tempoutput'.$logid);
					}
				}else{
					echo "<p class='pesan'>Data Pesanan masih kosong.</p>";
				}
			}
		break;
		case 'caridataOut':
			$key=$_POST['key'];
			if($key!=''){
				$x=$pengajuan->getSrc('nama',$key);
				cariBarang($x);
			}
		break;
		case 'clearTemp':
		$pengajuan->clearTemp();
		break;
	}
}
?>
