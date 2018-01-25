<?php
include "class/dtsatuan.cls.php";
$satuan=new Dtsatuan();
$link='?p='.encrypt_url('dtsatuan');
$linkdata='page/dtsatuandata.php';
$ide=$_GET['ide'];
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
?>
	<script>
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
				<form method="post" action="<?php echo $link; ?>" id="p-frm" enctype="multipart/form-data">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<th colspan="3" align="center"><h3>FORM DATA SATUAN BARANG </h3></th>
						<tr>
							<td class="btn" colspan="3" >&nbsp;</td>
				  		</tr>
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179">Nama Satuan </td>
						<td width="821">
						<input type="text" name="satuan" id="satuan" value="<?php echo $satuan->getField('satuan',$ide); ?>" />
						</td>
					  </tr>
						<tr>
							<td class="btn" colspan="3" >&nbsp;</td>
				  		</tr>
					  <tr>
						<td class="btn" colspan="2"  align="right"><input type="submit" name="btn" id="btn" value="<?php echo $btn; ?>" />
					    <input type="button" name="hapus" id="hapus" value="Hapus" /></td>
					  </tr>
					</table>
				</form>
				<div id="p-main">
				</div>
		
	</div>
</body>
	<script>
		function setfocus(){$('#satuan').focus();}
		document.onkeydown = function(e){setfocus();}
		$(document).ready(function(){
			$('#satuan').focus();
		});
		$('#satuan').keydown(function(e){
			if (e.keyCode==13){
				if($('#satuan').val()==''){
					alert('Kategori tidak boleh kosong');
					return;
				}else{
					$('#p-frm').submit();
				}
			}
		});
	</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Simpan':
			$id=kode('dtsatuan','');
			$data=array('id'=>$id,'satuan'=>$_POST['satuan']);
			$satuan->addData($data);		
			header("location:$link");	
		break;
		case 'Edit':
			$data=array('satuan'=>$_POST['satuan']);
			$satuan->updateData($id,$data);		
			header("location:$link");	
		break;		
		case 'Hapus':
			$satuan->delData($id);
			header("location:$link");	
		break;		
	}
}
?>
