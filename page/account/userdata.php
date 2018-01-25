<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/level.cls.php";
$db=new Db();
$db->conDb();
$user=new User();
$level=new Level();
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	case 'Cari':
		$cari=$_POST['cari'];
		$data=$user->getLike($cari);
		tabel($data);
	break;
	case '':
		$data=$user->getAll();	
		tabel($data);
	break;
	case 'Simpan':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$user->addData($data);		
		$data=$user->getAll();	
		tabel($data);
	break;
	case 'Edit':
		$data=array('jabatan'=>$_POST['jabatan'],'id'=>$_POST['id']);
		$user->updateData($id,$data);		
		$data=$user->getAll();	
		tabel($data);
	break;		
	case 'Hapus':
		$user->delData($id);
		$data=$user->getAll();	
		tabel($data);
	break;		
}
function tabel($data){
$level=new Level();
if ($data!=0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <th width="4%">No</th>
    <th width="7%" align="left">#ID</th>
    <th width="70%" align="left">Nama pengguna </th>
    <th width="10%">Password</th>
    <th width="4%" align="left">Level</th>
    <th width="5%">Status</th>
	<?php
	  if ($data!=0){
	  	foreach($data as $row){	  	
	?>
			<tr onMouseOver="this.style.background='#ccc';this.style.cursor='pointer';" onClick="viewDetail('<?php echo $row['id_user'];?>');"  onmouseout="this.style.background='#fff';">
    <td width="4%" align="center"><?php echo $c=$c+1;?></td>
    <td width="7%"><?php echo $row['id_user']; ?></td>
    <td width="70%"><?php echo $row['login_id']; ?></td>
    <td width="10%" align="center">**********</td>
    <td width="4%" ><?php echo $row['level']; ?></td>
	<td align="center">
	<?php 
		$sts=$row['status'];
		if($sts!=0){
			echo "<p style='background:green; color:white; font:bold; padding:5px'>AKTIF</p>";
		}else{
			echo "<p style='background:silver; padding:5px'>NON-AKTIF</p>";
		}
	?>
	</td>
  </tr>
  <?php 
	  	}
	  }	  
	  ?>
</table>
<?php
	}else{ 
		echo "<p class='pesan'>Data pengguna tidak ditemukan.</p>"; 
	}
}
?>
