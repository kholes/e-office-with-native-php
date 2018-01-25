<?php
$cari=$_GET['cari'];
if (isset($cari)){
	include "../lib/lib.php";
	include "../class/dtbarang.cls.php";
	$db=new Db();
	$db->conDb();
	$brg=new Dtbarang();
	$xb=$brg->getLike('nama',$toko);
	if($xb!=''){
		foreach($xb as $row){
			echo $row['nama'].", ".$row['kode']."\n";
		}
	}
}else{
	include "class/dttoko.cls.php";
	$dttoko=new Dttoko();
	$linkdata='page/dataumum/dttoko.php';
	$ide=$_GET['ide'];
	if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
	?>
	<script>
		$(document).ready(function(){ 
			$('#tombol').click(function(){
				$('#p-frm').submit();
			});
		});
		$(document).ready(function(){
			$.ajax({
				type:'post',
				url:'<?php echo $linkdata;?>',
				data:'btn',
				cache:false,
				success:function(data){
					$('#p-main').html(data);
				}
			});
		});
		$(document).ready(function(){ 
			$('#cari').keydown(function(){
				$.ajax({
					type:'post',
					url:'<?php echo $linkdata;?>',
					data:'btn=Cari&cari='+$('#cari').val(),
					cache:false,
					success:function(data){
						$('#p-main').html(data);
					}
				});
			});
		});
		$(document).ready(function(){ 
			$('#hapus').click(function(){
				$.ajax({
					type:'post',
					url:'<?php echo $link;?>',
					data:'btn=Hapus&id='+$('#id').val()+'',
					cache :false,
					success:function (data){
						window.location='<?php echo $link; ?>&m=tko';
					}
				});
			});
		});
		function viewDetail(id){
			window.location='<?php echo $link; ?>&m=tko&ide='+id;
		}
		function add(){
			window.location='<?php echo $link; ?>&m=tko';
		}
	</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<a href="<?php echo $link;?>&m=tko"><h3>+ TAMBAH DATA TOKO / REKANAN</h3></a>
		</div>
		<div class="c10"></div>
					<form method="post" action="<?php echo $link; ?>&m=tko" enctype="multipart/form-data">
		<div class="page-content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td class="label"><p style="font-size:16px; font-weight:bold;">Nama Supplayer</p></td>
							<td>
								<input type="hidden" name="id" id="id" value="<?php echo $dttoko->get_field('id',$ide); ?>" />
								<input type="text" name="nama" id="nama" value="<?php echo $dttoko->get_field('nama',$ide); ?>" />	
							</td>
						  </tr>
						  <tr>
							<td width="154"><p style="font-size:16px; font-weight:bold;">Alamat</p></td>
							<td width="829"><input type="text" name="alamat" id="alamat" value="<?php echo $dttoko->get_field('alamat',$ide); ?>" /></td>
						  </tr><tr>
							<td width="154"><p style="font-size:16px; font-weight:bold;">No .Tlp</p></td>
							<td width="829"><input type="text" name="tlp" id="tlp" value="<?php echo $dttoko->get_field('tlp',$ide); ?>" /></td>
						  </tr>
						</table>
					<div id="p-main">
				</div>
					</div>
						<div class="head_content">
							<input type="hidden" name="btn" id="btn" value="<?php echo $btn; ?>">
							<input type="submit" name="tombol" id="tombol" value="<?php echo $btn; ?>" style="float:right">
							<input type="button" name="hapus" id="hapus" value="Hapus" /></td>
						
						</div>
					</form>
		<script>
		$(document).ready(function(){
			$('#nama').focus();
		});
		$('#nama').keydown(function(e){
			if (e.keyCode==13){
				$('#alamat').focus();
			}
		});
		$('#alamat').keydown(function(e){
			if (e.keyCode==13){
				$('#tlp').focus();
			}
		});
		$('#tlp').keydown(function(e){
			if (e.keyCode==13){
				$('#p-frm').submit();
			}
		});
	</script>

	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id=$_POST['id'];
		switch ($_POST['btn']){
			case 'Simpan':
				$id=kode('dttoko','');
				$data=array('id'=>$id,'nama'=>$_POST['nama'],'alamat'=>$_POST['alamat'],'tlp'=>$_POST['tlp']);
				$dttoko->addData($data);		
				header("location:$link&m=tko");	
			break;
			case 'Edit':
				$data=array('nama'=>$_POST['nama'],'alamat'=>$_POST['alamat'],'tlp'=>$_POST['tlp']);
				$dttoko->updateData($id,$data);		
				header("location:$link&m=tko");	
			break;		
			case 'Hapus':
				$dttoko->delData($id);
				header("location:$link&m=tko");	
			break;		
		}
	}
}
?>