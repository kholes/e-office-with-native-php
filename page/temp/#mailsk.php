<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];
if(isset($s)){$s=$s;}else{$s='fdate DESC';}
if ($page <= 0) $page = 1;
$per_page = 100;
$point = ($page * $per_page) - $per_page;
$cari=$_GET['cari'];
$sts=$_GET['sts'];
if(isset($cari)){
		$statement = "dtsk where mto like '%$logid%' and fdate like '%$cari%' or mail_date like '%$cari%' or mail_about like '%$cari%' or mail_from like '%$cari%' or mail_index like '%$cari%' or mail_codeindex like '%$cari%' or mail_code like '%$cari%' or mail_no like '%$cari%'";
}else{
	$statement = "dtsk";
}
switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div class="p-wrapper">
	<div class="surat">
		<div id="head-mail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<th width="14%" align="left">
					<a href="<?php echo $link; ?>&m=sk&s=mail_no&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">NO.SURAT</a>				</th>
				<th width="20%" align="left">
					<a href="<?php echo $link; ?>&m=sk&s=mail_date&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">TANGGAL SURAT</a>				</th>
				<th width="60%" align="left">
					<a href="<?php echo $link; ?>&m=sk&s=mail_about&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">URAIAN SURAT  </a>				</th>
				<th width="6%" align="right">
					<a href="<?php echo $link; ?>&m=sk&s=mail_status&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">STATUS</a>				</th>
			</table>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="email">
			<?php
			while ($row = mysql_fetch_array($data)) {
				$sts=$row['mail_status']; 
				if($sts=='new' or $sts=='dis'){
					$background="#EDF3FB";
				}elseif($sts=='req'){
					$background="#8BF776";
				}elseif($sts=='rev'){
					$background="#F34A6A";
				}elseif($sts=='opn'){
					$background="#ccc";
				}else{$background='#fff';}
			?>			  
			<tr bgcolor="<?php echo $background;?>"  onMouseOver="this.style.color='#666';this.style.cursor='pointer';"onmouseout="this.style.color='#000';" onclick="viewDetailSk('<?php echo $row['id'];?>');">
				<td width="14%" class="mail" style="vertical-align:top; border-bottom:1px solid #ccc;">
					<p style="padding-left:10px">
					<?php echo $row['mail_no']; ?>								
					</p>								
			  </td>
				<td width="20%" class="mail" style="vertical-align:top; border-bottom:1px solid #ccc;">
					<p style="padding-left:10px">
						<?php echo getTanggal($row['mail_date']); ?>								
					</p>								
			  </td>
				<td width="51%" class="mail" style="vertical-align:top; border-bottom:1px solid #ccc;">
					<p><?php echo $row['mail_about']; ?></p>								
			  </td>
				<td width="15%" class="mail" align="right" style="vertical-align:top; padding-right:10px; border-bottom:1px solid #ccc;">
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
						case 'reg':
							echo "<img src='img/mail-reg.png' />";
						break;
						case 'rep':
							echo "<img src='img/mail-send.png' />";
						break;
						case 'end':
							echo "<img src='img/mail-reg.png' />";
						break;
					}
					?>				</td>
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
			$url=encrypt_url('surat').'&sts='.$sts.'&i='.$i;
			echo pagination($statement,$per_page,$page,$url);
		?>
		</div>
	</div>
</div>