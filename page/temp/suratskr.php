	<?php include 'header.php';?>
		<?php
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'datasurat.php';
			break;
			case 'fsuratmasuk':
				include 'frmsuratmasuk.php';
			break;
			case 'fsuratkeluar':
				include 'frmsuratkeluar.php';
			break;
			case 'fdraftkeluar':
				include 'frmdraftsurat.php';
			break;
			case 'fsuratrhs':
				include 'frmsuratrhs.php';
			break;
			case 'fklasi':
				include 'frmklasifikasi.php';
			break;
			case 'fkode':
				include 'kode.php';
			break;
			case 'report':
				include 'report.php';
			break;
		}
		?>
