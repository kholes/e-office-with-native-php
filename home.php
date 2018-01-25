<?php
session_start();
include "lib/lib.php";
include "class/user.cls.php";
include "class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$pegawai=new Pegawai();
$log=new Login();
$logid=decrypt_url($_SESSION['id_user']);
$iduser=$user->getField('id_user',$logid);
$linkdata='page/surat/mailprc.php';
$link='?p='.encrypt_url('surat');
if($logid != $iduser or $logid=='' or $iduser==''){
	header("location:index.php");
}else{
?>
<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
		<link rel="shortcut icon" href="img/logo-mini.png" />
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/jquery.autocomplete.css">
		<link href="css/calendar.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" >
		<script type="text/javascript" src="js/jquery.js"></script>
		
		<!--
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
		<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
		-->
		<script type="text/javascript" src="js/jquery.corner.js"></script>
		<script type="text/javascript" src="js/jquery.media.js"></script> 
		<script type="text/javascript" src="js/calendar.js"></script>
		<script type="text/javascript" src="js/calendar2.js"></script>
		<script type="text/javascript" src="js/lib.js"></script> 
		<script type="text/javascript" src="js/news.js"></script> 
		<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
		<link rel="stylesheet" href="js/thick/thickbox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/thick/thickbox.js"></script>
		<script type="text/javascript" src="js/jquery.purr.js"></script>
		<script type="text/javascript" src="js/autocomplete.js"></script>		
		<!--
		<script type="text/javascript" src="js/jscolor.js"></script>
		<script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
		<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
		<script type="text/javascript" src="js/jquery.metadata.js"></script>         
		-->
		<script>		
			tinyMCE.init({
				mode : "exact",
				elements : "elm1",
				theme : "simple"
			});
		
			$(function() {
			var flag;
			setInterval(function() {
			   if(flag == 0) {
				  $('.text-blink').css({'color':'blue'});
				  flag = 1;
			   }else{
				  if(flag = 1) {
					 $('.text-blink').css({'color':'red'});
					 flag = 0;                  
				  }
			   }
			}, 500); 
		});
		$(document).ready(function(){
			$('#menu-pop').hide();
		});
		function menu_pop_show(){
			$('#menu-pop').show();
		}
		function menu_pop_hide(){
			$('#menu-pop').hide();
		}
		function cekFrm(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=upd&user='+$('#user').val()+'&oldPass='+$('#oldPass').val()+'&newPass='+$('#newPass').val()+'&newPass2='+$('#newPass2').val()+'',
					cache:false,
					success:function(data){
						alert(data);
						$('#menu-pop').hide();
					}
				});
			}
			function cekId(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=cekId&val='+$('#user').val()+'',
					cache:false,
					success:function(data){
						$('#infID').html(data);
					}
				});
			}
			function cekOldPass(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=cekOldPass&val='+$('#oldPass').val()+'',
					cache:false,
					success:function(data){
						$('#infOldPass').html(data);
					}
				});
			}
			function charPass(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=charPass&val='+$('#oldPass').val()+'',
					cache:false,
					success:function(data){
						$('#infOldPass').html(data);
					}
				});
			}
			function machChar(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=machChar&val='+$('#newPass').val()+'',
					cache:false,
					success:function(data){
						$('#infNewP').html(data);
					}
				});
			}
			function machChar2(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=machChar&val='+$('#newPass2').val()+'',
					cache:false,
					success:function(data){
						$('#infNewP2').html(data);
					}
				});
			}
			function machPass(){
				$.ajax({
					type:'post',
					url:'page/account/accountprc.php',
					data:'btn=machPass&val='+$('#newPass').val()+'&val1='+$('#newPass2').val()+'',
					cache:false,
					success:function(data){
						$('#infNewP2').html(data);
					}
				});
			}
	</script>
	<title>e-Office KPHB</title>
    </head>
    <body>
		<div id="top">
		<div class="wrp">
		<div class="c10"></div>
		<div class="l" style="display:block; width:15%; float:left;"><img src="img/logo.png" width="135" height="119"></div>
		<div class="l" style="display:block; width:70%; margin-top:30px; float:left;"><h1>BADAN PENGHUBUNG <br>PEMERINTAH PROVINSI SUMATERA BARAT</h1></div>
		<div class="l" style="display:block; width:15%; float:left;" align="right"><div style="padding-right:5px;"><img src="img/eoffice-logo.png"></div></div>
		</div>
		</div>
		<div class="top-menu">
			<?php include "menu.php";?>
		</div>
		<?php 
		include "loader.php"; 
		?>
		<div class="mini-form" id="menu-pop">
			<div class="mini-form-head">
				<a onclick="menu_pop_hide();" class="right"><li class="fa fa-times icon-medium"></li></a>
				<h2 class="left"><li class="fa fa-key"></li> Setting Password</h2>
				<div class="c"></div>
			</div>
			<div class="mini-form-content">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="33%">Login ID</td>
					<td width="57%">
						<input type="text" name="user" maxlength="30" style="width:100%" id="user" onblur="cekId();" value="<?php echo $user->getField('login_id',$logid);?>" />
					</td>
					<td width="10%" style="vertical-align:middle;"><span id="infID"></span></td>
				</tr>
				<tr>
					<td>Password Lama</td>
					<td>
						<input type="password" name="oldPass" maxlength="30" style="width:100%" id="oldPass" onblur="cekOldPass();" />
					</td>
					<td><span id="infOldPass"></span></td>
				</tr>
				<tr>
					<td>Password Baru</td>
					<td>
						<input type="password" name="newPass" maxlength="30" style="width:100%" id="newPass" onblur="machChar();" />
					</td>
					<td><span id="infNewP"></span></td>
				</tr>
				<tr>
					<td>Ulangi Password</td>
					<td>
						<input type="password" name="newPass2" maxlength="30" style="width:100%" id="newPass2" onblur="machChar2();machPass();" />
					</td>
					<td><span id="infNewP2"></span></td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<div><span id="infSave"></span></div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="position:absolute; bottom:12px; right:33px;">
							<input type="submit" name="simpan" value="Simpan" onclick="cekFrm();" />
						</div>
					</td>
				</tr>
			</table>
			<div class="c"></div>
			</div>
		</div>
    </body>
</html>	
<?php
}
?>

