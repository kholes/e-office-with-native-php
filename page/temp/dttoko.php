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
	$link='?p='.encrypt_url('dttoko');
	$linkdata='page/dttokodata.php';
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
						window.location='<?php echo $link; ?>';
					}
				});
			});
		});
		function viewDetail(id){
			window.location='<?php echo $link; ?>&ide='+id;
		}
		function add(){
			window.location='<?php echo $link; ?>';
		}
	</script>
	<body>
			<div class="p-menu"><?php include "menu.php"; ?></div>
				<div class="p-head">
                  <div class="p-head-c">
                    <div id="right"> Cari &raquo;
                        <input type="text" name="cari" id="cari">
                    </div>
                    <div id="left">
                      <ul>
                        <li><a onClick="add();">Tambah</a></li>
                      </ul>
                    </div>
                  </div>
    			</div>
				<div class="p-wrapper">
					<form method="post" id="p-frm" action="<?php echo $link; ?>" enctype="multipart/form-data">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<th colspan="2" align="center"><h3>FORM DATA TOKO / SUPPLAYER </h3></th>
						<tr>
							<td class="btn" colspan="2" >&nbsp;</td>
				  		</tr>
						  <tr>
							<td class="label">Nama Supplayer </td>
							<td>
								<input type="hidden" name="id" id="id" value="<?php echo $dttoko->getField('id',$ide); ?>" />
								<input type="text" name="nama" id="nama" value="<?php echo $dttoko->getField('nama',$ide); ?>" />	
							</td>
						  </tr>
						  <tr>
							<td width="154">Alamat</td>
							<td width="829"><input type="text" name="alamat" id="alamat" value="<?php echo $dttoko->getField('alamat',$ide); ?>" /></td>
						  </tr><tr>
							<td width="154">No .Tlp </td>
							<td width="829"><input type="text" name="tlp" id="tlp" value="<?php echo $dttoko->getField('tlp',$ide); ?>" /></td>
						  </tr>
						  <tr>
							<td class="btn" colspan="2" align="right">
							<input type="hidden" name="btn" id="btn" value="<?php echo $btn; ?>">
							<input type="button" name="tombol" id="tombol" value="<?php echo $btn; ?>">
							<input type="button" name="hapus" id="hapus" value="Hapus" /></td>
							</td>
						  </tr>
						</table>
					</form>
					<div id="p-main">
					</div>
		</div>
	</body>
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
				header("location:$link");	
			break;
			case 'Edit':
				$data=array('nama'=>$_POST['nama'],'alamat'=>$_POST['alamat'],'tlp'=>$_POST['tlp']);
				$dttoko->updateData($id,$data);		
				header("location:$link");	
			break;		
			case 'Hapus':
				$dttoko->delData($id);
				header("location:$link");	
			break;		
		}
	}
}
?>