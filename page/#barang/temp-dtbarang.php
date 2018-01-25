<?php
include "class/dtbarang.cls.php";
include "class/dtkategori.cls.php";
include "class/dtmerek.cls.php";
include "class/dtsatuan.cls.php";
$dtbarang=new Dtbarang();
$dtkategori=new Dtkategori();
$dtmerek=new Dtmerek();
$dtsatuan=new Dtsatuan();
$link='?p='.encrypt_url('dtbarang');
$linkdata='page/dtbarangdata.php';
$ide=$_GET['ide'];
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';$id_barang=kodebrg('dtbarang','KPHB');}
if(isset($ide)){		
		$id_barang=$ide;		
		$barcode=$dtbarang->getField('barcode',$ide);
		$nama=$dtbarang->getField('nama',$ide);
		$kategori=$dtbarang->getField('kategori',$ide);
		$merek=$dtbarang->getField('merek',$ide);
		$satuan=$dtbarang->getField('satuan',$ide);
		$stok=$dtbarang->getField('stok',$ide);
		$minstok=$dtbarang->getField('minstok',$ide);
		$btn='Edit';
}
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
		$('#tombol').click(function(){
			$('#p-frm').submit();
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
	$(document).ready(function(){
		$("#barcode").change(function(){
			window.location='<?php echo $link; ?>&code='+$("#barcode").val();
		});
	});
	function clearPage(){
		document.getElementById('barcode').focus();
	}
	function newPage(){
		document.getElementById('nama').focus();
	}
	function editPage(){
		document.getElementById('btn').focus();
	}
	function submitForm(){
		document.getElementById("frmBarang").submit();
	}
</script>
<?php
$code=$_GET['code'];
if(isset($code)){
	$id_brg=$dtbarang->getCode('id',$code);
	if($id_brg==''){
		$id_barang=kodebrg('dtbarang','KPHB');		
		$barcode=$code;
		echo "<script>newPage();</script>";
	}else{
		$id_barang=$id_brg;		
		$barcode=$code;
		$nama=$dtbarang->getField('nama',$id_brg);
		$kategori=$dtbarang->getField('kategori',$id_brg);
		$merek=$dtbarang->getField('merek',$id_brg);
		$satuan=$dtbarang->getField('satuan',$id_brg);
		$stok=$dtbarang->getField('stok',$id_brg);
		$minstok=$dtbarang->getField('minstok',$id_brg);
		$btn='Edit';
		echo "<script>editPage();</script>";
	}
}

?>
<body onLoad="clearPage();">
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
					<th colspan="3" align="center"><h3>DATA BARANG</h3></th>
						<tr>
							<td class="btn" colspan="2" >&nbsp;</td>
				  		</tr>
                <tr>
                  <td width="192">ID Barang</td>
                  <td width="270">
				  <input type="text" name="id" id="id" value="<?php echo $id_barang; ?>" readonly="">                  
				  </td>
                  <td width="463">&nbsp;</td>
                </tr>
                <tr>
                  <td width="192">Kode Batang </td>
                  <td width="270">
				  <input type="text" name="barcode" id="barcode" value="<?php echo $barcode; ?>" onChange="getData();" />                  </td>
                  <td width="463"><em>*/Kosongkan jika tidak ada kode barcode</em></td>
                </tr>
                <tr>
                  <td width="192">Nama Barang</td>
                  <td width="270"><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" />                  </td>
                </tr>
                <tr>
                  <td width="192">Kategori Barang</td>
                  <td width="270">
				  	<select name="kategori" id="kategori">
                      <option value="<?php echo $kategori; ?>" selected="selected"> <?php echo $dtkategori->getField('kategori',$kategori); ?> </option>
                      <?php
							$kat=$dtkategori->getAll();
							foreach($kat as $row){
							echo "<option value='".$row['id']."'>".$row['kategori']."</option>";
							}
							?>
                  </select>
				  </td>
                </tr>
                <tr>
                  <td width="192">Merek</td>
                  <td width="270"><select name="merek">
                      <option value="<?php echo $merek; ?>" selected="selected"> <?php echo $dtmerek->getField('merek',$merek); ?> </option>
                      <?php
							$mrk=$dtmerek->getAll();
							foreach($mrk as $row){
							echo "<option value='".$row['id']."'>".$row['merek']."</option>";
							}
							?>
                    </select>                  </td>
                </tr>
                <tr>
                  <td width="192">Satuan</td>
                  <td width="270"><select name="satuan">
                      <option value="<?php echo $satuan; ?>" selected="selected"> <?php echo $dtsatuan->getField('satuan',$satuan); ?> </option>
                      <?php
							$sat=$dtsatuan->getAll();
							foreach($sat as $row){
							echo "<option value='".$row['id']."'>".$row['satuan']."</option>";
							}
							?>
                    </select>                  </td>
                </tr>
                <tr>
                  <td width="192">Stok Awal</td>
                  <td width="270"><input type="text" name="stok" id="stok" value="<?php echo $stok; ?>"  />                  </td>
                </tr>
                <tr>
                  <td width="192">Min-stok</td>
                  <td width="270"><input type="text" name="minstok" id="minstok" value="<?php echo $minstok; ?>"  />                  </td>
                </tr>
 						<tr>
							<td class="btn" colspan="2" >&nbsp;</td>
				  		</tr>
               <tr>
                  <td class="btn" colspan="3" align="right" >
					<input type="hidden" name="btn" id="btn" value="<?php echo $btn; ?>">
					<input type="button" name="tombol" id="tombol" value="<?php echo $btn; ?>">
					<input type="button" name="hapus" id="hapus" value="Hapus" /></td>
                </tr>
              </table>
			</form>
			<div id="p-main">
			</div>
			</div>
	</div>
</body>
<script>
	$('#barcode').keydown(function(e){
		if (e.keyCode==13){
			$('#nama').focus();
		}
	});
	$('#nama').keydown(function(e){
		if (e.keyCode==13){
			if($('#nama').val()==''){
				alert('Nama barang tidak boleh kosong');
				return;
			}else{
				$('#kategori').focus();
			}
		}
	});
	$('#kategori').keydown(function(e){
		if (e.keyCode==13){
			$('#merek').focus();
		}
	});
	$('#merek').keydown(function(e){
		if (e.keyCode==13){
			$('#satuan').focus();
		}
	});
	$('#satuan').keydown(function(e){
		if (e.keyCode==13){
			$('#stok').focus();
		}
	});
	$('#stok').keydown(function(e){
		if (e.keyCode==13){
			if($('#stok').val()==''){
				$('#stok').val('0');
				$('#minstok').focus();
			}else{
				$('#minstok').focus();
			}
		}
	});
	$('#minstok').keydown(function(e){
		if (e.keyCode==13){
			if($('#minstok').val()==''){
				$('#minstok').val('0');
				$('#frmBarang').submit();
			}else{
				$('#frmBarang').submit();
			}
		}
	});
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST['id'];
	switch ($_POST['btn']){
		case 'Simpan':
			$data=array('id'=>$_POST['id'],'barcode'=>$_POST['barcode'],'kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'merek'=>$_POST['merek'],'satuan'=>$_POST['satuan'],'stok'=>$_POST['stok'],'minstok'=>$_POST['minstok']);
			$dtbarang->addData($data);		
			header("location:$link");
		break;
		case 'Edit':
			$data=array('id'=>$_POST['id'],'barcode'=>$_POST['barcode'],'kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'merek'=>$_POST['merek'],'satuan'=>$_POST['satuan'],'stok'=>$_POST['stok'],'minstok'=>$_POST['minstok']);
			$dtbarang->updateData($id,$data);		
			header("location:$link");	
		break;		
		case 'Hapus':
			$dtbarang->delData($id);
			header("location:$link");	
		break;		
	}
}
?>