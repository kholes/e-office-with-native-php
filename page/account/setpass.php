<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtmail_in.cls.php";
include "../../class/pegawai.cls.php";
include "../../class/user.cls.php";
$link='?p='.encrypt_url('surat');
$linkdata="page/account/accountprc.php";
$db=new Db();
$db->conDb();
$mail=new Mail();
$peg=new Pegawai();
$user=new User();
$logid=decrypt_url($_SESSION['id_user']);
$level=$user->getField('level',$logid);
?><head>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
			location.reload();
		});
	});
	function cekFrm(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
			data:'btn=upd&user='+$('#user').val()+'&oldPass='+$('#oldPass').val()+'&newPass='+$('#newPass').val()+'&newPass2='+$('#newPass2').val()+'',
			cache:false,
			success:function(data){
				alert(data);
			}
		});
	}
	function cekId(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata;?>',
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
			url:'<?php echo $linkdata;?>',
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
			url:'<?php echo $linkdata;?>',
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
			url:'<?php echo $linkdata;?>',
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
			url:'<?php echo $linkdata;?>',
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
			url:'<?php echo $linkdata;?>',
			data:'btn=machPass&val='+$('#newPass').val()+'&val1='+$('#newPass2').val()+'',
			cache:false,
			success:function(data){
				$('#infNewP2').html(data);
			}
		});
	}
</script>
</head>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">Setting Password</h2>
		<div class="c"></div>
	</div>
	<div id="form-dis" style="height:180px; overflow:auto;background:#fff; padding:10px 0px 10px 10px;">
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
			<div style="float:left"><span id="infSave"></span></div>
			<div style="float:right"></div>
			</td>
	</tr>
</table>
	  <div style="position:absolute; bottom:12px; right:33px;"><input type="submit" name="simpan" value="Simpan" onclick="cekFrm();" /></div>
</div>
</body>