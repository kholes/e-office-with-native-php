<?php
ob_start();
include "table.php";
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}
function xlsEOF() {
	echo pack("ss", 0x0A, 0x00);
    return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

function getIP() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
$path=$path=$_SERVER['REQUEST_URI'];
date_default_timezone_set("Asia/Jakarta");
$date=new DateTime();
$bln=$date->format('m');
$bln=$date->format('m');
$tanggal=$date->format('Y-m-d');
$jam=$date->format('G:i:s');
$G=$date->format('G');
if(strlen($G)<2){$G='0'.$G;}else{$G=$G;}
function xTimeAgo ($oldTime, $newTime, $timeType) {
            $timeCalc = strtotime($newTime) - strtotime($oldTime);       
            if ($timeType == "x") {
                if ($timeCalc = 60) {
                    $timeType = "m";
                }
                if ($timeCalc = (60*60)) {
                    $timeType = "h";
                }
                if ($timeCalc = (60*60*24)) {
                    $timeType = "d";
                }
            }       
            if ($timeType == "s") {
                $timeCalc .= " seconds ago";
            }
            if ($timeType == "m") {
                $timeCalc = round($timeCalc/60) . "menit";
            }       
            if ($timeType == "h") {
                $timeCalc = round($timeCalc/60/60) . "jam";
            }
            if ($timeType == "d") {
                $timeCalc = round($timeCalc/60/60/24) . "hari";
            }       
            return $timeCalc;
}
function timeAgo($timestamp){
	date_default_timezone_set('Asia/Jakarta');
	$skrg=date("Y-m-d G:i:s");
	$isi= str_replace("-","",xTimeAgo($skrg,$timestamp,"m"));
	$isi2= str_replace("-","",xTimeAgo($skrg,$timestamp,"h"));
	$isi3= str_replace("-","",xTimeAgo($skrg,$timestamp,"d"));
    $go="";
	if($isi > 60){
    	$go=$isi2;
    }elseif($isi2 > 24){
    	$go=$isi3;
    }elseif($isi < 61){
    	$go=$isi;
    }
    return $go;
}
function lastM($timestamp){
	date_default_timezone_set('Asia/Jakarta');
	$skrg=date("Y-m-d G:i:s");
	$menit= str_replace("-","",xTimeAgo($skrg,$timestamp,"m"));
    return $menit;
}
function lastH($timestamp){
	date_default_timezone_set('Asia/Jakarta');
	$skrg=date("Y-m-d G:i:s");
	$jam= str_replace("-","",xTimeAgo($skrg,$timestamp,"h"));
    return $jam;
}
function lastD($timestamp){
	date_default_timezone_set('Asia/Jakarta');
	$skrg=date("Y-m-d G:i:s");
	$hari= str_replace("-","",xTimeAgo($skrg,$timestamp,"d"));
    return $hari;
}
function cekID($inputname,$v,$data,$id){
	$cek='checked';
	$pegawai=new Pegawai();
	$x=explode(',',$data);
	$n=sizeof($x);
	if($v==$x[0] or $v==$x[1] or $v==$x[2] or $v==$x[3] or $v==$x[4] or $v==$x[5] or $v==$x[6] or $v==$x[7] or $v==$x[8] or	$v==$x[9] or $v==$x[10]){$cek="checked";}else{$cek="";}
	echo "<li><input name='$inputname"."[]' type='checkbox' value='$v' class='ksi' $cek >&nbsp;".$pegawai->getField('jabatan',$v)."</li>";
}

// Konvesi dd-mm-yyyy -> yyyy-mm-dd
function tgl_ind_to_eng($tgl) {
	$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2); 
	return $tgl_eng;
}

// Konvesi yyyy-mm-dd -> dd-mm-yyyy
function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
	return $tgl_ind;
}
function  getTanggal($tgl){
$tanggal  =  substr($tgl,8,2);
$bulan  =  getBulan(substr($tgl,5,2));
$tahun  =  substr($tgl,0,4);
$jam = substr($tgl,11,9);
return  $tanggal.' '.$bulan.' '.$tahun.'';
}
function  getJam($tgl){
$jam = substr($tgl,11,9);
return  $jam;
}
function terbilang($x){
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " Belas" ;
  elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " Seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " Seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
function get_status($sts){
	switch($sts){
		case 'B':return 'BAIK';break;
		case 'KB':return 'KURANG BAIK';break;
		case 'RB':return 'RUSAK BERAT';break;
	}
}
function  getBulan($bln){
	switch  ($bln){
		case  1:
		return  "Januari";
		break;
		case  2:
		return  "Februari";
		break;
		case  3:
		return  "Maret";
		break;
		case  4:
		return  "April";
		break;
		case  5:
		return  "Mei";
		break;
		case  6:
		return  "Juni";
		break;
		case  7:
		return  "Juli";
		break;
		case  8:
		return  "Agustus";
		break;
		case  9:
		return  "September";
		break;
		case  10:
		return  "Oktober";
		break;
		case  11:
		return  "November";
		break;
		case  12:
		return  "Desember";
		break;
	}
}


function format_angka($angka) {
	$hasil = number_format($angka,0, ",",".");
	return $hasil;
}

function rupiah($data){
	$rupiah = "";
	$jml = strlen($data);
	
	 while($jml > 3)
	 {
		$rupiah = "." . substr($data,-3) . $rupiah;
		$l = strlen($data) - 3;
		$data = substr($data,0,$l);
		$jml = strlen($data);
	 }
	 $rupiah = "Rp " . $data . $rupiah . ",-";
	 return $rupiah;
}
function pagination($statement,$per_page=10,$page=1,$url,$id){
	$query = mysql_query("SELECT COUNT(".$id.") as num FROM ".$statement."");	
	$row = mysql_fetch_assoc($query);
	$total = $row['num'];
    $adjacents = "2";
      
    $prevlabel = "&lsaquo;";
    $nextlabel = "&rsaquo;";
    $lastlabel = "..&rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page); 
    $start = ($page - 1) * $per_page;                              
    $prev = $page - 1;                         
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){  
        $pagination .= "<ul class='pagination'>";
       // $pagination .= "<li class='page_info'>Halaman ".$page." dari ".$lastpage."</li><br>";
              
            if ($page > 1) $pagination.= "<li><a href='".$url."&page=".$prev."{$param}'>".$prevlabel."</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){  
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>".$counter."</a></li>";
                else
                    $pagination.= "<li><a href='".$url."&page=".$counter."{$param}'>".$counter."</a></li>";                   
            }
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>".$counter."</a></li>";
                    else
                        $pagination.= "<li><a href='".$url."&page=".$counter."{$param}'>".$counter."</a></li>";                   
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='".$url."&page=".$lpm1."{$param}'>".$lpm1."</a></li>";
                $pagination.= "<li><a href='".$url."&page=".$lastpage."{$param}'>".$lastpage."</a></li>"; 
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $pagination.= "<li><a href='".$url."&page=1{$param}'>1</a></li>";
                $pagination.= "<li><a href='".$url."&page=2{$param}'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>".$counter."</a></li>";
                    else
                        $pagination.= "<li><a href='".$url."&page=".$counter."{$param}'>".$counter."</a></li>";                   
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='".$url."&page=".$lpm1."{$param}'>".$lpm1."</a></li>";
                $pagination.= "<li><a href='".$url."&page=".$lastpage."{$param}'>".$lastpage."</a></li>";     
            } else {
                $pagination.= "<li><a href='".$url."&page=1{$param}'>1</a></li>";
                $pagination.= "<li><a href='".$url."&page=2{$param}'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='".$url."&page={$counter}{$param}'>{$counter}</a></li>";                   
                }
            }
        }
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='".$url."&page={$next}{$param}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='".$url."&page={$lastpage}{$param}'>{$lastlabel}</a></li>";
            }
        $pagination.= "</ul>";       
    }
    return $pagination;
}
function hari($hari)
{
    switch ($hari)
    {
         case 0 : $hari = "Minggu";
                  return $hari;
                  break;
         case 1 : $hari = "Senin";
                  return $hari;
                  break;
         case 2 : $hari = "Selasa";
                 return $hari;
                 break;
         case 3 : $hari = "Rabu";
                 return $hari;
                  break;
        case 4 : $hari = "Kamis";
               return $hari;
               break;
        case 5 : $hari = "Jum'at";
               return $hari;
               break;
       case 6 : $hari = "Sabtu";
               return $hari;
               break;
	}
}
	function bulan($bulan){
		switch ($bulan){
			case 01 : $bulan = " Januari";
					   return $bulan;
					   break;
			case 02 : $bulan = " Februari";
				return $bulan;
					break;
			case 03 : $bulan = " Maret";
				   return $bulan;
				   break;
			case 04 : $bulan = " April";
				   return $bulan;
				   break;
			case 05 : $bulan = " Mei";
				   return $bulan;
				   break;
			case 06 : $bulan = " Juni";
				   return $bulan;
				   break;
			case 07 : $bulan = " Juli";
				   return $bulan;
				   break;
			case 08 : $bulan = " Agustus";
				   return $bulan;
				   break;
			case 09 : $bulan = " September";
				   return $bulan;
				   break;
			case 10 : $bulan = " Oktober";
				   return $bulan;
				   break;
			case 11 : $bulan = " November";
				   return $bulan;
				   break;
			case 12 : $bulan = " Desember";
				   return $bulan;
				   break;
		}
	}
 
	function hari_tanggalindo(){
	   $hari_sekarang = hari(date("w"));
	   $bln_sekarang = bulan(date("m"));
	   return $hari_sekarang.", ".date("d").$bln_sekarang.date("Y");
	}
 
	function tanggal_indo($tanggal){
	  $hari = hari(substr($tanggal,5,2));
	  $tgl = substr($tanggal,5,2);
	  $bulan = bulan(substr($tanggal,4,2));
	  $tahun = substr($tanggal,0,4);
	  return  $hari.", ".$tgl." ".$bulan." ".$tahun;
	}



function makeTbin($name){
	$sql = mysql_query ("create table if not exists $name(
						idt char(9),
   						id char(14),
   						kode varchar(20),
   						nama varchar(255),
   						harga_beli int(11),
						qty int(11),
						jumlah int(11),
						diskon int(11))"
					);
}
function makeTbreq($name){
	$sql = mysql_query ("create table if not exists $name(
   						idt char(14),
   						id char(14),
   						barcode varchar(50),
						qty int(11),
						jumlah int(11),
						diskon int(11),
						keterangan varchar(255))"
					);
}
function makeTbout($name){
	$sql = mysql_query ("create table if not exists $name(
						idt char (14),
   						id char(14),
   						kode varchar(20),
						qty int(11),
						keterangan varchar(255))"
					);
}
function makeTperawatan($name){
	$sql = mysql_query ("create table if not exists $name(
						id varchar(30),
   						idt char(14),
						tanggal date,
						jenis varchar(30),
						sparepart varchar(100),
						harga varchar(100),
						status varchar(100),
						keterangan varchar(255))"
					);
}
function rand_str($length = 6) {
	$date=new DateTime();
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$date->format('Ymdhis');
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function kodebrg($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);
 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]==""){
 		$angka=0;
	}else{
 		$angka		= substr($row[0], strlen($inisial));
 	}
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}
function urutauto($tabel, $param){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,7);
	$panjang	= mysql_field_len($struktur,7);
 	$qry	= mysql_query("SELECT max(mail_index) FROM ".$tabel." where fdate like '%$param%' and mail_type='reg'");
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]==""){
 		$angka=0;
	}else{
 		$angka		= $row[0];
 	}
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $tmp.$angka;
}
function kode_trx($tabel,$inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);
 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel." where pemohon='".$inisial."'");
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]==""){
 		$angka=0;
	}else{
 		$angka		= substr($row[0], strlen($inisial));
 	}
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}
function kode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);
 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel."");
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]==""){
 		$angka=0;
	}else{
 		$angka		= substr($row[0], strlen($inisial));
 	}
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}
function kdauto($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);
 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel."");
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]==""){
 		$angka=0;
	}else{
 		$angka		= substr($row[0], strlen($inisial));
 	}
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

function text_limit($str,$limit){  
	if(stripos($str," ")){  
		$ex_str = explode(" ",$str);  
		if(count($ex_str)>$limit){  
			for($i=0;$i<$limit;$i++){  
				$str_s.=$ex_str[$i]." ";  
			}  
			return $str_s;  
	   }else{  
			return $str;  
	   }  
  	}else{  
		return $str;  
    }  
}  
function getext($filename) { 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1; 
	$exts = $exts[$n]; 
	return $exts; 
} 
function crypted($action, $string) {
   	$output = false;
   	$key = 'goombel selalu di hati';
   	$iv = md5(md5($key));
   	if($action == 'encrypt') {
	   $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
	   $output = base64_encode($output);
	}elseif($action == 'decrypt'){
	   $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
	   $output = rtrim($output, "");
	}
   return $output;
}
function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}
function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}
function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}

function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
function encrypt_decrypt($action, $string) {
   $output = false;

   $key = 'My strong random secret key';

   // initialization vector 
   $iv = md5(md5($key));

   if( $action == 'encrypt' ) {
       $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
       $output = base64_encode($output);
   }
   else if( $action == 'decrypt' ){
       $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
       $output = rtrim($output, "");
   }
   return $output;
}


class Db{
	private $dbHost="localhost"; //
	private $dbUser="root"; //tasexpre_goombel
	private $dbPass="1qs2wd3ef"; //123goombel456
	private $dbName="eoffice"; //tasexpre_db
	function conDb() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server"); 
	}
}
class Login{
	function logsys($user,$pass){
		$error1="<img src='img/warning.png'> User ID atau password tidak sesuai, login gagal!";
		$error2="<img src='img/warning.png'> Account anda belum diaktifkan, hubungi administrator.";
		$error3="<img src='img/warning.png'> Max ID 30 karakter, login gagal!";
		$error4="<img src='img/warning.png'> Hak akses ID, tidak dikenal, hubungi administrator.";
		$error5="<img src='img/warning.png'> Cek User ID atau Password.";
		if(strlen($user)>30 or strlen($pass)>30){
			return $error3;
		}else{
			$sql=mysql_query("select login_id from user where login_id='$user'") or die ($error5);
			$no=mysql_num_rows($sql);
			if ($no!=1){
				return $error1;
			}else{
				$passwd=md5($pass);
				$sql=mysql_query("select id_user,status,level from user where login_id='$user' and password='$passwd'");
				$no=mysql_num_rows($sql);
				$log=mysql_fetch_row($sql);
				if($no!=1){
					return $error1;
				}else{
					if($log[1]!='1'){
						return $error2;
					}else{
						$level=mysql_query("select id,module from level where id='{$log[2]}'");
						$no=mysql_num_rows($level);
						if($no!=1){
							return $error4;
						}else{
							$lev=mysql_fetch_row($level);
							session_start();
							$_SESSION['id_user']=encrypt_url($log[0]);
							$_SESSION['module']=$lev[1];
							makeTbin('tempinput'.$log[0]);
							makeTbreq('temppengajuan'.$log[0]);
							makeTbout('tempoutput'.$log[0]);
							makeTperawatan('tempperawatan'.$log[0]);
							header("location:home.php?p=".encrypt_url('home')."");
							return true;
						}
					}
				}
			}
		}
	}
	function getsesi(){
		return $_SESSION['loguser'];
	}
	function logout(){
		//exitlog();
		$_SESSION['loguser']=false;
		session_destroy();
	}
}
?>