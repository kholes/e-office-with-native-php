<?php
session_start();
include "../../lib/lib.php";
include "../../class/dtindex.cls.php";
include "../../class/dtklasifikasi.cls.php";
$db=new Db();
$db->conDb();
$logid=decrypt_url($_SESSION['id_user']);
$index=new Dtindex();
$klasifikasi=new Dtklasifikasi();
$link='?p='.encrypt_url('surat');
$btn=$_POST['btn'];
$id=$_POST['id'];
switch($btn){
	//===============PENANGANAN PROSES INDEX-------------//
	case 'getRowIndex':
		$id=$_POST['id'];
		$row=array('0'=>$index->getField('id',$id),'1'=>$index->getField('keterangan',$id));
		echo json_encode($row);
	break;
	case 'addIndex':
		$data=array('id'=>$_POST['id'],'keterangan'=>$_POST['keterangan']);
		echo $index->addData($data);
	break;
	case 'editIndex':
		$data=array('id'=>$_POST['id'],'keterangan'=>$_POST['keterangan']);
		$index->updateData($_POST['id'],$data);
	break;
	case 'deleteIndex':
		$id=$_POST['id'];
		$index->deleteData($id);
	break;
	case 'viewIndex':
		$val=$_POST['val'];
		if($val!=''){
			$x=$index->getLike($val);
		}else{
			$x=$index->getAll();		
		}
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="10%" align="center">NOMOR</th>
			<th width="90%" align="left">KETERANGAN</th>
		</table>
		<div style="height:200px; overflow:auto;">	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<?php
			foreach($x as $row){
			?>			  
			<tr onClick="getRow('<?php echo $row['id'];?>');" onMouseOver="this.style.background='#eee';this.style.cursor='pointer';" onmouseout="this.style.background='#fff';">
				<td width="10%" align="center"><?php echo $row['id']; ?></td>
				<td width="90%" class="mail"><?php echo $row['keterangan']; ?></td>
			</tr>
			<?php
			}
			?>
		</table>
		</div>
	<?php
	break;
	//===============PENANGANAN PROSES KLASIFIKASI-------------//
	case 'getIndex':
		$ide=$_POST['idindex'];
		?>
		<select name="idindex" id="idindex" style="width:100%">
		<?php
		if($ide!=''){
		echo "<option value=".$ide." selcted='selected'>".$ide."|".$index->getField('keterangan',$ide)."</option>";
		}
		$x=$index->getAll();
		foreach($x as $row){
		echo "<option value=".$row['id'].">".$row['id']."|".$row['keterangan']."</option>";
		}
		?>
		</select>
	<?php
	break;
	case 'getRowKlas':
		$id=$_POST['id'];
		$row=array('0'=>$klasifikasi->getField('idindex',$id),'1'=>$klasifikasi->getField('id',$id),'2'=>$klasifikasi->getField('keterangan',$id));
		echo json_encode($row);
	break;
	case 'addKlas':
		$data=array('idindex'=>$_POST['idindex'],'id'=>$_POST['id'],'keterangan'=>$_POST['keterangan']);
		echo $klasifikasi->addData($data);
	break;
	case 'editKlas':
		$data=array('idindex'=>$_POST['idindex'],'id'=>$_POST['id'],'keterangan'=>$_POST['keterangan']);
		$klasifikasi->updateData($_POST['id'],$data);
	break;
	case 'deleteKlas':
		$id=$_POST['id'];
		$klasifikasi->deleteData($id);
	break;
	case 'viewKlas':
		$val=$_POST['val'];
		if($val!=''){
			$x=$klasifikasi->getLike($val);
		}else{
			$x=$klasifikasi->getAll();		
		}
	?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<th width="10%" align="center">INDEX</th>
			<th width="10%" align="center">NOMOR</th>
			<th width="90%" align="left">KETERANGAN</th>
		</table>
		<div style="height:200px; overflow:auto;">	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
			<?php
			foreach($x as $row){
			?>			  
			<tr onClick="getRow('<?php echo $row['id'];?>');" onMouseOver="this.style.background='#eee';this.style.cursor='pointer';" onmouseout="this.style.background='#fff';">
				<td width="10%" align="center"><?php echo $row['idindex']; ?></td>
				<td width="10%" align="center"><?php echo $row['id']; ?></td>
				<td width="90%" class="mail"><?php echo $row['keterangan']; ?></td>
			</tr>
			<?php
			}
			?>
		</table>
		</div>
	<?php
	break;
}
?>