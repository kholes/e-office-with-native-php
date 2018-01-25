<?php
session_start();
include "../../lib/lib.php";
include "../../class/user.cls.php";
include "../../class/dtkiba.cls.php";
include "../../class/dtkibb.cls.php";
include "../../class/dtkibc.cls.php";
include "../../class/dtkibe.cls.php";
$db=new Db();
$db->conDb();
$dtkiba=new Dtkiba();
$dtkibb=new Dtkibb();
$dtkibc=new Dtkibc();
$dtkibe=new Dtkibe();
$id=$_GET['id'];
$req=$_POST['req'];
if(isset($_POST['id'])){

}else{

}
switch($req){
			case 'KIBB':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibb->getField('nama',$_POST['id']).'&nbsp;'.$dtkibb->getField('merek',$_POST['id']).'</option>';
						$x=$dtkibb->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['merek'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkibb->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['merek'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
			case 'KIBC':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibc->getField('nama',$_POST['id']).'</option>';
						$x=$dtkibc->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkibc->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
			case 'KIBE':
				if(isset($_POST['id'])){
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						echo '<option selected="selected" value="'.$_POST['id'].'">'.$_POST['id'].'&nbsp;'.$dtkibe->getField('nama',$_POST['id']).'&nbsp;'.$dtkibe->getField('judul',$_POST['id']).'</option>';
						$x=$dtkibe->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['judul'].'</option>';
						}
						?>
					</select>
					<?php		
				}else{
					?>
					<select name="id_barang" id="id_barang">
						<?php 
						$x=$dtkibe->getAll();
						foreach($x as $row){
						echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['judul'].'</option>';
						}
						?>
					</select>
					<?php		
				}
			break;
		}
	break;
}
?>
        
