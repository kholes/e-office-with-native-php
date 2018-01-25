<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];if(isset($s)){$s=$s;}else{$s='kategori';}
$cari=$_GET['cari'];
if ($page <= 0) $page = 1;$per_page = 50;$point = ($page * $per_page) - $per_page;
if(!isset($_GET['cari'])){
	$statement = "dtaset order by $s";
}else{
	$statement = "dtaset where nama like '%$cari%' or tahun_beli like '%$cari% order by $s";
}
$data = mysql_query("SELECT * FROM $statement LIMIT $point, $per_page");
?>				
<div id="head-mail">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th width="15%" align="left">NAMA ASET</th>
		    <th width="35%" align="left">
			<select>
				<option value="SEMUA">SEMUA</option>
			</select>
			</th>
		    <th width="14%" align="left"> TANGGAL</th>
		    <th width="15%" align="left"><input type="text" name="mtgl" id="mtgl"></th>
		    <th width="2%" align="left">s/d</th>
		    <th width="15%" align="left"><input type="text" name="mtgl" id="mtgl"></th>
			<th width="4%" align="left"><input type="button" name="cek" id="cek" value="Cek"></th>
	</table>
</div>
<form name="MyForm" style="background:#fff">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	while ($row = mysql_fetch_array($data)) {
	?>
	<tr onMouseOver="this.style.cursor='pointer';">
		<td width="8%" class="mail"><?php echo $row['kode']; ?></td>
		<td width="10%" class="mail"><?php echo $row['nama']; ?></td>
		<td width="15%" class="mail"><?php echo $row['merek']; ?></td>
		<td width="15%" class="mail"><?php echo $row['type']; ?></td>
		<td width="15%" class="mail"><?php echo $row['ukuran']; ?></td>
		<td width="15%" class="mail"><?php echo $row['bahan']; ?></td>
		<td width="15%" class="mail"><?php echo $row['tahun_beli']; ?></td>
		<td width="7%" class="mail" align="right"><input type="checkbox" id="aset" name="pilih[]" /></td>
	</tr>
	<?php
	}
	?>
</table>
</form>
<div id="pagination">
<?php
$sts=$_GET['sts'];
$url=encrypt_url('entrisurat').'&sts='.$sts.'&i='.$i;
echo pagination($statement,$per_page,$page,$url);
?>
</div>