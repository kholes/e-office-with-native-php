<?php
include "class/dtbarang.cls.php";
include "class/dtkategori.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/dttoko.cls.php";
include "class/trxinput.cls.php";
include "class/trxoutput.cls.php";
$trxin=new Trxinput();
$trxout=new Trxoutput();
$dtbarang=new Dtbarang();
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$dtsatuan=new Dtsatuan();
$toko=new Dttoko();
$link='?p='.encrypt_url('barang');
$linkdata='page/barang/databarang.php';
$trxoutprc='page/barang/trxoutprc.php';
$trxinprc='page/barang/trxinprc.php';
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
	function prev_barang(s,i){
		var print_stok=null;
		if (print_stok==null){
			print_stok=open('page/barang/prnbarang.php?s='+s+'&i='+i+'','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
		}
	}
	function deleteItem(id){
		var conf=confirm("Penghapusan data, akan mempengaruhi laporan keluar/masuk data!, apakah akan dilanjutkan?");
		if (conf==true){
			$.ajax({
				type: 'POST',
				url: '<?php echo $trxinprc;?>',
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
			case '':
				include 'databarang.php';
			break;
			case 'fbrg':
				include 'frmbarang.php';
			break;
			case 'fbrgk':
				include 'frmbarangkeluar.php';
			break;
			case 'ftrxo':
				include 'frmtransaksikeluar.php';
			break;
			case 'rbrgk':
				include 'reporttrxout.php';
			break;
			case 'rstok':
				include 'reportstok.php';
			break;
			case 'rsto':
				include 'reportstokopname.php';
			break;
			case 'dtbrm':
				include 'dtbelanja.php';
			break;
			case 'rbrgm':
				include 'reporttrxin.php';
			break;
			case 'fbrgm':
				include 'frmbarangmasuk.php';
			break;
			case 'fcon':
				include 'frmcount.php';
			break;
			case 'ftrxin':
				include 'frmtransaksimasuk.php';
			break;
			case 'dtbrg':
				include 'databarang.php';
			break;
			case 'dtrefout':
				include 'refrensiout.php';
			break;
			case 'dtrefin':
				include 'refrensiin.php';
			break;
			case 'fcode':
				include 'frmbarcode.php';
			break;
		}
		?>
