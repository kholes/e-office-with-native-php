<?php
include "class/dtbarang.cls.php";
include "class/dtbarangmasuk.cls.php";
include "class/dtbarangkeluar.cls.php";
include "class/dtkategori.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/dttoko.cls.php";
$dtbarang=new Dtbarang();
$barangmasuk=new Dtbarangmasuk();
$barangkeluar=new Dtbarangkeluar();
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$dtsatuan=new Dtsatuan();
$toko=new Dttoko();
$link='?p='.encrypt_url('barang');
$linkdata='page/barang/databarang.php';
$barangprc='page/barang/barangprc.php';
$barangkeluarprc='page/barang/barangkeluarprc.php';
$barangmasukprc='page/barang/barangmasukprc.php';
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
?>
<script>
	function print_stok(){
		var print_stok=null;
		if (print_stok==null){
			print_stok=open('page/barang/reportstok.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	function barangxls(){
		var print_stok=null;
		if (print_stok==null){
			print_stok=open('page/barang/barangxls.php','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	function deleteItem(id){
		var conf=confirm("Penghapusan data, akan mempengaruhi laporan keluar/masuk data!, apakah akan dilanjutkan?");
		if (conf==true){
			$.ajax({
				type: 'POST',
				url: '<?php echo $barangmasukprc;?>',
				data: 'req=delItem&id='+id,
				cache: false,
				success: function(data){
					//alert(data);
					self.location.reload();
				}
			});		
			return false;
		}else{
			return true;
		}
	}
</script>
	<?php 
	include "header.php";
		$menu=$_GET['m'];
		switch($menu){
			//================= BARANG ====================//
			case '':
				include 'home_page.php';
			break;
			case 'barangdata':
				include 'barang_data.php';
			break;
			case 'barangform':
				include 'barang_form.php';
			break;
			case 'barangstockopname':
				include 'barang_stockopname.php';
			break;
			//================= BARANG MASUK ====================//
			case 'barangmasukform':
				include 'barangmasuk_form.php';
			break;
			case 'barangmasuktrx':
				include 'barangmasuk_trx.php';
			break;
			case 'barangmasukadd':
				include 'barangmasuk_add.php';
			break;
			case 'barangmasukref':
				include 'barangmasuk_ref.php';
			break;
			case 'barangmasukreport':
				include 'barangmasuk_report.php';
			break;
			//================= END ===================//
			//================= BARANG KELUAR ====================//
			case 'barangkeluarform':
				include 'barangkeluar_form.php';
			break;
			case 'barangkeluarref':
				include 'barangkeluar_ref.php';
			break;
			case 'barangkeluartrx':
				include 'barangkeluar_trx.php';
			break;
			case 'barangkeluarreport':
				include 'barangkeluar_report.php';
			break;
			//================= END ===================//
/*
			case 'rstok':
				include 'reportstok.php';
			break;
			case 'dtbrm':
				include 'dtbelanja.php';
			break;
*/
			//================= BARCODE ====================//
			case 'barcodeform':
				include 'barcode_form.php';
			break;
		}
		?>
