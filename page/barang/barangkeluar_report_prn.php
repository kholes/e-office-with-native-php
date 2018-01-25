<?php
include "../../lib/lib.php";
include "../../class/dtbarangkeluar.cls.php";
include "../../class/dtbarang.cls.php";
include "../../class/dtsatuan.cls.php";
include "../../class/dttoko.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$barangkeluar=new Dtbarangkeluar();
$dtbarang=new Dtbarang();
$satuan=new Dtsatuan();
$toko=new Dttoko();
$pegawai=new Pegawai();
$link=$_SERVER['PHP_SELF'];
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
<?php
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
$mtgl=$_GET['mtgl'];
$htgl=$_GET['htgl'];
$r=array('mtgl'=>tgl_ind_to_eng($mtgl),'htgl'=>tgl_ind_to_eng($htgl));
$data=$barangkeluar->getRekap($r,$s,$i);
if ($data!=array()){
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div id="header">
<h3>LAPORAN PENGGUNAAN KELUAR</h3>
<h3>TANGGAL : <?php echo getTanggal(tgl_ind_to_eng($mtgl));?> S/D <?php echo getTanggal(tgl_ind_to_eng($htgl));?></h3>
</div>
<div style="clear:both; height:10px;"></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <?php
	if ($data!=0){
		foreach($data as $row){  	
			?>
			<tr bgcolor="#333">
				<td width="20%" align="left" style="border:none; color:#fff; font-weight:bold;">NO.PENGAJUAN</td>
				<td style="border:none; color:#fff; font-weight:bold;">: <?php $id_pengajuan=$row['id_pengajuan']; if($id_pengajuan!=''){echo $id_pengajuan;}else{echo 'Permintaan Langsung';} ?></td>
				<td width="13%" style="border:none; color:#fff; font-weight:bold;">&nbsp;</td>
				<td width="18%" style="border:none; color:#fff; font-weight:bold;">TANGGAL TERIMA </td>
				<td width="25%" style="border:none; color:#fff; font-weight:bold;">: <?php echo getTanggal($row['tanggal']);?></td>
			</tr>
			<tr bgcolor="#333">
				<td width="20%" align="left" style="border:none; color:#fff; font-weight:bold; padding-bottom:5px;">PENGGUNA BARANG</td>
				<td width="24%" align="left" style="border:none; color:#fff; font-weight:bold;">: <?php echo $pegawai->getField('nama',$row['pemohon'])."-".$pegawai->getField('bagian',$row['pemohon']);?></td>
				<td>&nbsp;</td>
				<td width="18%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
		    </tr>
			<tr>
				<td colspan="6">
					<h3>Detail Barang</h3>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th width="15%" align="left">Kode Barang</th>
						<th width="33%" align="left">Nama barang</th>
						<th width="13%" align="left">Satuan</th>
						<th width="9%" align="center">Volume</th>
						<th width="13%" align="right">Harga Satuan</th>
						<th width="13%" align="right">Jumlah</th>
						<?php
						$sql=$barangkeluar->getDetail($row['id']);
						if($sql!=array($sql)){
							foreach($sql as $data){	  	
							?>
							<tr>
								<td width="15%" style="border:1px solid #000000;"><?php echo $data['id']; ?></td>
								<td width="33%" style="border:1px solid #000000;"><?php echo $dtbarang->getField('nama',$data['id']); ?></td>
								<td width="13%" align="left" style="border:1px solid #000000;">
									<?php echo $satuan->getField('satuan',$dtbarang->getField('satuan',$data['id'])); ?>								</td>
								<td width="9%" align="center" style="border:1px solid #000000;"><?php echo $data['qty']; ?></td>
								<td width="13%" align="right" style="border:1px solid #000000;">
									<?php echo format_angka($dtbarang->getField('harga_beli',$data['id'])); ?>								</td>
								<td width="13%" align="right" style="border:1px solid #000000;">
									<?php echo format_angka($dtbarang->getField('harga_beli',$data['id'])*$data['qty']); ?>								</td>
							</tr>
							<?php
							}	  
						}
						?>
							<th colspan="5">
								<p style="letter-spacing:2px; margin:0; padding:0;">TOTAL</p>							</th>
							<th width="27%" align="right">
								<p style="font-weight:bold; margin:0; padding:0;">
								<?php
								$mtgl=tgl_ind_to_eng($_GET['mtgl']);
								$htgl=tgl_ind_to_eng($_GET['htgl']);
								$sql=mysql_query("select sum(dtbarang.harga_beli*dtbarangkeluaritem.qty) as jumlah from dtbarang,dtbarangkeluar,dtbarangkeluaritem where dtbarangkeluar.id=dtbarangkeluaritem.idt and dtbarang.id=dtbarangkeluaritem.id and dtbarangkeluaritem.idt='{$row['id']}'");
								while($tot=mysql_fetch_assoc($sql)){
									echo rupiah($tot['jumlah']);
								}
								?>
								</p>						  </th>
					</table>
					<div style="clear:both; height:5px;"></div>				</td>
			</tr>
			<?php
			}
		}	  
		?>
		<tr bgcolor="#333">
			<td colspan="4">
				<p style="letter-spacing:2px;font-weight:bold;color:#fff; margin:0; padding:3px 0px 5px 0px;">GRAND TOTAL</p>			</td>
			<td width="25%" align="right">
				<p style="font-weight:bold;margin:0; color:#fff; padding:3px 0px 5px 0px;">
				<?php
				$mtgl=tgl_ind_to_eng($_GET['mtgl']);
				$htgl=tgl_ind_to_eng($_GET['htgl']);
				$sql=mysql_query("select sum(dtbarang.harga_beli*dtbarangkeluaritem.qty) as jumlah from dtbarang,dtbarangkeluar,dtbarangkeluaritem where dtbarangkeluar.id=dtbarangkeluaritem.idt and dtbarang.id=dtbarangkeluaritem.id and dtbarangkeluar.tanggal between '$mtgl' and '$htgl'");
				while($tot=mysql_fetch_assoc($sql)){
					echo rupiah($tot['jumlah']);
				}
				?>
				</p>		  </td>
		</tr>
</table>
<?php
}else{ 
	echo "<p class='pesan'>Tidak ada transaksi.</p>"; 
}
?>
</body>
</html>
