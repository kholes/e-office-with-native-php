<?php
$m=$_GET['m'];
$type=$_GET['o'];
$cari=$_GET['cari'];
$sts=$_GET['sts'];
if(!isset($m)){$m='min_int';}
if(!isset($type)){$type='in';}
if(!isset($sts)){$sts='new';}
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];
if(isset($s)){$s=$s;}else{$s='tanggal DESC';}
if ($page <= 0) $page = 1;$per_page = 50;$point = ($page * $per_page) - $per_page;
if(isset($cari)){
	$statement = "dtmail_int where mto like '%$logid%' and tanggal like '%$cari%' or message like '%$cari%' or about like '%$cari%'";
}else{
	if($sts!='app'){
		$statement = "dtmail_int where mto='$logid'";
	}else{
		$statement = "dtmail_int where status='app'";
	}
}
switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div class="p-wrapper">
	<div class="surat">
		<form name="MyForm" id="MyForm">
		<div id="head-mail">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<th width="18%" align="left" style="padding:5px;"><a href="<?php echo $link; ?>&m=min_int&s=<?php echo $content;?>&i=<?php echo $i;?>&o=<?php echo $type;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">
			  <p style="padding-left:10px">DARI</p>
			</a></th>
			<th width="14%" align="left" style="padding:5px;"><a href="<?php echo $link; ?>&m=int&s=tanggal&i=<?php echo $i;?>&type=<?php echo $_GET['type'];?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">TANGGAL</a></th>
			<th width="9%" align="left" style="padding:5px;"><a href="<?php echo $link; ?>&m=int&s=tanggal&i=<?php echo $i;?>&type=<?php echo $_GET['type'];?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">JAM</a></th>
			<th width="21%" align="left" style="padding:5px;"><a href="<?php echo $link; ?>&m=int&s=mto&i=<?php echo $i;?>&type=<?php echo $_GET['type'];?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">PERIHAL</a></th> 
			<th width="35%" align="left" style="padding:5px;"><a href="<?php echo $link; ?>&m=int&s=about&i=<?php echo $i;?>&type=<?php echo $_GET['type'];?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">PESAN</a></th>
			<th width="3%" align="right" style="padding:5px;"><a href="<?php echo $link; ?>&m=int&s=status&i=<?php echo $i;?>&type=<?php echo $_GET['type'];?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>"></a></th>
		</table>
		</div>
		<table border="0" width="100%" cellspacing="0" cellpadding="0" id="mail_box">
		<?php
		while ($row = mysql_fetch_array($data)) {
			if($row['reading']=='0000-00-00 00:00:00'){$background="#EDF3FB";}else{$background="#fff";}
			$start_time=$row['tanggal'];
			if($start_time!='0000-00-00 00:00:00'){
				$selisih=substr(lastM($start_time),-0,-5);
			}else{
				$selisih=substr(lastM($date->format('Y-m-d G:i:s')),-0,-5);
			}
			if($selisih>$max_time&&$row['reading']=='0000-00-00 00:00:00'){$display='visible';}else{$display='hidden';}
		?>			  
			<tr bgcolor="<?php echo $background;?>" onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onmouseout="this.style.color='#000';">
				<td width="18%" onclick="viewDetailInt('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<p style="padding-left:10px">
					<?php 
						echo $pegawai->getField('jabatan',$row['mfrom'])."-".$pegawai->getField('nama',$row['mfrom']);
					?>
					</p>			  
			  </td>
				<td width="14%" onclick="viewDetailInt('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<?php echo getTanggal($row['tanggal']); ?>				
				</td>
				<td width="9%" onclick="viewDetailInt('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<?php echo getJam($row['tanggal']); ?>							<span id="alarm" style="visibility:<?php echo $display;?>;">
							<img src="img/alarmclockx.gif" style="width:50px; margin:-5px;" />
						</span>					
			
				</td>
				<td width="21%" onclick="viewDetailInt('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<?php echo $row['about']; ?>
				</td>
		    	<td width="35%" onclick="viewDetailInt('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<?php echo $row['message']; ?>			  
				</td>
				<td width="3%">
				<?php 
				$sts=$row['status']; 
				switch($sts){
					case 'new':
						if($mailint->getField('mfrom',$row['id'])!=$logid){
							echo "<img src='img/mail-new.png' />";
						}else{
							echo "<img src='img/mail-new-out.png' />";
						}
					break;
					case 'opn':
						echo "<img src='img/mail-open.png' />";
					break;
					case 'rev':
						echo "<img src='img/mail-rev.png' />";
					break;
					case 'end':
						echo "<img src='img/mail-reg.png' />";
					break;
					case 'app':
						echo "<img src='img/mail-app.png' />";
					break;
				}
			?>		  
		  	</td>
		</tr>
		<tr>
			<td colspan="7" class="col-detail" style="border:none;">
				<div style="width:100%" id="detail<?php echo $row['id'];?>"></div>
			</td>
		</tr>
		<?php
		}
		?>
	  </table>
		<div class="c10"></div>
		<div id="pagination">
			<?php
			$sts=$_GET['sts'];
			$type=$_GET['type'];
			$s=$_GET['s'];
			$i=$_GET['i'];
			if($s==''){$s='tanggal';}
			if($i==''){$i='1';}
			$url=$link.'&m=min_int&type='.$type.'&sts='.$sts.'&i='.$i.'&s='.$s;
			$id='id';
			echo pagination($statement,$per_page,$page,$url,$id);
			?>
		</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){menuHide();});
$('#hapus').click(function(){
	alert();
});
$(document).ready(function(){
	$('#menu_right').corner('round tl bl 7px');
});
</script>
