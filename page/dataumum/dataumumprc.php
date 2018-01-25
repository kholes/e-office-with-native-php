<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtkategori.cls.php";
include "../../class/dtmerek.cls.php";
include "../../class/dttoko.cls.php";
include "../../class/dtsatuan.cls.php";
$db=new Db();
$db->conDb();
$kategori=new Dtkategori();
$merek=new Dtmerek();
$toko=new Dttoko();
$satuan=new Dtsatuan();
$btn=$_POST['btn'];
$id=$_POST['id'];
$req=$_POST['req'];
switch($req){
	case 'save_merek':
		$id=kode('dtmerek','');
		$data=array('id'=>$id,'merek'=>$_POST['merek']);
		$merek->addData($data);			
	break;
	case 'edit_merek':
		$id=$_POST['id'];
		$data=array('merek'=>$_POST['merek']);
		$merek->updateData($id,$data);
	break;
	case 'del_merek':
		$id=$_POST['id'];
		$merek->delData($id);
	break;
	case 'get_all_merek':
		$data=$merek->getAll();	
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="4%">No</th>
			<th width="94%" align="left">Nama Merek</th>
			<th width="2%">&nbsp;</th>
		</table>
		<div style="height:250px; overflow:auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<?php
			foreach($data as $row){	  	
		  	?>
			<tr onMouseOver="this.style.background='#ccc';" onmouseout="this.style.background='#fff';">
				<td width="37" align="center"><?php echo $c=$c+1;?></td>
				<td width="919"><?php echo $row['merek']; ?></td>
				<td width="13" align="right">
					<a onClick="get_data('<?php echo $row['id'];?>');">
					<i class="fa fa-pencil-square-o icon-small" id="hapus"></i></a></td>
				<td width="12" align="right">
					<a onclick="hapus('<?php echo $row['id'];?>');">
					<i class="fa fa-trash-o icon-small"></i></a></td>
		  	</tr>
		  	<?php
		  	}
			?>
		</table>
		</div>
		<?php
	break;
	case 'save_satuan':
		$id=kode('dtsatuan','');
		$data=array('id'=>$id,'satuan'=>$_POST['satuan']);
		$satuan->addData($data);			
	break;
	case 'edit_satuan':
		$id=$_POST['id'];
		$data=array('satuan'=>$_POST['satuan']);
		$satuan->updateData($id,$data);
	break;
	case 'del_satuan':
		$id=$_POST['id'];
		$satuan->delData($id);
	break;
	case 'get_all_satuan':
		$data=$satuan->getAll();		
		?> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="4%">No</th>
			<th width="96%" align="left">Nama Merek</th>
		</table>
		<div style="height:250px; overflow:auto;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<?php
				foreach($data as $row){	  	
				?>
				<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
					<td width="4%" align="center"><?php echo $c=$c+1;?></td>
					<td width="96%"><?php echo $row['satuan']; ?></td>
				<td width="13" align="right">
					<a onClick="get_data('<?php echo $row['id'];?>');">
					<i class="fa fa-pencil-square-o icon-small" id="hapus"></i></a></td>
				<td width="12" align="right">
					<a onclick="hapus('<?php echo $row['id'];?>');">
					<i class="fa fa-trash-o icon-small"></i></a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
	break;
	case 'save_toko':
		$id=kode('dttoko','');
		$data=array('id'=>$id,'nama'=>$_POST['nama'],'alamat'=>$_POST['alamat'],'tlp'=>$_POST['tlp']);
		$toko->addData($data);			
	break;
	case 'edit_toko':
		$id=$_POST['id'];
		$data=array('nama'=>$_POST['nama'],'alamat'=>$_POST['alamat'],'tlp'=>$_POST['tlp']);
		$toko->updateData($id,$data);
	break;
	case 'del_toko':
		$id=$_POST['id'];
		$toko->delData($id);
	break;
	case 'get_all_toko':
		$data=$toko->getAll();		
		?> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="2%">No</th>
			<th width="29%" align="left">Nama Rekanan</th>
			<th width="51%" align="left">Alamat</th>
			<th width="18%" align="left">No.Tlp</th>
		</table>
		<div style="height:250px; overflow:auto;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<?php
				foreach($data as $row){	  	
				?>
				<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
					<td width="17" align="center"><?php echo $c=$c+1;?></td>
					<td width="285"><?php echo $row['nama']; ?></td>
					<td width="503"><?php echo $row['alamat']; ?></td>
					<td width="174"><?php echo $row['tlp']; ?></td>
				<td width="1" align="right">
					<a onClick="get_data('<?php echo $row['id'];?>');">
					<i class="fa fa-pencil-square-o icon-small" id="hapus"></i></a></td>
				<td width="1" align="right">
					<a onclick="hapus('<?php echo $row['id'];?>');">
					<i class="fa fa-trash-o icon-small"></i></a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
	break;
	case 'save_kategori':
		$id=kode('dtkategori','');
		$data=array('id'=>$id,'kategori'=>$_POST['kategori']);
		$kategori->addData($data);			
	break;
	case 'edit_kategori':
		$id=$_POST['id'];
		$data=array('kategori'=>$_POST['kategori']);
		$kategori->updateData($id,$data);
	break;
	case 'del_kategori':
		$id=$_POST['id'];
		$kategori->delData($id);
	break;
	case 'get_all_kategori':
		$data=$kategori->getAll();		
		?> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="4%">No</th>
			<th width="96%" align="left">Nama Kategori</th>
		</table>
		<div style="height:250px; overflow:auto;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
				<?php
				foreach($data as $row){	  	
				?>
				<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
					<td width="4%" align="center"><?php echo $c=$c+1;?></td>
					<td width="96%"><?php echo $row['kategori']; ?></td>
				<td width="13" align="right">
					<a onClick="get_data('<?php echo $row['id'];?>');">
					<i class="fa fa-pencil-square-o icon-small" id="hapus"></i></a></td>
				<td width="12" align="right">
					<a onclick="hapus('<?php echo $row['id'];?>');">
					<i class="fa fa-trash-o icon-small"></i></a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
	break;
	
	
	
	
	
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$dtmerek->getLike($cari);
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtmerek->addData($data);		
		$data=$dtmerek->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$dtmerek->updateData($id,$data);		
		$data=$dtmerek->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$dtmerek->delData($id);
		$data=$dtmerek->getAll();	
		tabel($data);
	break;		
}
?>