<?php
$sts=$_GET['sts'];
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];
if(isset($s)){$s=$s;}else{$s='tanggal DESC';}
if ($page <= 0) $page = 1;
$per_page = 50;
$point = ($page * $per_page) - $per_page;
$cari=$_GET['cari'];
if(isset($cari)){
	$statement = "dtmail where mto like '%$logid%' and tanggal like '%$cari%' or mail_date like '%$cari%' or mail_about like '%$cari%' or mail_from like '%$cari%' or mail_index like '%$cari%' or mail_codeindex like '%$cari%' or mail_no like '%$cari%'";
}else{
	$statement = "dtmail where  mfrom='$logid'";
}
	switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
	$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
	if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div class="p-wrapper">
	<div class="surat">
			<div id="head-mail">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <th width="13%" align="left">
					<a href="<?php echo $link; ?>&m=mout&s=mail_no&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">NO.SURAT</a></th>
					    <th width="15%" align="left"><a href="<?php echo $link; ?>&m=mout&s=tanggal&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">TANGGAL</a></th>
					<th width="23%" align="left"><a href="<?php echo $link; ?>&m=mout&s=mfrom&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">PENERIMA</a></th>
					<th width="27%" align="left"><a href="<?php echo $link; ?>&m=mout&s=mail_about&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">URAIAN SURAT </a></th>
					<th width="16%" align="left"><a href="<?php echo $link; ?>&m=mout&s=mail_forward&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">DISPOSISI</a></th> 
					<th width="6%" align="right"><a href="<?php echo $link; ?>&m=mout&s=mail_status&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">STATUS</a></th>
				</table>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="mail_box">
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
					<tr bgcolor="<?php echo $background;?>" onMouseOver="this.style.color='#666';this.style.cursor='pointer';"onmouseout="this.style.color='#000';" onclick="viewDetail('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
					<td width="13%">
						<p style="padding-left:10px"><?php echo $row['mail_no']; ?></p>								
					</td>
					<td width="15%">
						<p><?php echo getTanggal($row['tanggal']); ?></p>
					</td>
					<td width="23%">
						<p>
						<?php 
							echo $pegawai->getField('jabatan',$row['mto']);						
						?>								
						<span id="alarm" style="visibility:<?php echo $display;?>;">
							<img src="img/alarmclockx.gif" style="width:50px; margin:-5px;" />
			  			</span>	
						</p>				
					</td>
					<td width="27%">
						<p><?php echo $row['mail_about']; ?></p>
					</td>
					<td width="16%">
						<?php 
						$x=explode(',',$row['mail_forward']); 
						$n=sizeof($x);
						for($i=0;$i<$n;$i++){
							echo "<p>".$pegawai->getField('jabatan',$x[$i])."</p>";
						}
						?>							  							  
					</td>
					<td width="6%">
						<?php 
						$sts=$row['mail_status']; 
						switch($sts){
							case 'new':
								if($mail->getField('mfrom',$row['id'])!=$logid){
									echo "<img src='img/mail-new.png' />";
								}else{
									echo "<img src='img/mail-new-out.png' />";
								}
							break;
							case 'opn':
								echo "<img src='img/mail-open.png' />";
							break;
							case 'fwd':
								echo "<img src='img/mail-new.png' />";
							break;
							case 'rev':
								echo "<img src='img/draft-fail.png' />";
							break;
							case 'app':
								echo "<img src='img/mail-send.png' />";
							break;
							case 'dis':
								echo "<img src='img/mail-dis.png' />";
							break;
							case 'fin':
								echo "<img src='img/mail-send.png' />";
							break;
							case 'prc':
								echo "<img src='img/mail-prc.png' />";
							break;
							case 'req':
								echo "<img src='img/mail-req.png' />";
							break;
							case 'end':
								echo "<img src='img/mail-reg.png' />";
							break;
							case 'rep':
								echo "<img src='img/mail-send.png' />";
							break;
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="7" class="col-detail">
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
			$url=$link.'&m=mout&sts='.$sts.'&i='.$i;
			$id='id';
			echo pagination($statement,$per_page,$page,$url,$id);
		?>
		</div>
</div>
</div>