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
			<h3>PERALATAN DAN MESIN</h3>
			<div class="c10"></div>
			<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
				<tr bgcolor="#eee">
					<td width="16%" rowspan="2" id="thick-th">Jenis / Nama Barang</td>
					<td width="24%" rowspan="2" id="thick-th">Merek/Type</td>
					<td width="10%" rowspan="2" id="thick-th">Ukuran/cc</td>
					<td width="6%" rowspan="2" id="thick-th">Bahan</td>
					<td width="9%" rowspan="2" id="thick-th">Th.Pembelian</td>
					<td colspan="5" align="center" id="thick-th">Nomor</td>
				  <td width="5%" rowspan="2" id="thick-th">Terpilih</td>
				</tr>
				<tr bgcolor="#eee">
					<td width="6%" id="thick-th">Pabrik</td>
					<td width="6%" id="thick-th">Rangka</td>
					<td width="6%" id="thick-th">Mesin</td>
					<td width="6%" id="thick-th">Polisi</td>
					<td width="6%" id="thick-th">BPKB</td>
				</tr>
				<?php
				$xb=$kibb->getWhere('idkir','');
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
						<td><input type="hidden" name="btn" value="Tambah" /><?php echo $row['nama'];?></td>
						<td><?php echo $row['merek'];?></td>
						<td><?php echo $row['ukuran'];?></td>
						<td><?php echo $row['bahan'];?></td>
						<td><?php echo $row['thn_beli'];?></td>
						<td><?php echo $row['no_pabrik'];?></td>
						<td><?php echo $row['no_rangka'];?></td>
						<td><?php echo $row['no_mesin'];?></td>
						<td><?php echo $row['no_polisi'];?></td>
						<td><?php echo $row['no_bpkb'];?></td>
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
