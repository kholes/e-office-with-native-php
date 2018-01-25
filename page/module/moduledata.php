<?php
session_start();
include "../lib/lib.php";
include "../class/module.cls.php";
include "../class/katmodule.cls.php";
$db=new Db();
$db->conDb();
$module=new Module();
$katmod=new Katmodule();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$module->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$module->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('module'=>$_POST['module'],'id'=>$_POST['id']);
		$module->addData($data);		
		$data=$module->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('module'=>$_POST['module'],'id'=>$_POST['id']);
		$module->updateData($id,$data);		
		$data=$module->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$module->delData($id);
		$data=$module->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
$katmod=new Katmodule();
$data=$module->getAll();	
if ($data!=0){
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <th width="4%">No</th>
			  <th width="12%" align="left">Kategori</th>
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
				<td width="12%"><?php echo $katmod->getField('kategori',$row['kategori']); ?></td>
				<td width="16%"><?php echo $row['nama']; ?></td>
				<td width="14%"><a href="?p=<?php echo encrypt_url($row['url']); ?>"><?php echo $row['url']; ?></a></td>
				<td width="48%"><a onClick="prev_file('<?php echo substr($row['file'],5); ?>');"><?php echo substr($row['file'],5); ?></a>				</td>
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
}
?>