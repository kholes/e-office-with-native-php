<link href="css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/calendar2.js"></script>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
	});
	$(document).ready(function(){
		//$('#thick-conten,#thick-wrapper').corner('round bl br tl tr 7px');
	});
	$(document).ready(function(){
		//$('.btn').corner('round bl br tl tr 5px');
		getKode();
	});
</script>
<body>
<?php
include "../class/dtklasifikasi.cls.php";
include "../class/dtkode.cls.php";
include "../lib/lib.php";
$date=new DateTime();
$klas=new Dtklasifikasi();
$kode=new Dtkode();
$db=new Db();
$db->conDb();
?>
<div id="thick-wrapper">
<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l"> &raquo; Form Surat Masuk</h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
		<div id="thick-frm">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="thick-tbl">
			  <tr>
				<td width="238">NO. SURAT </td>
				<td width="31">&nbsp;</td>
				<td><input type="text" name="nosurat" id="nosurat"></td>
			  </tr>
			  <tr>
				<td>INDEX SURAT </td>
				<td>&nbsp;</td>
				<td>
				<select name="noindex" id="noindex" onChange="getKode();">
                <?php
				$x=$klas->getAll();
				foreach($x as $row){
					echo "<option value=".$row['id'].">".$row['klasifikasi']."</option>";
				}
				?>
                </select>
				</td>
			  </tr>
			  <tr>
			  	<td><span class="frm">KODE SURAT </span></td>
				<td>&nbsp;</td>
				<td width="703" class="frm"><span id="infKode"></span></td>
			  </tr>
			  <tr>
				<td>TANGGAL</td>
				<td>&nbsp;</td>
				<td><input type="text" class="tgl" name="tanggal" id="tanggal" value="<?php echo $date->format('d-m-Y'); ?>"  onclick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
			  </tr>
			  <tr>
				<td>ASAL SURAT </td>
				<td>&nbsp;</td>
				<td><input type="text" name="dari" id="dari"></td>
			  </tr>
			  <tr>
				<td>KETERANGAN</td>
				<td>&nbsp;</td>
				<td><textarea name="rangkuman" id="rangkuman"></textarea></td>
			  </tr>
			</table>
		</div>
	</div>
	<div id="thick-bottom">
		<div id="thick-menu"><input type="submit" name="btn" class="btn" id="simpan" value="Simpan"></div>
	</div>
</form>
</div>
</body>