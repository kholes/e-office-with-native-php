<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtbarang.cls.php";
$db=new Db();
$db->conDb();
$barang=new Dtbarang();
$btn=$_POST['btn'];
$id_brg=$_POST['id_brg'];
$qty=$_POST['qty'];
switch($btn){
	case 'getBrg':
		$kategori=$_POST['kategori'];
		echo "<select name='brg' id='brg'>";
		$brg=$barang->getWhere('kategori',$kategori);
		foreach($brg as $rbrg){
			echo "<option value='$rbrg[id]'>$rbrg[nama]</option>";	
		}
		echo "</select>";
	break;
	case 'getTemp':
		$sel=mysql_query("select * from tempbarcode");
		while($row=mysql_fetch_assoc($sel))
		$data[]=$row;
		if($data!=array()){
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="2%">No</th>
			<th width="74%" align="left">Kode Barang </th>
			<th width="18%">Jumlah</th>
			<th colspan="2">&nbsp;</th>
		<?php
		foreach($data as $row){
		?>
		  <tr>
			<td><?php echo $c=$c+1;?></td>
			<td><?php echo $barang->getField('nama',$row['id_brg']);?></td>
			<td><input type="text" name="qty" id="qty<?php echo $row['id_brg'];?>" value="<?php echo $row['qty'];?>"></td>
			<td width="3%"><a onClick="editTemp('<?php echo $row['id_brg'];?>');"><img src="img/edit.png"></a></td>
			<td width="3%"><a onClick="delTemp('<?php echo $row['id_brg'];?>');"><img src="img/hapus.png"></a></td>
		  </tr>
		<?php
		}
		?>
		</table>
	<?php
	}
	break;
	case 'addTemp':
		$sel=mysql_query("select * from tempbarcode where id_brg='$id_brg'");
		while($dsel=mysql_fetch_assoc($sel))
		$rsel[]=$dsel;
		if($rsel['id_beg']!=''){
			$sql=mysql_query("update tempbarcode set qty='$qty' where id_brg='$id_brg'");
		}else{
			$sql=mysql_query("insert into tempbarcode value('$id_brg','$qty')");
		}
	break;
	case 'editTemp':
		$sql=mysql_query("update tempbarcode set qty='$qty' where id_brg='$id_brg'");
	break;
	case 'delTemp':
		$sql=mysql_query("delete from tempbarcode where id_brg='$id_brg'");
	break;
}
?>