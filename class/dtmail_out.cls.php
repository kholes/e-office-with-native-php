<?php
class Mailout{
	private $table='dtmail_out';
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nourut]','$data[jenis]','$data[tanggal]','$data[klasifikasi]','$data[codeindex]','$data[nosurat]','$data[tgl_surat]','$data[dari]','$data[tujuan]','$data[uraian]','$data[file]','$data[lampiran]','$data[replay]')");		
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nourut='$data[nourut]',jenis='$data[jenis]',klasifikasi='$data[klasifikasi]',codeindex='$data[codeindex]',nosurat='$data[nosurat]',tgl_surat='$data[tgl_surat]',dari='$data[dari]',tujuan='$data[tujuan]',uraian='$data[uraian]',file='$data[file]',lampiran='$data[lampiran]',replay='$data[replay]' where id='$id'");	
		if($sql){
			return true;
		}
		return false;
	}
	function getAll($id){
		$sql=mysql_query("select * from $this->table order by tanggal");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->table where id='$id' limit 1");
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
	function getLike($col,$val){
		$sql=mysql_query("select * from $this->table where $col like '%$val%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getCount(){
		$sql=mysql_query("select count(id) as jumlah from $this->table");
		while($row=mysql_fetch_assoc($sql))
		return $row['jumlah'];
	}
	function getLast(){
		$sql=mysql_query("select mail_index from $this->table order by tanggal DESC");
		while($row=mysql_fetch_assoc($sql))
		return $row['nourut'];
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
				case 'nourut':
					return $data['nourut'];
				break;
				case 'jenis':
					return $data['jenis'];
				break;
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'klasifikasi':
					return $data['klasifikasi'];
				break;
				case 'codeindex':
					return $data['codeindex'];
				break;
				case 'nosurat':
					return $data['nosurat'];
				break;
				case 'tgl_surat':
					return $data['tgl_surat'];
				break;
				case 'dari':
					return $data['dari'];
				break;
				case 'tujuan':
					return $data['tujuan'];
				break;
				case 'uraian':
					return $data['uraian'];
				break;
				case 'file':
					return $data['file'];
				break;
				case 'lampiran':
					return $data['lampiran'];
				break;
				case 'replay':
					return $data['replay'];
				break;
			}
		}
	}
}
?>