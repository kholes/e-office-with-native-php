<script>
	setInterval(function(){
		getNew();
		getDis();
		getRem();				
	}, 1000);
	$(document).ready(function(){
		$('#btcari').click(function(){
			window.location='<?php echo $link; ?>&cari='+$('#cari').val();
		});
	});
	$(document).ready(function() {
		$("a.media").media({
			width:100+'%', 
			height:1000,
		});
		$('#cari').focus();
		getNew();				
		getDis();				
   });
   	function viewHide(id){
		$('#infItem'+id).slideUp(400).html(res);
	}
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getDetailSurat&id='+id+'',
			success: function(res){
				$('#infItem'+id).slideDown('fast').html(res);
			}
		});		
	}
	function getNew(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&sts=new',cache :false,success:function (data){
			var oldMail=document.getElementById('infNew').innerHTML;
			if(parseInt(data) > parseInt(oldMail)){
				$('#chatAudio')[0].play();
				alert('Surat baru masuk');
				window.location='<?php echo $link; ?>';
			}
			$('#infNew').html(data);

		}});
	}
	function getDis(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&sts=dis',cache :false,success:function (data){$('#infDis').html(data);}});
	}
	function getRem(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getRem&sts=all',cache :false,success:function (data){$('#infRem').html(data);}});
	}
		$('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.wav" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
</script>
	<div class="p-head">
        <div class="p-head-c">
			<div id="right">
			  <input type="text" name="cari" id="cari" value="<?php echo $_GET['cari']; ?>" />
			  &nbsp;
			  <input type="button" id="btcari" value="Cari" />
		  </div>
			<div id="left">
				<div id="menu-head">
					<ul>
						<li><a href="<?php echo $link; ?>&sts=new">Surat Masuk <span class="counter" id="infNew"></span></a></li>
						<li><a href="<?php echo $link; ?>&sts=dis">Disposisi <span class="counter" id="infDis"></span></a></li>
						<li><a href="<?php echo $link; ?>&sts=rem">Surat Berbatas <span class="blink counter" id="infRem"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="p-wrapper">
		<div class="surat">
				<?php
				$level=$user->getField('level',$logid);
				switch($get){
					case '':
					$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
					$s=$_GET['s'];
					if(isset($s)){
						$s=$s;
					}else{
						$s='tanggal';
					}
					if ($page <= 0) $page = 1;
						$per_page = 10;
						$point = ($page * $per_page) - $per_page;
						if($_GET['cari']==''){
							$sts=$_GET['sts'];
							switch($sts){
								case '':
									$sts='new';
									$statement = "dtsuratmasuk where tujuan like '%$level%' and status='".$sts."'";							
								break;
								case 'all':
									$statement = "dtsuratmasuk order by $s";
								break;
								case 'rem':
									$statement = "dtsuratmasuk where status!='new' and bataswaktu!='0000-00-00'";							
								break;
								case $sts:
									$statement = "dtsuratmasuk where tujuan like '%$level%' and status='".$sts."'";	
								break;						
							}
						}else{
							$cari=$_GET['cari'];
							$statement = "dtsuratmasuk where tujuan like '%$level%' and nourut like '%$cari%' or tanggal like '%$cari%' or dari like '%$cari%' or tujuan like '%$cari%' or kode like '%$cari%' or noindex like '%$cari%' or rangkuman like '%$cari%'";
						}
						switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
						$data = mysql_query("SELECT * FROM $statement  order by $s $ix LIMIT $point, $per_page");
						if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
						?>				
						<div id="head-mail">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<th width="11%" align="left"><a href="<?php echo $link;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>&s=tanggal&i=<?php echo $i;?>">Tanggal</a>
								</th>
								<th width="25%" align="left"><a href="<?php echo $link; ?>&s=dari&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Dari</a></th>
								<th width="39%" align="left"><a href="<?php echo $link; ?>&s=rangkuman&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Ringkasan</a></th>
								<th width="23%" align="left"><a href="#">Tujuan Disposisi</a></th> 
								<th width="2%" align="left">&nbsp;</th>
							</table>
						</div>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <?php
						while ($row = mysql_fetch_array($data)) {
							$sts=$row['status']; 
							if($sts=='new'){$background="EDF3FB";}else{$background='#fff';}
							?>
                                  <tr bgcolor="<?php echo $background;?>" onmouseover="this.style.cursor='pointer';">
                                    <td width="11%" class="mail"><?php echo getTanggal($row['tanggal']); ?></td>
                                    <td width="26%" class="mail"><?php echo $row['dari']; ?></td>
                                    <td width="40%" class="mail"><?php echo $row['rangkuman']; ?></td>
                                    <td width="19%" class="mail"><?php 
								$x=explode(',',$row['disposisi']); 
								$n=sizeof($x);
								for($i=0;$i<$n;$i++){
									echo "<p>".$pegawai->getField('jabatan',$x[$i])."</p>";
								}
								?>
                                    </td>
                                    <td width="4%" class="mail" align="right">
								<li class="tooltip">
									<?php 
									$sts=$row['status']; 
									switch($sts){
										case 'new':
											echo "<img src='img/mail-new.png' />";
										break;
										case 'dis':
											echo "<img src='img/mail-dis.png' />";
										break;
									}
									?>			  
									<span><b></b>
										<div class="main">			
											<div class="work">
												<a class="thickbox" href="page/surat/detail.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/surat-detail.png" class="media" alt="" />
													<div class="caption">
														<div class="work_title">
															<h1>D E T A I L</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a class="thickbox" href="page/surat/disposisi.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/dis.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>DISPOSISI</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a class="thickbox" href="page/surat/lampiran.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/file-lampiran.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>LAMPIRAN</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a href="<?php echo $surat->getField('surat',$row['id']);?>" target="_blank">
													<img src="img/file-open.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>F I L E</h1>
													  </div>
													</div>
												</a>		
											</div>
										</div>
								  </span>
								  </li>
									</td>
                                  </tr>
                                  <?php
					}
					?>
                                </table>
								<?php
					break;
					case 'detail':
						detail($ids);
					break;
				}
			?>
	<div class="c10"></div>
		<div id="pagination">
			<?php
			$sts=$_GET['sts'];
			$url=encrypt_url('entrisurat').'&sts='.$sts.'&i='.$i;
			echo pagination($statement,$per_page,$page,$url);
			?>
		</div>
	</div>
<script>
	$('#cari').keydown(function(e){
		if (e.keyCode==13){
			$('#btcari').click();
		}
	});
</script>
<?php
function cek($nama,$value,$mod){
	$surat=new Surat();	
	$ide=$_GET['ide'];
	$id=$ide;
	$olddis=$surat->getField('disposisi',$id);
	$data=explode(',',$olddis);
	$cdata=count($data);
	if($value==$data[0] or $value==$data[1] or $value==$data[2] or $value==$data[3] or $value==$data[4] or $value==$data[5] or $value==$data[6] or $value==$data[7] or $value==$data[8] or	$value==$data[9] or	$value==$data[10] or $value==$data[11] or $value==$data[12] or	$value==$data[13] or $value==$data[14] or $value==$data[15]){$cek="checked";}else{$cek="";}
	echo "<li><input name='$nama"."[]' type='checkbox' value='$value' $cek >&nbsp;$mod</li>";
}
?>
