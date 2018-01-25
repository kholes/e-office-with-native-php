<?php
class Module{
	private $table='module';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($cari){
		$sql=mysql_query("select * from $this->table where nama like '%$cari%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getField($field,$id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'kategori':
					return $data['kategori'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'url':
					return $data['url'];
				break;
				case 'file':
					return $data['file'];
				break;
				case 'icon':
					return $data['icon'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('','$data[kategori]','$data[nama]','$data[url]','$data[file]','$data[icon]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set kategori='$data[kategori]',nama='$data[nama]',url='$data[url]',file='$data[file]',icon='$data[icon]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
	}
}
?>