<?php
class Trxreq{
	private $table='dtbarang';
	private $permintaan='dtreqaset';
	private $permintaanItem='dtreqasetitem';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($col,$txt){
		$sql=mysql_query("select * from $this->permintaan where $col like '%$txt%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getPenerima($col,$txt){
		$sql=mysql_query("select * from $this->permintaan where $col like '%$txt%' and status='kirim' and penerima=''");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->permintaan where id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getReq($sts){
		$sql=mysql_query("select * from $this->permintaan where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getStok(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getDetail($id){
		$sql=mysql_query("select dtreqasetitem.*, dtbarang.stok from dtreqasetitem,dtbarang where dtbarang.id=dtreqasetitem.id and dtreqasetitem.idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function editQty($data){
		$sql=mysql_query("update $this->permintaanItem set jum_pengajuan='$data[qty]',keterangan='$data[ket]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getTemp(){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getField($field,$id){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table where id='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'kode':
					return $data['kode'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'qty':
					return $data['qty'];
				break;
			}
		}
	}
	function addTemp($data){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[qty]')");
		if($sql){
			return true;
		}
		return false;

	}
	function editTemp($data){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;

	}
	function deletTemp($data){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;

	}
	function addData($data){
		$sql=mysql_query("insert into $this->permintaan values('$data[id]','$data[tgl_pesan]','$data[pemesan]','$data[tgl_terima]','$data[pejabat]','$data[pengesahan]','pesan','0000-00-00','','')");
		if($sql){
			return true;
		}
		return false;
	}
	function addItem($data){
		$sql=mysql_query("insert into dtreqasetitem values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[qty]','')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateApprove($id,$data){
		$sql=mysql_query("update $this->permintaan set tgl_terima='$data[tgl_terima]',pengesahan='$data[pengesahan]',status='$data[status]' where id='$id'");	
		if($sql){
			return true;
		}
		return false;
	}
	function updateOrder($id,$data){
		$sql=mysql_query("update $this->permintaan set tgl_kirim='$data[tgl_kirim]',status='$data[status]',staf='$data[staf]' where id='$id'");	
		if($sql){
			return true;
		}
		return false;
	}
	function updateStok($id,$val){
		$sql=mysql_query("update $this->table set stok='$val' where id='$id'");	
		if($sql){
			return true;
		}
		return false;		
	}
	function updateQty($id,$data){
		$table='tempreq'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set kategori='$data[kategori]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function clearTemp($table){
		$sql=mysql_query("delete from $table");	
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
	}
}
?>