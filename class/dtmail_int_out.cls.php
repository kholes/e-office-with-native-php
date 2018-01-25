<?php
class Mailint_out{
	private $table='dtmail_int_out';
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[tanggal]','$data[mfrom]','$data[mto]','$data[message]','$data[about]','$data[file01]','$data[file02]','$data[file03]','$data[file04]','$data[file05]','$data[ext01]','$data[ext02]','$data[ext03]','$data[ext04]','$data[ext05]','$data[status]','$data[replay]','$data[reading]')");		
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set tgl_fwd='$data[tgl_fwd]',tgl_back='$data[tgl_back]',tgl_rev='$data[tgl_rev]',tgl_dis='$data[tgl_dis]',mfrom='$data[mfrom]',mto='$data[mto]',about='$data[about]',message='$data[message]',file01='$data[file01]',file02='$data[file02]',file03='$data[file03]',file04='$data[file04]',file05='$data[file05]',ext01='$data[ext01]',ext02='$data[ext02]',ext03='$data[ext03]',ext04='$data[ext04]',ext05='$data[ext05]',status='$data[status]' where id='$id'");		
		if($sql){
			return true;
		}
		return false;
	}
	function forwardData($id,$data){
		$sql=mysql_query("update $this->table set tgl_fwd='$data[tgl_fwd]',mfrom='$data[mfrom]',mto='$data[mto]',message='$data[message]',about='$data[about]',status='$data[status]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function read($id,$val){
		$sql=mysql_query("update $this->table set m_sts='$val' where id='$id'");
		if($sql){
			return true;
		}	
		return false;
	}
	function approve_mail($id,$data){
		$sql=mysql_query("update $this->table set tgl_dis='$data[tgl_dis]',mto='$data[mto]',mfrom='$data[mfrom]',message='$data[message]',status='$data[status]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function getAll($id){
		$sql=mysql_query("select * from $this->table where mfrom='$id' order by fdate");
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
	function getIn($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and status='new'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
	}
	function getOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and status='new'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getRev($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and status='rev'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getReg($id){
		$sql=mysql_query("select count(id) as num from $this->table where status='dis'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getDis($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and status='dis'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getNew($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and status in('rev','new','dis')");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}

	function forwardOut($data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',mfrom='$data[mfrom]',content='$data[content]',approved='$data[approved]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function saranReg($data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',content='$data[content]',mail_status='new' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	
	function register($data){
		$sql=mysql_query("update $this->table set mail_codeindex='$data[mail_codeindex]',mail_code='$data[mail_code]',mail_date='$data[mail_date]',mail_index='$data[mail_index]',mail_no='$data[mail_no]',mail_to='$data[mail_to]',mail_about='$data[mail_about]',mail_status='$data[mail_status]',mail_file01='$data[mail_file01]',mail_file02='$data[mail_file02]',mail_file03='$data[mail_file03]',mail_file04='$data[mail_file04]',mail_file05='$data[mail_file05]',mail_file01_type='$data[mail_file01_type]',mail_file02_type='$data[mail_file02_type]',mail_file03_type='$data[mail_file03_type]',mail_file04_type='$data[mail_file04_type]',mail_file05_type='$data[mail_file05_type]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function setReading($id,$val){
		$sql=mysql_query("update $this->table set reading='$val' where id='$id'");
		if($sql){
			return true;
		}	
		return false;
	}
	/*
	function setStatus($id,$sts){
		$sql=mysql_query("update $this->table set status='$sts' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function setIdStatus($id,$sts){
		$sql=mysql_query("update $this->table set mail_status='$sts' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function revisiFile($data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',mfrom='$data[mfrom]',mail_to='$data[mail_to]',content='$data[content]',mail_about='$data[mail_about]',mail_file01='$data[mail_file01]',mail_file02='$data[mail_file02]',mail_file03='$data[mail_file03]',mail_file04='$data[mail_file04]',mail_file05='$data[mail_file05]',mail_file01_type='$data[mail_file01_type]',mail_file02_type='$data[mail_file02_type]',mail_file03_type='$data[mail_file03_type]',mail_file04_type='$data[mail_file04_type]',mail_file05_type='$data[mail_file05_type]',mail_status='$data[mail_status]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function revisiNoFile($data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',mfrom='$data[mfrom]',content='$data[content]',mail_status='$data[mail_status]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function del($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	*/
	function hapus($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
		if($sql){
			return true;
		}
		return false;
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
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'mfrom':
					return $data['mfrom'];
				break;
				case 'mto':
					return $data['mto'];
				break;
				case 'message':
					return $data['message'];
				break;
				case 'about':
					return $data['about'];
				break;
				case 'file01':
					return $data['file01'];
				break;
				case 'file02':
					return $data['file02'];
				break;
				case 'file03':
					return $data['file03'];
				break;
				case 'file04':
					return $data['file04'];
				break;
				case 'file05':
					return $data['file05'];
				break;
				case 'ext01':
					return $data['ext01'];
				break;
				case 'ext02':
					return $data['ext02'];
				break;
				case 'ext03':
					return $data['ext03'];
				break;
				case 'ext04':
					return $data['ext04'];
				break;
				case 'ext05':
					return $data['ext05'];
				break;
				case 'status':
					return $data['status'];
				break;
				case 'replay':
					return $data['replay'];
				break;
				case 'reading':
					return $data['reading'];
				break;
				case 'type':
					return $data['type'];
				break;
			}
		}
	}
}
?>