<?php
$id=$_GET['idk'];
$link="?p=".encrypt_url('asettetap')."&m=fkupd&idk=".$id;
?>
<script>
$(document).ready(function(){
	getItem();
	$('#add').click(function(){
		$.ajax({
			type:'post',
			url:'page/asettetap/kirprc.php',
			data:'req=add&id='+$('#id').val()+'&idbrg='+$('#idbrg').val(),
			cache :false,
			success:function (data){
				getItem();	
				$('#infAdd').html(data);
			}
		});
	});
	$('#simpan').click(function(){
		$.ajax({
			type:'post',
			url:'page/asettetap/kirprc.php',
			data:'req=update&id='+$('#id').val()+'&unit='+$('#unit').val()+'&bidang='+$('#bidang').val()+'&ruangan='+$('#ruangan').val()+'&lokasi='+$('#lokasi').val()+'',
			cache :false,
			success:function (data){
				getItem();
				window.location='<?php echo $link;?>';
			}
		});
	});
});	
function getItem(){
	$.ajax({
		type:'post',
		url:'page/asettetap/kirprc.php',
		data:'req=viewitem&id=<?php echo $id;?>',
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
<div id="head">&raquo; PENGATURAN KARTU INVENTARIS RUANGAN (KIR)</div>
	<form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="16%">UNIT KERJA </td>
				<td width="16%">
					
					<input type="text" name="unit" id="unit" value="KANTOR PENGHUBUNG">
			  </td>
			  <td width="19%">SUB-SUB UNIT BIDANG </td>
			  <td width="49%"><input type="text" name="bidang" id="bidang" value="<?php echo $dtkir->getField('bidang',$id);?>" ></td>
			</tr>
			<tr>
				<td>NAMA RUANGAN </td>
				<td><input type="text" name="ruangan" id="ruangan" value="<?php echo $dtkir->getField('ruangan',$id);?>"></td>
				<td>KODE LOKASI</td>
				<td><input type="text" name="lokasi" id="lokasi" value="<?php echo $dtkir->getField('lokasi',$id);?>"></td>
			</tr>
  		</table>
		<div class="c10"></div>
		<div style=" width:100%; background:#333;">
		<ul>
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetA.php?width=800">Data KIB (A) </a></li>
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetB.php?width=800">Data KIB (B) </a></li>
			<li><a style="font-weight:bold" class="thickbox" href="page/asettetap/dataasetE.php?width=800">Data KIB (E) </a></li>
		</ul>
	<div class="c10"></div>
		</div>
	</form>
	<form method="post" action="<?php echo $link;?>" name="MyForm">
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
		<span id="infTemp"></span>
		<div id="head"></div>
		<input type="button" name="simpan" id="simpan" value="Simpan Perubahan" />&nbsp;<input type="submit" name="btn" id="btn" value="Hapus" />
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
				$kode=$dtkibb->getField('kode',$idbrg);
				if($kode!=''){
					if($idbrg!=''){
						$c=mysql_query("select * from dtkiritem where kode='$kode' and idkir='$id'");
						$num=mysql_num_rows($c);
						if($num!='0'){
							while($rc=mysql_fetch_assoc($c)){
								$v=explode(',',$rc['idbarang']);
								$ck=array_search($idbrg,$v);
								$t="a".$ck;
								if($t=="a"){
									$n=$rc['jumlah']+1;
									$nid=$rc['idbarang'].",".$idbrg;
									$upd=mysql_query("update dtkiritem set idbarang='$nid',jumlah='$n' where kode='$kode'");
									if($upd){
										echo "Update data barang berhasil.<br>";
									}
								}else{
									echo "Data ID : $idbrg, sudah terdapat di KODE : $kode.<br>";
								}
							}
						}else{
							$c=$dtkibb->getCount($idbrg);
							if($c>'0'){
								$sql=mysql_query("insert into dtkiritem values ('$id','$kode','$idbrg','1')");
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
				$del=mysql_query("delete from dtkiritem where idkir='$id' and kode='$kd'");
				if($del){
					$sql=mysql_query("update dtkibb set idkir='' where kode='$kd'");
				}
			}
		break;
	}
	header("location:$link");
}
?>