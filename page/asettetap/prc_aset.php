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
	//------------------------------Proses umunm----------------------------//
	case 'get_id':
		$kategori=$_POST['kategori'];
		echo kdauto('dtperawatan',$kategori);
	break;
	case 'get_kib':
		switch($_POST['kib']){
			case 'KIBA':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibc->getField('nama',$_POST['id']).'</option>';
						$x=$dtkiba->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkiba->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
			case 'KIBB':
				if(isset($_POST['id'])){
				?>
				<select name="id_barang" id="id_barang">
					<?php 
					echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibb->getField('nama',$_POST['id']).'&nbsp;'.$dtkibb->getField('merek',$_POST['id']).'</option>';
					$x=$dtkibb->getAll();
					foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['merek'].'</option>';
					}
					?>
				</select>
				<?php		
				}else{
				?>
				<select name="id_barang" id="id_barang">
					<option value="all" selected="selected">--- SEMUA ASET ---</option>
					<?php 
					$x=$dtkibb->getAll();
					foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['merek'].'</option>';
					}
				?>
				</select>
				<?php		
				}
			break;
			case 'KIBC':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibc->getField('nama',$_POST['id']).'</option>';
						$x=$dtkibc->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkibc->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
			case 'KIBE':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibe->getField('nama',$_POST['id']).'&nbsp;'.$dtkibe->getField('judul',$_POST['id']).'</option>';
						$x=$dtkibe->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['judul'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkibe->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['judul'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
		}
	break;
	//------------------------------Proses perawatan----------------------------//
	case 'insert':
		$id=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$id,'tanggal'=>tgl_ind_to_eng($_POST['tgl']),'kategori'=>$_POST['kategori'],'pelaksana'=>substr($_POST['pelaksana'],0,3),'stafaset'=>$logid);
		$add=$perawatan->insert($data);
		if($add){
			$temp=$perawatan->get_all_temp();
			foreach($temp as $row){
				$item=array('id'=>$row['id'],'idt'=>$id,'tanggal'=>$row['tanggal'],'jenis'=>$row['jenis'],'sparepart'=>$row['sparepart'],'harga'=>$row['harga'],'status'=>$row['status'],'keterangan'=>$row['keterangan']);
				$addItem=$perawatan->insert_item($item);
			}		
			if($addItem){
				$perawatan->clearTemp();
			}
		}
	break;
	case 'update':
		$data=array('id'=>$_POST['id'],'tgl'=>tgl_ind_to_eng($_POST['tgl']),'kategori'=>$_POST['kategori'],'pelaksana'=>substr($_POST['pelaksana'],0,3));
		$perawatan->update($data);
	break;
	case 'delete':
		$perawatan->delete($_POST['idt']);
	break;
	//------------------------------Proses item----------------------------//
	case 'insert_item':
		$data=array('id'=>$_POST['id'],'idt'=>$_POST['idt'],'jenis'=>$_POST['jenis'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'sparepart'=>$_POST['sparepart'],'status'=>$_POST['status']);
		if($perawatan->insert_item($data)){
			return true;
		}
		return false;
	break;
	case 'update_item':
		$data=array('id'=>$_POST['id'],'idt'=>$_POST['idt'],'jenis'=>$_POST['jenis'],'harga'=>$_POST['harga'],'keterangan'=>$_POST['keterangan'],'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'sparepart'=>$_POST['sparepart'],'status'=>$_POST['status']);
		if($perawatan->update_item($data)){
			return true;
		}
		return false;
	break;
	case 'delete_item':
		$perawatan->delete_item($_POST['idt'],$_POST['id']);
	break;
	case 'get_item':
		$idt=$_POST['idt'];
		$id=$_POST['id'];
		$x=$perawatan->get_item($idt,$id);
		foreach($x as $data)
		$row=array('0'=>$data['id'],'1'=>$data['jenis'],'2'=>$data['harga'],'3'=>$data['keterangan'],'4'=>tgl_eng_to_ind($data['tanggal']),'5'=>$data['sparepart'],'6'=>$data['status']);
		echo json_encode($row);
	break;
	//------------------------------End Item----------------------------//
	//------------------------------Proses temp----------------------------//
	case 'insert_temp':
		$idt=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$_POST['id'],'idt'=>$idt,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
		$perawatan->insert_temp($data);
		//$cekTemp=$perawatan->getTemp($idt,$_POST['id']);
		//if(!$cekTemp){
		//}
	break;
	case 'update_temp':
		$idt=kdauto('dtperawatan',$_POST['kategori']);
		$data=array('id'=>$_POST['id'],'idt'=>$idt,'tanggal'=>tgl_ind_to_eng($_POST['tanggal']),'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
		$perawatan->update_temp($data);
	break;
	case 'delete_temp':
		$idt=$_POST['idt'];
		$id=$_POST['id'];
		$perawatan->delete_temp($idt,$id);
	break;
	case 'get_temp':
		$idt=$_POST['idt'];
		$id=$_POST['id'];
		$x=$perawatan->get_temp($idt,$id);
		foreach($x as $data)
		$row=array('0'=>$data['id'],'1'=>$data['jenis'],'2'=>$data['harga'],'3'=>$data['keterangan'],'4'=>tgl_eng_to_ind($data['tanggal']),'5'=>$data['sparepart'],'6'=>$data['status']);
		echo json_encode($row);
	break;
	case 'get_all_temp':
		switch($_POST['act']){
			case 'temp':
				$data=$perawatan->get_all_temp();
			break;
			case 'item':
				$data=$perawatan->get_all_temp($_POST['idt']);
			break;
		}
		if($data!=array()){
		?>
		<div style="height:150px; overflow:auto">
		<table cellpadding="0" cellspacing="0" width="100%" class="table">
			<th width="9%" align="left">ID.ASET</th>
			<th width="14%" align="left">TANGGAL</th>
			<th width="8%" align="left">JENIS</th>
			<th width="16%" align="left">SPAREPART</th>
			<th width="10%" align="right">HARGA</th>
			<th width="10%" align="center">STATUS</th>
			<th width="25%" align="left">KETERANGAN</th>
			<th width="8%" align="left">&nbsp;</th>
			<?php
			foreach($data as $row){
			?>
			<tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo getTanggal($row['tanggal']);?></td>
				<td><?php echo $row['jenis'];?></td>
				<td><?php echo $row['sparepart'];?></td>
				<td align="right"><?php echo format_angka($row['harga']);?></td>
				<td align="center"><?php echo get_status($row['status']);?></td>
				<td><?php echo $row['keterangan'];?></td>
				<td style="vertical-align:middle" align="right">
					<a onclick="get_temp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
						<img src="img/edit.png" />
					</a>
					<a onclick="delete_temp('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');">
						<img src="img/hapus.png" />
					</a>
				</td>
			</tr>
			<?php }?>
		</table>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" class="table">
			<th style="text-align:left">T O T A L</th>
			<th style="text-align:right"><?php echo format_angka($perawatan->get_total_temp());?></th>
		</table>
		<?php
		}
	break;
	case 'get_report_item':
		$kib=$_POST['kategori'];
		$id=$_POST['id'];
		$bln=$_POST['bln'];
		$thn=$_POST['thn'];
		if($bln=='all'){
			$periode=$thn;
		}else{
			$periode=$thn."-".$bln;
		}
		switch($kib){
			case 'KIBA':$dtkib=$dtkiba;break;
			case 'KIBB':$dtkib=$dtkibb;break;
			case 'KIBC':$dtkib=$dtkibc;break;
			case 'KIBE':$dtkib=$dtkibe;break;
		}
		if($id!='all'){
			$sql=mysql_query("select * from dtperawatanitem where id='$id' and tanggal like '%$periode%' order by tanggal");
			$stotal=mysql_query("select sum(harga) as jumlah from dtperawatanitem where id='$id' and tanggal like '%$periode%'");
		}else{
			$sql=mysql_query("select * from dtperawatanitem where tanggal like '%$periode%' order by tanggal");
			$stotal=mysql_query("select sum(harga) as jumlah from dtperawatanitem where tanggal like '%$periode%'");
		}
		while($rtotal=mysql_fetch_array($stotal)){$total=$rtotal['jumlah'];}
		?>
		<div class="content" align="center">
			<div class="c10"></div>
			<div class="c10"></div>
			<h2>LAPORAN PERWATAN ASET (<?php echo $kib;?>)</h2>
			<h2>PERIODE <?php echo getBulan($bln);?> TAHUN <?php echo $thn;?></h2>
			<table border="0" cellpadding="0" cellspacing="0" class="tabel" width="99%">
              <tr>
                <th width="11%" align="left">TANGGAL</th>
                <th width="18%" align="left">NAMA BARANG</th>
                <th width="20%" align="left">PEKERJAAN</th>
                <th width="23%" align="left">SPAREPART</th>
                <th width="11%" align="center">STATUS</th>
                <th width="17%" align="right">BIAYA/HARGA</th>
                <?php
			while($row=mysql_fetch_array($sql)){
		?>
              </tr>
			  <tr>
                <td><?php echo getTanggal($row['tanggal']);?></td>
			    <td><?php echo $dtkib->getField('nama',$row['id'])."&nbsp".$dtkib->getField('merek',$row['id'])."&nbsp".$dtkib->getField('no_polisi',$row['id']);?></td>
			    <td><?php echo $row['jenis'];?></td>
			    <td><?php echo $row['sparepart'];?></td>
			    <td align="center"><?php echo get_status($row['status']);?></td>
			    <td align="right"><?php echo rupiah($row['harga']);?></td>
		      </tr>
              <?php
		}
		?>
              <tr>
                <th colspan="5" align="left">TOTAL BIAYA PERAWATAN</th>
                <th colspan="2" align="right"><?php echo rupiah($total);?></th>
              </tr>
		  </table>
			<div class="c10"></div>
			<a onclick="preview_item();"><li class="fa fa-print icon"></li></a>
			<div class="c10"></div>
		</div>
	<?php
	break;
}
?>
