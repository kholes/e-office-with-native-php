<?php
class Themes{
	private $table='themes';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
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
				case 'nama':
					return $data['nama'];
				break;
				case 'wall':
					return $data['wall'];
				break;
				case 'head':
					return $data['head'];
				break;
				case 'button':
					return $data['button'];
				break;
				case 'form':
					return $data['form'];
				break;
				case 'th':
					return $data['th'];
				break;
				case 'td1':
					return $data['td1'];
				break;
				case 'td2':
					return $data['td2'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('','$data[nama]','$data[wall]','$data[head]','$data[form]','$data[button]','$data[th]','$data[td1]','$data[td2]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nama='$data[nama]',wall='$data[wall]',head='$data[head]',form='$data[form]',button='$data[button]',th='$data[th]',td1='$data[td1]',td2='$data[td2]' where id='$id'");
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