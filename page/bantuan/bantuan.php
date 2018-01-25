<?php 
$link='?p='.encrypt_url('bantuan');
$linkdata='page/bantuan/bantuanprc.php';
include "header.php"; 
?>
	<div class="p-wrapper">
		<div class="content">
		<?php 
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'frmbackup.php';
			break;
			case 'fback':
				include 'frmbackup.php';
			break;
			case 'fres':
				include 'frmrestore.php';
			break;
			case 'fclear':
				include 'frmclear.php';
			break;
		}
		?>
	</div>
</div>
<?php
