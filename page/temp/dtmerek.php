<?php
include "class/dtmerek.cls.php";
$merek=new Dtmerek();
$link='?p='.encrypt_url('dtmerek');
$linkdata='page/dtmerekdata.php';
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
					<th colspan="3" align="center"><h3>FORM DATA MEREK BARANG </h3></th>
						<tr>
							<td class="btn" colspan="3" >&nbsp;</td>
				  		</tr>
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>">					 
					  <tr>
						<td width="179">Nama Merek </td>
						<td width="821">
						<input type="text" name="merek" id="merek" value="<?php echo $merek->getField('merek',$ide); ?>" />
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
	$(document).ready(function(){
		$('#merek').focus();
	});
	$('#merek').keydown(function(e){
		if (e.keyCode==13){
			if($('#merek').val()==''){
				alert('Merek tidak boleh kosong');
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
			$id=kode('dtmerek','');
			$data=array('id'=>$id,'merek'=>$_POST['merek']);
			$merek->addData($data);		
			header("location:$link");	
		break;
		case 'Edit':
			$data=array('merek'=>$_POST['merek']);
			$merek->updateData($id,$data);		
			header("location:$link");	
		break;		
		case 'Hapus':
			$merek->delData($id);
			header("location:$link");	
		break;		
	}
}
?>
