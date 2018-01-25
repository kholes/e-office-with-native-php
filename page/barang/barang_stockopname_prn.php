<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
include "../../class/dtbarangmasuk.cls.php";
include "../../class/dtbarangkeluar.cls.php";
include "../../class/user.cls.php";
include "../../class/dtmerek.cls.php";
include "../../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$dtbarang=new Dtbarang();
$barangmasuk=new Dtbarangmasuk();
$barangkeluar=new Dtbarangkeluar();
$merek=new Dtmerek();
$satuan=new Dtsatuan();
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
	$trx_awal=$barangmasuk->get_trxawal();						
	$mtgl=tgl_ind_to_eng($_GET['mtgl']);
	$htgl=tgl_ind_to_eng($_GET['htgl']);
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
	$sql=mysql_query("select * from dtbarang where id in(select id from dtbarangmasukitem) order by kategori");
	while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LAPORAN PENGGUNAAN BARANG</title>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
</head>
<body>
	<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>
	<div id="header">
		<h3>Lampiran Berita Acara Stock Opname</h3>
		<h3>KANTOR PENGHUBUNG PROVINSI SUMATERA BARAT</h3>
		<h3>Nomor : 01/BA/SO/2015</h3>
		<h3>Per <?php echo getTanggal($htgl);?></h3>
		<div class="c10"></div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="4%">NO</th>
			<th width="17%" style="text-align:left"><a href="<?php echo $link;?>&m=rsto&s=nama&i=<?php echo $i;?>">NAMA</a></th>
			<th width="12%"><a href="<?php echo $link;?>&m=rsto&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
			<th width="11%" align="center"><a href="<?php echo $link;?>&m=rsto&s=stok&i=<?php echo $i;?>">STOK AWAL  </a></th>
			<th width="13%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">PEMBELIAN</a></th>
			<th width="13%" align="right"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">HARGA  </a></th>
			<th width="10%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">PEMAKAIAN</a></th>
			<th width="7%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>"> SISA </a></th>
			<th width="13%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">HARGA SISA </a></th>
			<?php
			if ($data!=0){
					foreach($data as $row){	  	
				?>
				<tr style="border-bottom:1px solid #999;" onMouseOver="this.style.color='red';cursor.poniter='normal';" onMouseOut="this.style.color='#333';">
					<td width="4%" align="center"><?php echo $c=$c+1;?></td>
					<td width="17%" style="text-align:left"><?php echo $row['nama']; ?></td>
					<td width="12%" align="center"><?php echo $satuan->getField('satuan',$row['satuan']); ?></td>
					<td width="11%" align="center"><?php
					$x=$barangmasuk->get_total('qty',$row['id'],$trx_awal,$mtgl);
					$y=$barangkeluar->get_total($row['id'],$trx_awal,$mtgl);
					echo $stok_awal=$x-$y;
					?>
					</td>
					<td width="13%" align="center">
					<?php echo $belanja=$barangmasuk->get_total('qty',$row['id'],$mtgl,$htgl); ?>
					</td>
					<td width="14%" align="right">
					<?php $harga=$barangmasuk->get_total('harga',$row['id'],$trx_awal,$htgl);echo format_angka($harga); ?>
					</td>
					<td width="11%" align="center">
					<?php echo $pemakaian=$barangkeluar->get_total($row['id'],$mtgl,$htgl);?>
					</td>
					<td width="5%" align="center">
					<?php echo $vol_sisa=$stok_awal+$belanja-$pemakaian;?>      
					</td>
					<td width="13%" align="right">
					<?php  
					echo format_angka ($vol_sisa*$harga);
					$total_harga_sisa[]=$vol_sisa*$harga;
					?>
					</td>
				</tr>
				<?php
				}
				}	  
				?>
				<th colspan="8" align="left">TOTAL</th>
				<th align="right">
				<?php echo format_angka(array_sum($total_harga_sisa)); ?>
				</th>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="76%" style="border:none;">&nbsp;</td>
					<td width="24%" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
					<td width="76%" style="border:none;">&nbsp;</td>
					<td width="24%" style="border:none;">Jakarta, <?php echo getTanggal($date->format('Y-m-d'));?></td>
				</tr>
				<tr>
					<td width="76%" style="border:none;">&nbsp;</td>
					<td width="24%" style="border:none;">Petugas Opname Barang </td>
				</tr>
				<tr>
					<td width="76%" style="border:none;">&nbsp;</td>
					<td width="24%" style="border:none;">&nbsp;</td>
				</tr>
				<tr>
					<td width="76%" style="border:none;">&nbsp;</td>
					<td width="24%" style="border:none;">&nbsp;</td>
				</tr>
			</table>
		</div>
		<?php
}
?>
