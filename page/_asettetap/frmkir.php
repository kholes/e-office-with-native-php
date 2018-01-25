<?php
$link="?p=".encrypt_url('asettetap')."&m=fkir";
?>
<script>
$(document).ready(function(){
	getTemp();
	$('#add').click(function(){
		$.ajax({
			type:'post',
			url:'page/asettetap/kirprc.php',
			data:'req=add&id='+$('#id').val()+'&idbrg='+$('#idbrg').val(),
			cache :false,
			success:function (data){
				getTemp();	
				$('#infAdd').html(data);
			}
		});
	});
	$('#simpan').click(function(){
		$.ajax({
			type:'post',
			url:'page/asettetap/kirprc.php',
			data:'req=save&id='+$('#id').val()+'&unit='+$('#unit').val()+'&bidang='+$('#bidang').val()+'&ruangan='+$('#ruangan').val()+'&lokasi='+$('#lokasi').val()+'',
			cache :false,
			success:function (data){
				getTemp();	
				$('#infAdd').html(data);
			}
		});
	});
});	
function getTemp(){
	$.ajax({
		type:'post',
		url:'page/asettetap/kirprc.php',
		data:'req=viewtemp',
		cache :false,
		success:function (data){
			$('#infTemp').html(data);	
		}
	});
}
</script>
<style>
	ul {margin:0; padding:0; padding:5px;}
	ul li{ padding-right:10px;float:left;}
	ul li a{color:#fff;}
</style>
<div id="head">&raquo; PEMBUATAN KARTU INVENTARIS RUANGAN (KIR)</div>
	<form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="16%">UNIT KERJA </td>
				<td width="16%">
					
					<input type="text" name="unit" id="unit" value="KANTOR PENGHUBUNG">
			  </td>
			  <td width="19%">SUB-SUB UNIT BIDANG </td>
			  <td width="49%"><input type="text" name="bidang" id="bidang" ></td>
			</tr>
			<tr>
				<td>NAMA RUANGAN </td>
				<td><input type="text" name="ruangan" id="ruangan"></td>
				<td>KODE LOKASI</td>
				<td><input type="text" name="lokasi" id="lokasi"></td>
			</tr>
  		</table>
		<div class="c10"></div>
		<div style=" width:100%; background:#333;">
		<ul>
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetB.php?width=800">Data KIB (B) </a></li>
			<!--
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetA.php?width=800">Data KIB (A) </a></li>
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetE.php?width=800">Data KIB (E) </a></li>
			-->
		</ul>
	<div class="c10"></div>
		</div>
	</form>
	<form method="post" action="<?php echo $link;?>" name="MyForm">
		<input type="hidden" name="id" id="id" value="<?php echo kdauto('dtkir','');?>" />
		<span id="infTemp"></span>
		<div id="head"></div>
		<div style="float:right;">
		<input type="button" name="simpan" id="simpan" value="Simpan" />
		<input type="submit" name="btn" value="Hapus" />
		</div>
		<input type="button" value="Kembali" onclick="self.history.back();">
	</form>
	
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	$btn=$_POST['btn'];
	switch($btn){
		case 'Tambah':
			$idb=$_POST['pilih'];
			$n=sizeof($idb);
			for($i=0;$i<$n;$i++){
				$idbrg=$idb[$i];
				$kode=($dtkiba->getField('kode',$idbrg) or $dtkibb->getField('kode',$idbrg) or $dtkibe->getField('kode',$idbrg));
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
										echo "Update data barang berhasil.<br>";
									}
								}else{
									echo "Data ID : $idbrg, sudah terdapat di KODE : $kode.<br>";
								}
							}
						}else{
							$c=($dtkiba->getCount($idbrg) or $dtkibb->getCount($idbrg) or $dtkibe->getCount($idbrg));
							if($c>'0'){
								$sql=mysql_query("insert into tempkir values ('$id','$kode','$idbrg','1')");
								if($sql){
									echo "Jenis barang berhasil ditambahkan.<br>";
								}
							}else{
								echo "Data barang : $idbrg, tidak ditemukan.<br>";
							}
						}			
					}
				}
			}
		break;
		case 'Hapus':
			$kode=$_POST['pilih'];
			$n=sizeof($kode);
			for($i=0;$i<$n;$i++){
				$kd=$kode[$i];
				$del=mysql_query("delete from tempkir where idkir='$id' and kode='$kd'");
			}
		break;
	}
	//header("location:$link");
}
?>