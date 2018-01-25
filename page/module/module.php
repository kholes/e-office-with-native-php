<?php
$ide=$_GET['ide'];
if(isset($ide)){$btn='Edit';}else{$btn='Simpan';}
$link='?p='.encrypt_url('module');
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
		$('#batal').click(function(){
			window.location='<?php echo $link; ?>&m=dmod';
		});
	});
	function viewDetail(id){
		window.location='<?php echo $link; ?>&ide='+id;
	}
	function prev_file(id){
		var prev=null;
		if (prev==null){
			prev=open('page/prev_file.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1100,height=1600');
		}
	}
</script>
<?php include "header.php"; ?>
	<div class="p-wrapper">
		<div class="content">
		<div style="clear:both; padding-top:30px;"></div>
		<div style="border-bottom:1px solid #ccc;"></div>
		<h3 id="label-form">
			<ul>
				<li><a href="<?php echo $link; ?>&m=fjab">Module</a></li>
				<li class="active"><?php echo $val;?></li>
			</ul>
		</h3>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link; ?>" enctype="multipart/form-data" name="MyForm" id="MyForm">
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
					<tr>
						<td width="241">Nama menu </td>
					<td width="731">
						<input type="text" name="nama" id="nama" value="<?php echo $module->getField('nama',$ide); ?>" />
						<input type="hidden" name="id" id="id" value="<?php echo $ide; ?>" /></td>
				  	</tr>
					<tr>
						<td width="241">URL File </td>
						<td width="731"><input type="file" name="module[]" /></td>
					</tr>
					<tr>
						<td width="241">Icon (PNG) </td>
						<td width="731"><input type="file" name="img[]" /></td>
					</tr>
			  	</table>
					<div id="p-main">
	<?php 
	$data=$module->getAll();	
	if ($data!=0){
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			  <th width="4%">No</th>
			  <th width="16%" align="left">Nama menu</th>
			  <th width="14%" align="left">URL</th>
			  <th width="48%" align="left">File</th>
			  <th width="6%">Icon</th>
			  <?php
			  if ($data!=0){
				  foreach($data as $row){	  	
			  ?>
			<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id'];?>','<?php echo $row['module']; ?>');"  onmouseout="this.style.background='#fff';">
				<td width="4%" align="center"><?php echo $c=$c+1;?></td>
				<td width="16%"><?php echo $row['nama']; ?></td>
				<td width="14%"><a style="color:#333" href="?p=<?php echo encrypt_url($row['url']); ?>"><?php echo $row['url']; ?></a></td>
				<td width="48%"><a style="color:#333" onClick="prev_file('<?php echo substr($row['file'],5); ?>');"><?php echo substr($row['file'],5); ?></a>				</td>
				<td width="6%">
				<?php
				if(isset($row['icon']) && $row['icon']!=''){
				?>
				<img src="<?php echo $row['icon']; ?>" />
				<?php
				}else{ echo "NULL"; }
				?>				</td>
	  </tr>
			  <?php
					$counter++;
				}
			  }	  
			  ?>
			</table>
	<?php
	}else{ 
		echo "<p class='pesan'>Data module tidak ditemukan.</p>"; 
	}	
			?>					
					</div>
					<div class="head_content" style="box-shadow:none;" >
				<input type="submit" name="btn" id="btn" value="<?php echo $btn;?>" />
					</div>
	</form>

	</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$path = pathinfo($_SERVER['PHP_SELF']);
	$numfile = count ($_FILES['img']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpimg = $_FILES['img']['tmp_name'][$i];
		$imgtype = $_FILES['img']['type'][$i];
		$imgsize = $_FILES['img']['size'][$i];
		$imgname = $_FILES['img']['name'][$i];
		echo $destimg= $path['dirname'] . '/img/icon/' . $imgname;
	}
	$numfile = count ($_FILES['module']['name']);   
	for ($i = 0; $i < $numfile; $i++){
		$tmpmod = $_FILES['module']['tmp_name'][$i];
		$modtype = $_FILES['module']['type'][$i];
		$modsize = $_FILES['module']['size'][$i];
		$modname = $_FILES['module']['name'][$i];
		$url=substr($modname,0,-4);
		$destmod= $path['dirname'] . '/page/'.$url.'/'.$modname;  
	}
	$id=$_POST['id'];
		switch ($_POST['btn']){
			case 'Simpan':
					if ($modname!=''){
						$url=substr($modname,0,-4);
						$path="page\\$url";
						if(mkdir($path,0777,TRUE)){
							move_uploaded_file($tmpmod, $_SERVER['DOCUMENT_ROOT'] . $destmod);
						}
						$file='page/'.$url.'/'.$modname;
						if ($imgname!=''){
							$icon= 'img/icon/' . $imgname;
							move_uploaded_file($tmpimg, $_SERVER['DOCUMENT_ROOT'] . $destimg);
						}else{
							$icon='';
						}
						$data=array('kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'url'=>$url,'file'=>$file,'icon'=>$icon);
						$module->addData($data);		
					}
					header("location:$link");	
			break;
			case 'Edit':
				$oldurl=$module->getField('url',$id);
				$newurl=substr($modname,0,-4);
				$oldfile=$module->getField('file',$id);
				$newfile='page/'.$modname;
				$oldicon=$module->getField('icon',$id);
				$newicon= 'img/icon/' . $imgname;
				if ($modname!=''){
					if($imgname!=''){
						if (file_exists($oldfile)) { unlink ($oldfile);}
						if (file_exists($oldicon)) { unlink ($oldicon);}
						move_uploaded_file($tmpimg, $_SERVER['DOCUMENT_ROOT'] . $destimg);
						move_uploaded_file($tmpmod, $_SERVER['DOCUMENT_ROOT'] . $destmod);
						$data=array('kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'url'=>$newurl,'file'=>$newfile,'icon'=>$newicon);
						$module->updateData($id,$data);	
						
					}else{
						if (file_exists($oldfile)) { unlink ($oldfile);}
						move_uploaded_file($tmpmod, $_SERVER['DOCUMENT_ROOT'] . $destmod);
						$data=array('kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'url'=>$newurl,'file'=>$newfile,'icon'=>$oldicon);
						$module->updateData($id,$data);	
					}
				}else{
					if($imgname!=''){
						if (file_exists($oldicon)) { unlink ($oldicon);}
						move_uploaded_file($tmpimg, $_SERVER['DOCUMENT_ROOT'] . $destimg);
						$data=array('kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'url'=>$oldurl,'file'=>$oldfile,'icon'=>$newicon);
						$module->updateData($id,$data);	
					
					}else{
						$data=array('kategori'=>$_POST['kategori'],'nama'=>$_POST['nama'],'url'=>$oldurl,'file'=>$oldfile,'icon'=>$oldicon);
						$module->updateData($id,$data);						
					}
				}
				//header("location:$link");	
			break;		
			case 'Hapus':
				$file=$module->getField('file',$id);
				$icon=$module->getField('icon',$id);
				$module->delData($id);
				if (file_exists($file)) { unlink ($file);}
				if (file_exists($icon)) { unlink ($icon);}	
			break;		
	}
}
?>
