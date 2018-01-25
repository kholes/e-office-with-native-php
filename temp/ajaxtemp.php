<?php
session_start();
include "lib/lib.php";
include "class/dtbarang.cls.php";
include "class/trxinput.cls.php";
include "class/trxoutput.cls.php";
include "class/barangkeluar.cls.php";
include "class/permohonan.cls.php";
include "class/Asettetaphis.cls.php";
include "class/user.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$trx=new Trxinput();
$trxout=new Trxoutput();
$dtbarang=new Dtbarang();
$barangkeluar=new Barangkeluar();
$permohonan=new Permohonan();
$asettrx=new Asettetaphis();
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
				$x=$trx->getSrc('nama',$key);
				cariBarang($x);
			}
		break;
		case 'caridataOut':
			$key=$_POST['key'];
			if($key!=''){
				$x=$trxout->getSrc('nama',$key);
				cariBarang($x);
			}
		break;
		case 'viewdata':
			$x=$trxout->getAll();
			cariBarang($x);
		break;
		case 'viewStokOut':
			$x=$trxout->getStokOut();
			cariBarang($x);
		break;
		case 'cekStokOut':
			$kode=$_POST['kode'];
			$id=$dtbarang->getCode('id',$kode);
			if($id!=''){
				echo $x=$dtbarang->getCode('stok',$kode);
			}	
		break;
		case 'clearTemp':
			$trx->clearTemp($tbinput);
		break;
		case 'clearTempOut':
			$trxout->clearTemp($tboutput);
		break;
		case 'editQty':
			$data=array('id'=>$_POST['id'],'idt'=>$_POST['idt'],'qty'=>$_POST['qty'],'ket'=>$_POST['ket']);
			$permohonan->editQty($data);			
		break;
		case 'editQtyOut':
			$data=array('id'=>$_POST['id'],'idt'=>$_POST['idt'],'qty'=>$_POST['qty'],'ket'=>$_POST['ket']);
			$edit=$barangkeluar->editQty($data);
			if($edit){
				$x=$barangkeluar->getTemp();
				viewTempKeluar($x);
			}
		break;
		case 'delTempOut':
			$id=$_POST['id'];
			$del=$barangkeluar->delTempOut($id);
			$x=$barangkeluar->getTemp();
			viewTempKeluar($x);
		break;
		case 'addOut':
			$id=$_POST['id'];
			$idreq=$_POST['pemohon'];
			$pemohon=substr($idreq,0,3);
			$data=array('id'=>$id,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'id_pegawai'=>$pemohon,'id_user'=>$logid);
			$add=$trxout->addData($data);
			if($add){
				$temp=$trxout->getTemp();
				if($temp!=array()){
					foreach($temp as $row){
						$dataitem=array('idt'=>$row['idt'],'id'=>$row['id'],'kode'=>$row['kode'],'nama'=>$row['nama'],'harga'=>$row['harga'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
						$item=$trxout->addItem($dataitem);
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
		case 'getOrder':
			$sql=$permohonan->getReq('pesan',$logid);
			viewOrder($sql);
		break;
		case 'getOrderProses':
			$sts=$_POST['status'];
			$sql=$permohonan->getReq('all',$logid);
			viewOrderProses($sts,$sql);
		break;
		case 'prcOrder':
			$req=$permohonan->getReq('terima',$logid);
			viewPrcOrder($req);
		break;
		case 'prcOrderPrc':
			$req=$permohonan->getReq('proses',$logid);
			viewPrcOrder($req);
		break;
		case 'prcOrderKrm':
			$req=$permohonan->getReq('kirim',$logid);
			viewPrcOrderKrm($req);
		break;
		case 'getStok':
			$req=$permohonan->getStok();
			viewStok($req);
		break;
		case 'approveOreder':
			$id=$_POST['id'];
			$userid=$_POST['user'];
			$sts=$_POST['sts'];
			$tgl=$date->format('Y-m-d');		
			switch($sts){
				case 'terima':
					$data=array('tgl_terima'=>$tgl,'pengesahan'=>$userid,'status'=>'terima');
					$permohonan->updateApprove($id,$data);
				break;
				case 'proses':
					$data=array('tgl_terima'=>$tgl,'pengesahan'=>$userid,'status'=>'proses');
					$permohonan->updateApprove($id,$data);
				break;
				case 'kirim':
					$data=array('tgl_kirim'=>$tgl,'status'=>'kirim','staf'=>$logid);
					$kirim=$permohonan->updateOrder($id,$data);
					if($kirim){
						$x=$permohonan->getDetail($id);
						foreach($x as $z){
							$idb=$z['id'];
							$val=$z['stok']-$z['jum_pengajuan'];
							$permohonan->updateStok($idb,$val);
						}
					}
				break;
			}
		break;
		case 'getKode':
			echo $_POST['src'];
			$id=$_POST['id'];
			if(!isset($id)){
				$kode=$_POST['kode'];
				$id=$dtbarang->getCode('id',$kode);
			}
			$sql = mysql_query("select id,barcode,nama,harga_beli,harga_jual from dtbarang where id='$id'");
			$nmr=mysql_num_rows($sql);
			if($nmr!=0){
				while ($row = mysql_fetch_row($sql))
				echo json_encode($row);
			}
		break;
		case 'getPenerima':
			$kode=$_POST['kode'];
			$kd=substr($kode,-3);
			$sql = mysql_query("select id,nama from pegawai where id='$kd'");
			$nmr=mysql_num_rows($sql);
			if($nmr!=0){
				while ($row = mysql_fetch_row($sql))
				echo json_encode($row);
			}		
		break;
		case 'terimaBarang':
			$id=$_POST['id'];
			$penerima=$_POST['penerima'];
			$sql = mysql_query("update dtreqaset set penerima='$penerima' where id='$id'");
		break;
		case 'getItem':
			$id=$_POST['id'];
			$x=$permohonan->getDetail($id);
			viewDetailReq($x,$id);
		break;
		case 'updateStatus':
			$id=$_POST['id'];
			$permohonan->updateStatus($id,'proses');
		break;
		case 'addItemReq':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga'=>$_POST['harga'],'qty'=>$_POST['qty']);
			$cekid=$trxreq->getField('id',$_POST['id']);
			if($cekid!=$_POST['id']){
				$add=$trxreq->addTemp($data);
				if($add){
					$x=$trxreq->getTemp();
					viewItemReq($x);
				}
			}else{
				$oldQty=$trxreq->getField('qty',$cekid);
				$qty=$oldQty+$_POST['qty'];
				$data=array('qty'=>$qty);
				$upqty=$trxreq->updateQty($cekid,$data);
				$x=$trxreq->getTemp();
				viewItemReq($x);
			}
		break;
		case 'getTempIn':
			$x=$trx->getTemp();
			viewItem($x);
		break;
		case 'getTempOut':
			$x=$trxout->getTemp();
			viewItemOut($x);
		break;
		case 'getDetailIn':
			$idt=$_POST['idt'];
			$x=$trx->getDetail($idt);
			viewItem($x);
		break;
		case 'editItemReq':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga'=>$_POST['harga'],'qty'=>$_POST['qty']);
			$edit=$trxreq->editTemp($data);
			if($edit){
				$x=$trxreq->getTemp();
				viewItemReq($x);
			}
		break;
		case 'deletItemReq':
			$data=array('id'=>$_POST['id']);
			$delet=$trxreq->deletTemp($data);
			if($delet){
				$x=$trxreq->getTemp();
				viewItemReq($x);
			}		
		break;
		case 'getHistory':
			$id_aset=$_POST['id_aset'];
			$sql=$asettrx->getWhere('id_aset',$id_aset);
			viewHistory($sql);
		break;
		case 'trxHead':
			$temp=$trx->getTemp();
			if($temp!=array()){
				$suplayer=substr($_POST['suplayer'],0,3);
				$data=array('id'=>$_POST['id'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'nota'=>$_POST['nota'],'suplayer'=>$suplayer,'diskon'=>$_POST['diskon'],'total'=>$_POST['total']);
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
				}
				return true;
			}else{
				echo "Data barang masih kosong";
				return false;
			}
		break;
		case 'addItemUpd':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$idt=$_POST['idt'];
			$id=$_POST['id'];
			$cql=mysql_query("select id,qty from dtbarangmasukitem where id='$id' and idt='$idt'");
			$rql=mysql_fetch_row($cql);
			$cekid=$rql[0];
			if($cekid!=$_POST['id']){
				$add=$trx->addItem($data);
				if($add){
					$oldstok=$dtbarang->getField('stok',$data['id']);
					$newstok=$oldstok+$data['qty'];
					$dtstok=array('harga_beli'=>$data['harga_beli'],'stok'=>$newstok);
					$dtbarang->updateStok($data['id'],$dtstok);
				}
			}else{
				$oldQty=$rql[1];
				$qty=$oldQty+$_POST['qty'];
				$sql=mysql_query("update dtbarangmasukitem set qty='$qty' where id='$id' and idt='$idt'");
			}
		break;
		case 'addItemIn':
			$data=array('idt'=>'','id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$cekid=$trx->getField('id',$_POST['id']);
			if($cekid!=$_POST['id']){
				$add=$trx->addTemp($data);
				if($add){
					$x=$trx->getTemp();
					viewItem($x);
				}
			}else{
				$oldQty=$trx->getField('qty',$cekid);
				$qty=$oldQty+$_POST['qty'];
				$data=array('qty'=>$qty);
				$upqty=$trx->updateQty($cekid,$data);
				$x=$trx->getTemp();
				viewItem($x);

			}
		break;
		case 'addItemOut':
			$kode=$_POST['kode'];
			if($kode!=''){
				$id=$dtbarang->getCode('id',$kode);
				$qty=$_POST['qty'];
				$harga=$dtbarang->getCode('harga_beli',$kode);
				$jumlah=$qty*$harga;
				$cekid=$trxout->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode('dtbarangkeluar',$logid),'id'=>$dtbarang->getCode('id',$kode),'kode'=>$kode,'nama'=>$dtbarang->getCode('nama',$kode),'harga_beli'=>$harga,'qty'=>$qty,'jumlah'=>$jumlah,'diskon'=>'0','keterangan'=>'');
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
				$harga=$dtbarang->getField('harga_beli',$id);
				$jumlah=$qty*$harga;
				$cekid=$trxout->getField('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode('dtbarangkeluar',$logid),'id'=>$id,'kode'=>$dtbarang->getField('barcode',$id),'nama'=>$dtbarang->getField('nama',$id),'harga_beli'=>$harga,'qty'=>$qty,'jumlah'=>$jumlah,'diskon'=>'0','keterangan'=>'');
					$add=$trxout->addTemp($data);
					if($add){
						$x=$trxout->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$trxout->getField('qty',$id);
					$qty=$oldQty+$qty;
					$harga=$dtbarang->getField('harga_beli',$id);
					$jumlah=$qty*$harga;
					$data=array('qty'=>$qty,'jumlah'=>$jumlah);
					$upqty=$trxout->updateQty($id,$data);
					$x=$trxout->getTemp();
					viewItemOut($x);
				}
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
		case 'addTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'kode'=>$_POST['kode'],'nama'=>$_POST['nama'],'harga'=>$_POST['harga'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon'],'keterangan'=>$_POST['keterangan']);		
			$cekid=$barangkeluar->getField('id',$_POST['id']);
			if($cekid!=$_POST['id']){
				$add=$barangkeluar->addTemp($data);
			}
			$x=$barangkeluar->getTemp();
			viewTempKeluar($x);
		break;
		case 'editItemIn':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$trx->updateTemp($data);		
		break;
		case 'updateTrx':
			$suplayer=substr($_POST['suplayer'],0,3);
			$data=array('id'=>$_POST['id'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'nota'=>$_POST['nota'],'suplayer'=>$suplayer,'total'=>$_POST['total'],'diskon'=>$_POST['diskon']);
			$trx->updateData($_POST['id'],$data);		
		break;
		case 'editItemUpd':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'harga_beli'=>$_POST['harga_beli'],'qty'=>$_POST['qty'],'jumlah'=>$_POST['jumlah'],'diskon'=>$_POST['diskon']);
			$oldQty=$trx->getFieldDetail('qty',$data);
			$oldStok=$dtbarang->getField('stok',$_POST['id']);
			$stok=$oldStok-$oldQty;
			$newStok=$stok+$_POST['qty'];
			$updata=array('harga_beli'=>$_POST['harga_beli'],'stok'=>$newStok);
			$dtbarang->updateStok($_POST['id'],$updata);
			$upd=$trx->updateDetail($data);
			$newTotal=$trx->getTotal($_POST['idt']);
			$newDiskon=$trx->getDiskon($_POST['idt']);
			$dtcount=array('diskon'=>$newDiskon,'total'=>$newTotal);
			$trx->updateHeadCount($_POST['idt'],$dtcount);
		break;
		case 'hapusItemIn':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
			$trx->deleteTemp($data);		
		break;
		case 'hapusItemUpd':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
			$del=$trx->deleteDetail($data);
			
			$oldstok=$dtbarang->getField('stok',$_POST['id']);
			$newstok=$oldstok-$_POST['qty'];
			if($del){
				$dtbarang->stok($_POST['id'],$newstok);
			}	
		break;
		case 'getHead':
			$id=$_POST['id'];
			$sql=$trx->getLike('id',$id);
			viewHead($sql);
		break;
		case 'viewPermohonanTemp':
			$sql=$permohonan->getTemp();
			viewTempPermohonan($sql);
		break;
		case 'addTempPermohonan':
			$id=$_POST['id'];
			$data=array('id'=>$id,'barcode'=>$dtbarang->getField('barcode',$id),'nama'=>$dtbarang->getField('nama',$id));
			$cekid=$permohonan->getRowTemp($id);
			if($cekid==array()){
				$sql=$permohonan->addTemp($data);				
			}
			viewTempPermohonan($sql);
		break;
		case 'upQtyPermohonan':
			$id=$_POST['id'];
			$qty=$_POST['qty'];
			$permohonan->upQtyPermohonan($id,$qty);
			$sql=$permohonan->getTemp();
			viewTempPermohonan($sql);
		break;
		case 'clearTempPermohonan':
			$permohonan->clearTemp();
			$sql=$permohonan->getTemp();
			viewTempPermohonan($sql);
		break;
		case 'sendPermohonan':
			$data=array('idt'=>$_POST['id'],'tgl_permohonan'=>tgl_ind_to_eng($_POST['tgl_permohonan']),'pemohon'=>$logid,'pejabat'=>$_POST['pejabat']);
			$temp=$permohonan->getTemp();
			if($temp!=array()){
				$add=$permohonan->addPermohonan($data);
				if($add){
					foreach($temp as $row){
						$item=array('idt'=>$_POST['id'],'id'=>$row['id'],'barcode'=>$row['barcode'],'nama'=>$row['nama'],'qty'=>$row['qty']);
						$permohonan->addPermohonanItem($item);
					}				
				}
			}
		break;
		case 'viewPermohonanData':
			$s=$_POST['s'];
			$sql=$permohonan->getPermohonanData($logid,$s);
			viewDataPermohonan($sql);
		break;
		case 'viewOrderData':
			$idt=$_POST['idt'];
			$sql=$permohonan->getOrderDetail($idt);
			viewDetailPermohonan($sql);
		break;
		case 'getItemPermohonan':
			$id=$_POST['id'];
			$sql=$permohonan->getItem($id);
			viewItemPermohonan($sql,$id);
		break;
		case 'getDetailSurat':
			$id=$_POST['id'];
			detail($id);
		break;
		case 'getItemOut':
			$idt=$_POST['idt'];
			$barcode=$_POST['barcode'];
			$id=$dtbarang->getCode('id',$barcode);
			
		break;	
		case 'viewDetailKirim':
			$idt=$_POST['idt'];
			$sql=$barangkeluar->getTemp($idt);
			viewTempKeluar($sql);
			//viewDetailKirim();
		break;
		case 'saveDisposisi':
			include "class/surat.cls.php";
			$sr=new Surat();
			$data=array('id'=>$_POST['id'],'pejabat_dis'=>$logid,'disposisi'=>$_POST['dis'],'tanggal'=>$date->format('Y-m-d'),'catatan'=>$_POST['catatan'],'bataswaktu'=>tgl_ind_to_eng($_POST['bataswaktu']),'status'=>'dis');
			$sr->disposisi($data);
		break;
	}
}

$toko=$_GET['cari'];
if (isset($toko)){
	$sql=mysql_query("SELECT id,nama FROM dttoko WHERE nama LIKE '%$toko%' ORDER BY id");
	if($sql){
		while($row=mysql_fetch_row($sql)){
			echo $row[0].".".$row[1]."\n";
		}
	}
}
?>
