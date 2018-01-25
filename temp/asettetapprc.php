<?php
session_start();
include "../lib/lib.php";
include "../class/asettetap.cls.php";
include "../class/dtkategori.cls.php";
include "../class/dtmerek.cls.php";
include "../class/jabatan.cls.php";
$db=new Db();
$db->conDb();
$aset=new Asettetap();
$jabatan=new Jabatan();
$dtkategori=new dtkategori();
$btn=$_POST['btn'];
$id=$_POST['id'];
$id_aset=$date->format('Ymdhis');
$data=array('id'=>$id_aset,'kode'=>$_POST['kode'],'kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'merek'=>$_POST['merek'],'type'=>$_POST['type'],'ukuran'=>$_POST['ukuran'],'bahan'=>$_POST['bahan'],'tahun_beli'=>$_POST['tahun_beli'],'perolehan'=>$_POST['perolehan'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan'],'no_pabrik'=>$_POST['no_pabrik'],'no_rangka'=>$_POST['no_rangka'],'no_mesin'=>$_POST['no_mesin'],'no_polisi'=>$_POST['no_polisi'],'no_bpkb'=>$_POST['no_bpkb']);
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$aset->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$aset->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$aset->addData($data);		
		$data=$aset->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$aset->updateData($id,$data);		
		$data=$aset->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$aset->delData($id);
		$data=$aset->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
$dtmerek=new dtmerek();
$dtkategori=new dtkategori();
$jabatan=new Jabatan();
if ($data!=0){
?>
<?php
	}else{ 
		echo "<p class='pesan'>Data aset tidak ditemukan.</p>"; 
	}
}
?>