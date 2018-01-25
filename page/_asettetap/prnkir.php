<?php
include "../../lib/lib.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkir.cls.php";
include "../../class/user.cls.php";
$db=new Db();
$db->conDb();
$dtkir=new Dtkir();
$dtkibb=new Dtkibb();
$id=$_GET['id'];
$kir=$dtkir->getWhere('id',$id);
foreach($kir as $rkir){
?>
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<div id="header">
<h2>KARTU INVENTARIS RUANGAN (KIR)</h2>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="159" class="b">UNIT KERJA </td>
    <td width="15" class="b">:</td>
    <td width="284"><?php echo $rkir['unit'];?></td>
    <td width="234">&nbsp;</td>
    <td width="149">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="116">&nbsp;</td>
  </tr>
  <tr>
    <td class="b">SUB UNIT BIDANG </td>
    <td class="b">:</td>
    <td width="284"><?php echo $rkir['bidang'];?></td>
    <td width="234">&nbsp;</td>
    <td width="149">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="116">&nbsp;</td>
  </tr>
  <tr>
    <td class="b">NAMA RUANGAN </td>
    <td class="b">:</td>
    <td width="284"><?php echo $rkir['ruangan'];?></td>
    <td width="234">&nbsp;</td>
    <td width="149" class="b">KODE RUANGAN</td>
    <td width="15" class="b">:</td>
    <td width="116" align="right"><?php echo $rkir['lokasi'];?></td>
  </tr>
  <tr>
  	<td colspan="8">
		<span id="infItem">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
		  <tr>
			<td width="3%" rowspan="2" class="b">No</td>
			<td width="10%" rowspan="2" class="b">Nama Barang </td>
			<td width="13%" rowspan="2" class="b">Merek/ Model </td>
			<td width="6%" rowspan="2" class="b">No. Pabrik </td>
			<td width="8%" rowspan="2" class="b">Ukuran/cc</td>
			<td width="5%" rowspan="2" class="b">Bahan</td>
			<td width="7%" rowspan="2" class="b">Thn. Perolehan</td>
			<td width="8%" rowspan="2" class="b">Kode Barang </td>
			<td width="8%" rowspan="2" class="b">No. Registrasi </td>
			<td width="6%" rowspan="2" class="b">Nilai (Rp)</td>
			<td align="center" colspan="3" class="b">Keadaan Barang </td>
			<td width="7%" rowspan="2" class="b">Ket</td>
		  </tr>
		  <tr>
			<td width="6%" align="center" class="b">B</td>
			<td width="6%" align="center" class="b">KB</td>
			<td width="7%" align="center" class="b">RB</td>
		  </tr>		  
			<?php
			$sql=mysql_query("select * from dtkiritem where idkir='{$rkir['id']}'");
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
			<td><?php echo $dtkibb->getField('nama',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('merek',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('no_pabrik',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('ukuran',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('bahan',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('thn_beli',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('kode',$v[0]);?></td>
			<td><?php echo $dtkibb->getField('register',$v[0]);?></td>
			<td align="right"><?php echo format_angka($dtkibb->getField('harga',$v[0]));?></td>
			<td align="center"><?php echo $b;?></td>
			<td align="center"><?php echo $kb;?></td>
			<td align="center"><?php echo $rb;?></td>
			<td><?php echo $dtkibb->getField('keterangan',$v[0]);?></td>
		  </tr>
		<?php
		}
		?>
		</table>
		</span>
		<div id="head" align="right">
		  <input type="button" name="cetak" id="cetak" onclick="window.print();" value="Cetak">
	  </div>	
	  </td>
  </tr>
</table>
<?php
}
?>