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
		<div id="label-form">
			<li class="fa fa-file-text">   <label>LAPORAN BARANG KELUAR</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
	</div>
	<div id="thick-conten">
	<div id="thick-frm">
		<form method="post" action="<?php echo $link;?>" enctype="multipart/form-data" id="MyForm">
			<input type="hidden" name="id" id="id" value="<?php echo $id;?>">			
			<div>
			<h3>T A N A H</h3>
			<div class="c10"></div>
			<table width="100%" cellpadding="0" cellspacing="0" id="thick-tbl">
				<tr bgcolor="#eee">
					<td rowspan="2" id="thick-th" style="vertical-align:middle">No</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Jenis/Nama Barang</td>
					<td colspan="2" id="thick-th">Nomor</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Luas (M2)</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Tahun</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Letak/Alamat</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Penggunaan</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Asal-usul</td>
					<td rowspan="2" id="thick-th" style="vertical-align:middle">Keterangan</td> 
					<td width="5%" rowspan="2" id="thick-th" style="vertical-align:middle">Terpilih</td>
				</tr>
				<tr bgcolor="#eee">
					<td id="thick-th">Kode</td>
					<td id="thick-th">Register</td>
				</tr>
				<?php
				$xb=$kiba->getWhere('idkir','');
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
						<td><?php echo $row['nama'];?></td>
						<td><?php echo $row['kode'];?></td>
						<td><?php echo $row['register'];?></td>
						<td><?php echo $row['luas'];?></td>
						<td><?php echo $row['tahun'];?></td>
						<td><?php echo $row['alamat'];?></td>
						<td><?php echo $row['penggunaan'];?></td>
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
