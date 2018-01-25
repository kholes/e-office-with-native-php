<?php
include '../../lib/barcode.php';
include '../../lib/lib.php';
include '../../class/dtbarang.cls.php';
$db=new Db();
$db->conDb();
$barang= new Dtbarang();
$encode="CODE128";
$height="50";
$scale="2";
$bgcolor="#FFFFFF";
$color="#000000";
$file="";
$type="PNG";
$sql=mysql_query("select * from tempbarcode");
while($r=mysql_fetch_assoc($sql))
$x[]=$r;
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css">
<div style="width:1400px;position:absolute;left:20px; margin-top:20px">
<style>
.body{margin:0; padding:0;}
</style>
<?php
if($x!=array()){	
	foreach($x as $data){
		for($i=0;$i<$data['qty'];$i++){
			$bdata=$data['id_brg'];
			$arraybar = array('encode'=>'CODE39','bdata'=>$bdata,'height'=>'40','scale'=>'2.5','bgcolor'=>'#FFFFFF','color'=>'#000000','file'=>'','type'=>'png');
		?>
			<div style="padding:5px;font-size:11px;width:430px;height:205px; margin-right:15px; margin-top:30px;float:left;background-color:white; text-align:center;">
				<?php
					foreach($arraybar as $keys=>$value){
						$qstr.=$keys."=".urlencode($value)."&";
					}
					echo "<img src='prnbarcode.php?$qstr'>";
				?>
			</div>
		<?php
		}
	}
}else{
	echo "<h3>Data barang kosong.</h3>";
}
?>

</div>
<div id="menu"><a onClick="window.print();"><img src="../../img/print.png"></a></div>