<script>
$(document).ready(function(){
	
});
function ubah(id){
	window.location="<?php echo $link;?>&m=fkupd&idk="+id;
}
function cetakkir(id){
	var prnkir=null;
	if (prnkir==null){
		prnkir=open('page/asettetap/prnkir.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1300,height=600');
	}
}
</script>
<div id="head">&raquo; KARTU INVENTARIS RUANGAN (KIR)</div>
<?php
$kir=$dtkir->getAll();
if($kir!=array()){
	foreach($kir as $rkir){
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td id="thick-th" width="120">UNIT KERJA </td>
		<td id="thick-th" width="4">:</td>
		<td id="thick-th" width="188"><?php echo $rkir['unit'];?></td>
		<td id="thick-th" width="396">&nbsp;</td>
		<td id="thick-th" width="139">&nbsp;</td>
		<td id="thick-th" width="5">&nbsp;</td>
		<td id="thick-th" width="120">&nbsp;</td>
	  </tr>
	  <tr>
		<td id="thick-th">SUB UNIT BIDANG </td>
		<td id="thick-th">:</td>
		<td id="thick-th" width="188"><?php echo $rkir['bidang'];?></td>
		<td id="thick-th" width="396">&nbsp;</td>
		<td id="thick-th" width="139">&nbsp;</td>
		<td id="thick-th" width="5">&nbsp;</td>
		<td id="thick-th" width="120">&nbsp;</td>
	  </tr>
	  <tr>
		<td id="thick-th">NAMA RUANGAN </td>
		<td id="thick-th">:</td>
		<td id="thick-th" width="188"><?php echo $rkir['ruangan'];?></td>
		<td id="thick-th" width="396">&nbsp;</td>
		<td id="thick-th" width="139">KODE RUANAGN </td>
		<td id="thick-th" width="5">:</td>
		<td id="thick-th" width="120" align="left"><?php echo $rkir['lokasi'];?></td>
	  </tr>
	  <tr>
		<td colspan="8">
			<div class="c10"></div>
			<span id="infItem">
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
			  </tr>
			  <tr bgcolor="#eee">
				<td width="8%" id="thick-th">Baik (B)</td>
				<td width="8%" id="thick-th">Kurang Baik (KB)</td>
				<td width="8%" id="thick-th">Rusak Berat (RB)</td>
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
				<input type="button" name="ubbah" id="ubah" value="Ubah" onClick="ubah('<?php echo $rkir['id'];?>');">&nbsp;<input type="button" name="cetak" id="cetak" onClick="cetakkir('<?php echo $rkir['id'];?>');" value="Cetak">
			</div>
		</td>
	  </tr>
	</table>
	<?php
	}
}else{
	echo "<p class='pesan'>Data KIR belum dibuat.</p>";
}
?>