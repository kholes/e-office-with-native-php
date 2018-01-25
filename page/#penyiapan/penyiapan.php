<?php
include "class/pengajuan.cls.php";
include "class/dtbarang.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
include "class/jabatan.cls.php";
$pengajuan=new Pengajuan();
$jabatan=new Jabatan();
$dtbarang=new Dtbarang();
$merek=new Dtmerek();
$satuan=new Dtsatuan();
$link='?p='.encrypt_url('penyiapan');
$linkdata='page/penyiapan/penyiapanprc.php';
$i=$_GET['i'];
$s=$_GET['s'];
if($s==''){$s='id';}
?>
<body>
	<?php include "header.php"; ?>
	<div class="p-wrapper">
		<div class="content">
			<div id="head">&raquo; PENYIAPAN PENGAJUAN BARANG </div>		
		<?php
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'datapenyiapan.php';
			break;
			case 'dpenyiapan':
				include 'datapenyiapan.php';
			break;
		}
		?>
		</div>
	</div>
</body>
