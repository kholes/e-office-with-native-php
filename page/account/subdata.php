<?php
session_start();
include "../../lib/lib.php";
include "../../class/sub.cls.php";
$db=new Db();
$db->conDb();
$sub=new Sub();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case '':
		$data=$sub->getAll();	
		tabel($data);
	break;
}
function tabel($data){
if ($data!=0){
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
		<th width="3%">No</th>
			<th width="92%" align="left">Sub / Bagian</th>
			<?php
			foreach($data as $row){	  	
				if ($counter % 2 == 0)$warna = $warnaGenap; else $warna = $warnaGanjil;
			?>
			<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>');"  onmouseout="this.style.background='#fff';">
			<td width="3%" align="center"><?php echo $c=$c+1;?></td>
			<td width="92%"><?php echo $row['id']; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
	}else{ 
		echo "<p class='pesan'>Data pangkat tidak ditemukan.</p>"; 
	}
}
?>