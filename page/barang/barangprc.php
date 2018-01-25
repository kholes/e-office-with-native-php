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
	$req=$_POST['req'];
	switch($req){
		case 'view_data':
			$i=$_POST['i'];
			$trx_awal=$barangmasuk->get_trxawal();						
			$mtgl=tgl_ind_to_eng($_POST['mtgl']);
			$htgl=tgl_ind_to_eng($_POST['htgl']);

			if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
			$sql=mysql_query("select * from dtbarang where id in(select id from dtbarangmasukitem) order by kategori");
			while($row=mysql_fetch_assoc($sql))
			$data[]=$row;
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<th width="4%">NO</th>
				<th width="17%" align="left"><a href="<?php echo $link;?>&m=rsto&s=nama&i=<?php echo $i;?>">NAMA</a></th>
				<th width="12%"><a href="<?php echo $link;?>&m=rsto&s=satuan&i=<?php echo $i;?>">SATUAN</a></th>
				<th width="11%" align="center"><a href="<?php echo $link;?>&m=rsto&s=stok&i=<?php echo $i;?>">STOK AWAL  </a></th>
				<th width="13%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">PEMBELIAN</a></th>
				<th width="13%" align="right"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">HARGA  </a></th>
				<th width="10%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">PEMAKAIAN</a></th>
				<th width="7%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>"> SISA </a></th>
				<th width="13%" align="center"><a href="<?php echo $link;?>&m=rsto&s=minstok&i=<?php echo $i;?>">HARGA SISA </a></th>
			</table>
				<div style="display:block; height:350px; overflow:auto; padding-bottom:5px;">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
					<?php
								if ($data!=0){
									foreach($data as $row){	  	
								?>
					<tr style="border-bottom:1px solid #999;" onMouseOver="this.style.color='red';cursor.poniter='normal';" onMouseOut="this.style.color='#333';">
					  <td width="4%" align="center"><?php echo $c=$c+1;?></td>
					  <td width="17%"><?php echo $row['nama']; ?></td>
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
				</div>
			<?php
		break;
	}
}
?>
