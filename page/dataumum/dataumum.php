<?php
include "class/dtmerek.cls.php";
$merek=new Dtmerek();
$link='?p='.encrypt_url('dataumum');
include "header.php";
		$menu=$_GET['m'];
		switch($menu){
			case '':
				include 'home_page.php';
			break;
			case 'formmerek':
				include 'form_merek.php';
			break;
			case 'formkategori':
				include 'form_kategori.php';
			break;
			case 'datamerek':
				include 'data_merek.php';
			break;
			case 'formsatuan':
				include 'form_satuan.php';
			break;
			case 'formtoko':
				include 'form_toko.php';
			break;
		}
		?>

