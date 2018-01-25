<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/surat.cls.php";
include "../../class/pegawai.cls.php";
$db=new Db();
$db->conDb();
$surat=new Surat();
$user=new User();
$pegawai=new Pegawai();
$logid=decrypt_url($_SESSION['id_user']);
$id=$_GET['id'];
$status=$surat->getField('status',$id);
$level=$user->getField('level',$logid);
?><head>
<script src="js/jquery.corner.js"></script>
<script>
	var sts='<?php echo $status; ?>';
	var lev='<?php echo $level; ?>';
	$(document).ready(function(){
		$('#dis-wrapper,#page').corner('round tr tl bl br 7px');
		if(sts=='prc'){
			tb_remove();
		}
		if(lev!='KSI'){
			tb_remove();
		}
	});
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
	$('#dispos').click(function(){
		var chkArray = [];
		$(".ksi:checked").each(function() {
			chkArray.push($(this).val());
		});
		var dis;
		dis = chkArray.join(",") + '';
		if (dis==''){alert("Tujuan disposisi tidak dipilih.");return;}else{
			$.ajax({
				type:'post',
				url:'page/surat/suratprc.php',
					data:'req=saveDisposisi&id=<?php echo $_GET['id'];?>&dis='+dis+'&catatan='+$('#catatan').val()+'&bataswaktu='+$('#bataswaktu').val()+'',
			cache:false,
				success:function(data){
					window.location.reload();
					tb_remove();
				}
			});
		}
	});
	function Data(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn&sts=<?php echo $sts; ?>',
			cache :false,
			success:function (data){
				$('#inf-data').html(data);
			}
		});
	}
	function New(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getNew',
			cache :false,
			success:function (data){
				$('#infNew').html(data);
			}
		});
	}
	function Dis(){
		$.ajax({
			type:'post',
			url:'<?php echo $linkdata; ?>',
			data:'btn=getDis',
			cache :false,
			success:function (data){
				$('#infDis').html(data);
			}
		});
	}
</script>

<div id="thick-wrapper">
<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">Pengolahan Surat</h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
		<div id="thick-frm">
		<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
			<tr>
				<td width="25%" valign="top" class="detail" style="border:none;"><p style="font-weight:bold;">Surat dari</p></td>
				<td width="75%"><p><?php echo $surat->getField('dari',$id);?></p></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Ringkasan</p></td>
				<td><p style="text-align:justify"><?php echo $surat->getField('rangkuman',$id);?></p></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Di Tujukan </p></td>
				<td class="list-ksi detail">
				<ul>
					<?php 
					$ksi=$pegawai->getWhere('level','KSI');
					$ktu=$pegawai->getWhere('level','KTU');
					foreach($ktu as $n){
						echo "<li><input type='checkbox' value='".$n['jabatan']."' class='ksi' checked /> ".$n['jabatan']."</li>";
					}
					foreach($ksi as $row){
						echo "<li><input type='checkbox' value='".$row['jabatan']."' class='ksi' /> ".$row['jabatan']."</li>";
					}
					?>
				</ul>
				</td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Instruksi</p></td>
				<td style="border:none;" class="detail"><textarea name="catatan" id="catatan" style="height:100px;"></textarea></td>
			</tr>
			<tr>
				<td valign="top"><p style="font-weight:bold;">Batas waktu</p></td>
				<td><input type="text" name="bataswaktu" id="bataswaktu" value=""  onclick="return showCalendar('bataswaktu', 'dd-mm-y')"/></td>
			</tr>
		</table>
		</div>
	</div>
	<div id="thick-bottom">
		<div id="thick-menu"><input type="button" name="btn" class="btn" id="dispos" value="Disposisi"></div>
	</div>
</form>
</div>
</body>