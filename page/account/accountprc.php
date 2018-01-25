<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$logid=decrypt_url($_SESSION['id_user']);
$btn=$_POST['btn'];
switch($btn){
	case 'cekId':
		$val=$_POST['val'];
		$res=$user->getUser($val);
		if(isset($res)){echo "<img src='img/failed.png'>";}else{
			$len=strlen($val);
			if($len<6 or $len>20){
			echo "<li class='fa fa-times icon-small red'></li>";
		}else{
			echo "<li class='fa fa-check icon-small green'></li>";
			}
		}
	break;
	case 'cekOldPass':
		$val=md5($_POST['val']);
		$oldPass=$user->getField('password',$logid);
		if($val!=$oldPass){
			echo "<li class='fa fa-times icon-small red'></li>";
		}else{
			echo "<li class='fa fa-check icon-small green'></li>";
		}
	break;
	case 'machChar':
		$len=strlen($_POST['val']);
		if($len<6 or $len>20){
			echo "<li class='fa fa-times icon-small red'></li>";
		}else{
			echo "<li class='fa fa-check icon-small green'></li>";
		}
	break;
	case 'machPass':
		$pass=$_POST['val'];
		$pass1=$_POST['val1'];
		if($pass!=$pass1){
			echo "<li class='fa fa-times icon-small red'></li>";
		}else{
			echo "<li class='fa fa-check icon-small green'></li>";
		}
	break;
	case 'upd':
		$id=$_POST['id'];
		$valuser=$_POST['user'];
		$oldPass=$_POST['oldPass'];
		$newPass=$_POST['newPass'];
		$newPass2=$_POST['newPass2'];

		if($valuser==$user->getField('login_id',$logid)){
			if(md5($_POST['oldPass'])!=$user->getField('password',$logid)){
				echo "Silahkan masukan password lama dengan benar!";
			}else{
				if(strlen($newPass)<6 or strlen($newPass)>20 and strlen($newPass2)<6 or strlen($newPass2)>20){
					echo "Min karakter 6 dan max 20";
				}else{
					if($newPass!=$newPass2){
						echo "Ulangi password baru, password baru tidak cocok!";
					}else{
						$data=array('user'=>$valuser,'password'=>md5($newPass));
						if($user->setUser($logid,$data)){
							echo "Password berhasil diubah.";
						}
					}
				}
			}
		}else{
			if(strlen($valuser)<6 or strlen($valuser)>20){
				echo "Min karakter UserID=6 dan max 20";
			}else{
				if(md5($_POST['oldPass'])!=$user->getField('password',$logid)){
					echo "Silahkan masukan password lama dengan benar!";
				}else{
					if(strlen($newPass)<6 or strlen($newPass)>20 and strlen($newPass2)<6 or strlen($newPass2)>20){
						echo "Min karakter 6 dan max 20";
					}else{
						if($newPass!=$newPass2){
							echo "Ulangi password baru, password baru tidak cocok!";
						}else{
							$data=array('user'=>$valuser,'password'=>md5($newPass));
							if($user->setUser($logid,$data)){
								echo "Password berhasil diubah.";
							}
						}
					}
				}
			}
		}
	break;
}
?>
