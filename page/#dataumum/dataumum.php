<?php
include "class/dtmerek.cls.php";
$merek=new Dtmerek();
$link='?p='.encrypt_url('dataumum');
include "header.php";
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'merek.php';
			break;
			case 'kat':
				include 'kategori.php';
			break;
			case 'mrk':
				include 'merek.php';
			break;
			case 'sat':
				include 'satuan.php';
			break;
			case 'tko':
				include 'toko.php';
			break;
		}
		?>

