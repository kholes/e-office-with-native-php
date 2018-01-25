<?php
include "lib/lib.php";
$db=new Db();
$db->conDb();
$log=new Login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="shortcut icon" href="img/logo-mini.png" /><title>User Login</title>
</head>
<body>
<div align="center"><img src="img/header-login.png" /></div>
<div class="running">
		<marquee behavior="alternate" scrollamount="3" onMouseOver="this.setAttribute('scrollamount', 1, 0);" onMouseOut="this.setAttribute('scrollamount', 3, 0);" onMouseDown="this.stop();" onMouseUp="this.start();" width="100%" style="float:right;">
			<h3 style="color:#fff; letter-spacing:2px;"><img src="img/logo-mini.png" align="left" />&nbsp;&nbsp;&nbsp;SISTEM APLIKASI E-OFFICE BADAN PENGHUBUNG PEMERINTAH PROVINSI SUMATERA BARAT&nbsp;&nbsp;&nbsp;<img src="img/logo-eo-mini.png" align="right" /></h3>
		</marquee>
</div>
<div class="wrp" style="margin-top:100px;">
	<div class="login" style="margin-top:50px;">
		<div class="frm">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="86"><p>USER ID</p> </td>
					<td width="218" align="right"><input type="text" name="user" id="iduser" /></td>
				  </tr>
				  <tr>
					<td><p>PASSWORD</p></td>
					<td align="right"><input type="password" name="pass" id="idpass" /></td>
				  </tr>
				  <tr>
					<td colspan="2" align="right"><input type="submit" name="btnlogin" id="idbtnlogin" value="MASUK" />
					</td>
				  </tr>
				</table>
		</form>
		</div>
		<div class="warn">
			<h1><img src="img/key-icon.png" /> E-Office Login </h1>
			<p>
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					$login=$log->logsys($_POST['user'], $_POST['pass']);
					echo $login;
				}
				?>
			</p>
		</div>
		<div class="c"></div>
	</div>
</div>
</body>
</html>
