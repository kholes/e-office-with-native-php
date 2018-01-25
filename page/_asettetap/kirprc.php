<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkir.cls.php";
$db=new Db();
$db->conDb();
$kibb=new Dtkibb();
$id=$_GET['id'];
$req=$_POST['req'];
switch($req){
	case 'add':
		$id=$_POST['id'];
		$idbrg=$_POST['idbrg'];
		$kode=$kibb->getField('kode',$idbrg);
		if($kode!=''){
			if($idbrg!=''){
				$c=mysql_query("select * from tempkir where kode='$kode'");
				$num=mysql_num_rows($c);
				if($num!='0'){
					while($rc=mysql_fetch_assoc($c)){
						$v=explode(',',$rc['idbarang']);
						$ck=array_search($idbrg,$v);
						$t="a".$ck;
						if($t=="a"){
							$n=$rc['jumlah']+1;
							$nid=$rc['idbarang'].",".$idbrg;
							$upd=mysql_query("update tempkir set idbarang='$nid',jumlah='$n' where kode='$kode'");
							if($upd){
								echo "Update data barang berhasil.";
							}
						}else{
							echo "Data ID : $idbrg, sudah terdapat di KODE : $kode.";
						}
					}
				}else{
					$c=$kibb->getCount($idbrg);
					if($c>'0'){
						$sql=mysql_query("insert into tempkir values ('$id','$kode','$idbrg','1')");
						if($sql){
							echo "Jenis barang berhasil ditambahkan.";
						}
					}else{
						echo "Data barang : $idbrg, tidak ditemukan.";
					}
				}			
			}
		}else{
			echo "ID :$idbrg, tidak memiliki kode barang.";
		}
	break;
	case 'save':
		$id=$_POST['id'];
		$unit=$_POST['unit'];
		$bidang=$_POST['bidang'];
		$ruangan=$_POST['ruangan'];
		$lokasi=$_POST['lokasi'];
		$sql=mysql_query("insert into dtkir values ('$id','$unit','$bidang','$ruangan','$lokasi')");
		if($sql){
			$temp=mysql_query("select * from tempkir");
			while($row=mysql_fetch_assoc($temp)){
				$item=mysql_query("insert into dtkiritem values ('{$row['idkir']}','{$row['kode']}','{$row['idbarang']}','{$row['jumlah']}')");
				$arbrg=$row['idbarang'];
				$nbrg=explode(',',$arbrg);
				$xn=sizeof($nbrg);
				for($i=0;$i<$xn;$i++){
					mysql_query("update dtkibb set idkir='$id' where id='$nbrg[$i]'");
				}
			}
			mysql_query("delete from tempkir");
		}
	break;
	case 'update':
		$id=$_POST['id'];
		$unit=$_POST['unit'];
		$bidang=$_POST['bidang'];
		$ruangan=$_POST['ruangan'];
		$lokasi=$_POST['lokasi'];
		$sql=mysql_query("update dtkir set unit='$unit',bidang='$bidang',ruangan='$ruangan',lokasi='$lokasi' where id='$id'");
		if($sql){
			$temp=mysql_query("select * from dtkiritem where idkir='$id'");
			while($row=mysql_fetch_assoc($temp)){
				//$item=mysql_query("insert into dtkiritem values ('{$row['idkir']}','{$row['kode']}','{$row['idbarang']}','{$row['jumlah']}')");
				$arbrg=$row['idbarang'];
				$nbrg=explode(',',$arbrg);
				$xn=sizeof($nbrg);
				for($i=0;$i<$xn;$i++){
					mysql_query("update dtkibb set idkir='$id' where id='$nbrg[$i]'");
				}
			}
			mysql_query("delete from tempkir");
		}
	break;
	case 'viewtemp':
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
		  <tr bgcolor="#eee">
			<td width="2%" rowspan="2" id="thick-th" style="vertical-align:middle;">No</td>
			<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle;">Nama Barang </td>
			<td width="10%" rowspan="2" id="thick-th" style="vertical-align:middle;">Merek/ Model </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">No. Pabrik </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">Ukuran/cc</td>
			<td width="7%" rowspan="2" id="thick-th" style="vertical-align:middle;">Bahan</td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">Thn. Perolehan</td>
			<td width="9%" rowspan="2" id="thick-th" style="vertical-align:middle;">Kode Barang </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">No. Registrasi </td>
			<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle;">Nilai (Rp)</td>
			<td align="center" colspan="3" id="thick-th">Keadaan Barang </td>
			<td width="11%" rowspan="2" id="thick-th" style="vertical-align:middle;">Keterangan Mutasi dll</td>
			<td width="3%" rowspan="2" id="thick-th" style="vertical-align:middle;"><input type="checkbox" id="sel" onclick="cek();" /></td>
		  </tr>
		  <tr bgcolor="#eee">
			<td width="8%" id="thick-th">Baik (B)</td>
			<td width="8%" id="thick-th">Kurang Baik (KB)</td>
			<td width="8%" id="thick-th">Rusak Berat (RB)</td>
		  </tr>		  
			<?php
			
			$sql=mysql_query("select * from tempkir");
			while($row=mysql_fetch_assoc($sql)){
					$v=explode(',',$row['idbarang']);
					$a=sizeof($v);
					$b=0;$kb=0;$rb=0;
					for ($i=0;$i<$a;$i++){
						$kbb=mysql_query("select kondisi from dtkibb where id='$v[$i]'");
						while($f=mysql_fetch_row($kbb)){
							if($f[0]=='B'){$b++;}
							if($f[0]=='KB'){$kb++;}
							if($f[0]=='RB'){$rb++;}
						}
					}
			?>
		  <tr>
			<td align="center"><?php echo $c=$c+1;?></td>
			<td><?php echo $kibb->getField('nama',$v[0]);?></td>
			<td><?php echo $kibb->getField('merek',$v[0]);?></td>
			<td><?php echo $kibb->getField('no_pabrik',$v[0]);?></td>
			<td><?php echo $kibb->getField('ukuran',$v[0]);?></td>
			<td><?php echo $kibb->getField('bahan',$v[0]);?></td>
			<td><?php echo $kibb->getField('thn_beli',$v[0]);?></td>
			<td><?php echo $kibb->getField('kode',$v[0]);?></td>
			<td><?php echo $kibb->getField('register',$v[0]);?></td>
			<td align="right"><?php echo format_angka($kibb->getField('harga',$v[0]));?></td>
			<td align="center"><?php echo $b;?></td>
			<td align="center"><?php echo $kb;?></td>
			<td align="center"><?php echo $rb;?></td>
			<td><?php echo $kibb->getField('keterangan',$v[0]);?></td>
			<td><input type="checkbox" id="pilih" name="pilih[]" value="<?php echo $row['kode'];?>" /></td>
		  </tr>
		<?php
		}
		?>
		</table>
		<?php
	break;
	case 'viewitem':
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl">
		  <tr bgcolor="#eee">
			<td width="2%" rowspan="2" id="thick-th" style="vertical-align:middle;">No</td>
			<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle;">Nama Barang </td>
			<td width="10%" rowspan="2" id="thick-th" style="vertical-align:middle;">Merek/ Model </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">No. Pabrik </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">Ukuran/cc</td>
			<td width="7%" rowspan="2" id="thick-th" style="vertical-align:middle;">Bahan</td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">Thn. Perolehan</td>
			<td width="9%" rowspan="2" id="thick-th" style="vertical-align:middle;">Kode Barang </td>
			<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle;">No. Registrasi </td>
			<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle;">Nilai (Rp)</td>
			<td align="center" colspan="3" id="thick-th">Keadaan Barang </td>
			<td width="11%" rowspan="2" id="thick-th" style="vertical-align:middle;">Keterangan Mutasi dll</td>
			<td width="3%" rowspan="2" id="thick-th" style="vertical-align:middle;"><input type="checkbox" id="sel" onclick="cek();" /></td>
		  </tr>
		  <tr bgcolor="#eee">
			<td width="8%" id="thick-th">Baik (B)</td>
			<td width="8%" id="thick-th">Kurang Baik (KB)</td>
			<td width="8%" id="thick-th">Rusak Berat (RB)</td>
		  </tr>		  
			<?php
			$id=$_POST['id'];
			$sql=mysql_query("select * from dtkiritem where idkir='$id'");
			while($row=mysql_fetch_assoc($sql)){
					$v=explode(',',$row['idbarang']);
					$a=sizeof($v);
					$b=0;$kb=0;$rb=0;
					for ($i=0;$i<$a;$i++){
						$kbb=mysql_query("select kondisi from dtkibb where id='$v[$i]'");
						while($f=mysql_fetch_row($kbb)){
							if($f[0]=='B'){$b++;}
							if($f[0]=='KB'){$kb++;}
							if($f[0]=='RB'){$rb++;}
						}
					}
			?>
		  <tr>
			<td align="center"><?php echo $c=$c+1;?></td>
			<td><?php echo $kibb->getField('nama',$v[0]);?></td>
			<td><?php echo $kibb->getField('merek',$v[0]);?></td>
			<td><?php echo $kibb->getField('no_pabrik',$v[0]);?></td>
			<td><?php echo $kibb->getField('ukuran',$v[0]);?></td>
			<td><?php echo $kibb->getField('bahan',$v[0]);?></td>
			<td><?php echo $kibb->getField('thn_beli',$v[0]);?></td>
			<td><?php echo $kibb->getField('kode',$v[0]);?></td>
			<td><?php echo $kibb->getField('register',$v[0]);?></td>
			<td align="right"><?php echo format_angka($kibb->getField('harga',$v[0]));?></td>
			<td align="center"><?php echo $b;?></td>
			<td align="center"><?php echo $kb;?></td>
			<td align="center"><?php echo $rb;?></td>
			<td><?php echo $kibb->getField('keterangan',$v[0]);?></td>
			<td><input type="checkbox" id="pilih" name="pilih[]" value="<?php echo $row['kode'];?>" /></td>
		  </tr>
		<?php
		}
		?>
		</table>
	<?php
	break;
}
?>
        
