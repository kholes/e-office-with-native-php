<?php
include "class/jabatan.cls.php";
include "class/sub.cls.php";
include "class/pangkat.cls.php";
$jabatan=new Jabatan();
$sub=new Sub();
$pangkat=new Pangkat();
$link='?p='.encrypt_url('account');
?>
<script>
	function detail(id){
		window.location='<?php echo $link;?>&m=fuser&ide='+id;
	}
	$(document).ready(function(){
		$('#batal').click(function(){
			window.location='<?php echo $link;?>';
		});
	});
</script>
	<?php include "header.php"; ?>
		<?php 
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'frmuser.php';
			break;
			case 'fuser':
				include 'frmuser.php';
			break;
			case 'fakses':
				include 'frmakses.php';
			break;
			case 'fpeg':
				include 'frmpegawai.php';
			break;
			case 'fper':
				include 'frmperawatan.php';
			break;
			case 'fjab':
				include 'jabatan.php';
			break;
			case 'fpangkat':
				include 'pangkat.php';
			break;
			case 'fsub':
				include 'sub.php';
			break;
		}
		?>

