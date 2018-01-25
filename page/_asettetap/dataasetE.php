<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkiba.cls.php";
include "../../class/dtkibe.cls.php";
$db=new Db();
$db->conDb();
$kibb=new Dtkibb();
$kiba=new Dtkiba();
$kibe=new Dtkibe();
$act=$_GET['act'];
$id=$_GET['id'];
if($act!=''){
	$link="?p=".encrypt_url('asettetap')."&m=fkupd&idk=".$id;
	$id=$id;
}else{
	$link="?p=".encrypt_url('asettetap')."&m=fkir";
	$id=kdauto('dtkir','');
}
?>
<script>
	$(document).ready(function(){
		$('#batal').click(function(){
			tb_remove();
		});
		$('#tombol').click(function(){
			$('#MyForm').submit();
		});
	});
</script>
<div id="thick-wrapper">
	<div id="thick-header">
		<h2 class="r" id="batal">X</h2>
		<h2 class="l">&raquo; DATA ASET</h2>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
	<div id="thick-frm">
		<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data" id="MyForm">
			<input type="hidden" name="id" id="id" value="<?php echo $id;?>">			
			<div>
			<h3>ASET TETAP LAINNYA </h3>
			<div class="c10"></div>
			<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
				<tr bgcolor="#eee">
					<td width="2%" rowspan="2" id="thick-th" style="vertical-align:middle" align="center">No</td>
					<td width="27%" rowspan="2" id="thick-th" style="vertical-align:middle">Nama Barang </td>
					<td colspan="2" id="thick-th" align="center">Nomor</td>
					<td colspan="2" align="center" id="thick-th">Buku/Perpustakaan</td>
					<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle">Aset Renovasi </td>
					<td width="4%" rowspan="2" id="thick-th" style="vertical-align:middle">Tahun Cetak </td>
					<td width="7%" rowspan="2" id="thick-th" style="vertical-align:middle">Asal-usul</td>
					<td width="6%" rowspan="2" id="thick-th" style="vertical-align:middle">Ket.</td>
					<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle">Terpilih</td>
				</tr>
				<tr bgcolor="#eee">
					<td width="9%" id="thick-th">Kode</td>
					<td width="9%" id="thick-th">Register</td>
					<td width="13%" id="thick-th">Judul/Pencipta</td>
					<td width="12%" id="thick-th">Spesifikasi</td>
				</tr>
				<?php
				$xb=$kibe->getWhere('idkir','');
				if($xb!=array()){
					foreach($xb as $row){
					$kon=$row['kondisi'];
					switch($kon){
						case 'B':
							$bg='white';
						break;
						case 'KB':
							$bg='orange';
						break;
						case 'RB':
							$bg='red';
						break;
					}
					?>
					<tr bgcolor="<?php echo $bg;?>" onMouseOver="this.style.color='#333';this.style.color='#fff';this.style.cursor='pointer';" onClick="viewItem('<?php echo $row['id'];?>');" class="sub" id="orderID<?php echo $row['id'];?>">
						<td align="center"><?php echo $c=$c+1;?></td>
						<td><?php echo $row['nama'];?></td>
						<td><?php echo $row['kode'];?></td>
						<td><?php echo $row['register'];?></td>
						<td><?php echo $row['judul'];?></td>
						<td><?php echo $row['spesifikasi'];?></td>
						<td><?php echo $row['renovasi'];?></td>
						<td><?php echo $row['thn_beli'];?></td>
						<td><?php echo $row['asalusul'];?></td>
						<td><?php echo $row['keterangan'];?></td>
						<td align="right"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?php echo $row['id'];?>" /></td>
					</tr>
					<?php
					}
				}
				?>
			</table>
			</div>
		</form>
		</div>
	</div>
	<div id="thick-bottom">
	  <div id="thick-menu">
		  <span class="btn frm">
			<input type="button" name="btn" onclick="<?php echo $btn; ?>" id="tombol" value="Kirim" />
		  </span>
		  <div style="display:block; padding:5px; background:white; float:left; color:red; font-weight:bold; margin-left:5px;">(B)</div>
		  <div style="display:block; padding:5px; background:orange; float:left; color:#FFFFFF; font-weight:bold; margin-left:5px;">(KB)</div>
		  <div style="display:block; padding:5px; background:red; float:left; color:#FFFFFF; font-weight:bold; margin-left:5px;">(RB)</div>
	  </div>
	</div>
</div>
