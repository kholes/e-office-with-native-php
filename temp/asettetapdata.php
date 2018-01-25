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
			<th width="8%" align="left"><a href="">Kode</a></th>
		    <th width="10%" align="left"><a href="">Nama</a></th>
		    <th width="15%" align="left"><a href="">Merek</a></th>
		    <th width="15%" align="left"><a href="">Type</a></th>
		    <th width="15%" align="left"><a href="">Ukuran</a></th>
		    <th width="15%" align="left"><a href="">Bahan</a></th>
			<th width="15%" align="left"><a href="">Tahun pembelian</a></th>
			<th width="7%" align="right">&nbsp;</th>
	</table>
</div>
<form name="MyForm" style="background:#fff">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	while ($row = mysql_fetch_array($data)) {
	?>
	<tr onmouseover="this.style.cursor='pointer';">
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
	<tr>
		<td colspan="8" align="right"><input type="checkbox" id="sel" onclick="cek();" /></td>
	</tr>
</table>
</form>
<div id="pagination">
<?php
$sts=$_GET['sts'];
$url=encrypt_url('entrisurat').'&sts='.$sts.'&i='.$i;
echo pagination($statement,$per_page,$page,$url);
?>
</div>