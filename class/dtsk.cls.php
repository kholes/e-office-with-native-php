<?php
class Sk{
	private $table='dtsk';
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[fdate]','$data[mfrom]','$data[mto]','$data[content]','$data[approved]','$data[mail_type]','$data[mail_index]','$data[mail_no]','$data[mail_date]','$data[mail_from]','$data[mail_to]','$data[mail_code]','$data[mail_codeindex]','$data[mail_about]','$data[mail_file01]','$data[mail_file02]','$data[mail_file03]','$data[mail_file04]','$data[mail_file05]','$data[mail_file01_type]','$data[mail_file02_type]','$data[mail_file03_type]','$data[mail_file04_type]','$data[mail_file05_type]','$data[mail_attc]','$data[mail_status]','$data[mail_forward]','$data[forward_by]','$data[forward_date]','$data[mail_limit]','$data[forward_note]','$data[replay_to]','$data[draft_from]')");		
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',content='$data[content]',mail_index='$data[mail_index]',mail_to='$data[mail_to]',mail_no='$data[mail_no]',mail_date='$data[mail_date]',mail_from='$data[mail_from]',mail_to='$data[mail_to]',mail_code='$data[mail_code]',mail_codeindex='$data[mail_codeindex]',mail_about='$data[mail_about]',mail_file01='$data[mail_file01]',mail_file01_type='$data[mail_file01_type]',mail_attc='$data[mail_attc]' where id='$id'");		
		if($sql){
			return true;
		}
		return false;
	}
	function register($id,$data){
		$sql=mysql_query("update $this->table set mail_codeindex='$data[mail_codeindex]',mail_code='$data[mail_code]',mail_date='$data[mail_date]',mail_index='$data[mail_index]',mail_no='$data[mail_no]',mail_to='$data[mail_to]',mail_about='$data[mail_about]',mail_status='$data[mail_status]',mail_file01='$data[mail_file01]',mail_file02='$data[mail_file02]',mail_file03='$data[mail_file03]',mail_file04='$data[mail_file04]',mail_file05='$data[mail_file05]',mail_file01_type='$data[mail_file01_type]',mail_file02_type='$data[mail_file02_type]',mail_file03_type='$data[mail_file03_type]',mail_file04_type='$data[mail_file04_type]',mail_file05_type='$data[mail_file05_type]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function disposisi($data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',mail_status='$data[mail_status]',mail_forward='$data[mail_forward]',forward_by='$data[forward_by]',forward_date='$data[forward_date]',forward_note='$data[forward_note]',mail_limit='$data[mail_limit]' where id='$data[id]'");
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
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and mail_status in('new','dis','prc')");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getSk(){
		$sql=mysql_query("select count(id) as num from $this->table");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getNewOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='new'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getDisOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='dis'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getPrcOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='prc'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getEndOut($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='end'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getDis($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and mail_status='dis'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getPrc($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and mail_status='prc'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getRev($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='rev'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getApp($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='app'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getRevIn($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and mail_status='rev'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getReq($id){
		$sql=mysql_query("select count(id) as num from $this->table where mfrom like '%$id%' and mail_status='req'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getRem($id){
		$sql=mysql_query("select count(id) as num from $this->table where mto like '%$id%' and mail_limit!='0000-00-00' and mail_status!='rep'");		
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function lastIndexin(){
		$sql=mysql_query("select mail_index from dtsk where mail_type='in' order by mail_index DESC limit 1");
		while($row=mysql_fetch_assoc($sql))
		if($sql){
			return $row['mail_index'];
		}
		return false;
	}
	function lastIndexout(){
		$sql=mysql_query("select mail_index from dtsk where mail_type='out' order by mail_index DESC limit 1");
		while($row=mysql_fetch_assoc($sql))
		if($sql){
			return $row['mail_index'];
		}
		return false;
	}
	function forward($id,$data){
		$sql=mysql_query("update $this->table set mto='$data[mto]',content='$data[content]' where id='$id'");
		if($sql){
			return true;
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
		$sql=mysql_query("update $this->table set forward_note='$data[content]',mail_status='new' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	
	function setStatus($id,$sts){
		$sql=mysql_query("update $this->table set mail_status='$sts' where id='$id'");
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
	function getField($field,$id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'fdate':
					return $data['fdate'];
				break;
				case 'mfrom':
					return $data['mfrom'];
				break;
				case 'mto':
					return $data['mto'];
				break;
				case 'content':
					return $data['content'];
				break;
				case 'approved':
					return $data['approved'];
				break;
				case 'mail_type':
					return $data['mail_type'];
				break;
				case 'mail_index':
					return $data['mail_index'];
				break;
				case 'mail_no':
					return $data['mail_no'];
				break;
				case 'mail_date':
					return $data['mail_date'];
				break;
				case 'mail_from':
					return $data['mail_from'];
				break;
				case 'mail_to':
					return $data['mail_to'];
				break;
				case 'mail_code':
					return $data['mail_code'];
				break;
				case 'mail_codeindex':
					return $data['mail_codeindex'];
				break;
				case 'mail_about':
					return $data['mail_about'];
				break;
				case 'mail_file01':
					return $data['mail_file01'];
				break;
				case 'mail_file02':
					return $data['mail_file02'];
				break;
				case 'mail_file03':
					return $data['mail_file03'];
				break;
				case 'mail_file04':
					return $data['mail_file04'];
				break;
				case 'mail_file05':
					return $data['mail_file05'];
				break;
				case 'mail_file01_type':
					return $data['mail_file01_type'];
				break;
				case 'mail_file02_type':
					return $data['mail_file02_type'];
				break;
				case 'mail_file03_type':
					return $data['mail_file03_type'];
				break;
				case 'mail_file04_type':
					return $data['mail_file04_type'];
				break;
				case 'mail_file05_type':
					return $data['mail_file05_type'];
				break;
				case 'mail_attc':
					return $data['mail_attc'];
				break;
				case 'mail_status':
					return $data['mail_status'];
				break;
				case 'mail_limit':
					return $data['mail_limit'];
				break;
				case 'mail_forward':
					return $data['mail_forward'];
				break;
				case 'forward_date':
					return $data['forward_date'];
				break;
				case 'forward_note':
					return $data['forward_note'];
				break;
				case 'replay_to':
					return $data['replay_to'];
				break;
				case 'draft_from':
					return $data['draft_from'];
				break;
			}
		}
	}
}
?>