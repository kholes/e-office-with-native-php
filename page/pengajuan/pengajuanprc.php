<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/dtsatuan.cls.php";
include "../../class/pengajuan.cls.php";
include "../../class/user.cls.php";
include "../../class/dtbarangkeluar.cls.php";
include "../../class/dtbarangmasuk.cls.php";

$db=new Db();
$db->conDb();
$user=new User();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$level=$user->getField('level',$logid);

$pengajuan=new Pengajuan();
$barangkeluar=new Dtbarangkeluar();
$barangmasuk=new Dtbarangmasuk();
$dtbarang=new Dtbarang();
$satuan=new Dtsatuan();
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
					<td width="3%" align="center" style="vertical-align:middle;"><?php echo $c=$c+1;?></td>
					<td width="9%" style="vertical-align:middle;"><?php if($row['barcode']!=''){echo $row['barcode'];}else{echo $row['id'];};?></td>
					<td width="38%" style="vertical-align:middle;"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
					<td width="6%" style="vertical-align:middle;" align="center" onmouseover="this.style.cursor='pointer';" onClick="upQty('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><?php echo $row['qty']; ?></td>
					<td width="6%" style="vertical-align:middle;" align="center"><?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?></td>
					<td width="44%" align="left"><?php echo $row['keterangan']; ?></td>
					<td style="vertical-align:middle;"><a  onclick="delTemp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><img src="img/hapus.png" /></a></td>
				</tr>
				<?php
				}	  
				?>
			</table>
			<?php
				}
		break;
		case 'cekTemp':
			echo $pengajuan->cekTemp();
		break;
		case 'addData':
			$data=array('idt'=>$_POST['id'],'pemohon'=>$logid,'tgl_pengajuan'=>tgl_ind_to_eng($_POST['tanggal']),'tgl_diterima'=>'','tgl_disetujui'=>'','tgl_pengiriman'=>'','tgl_penyerahan'=>'','penerima'=>'','status'=>'0','staf'=>'');
			$temp=$pengajuan->getTemp();
			if($temp!=array()){
				$add=$pengajuan->addData($data);
				if($add){
					foreach($temp as $row){
						$item=array('idt'=>$_POST['id'],'id'=>$row['id'],'barcode'=>$row['barcode'],'nama'=>$row['nama'],'satuan'=>$row['satuan'],'harga'=>$row['harga'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
						$pengajuan->addItem($item);
					}	
					$pengajuan->clearTemp();
				}
			}
		break;
		case 'getItem':
			$id=$_POST['id'];
			?>
			<div class="pesan-detail">
			<div id="conten-detail">
				<div style=" display:block; min-height:20px; padding:2px 5px;background:#ccc; margin:5px;">			
				<table cellpadding="0" cellspacing="0" width="99%">
					<tr>
						<td width="8%" style="background:#ccc">Tanggal</td>
						<td width="24%" style="background:#ccc">
							<input type="text" class="tgl" name="tanggal" id="tanggal<?php echo $id;?>" value="<?php echo tgl_eng_to_ind($pengajuan->getField('tgl_pengajuan',$id)); ?>"  onclick="return showCalendar('tanggal<?php echo $id;?>', 'dd-mm-y')" style="width:200px;"/>
					  	</td>
						<td width="18%" style="background:#ccc">&nbsp;</td>
					<?php
					$sts=$pengajuan->getField('status',$id);
					if($sts>=3){
					?>
						<td width="19%" style="background:#ccc">Penerima barang</td>
						<td width="24%" style="background:#ccc">
						<input type="text" name="penerima" id="penerima" value="<?php ?>" style="width:200px;" />
					  </td>
						<td width="7%" style="background:#ccc">
						<input type="button" onclick="setPenerima('<?php echo $id;?>');" value="Simpan" />
					  </td>
					<?php
					}
					?>
					</tr>
				</table>
				</div>
				<table width="99%" border="0" cellspacing="0" cellpadding="0" class="table" style="margin:auto">
					<th width="4%" align="center">No</th>
					<th width="42%" align="left">Nama barang </th>
					<th width="6%" align="center">Jumlah</th>
					<th width="5%" align="center">Stok</th>
					<th width="6%" align="center">Satuan</th>
					<th width="9%" align="center">Permintaan</th>
					<th width="20%" align="left">Keterangan</th>
					<th width="8%">&nbsp;</th>
				<?php
				$sql=$pengajuan->getItem($id);
				if($sql!=array()){
					foreach($sql as $row){
						switch($level){
							case 'STB':$val_btn='Proses';
								?>
								<tr>
									<td width="4%" align="center"><?php echo $c=$c+1;?></td>
									<td width="42%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
									<td width="6%" align="center">
									<input style="width:20px;" type="text" name="jumlah" id="qty<?php echo $row['idt']; ?><?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" onblur="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');" />									</td>
									<td width="5%" align="center">
									<?php 
										$x=$barangmasuk->get_total_trx($row['id']);
										$y=$barangkeluar->get_total_trx($row['id']);
										echo $sisa_stok=$x-$y;
										?>
									</td>
									<td width="6%" align="center"><?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id'])); ?></td>
									<td width="9%" align="center">
										<?php  
										$jumlah_pengajuan=$pengajuan->getQtyPengajuan($row['id'])-$row['qty'];
										if($jumlah_pengajuan>0){echo $jumlah_pengajuan;}else{echo '0';}
										?>
									</td>
									<td width="20%" align="left"><input type="text" name="keterangan2" id="keterangan" value="<?php echo $row['keterangan']; ?>"/></td>
									<td>
										<a onclick="editTerima('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');">
											<img src="img/edit.png" style="margin-bottom:-5px;" />										</a>
										<a onclick="deleteItem('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');">
											<img src="img/hapus.png" style="margin-bottom:-5px;" />										</a>									</td>
								</tr>
							<?php
							break;
							case 'KKR':$val_btn='Setuju';
								?>
								<tr>
									<td width="4%" align="center"><?php echo $c=$c+1;?></td>
									<td width="42%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
									<td width="6%" align="center">
									<input style="width:20px;" type="text" name="jumlah" id="qty<?php echo $row['idt']; ?><?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" onblur="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');" />								  	</td>
									<td width="5%" align="center">
									<?php echo $dtbarang->getField('stok',$row['id']);?>									</td>
									<td width="6%" align="center">
										<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id']));?>				</td>
									<td width="9%" align="center">
										<?php 
											$pengajuan->getQtyPengajuan($row['id'])-$row['qty'];
										?>									</td>
									<td width="20%" align="left">
									<input type="text" name="keterangan" id="keterangan<?php echo $row['idt'];?><?php echo $row['id'];?>" value="<?php echo $row['keterangan']; ?>"/>								  	</td>
									<td>
										<a onclick="editTerima('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>','<?php echo $row['harga'];?>');"><img src="img/edit.png" style="margin-bottom:-5px;" /></a>									</td>
								</tr>
							<?php
							break;
							case 'KTU':
								$val_btn='Terima';
								?>
								<tr>
									<td width="4%" align="center"><?php echo $c=$c+1;?></td>
									<td width="42%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
									<td width="6%" align="center">
									<input style="width:20px;" type="text" name="jumlah" id="qty<?php echo $row['idt']; ?><?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" onblur="editQty('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>');" />								  	</td>
									<td width="5%" align="center">
									<?php echo $dtbarang->getField('stok',$row['id']);?>									</td>
									<td width="6%" align="center">
										<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id']));?>				</td>
									<td width="9%" align="center">
										<?php echo $pengajuan->getQtyPengajuan($row['id'])-$row['qty'];?>									</td>
									<td width="20%" align="left">
									<input type="text" name="keterangan" id="keterangan<?php echo $row['idt'];?><?php echo $row['id'];?>" value="<?php echo $row['keterangan']; ?>"/>								  	</td>
									<td>
										<a onclick="editTerima('<?php echo $row['idt']; ?>','<?php echo $row['id'];?>','<?php echo $row['harga'];?>');"><img src="img/edit.png" style="margin-bottom:-5px;" /></a>									</td>
								</tr>
							<?php
							break;
							case 'KSI':
							?>
								<tr onClick="upQty('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
									<td width="4%" align="center"><?php echo $c=$c+1;?></td>
									<td width="42%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
									<td width="6%" align="center"><?php echo $row['qty']; ?></td>
									<td width="5%" align="center">
									<?php echo $dtbarang->getField('stok',$row['id']);?>									</td>
									<td width="6%" align="center">
										<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id']));?>									</td>
									<td width="9%" align="center">
										<?php echo $pengajuan->getQtyPengajuan($row['id'])-$row['qty'];?>									</td>
									<td width="20%" align="left"><?php echo $row['keterangan']; ?></td>
									<td>&nbsp;</td>
								</tr>
							<?php
							break;
							case 'STF':
							?>
								<tr onClick="upQty('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
									<td width="4%" align="center"><?php echo $c=$c+1;?></td>
									<td width="42%"><?php echo $dtbarang->getField('nama',$row['id']); ?></td>
									<td width="6%" align="center"><?php echo $row['qty']; ?></td>
									<td width="5%" align="center">
									<?php echo $dtbarang->getField('stok',$row['id']);?>									</td>
									<td width="6%" align="center">
										<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$row['id']));?>									</td>
									<td width="9%" align="center">
										<?php echo $pengajuan->getQtyPengajuan($row['id'])-$row['qty'];?>									</td>
									<td width="20%" align="left"><?php echo $row['keterangan']; ?></td>
									<td>&nbsp;</td>
								</tr>
							<?php
							break;
						}
					}	  	
				}
				?>
				</table>
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
				
				</div>
			</div>
		</div>	
		<?php
		break;
		case 'setPenerima':
			$data=array('id'=>$_POST['id'],'penerima'=>$_POST['penerima'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']));
			//print_r($data);
			$pengajuan->setPenerima($data);
		break;
		case 'editTerima':
			$jumlah=$_POST['qty']*$_POST['harga'];
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'qty'=>$_POST['qty'],'jumlah'=>$jumlah,'keterangan'=>$_POST['keterangan']);
			$pengajuan->updateTerima($data);
		break;
		case 'setTolak':
			$id=$_POST['id'];
			$pengajuan->setTolak($id);
		break;
		case 'setStatus':
			$data=array('id'=>$_POST['id'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'status'=>$_POST['set_sts']);
			$pengajuan->setStatus($data);
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
		case 'kirimBarang':
			$id=$_POST['id'];
			$status=$pengajuan->getField('status',$id);
			if($status < 3){
				$pengajuan->getField('status',$id);
				$tanggal=$_POST['tanggal'];
				$data=array('tanggal'=>tgl_ind_to_eng($tanggal),'status'=>'3','staf'=>$logid);
				$order=$pengajuan->setKirim($id,$data);
				if($order){
					$pemohon=$pengajuan->getField('pemohon',$id);
					$idtrx=kode('dtbarangkeluar',$logid);
					$total=$pengajuan->getTotal($id);
					$data=array('id'=>$id,'id_pengajuan'=>$id,'tanggal'=>tgl_ind_to_eng($tanggal),'pemohon'=>$pemohon,'total'=>$total,'id_user'=>$logid);
					$add=$barangkeluar->addData($data);
					if($add){
						$temp=$pengajuan->getItem($id);
						if($temp!=array()){
							foreach($temp as $row){
								$dataitem=array('idt'=>$id,'id'=>$row['id'],'barcode'=>$row['barcode'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
								$item=$barangkeluar->addItem($dataitem);
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
		case 'delTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id']);
			$pengajuan->deleteTemp($data);
		break;
		case 'updateQtyItem':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'qty'=>$_POST['qty']);
			$pengajuan->updateQtyItem($data);
		break;
		case 'updateQtyTemp':
			$data=array('idt'=>$_POST['idt'],'id'=>$_POST['id'],'qty'=>$_POST['qty']);
			$pengajuan->updateQtyTemp($data);
		break;
		case 'addTemp':
			$kode=$_POST['kode'];
			if($kode!=''){
				$id=kode_trx('dtpengajuan',$logid);
				$qty=$_POST['qty'];
				$cekid=$pengajuan->getFieldTemp('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode_trx('dtbarangkeluar',$logid),'id'=>$dtbarang->getCode('id',$kode),'kode'=>$kode,'qty'=>$qty,'keterangan'=>'');
					$add=$pengajuan->addTemp($data);
					if($add){
						$x=$pengajuan->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$pengajuan->getField('qty',$cekid);
					$qty=$oldQty+$qty;
					$upqty=$pengajuan->updateQty($cekid,$data);
					$x=$pengajuan->getTemp();
					viewItemOut($x);
				}
			}else{
				$id=$_POST['id'];
				$qty=$_POST['qty'];
				$cekid=$pengajuan->getFieldTemp('id',$id);
				if($cekid!=$id){
					$data=array('idt'=>kode_trx('dtpengajuan',$logid),'id'=>$id,'kode'=>$dtbarang->getField('barcode',$id),'qty'=>$qty,'keterangan'=>'');
					$add=$pengajuan->addTemp($data);
					if($add){
						$x=$pengajuan->getTemp();
						viewItemOut($x);
					}
				}else{
					$oldQty=$pengajuan->getFieldTemp('qty',$id);
					$qty=$oldQty+$qty;
					$data=array('id'=>$id,'qty'=>$qty);
					$upqty=$pengajuan->updateQty($data);
					//$x=$pengajuan->getTemp();
					//viewItemOut($x);
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
						$dataitem=array('idt'=>$row['idt'],'id'=>$row['id'],'kode'=>$row['kode'],'qty'=>$row['qty'],'jumlah'=>$row['jumlah'],'diskon'=>$row['diskon'],'keterangan'=>$row['keterangan']);
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
