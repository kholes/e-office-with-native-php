<?php
class Dtbarang{
	private $table='dtbarang';
	function getAll($s,$i){
		switch($i){
			case '0':
				$ix='ASC';
			break;
			case '1':
				$ix='DESC';
			break;
		}
		$sql=mysql_query("select * from $this->table order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($c,$s,$i){
		switch($i){
			case '0':
				$ix='ASC';
			break;
			case '1':
				$ix='DESC';
			break;
		}
		$sql=mysql_query("select * from $this->table where nama like '%$c%' or  kategori like '%$c%' order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getStokopname($r,$s,$i){
		switch($i){
			case '0':
				$ix='ASC';
			break;
			case '1':
				$ix='DESC';
			break;
		}
		$sql=mysql_query("select * from $this->table order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getWhere($col,$val){
		$sql=mysql_query("select * from $this->table where $col='$val'");
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
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getTemp($temptb){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getCode($field,$code){
		$sql=mysql_query("select * from $this->table where barcode='$code'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'barcode':
					return $data['barcode'];
				break;
				case 'kategori':
					return $data['kategori'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'merek':
					return $data['merek'];
				break;
				case 'satuan':
					return $data['satuan'];
				break;
				case 'harga_jual':
					return $data['harga_jual'];
				break;
				case 'harga_beli':
					return $data['harga_beli'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
				case 'stok':
					return $data['stok'];
				break;
				case 'minstok':
					return $data['minstok'];
				break;
			}
		}
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
				case 'barcode':
					return $data['barcode'];
				break;
				case 'kategori':
					return $data['kategori'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'merek':
					return $data['merek'];
				break;
				case 'satuan':
					return $data['satuan'];
				break;
				case 'stok':
					return $data['stok'];
				break;
				case 'harga_jual':
					return $data['harga_jual'];
				break;
				case 'harga_beli':
					return $data['harga_beli'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
				case 'stok':
					return $data['stok'];
				break;
				case 'minstok':
					return $data['minstok'];
				break;
			}
		}
	}
	function getTempField($field,$id){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table where id='$id'");
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
				case 'harga':
					return $data['harga'];
				break;
				case 'qty':
					return $data['qty'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[barcode]','$data[kategori]','$data[nama]','$data[merek]','$data[satuan]','$data[harga_jual]','$data[harga_beli]','$data[diskon]','$data[stok]','$data[minstok]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set barcode='$data[barcode]',kategori='$data[kategori]',nama='$data[nama]',merek='$data[merek]',satuan='$data[satuan]',harga_beli='$data[harga_beli]',harga_jual='$data[harga_jual]',diskon='$data[diskon]',stok='$data[stok]',minstok='$data[minstok]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateStok($id,$data){
		$sql=mysql_query("update $this->table set harga_beli='$data[harga_beli]',stok='$data[stok]' where id='$id'");
		if($sql){
			return true;
		}
		return false;	
	}
	function stok($id,$stok){
		$sql=mysql_query("update $this->table set stok='$stok' where id='$id'");
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