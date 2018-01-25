<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtkibc.cls.php';
$db=new Db();
$db->conDb();
$dtkibc=new Dtkibc();
$pp=$_GET['pp'];
$link='?pp='.$pp;
?>
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<div style="width:1400px;position:absolute;left:20px; margin-top:20px">
<style>
.body{margin:0; padding:0;}
</style>
<h3 align="center">KARTU INVENTARIS BARANG (KIB) C</h3>
<h3 align="center">BARCODE LAYOUT</h3>
<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;$per_page = $pp;$point = ($page * $per_page) - $per_page;
$statement = "dtkibc";
$sql = mysql_query("SELECT * FROM $statement order by id LIMIT $point, $per_page");
while($row=mysql_fetch_assoc($sql))
$data[]=$row;
if($data!=array()){
	foreach($data as $row){
		$bdata=$row['id'];
		$array = array('encode'=>'CODE128','bdata'=>$bdata,'height'=>'30','scale'=>'2','bgcolor'=>'#FFFFFF','color'=>'#000000','file'=>'','type'=>'png');
		?>
		<div style="padding:5px;width:410px;height:125px; margin-right:15px; margin-top:30px;float:left;background-color:white; text-align:center;">
		<?php
			foreach($array as $keys=>$value){
				$qstr.=$keys."=".urlencode($value)."&";
			}
		?>
			<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td rowspan="3" style="border:1px solid #000000; padding-top:25px;"><img src="../../img/logo.png" width="92" height="80"></td>
					</tr>
					<tr>
						<td style="border:1px solid #000000" align="center"><p style="font-weight:bold; font-size:16px; margin-bottom:5px; letter-spacing:2px;"><?php echo $bdata=$row['kode'];?></p></td>
					</tr>
					<tr>
						<td style="border:1px solid #000000;"><img src='prnkibb.php?<?php echo $qstr;?>'></td>
					</tr>
			</table>
		</div>
		<?php
	}
	?>
	<div style="clear:both; height:10px;"></div>
	<div id="paging">
		<div id="pagination">
			<?php
			$url=$link;
			$id='id';
			echo pagination($statement,$per_page,$page,$url,$id);
		?>
		</div>
		<p align="center"><a onClick="window.print();"><img src="../../img/print.png"></a></p>
	</div>	
	<?php
}else{
	echo "<h3>Data barang kosong.</h3>";
}
?>
</div>
