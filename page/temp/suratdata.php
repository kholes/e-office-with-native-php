<div class="p-wrapper">
	<div class="surat">
		<?php
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
						$statement = "dtsuratmasuk where status='".$sts."'";							
					break;
					case 'all':
						$statement = "dtsuratmasuk";
					break;
					case 'out':
						$statement = "dtsuratkeluar";
					break;
					case 'rem':
						$statement = "dtsuratmasuk where status!='new' and bataswaktu!='0000-00-00'";							
					break;
					case $sts:
						$statement = "dtsuratmasuk where status='".$sts."'";	
					break;						
				}
			}else{
				$cari=$_GET['cari'];
				$statement = "dtsuratmasuk where nourut like '%$cari%' or nosurat like '%$cari%' or tanggal like '%$cari%' or dari like '%$cari%' or tujuan like '%$cari%' or kode like '%$cari%' or noindex like '%$cari%' or rangkuman like '%$cari%'";
			}
			switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
			$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
			if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
			<div id="head-mail">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<th width="11%" align="left"><a href="<?php echo $link; ?>&s=tanggal&i=<?php echo $i;?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Tanggal</a></th>
					<th width="25%" align="left"><a href="<?php echo $link; ?>&s=dari&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Dari</a></th>
					<th width="39%" align="left"><a href="<?php echo $link; ?>&s=rangkuman&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Ringkasan/Uraian</a></th>
					<th width="23%" align="left"><a href="<?php echo $link; ?>&s=disposisi&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Tujuan Disposisi</a></th> 
					<th width="2%" align="left">&nbsp;</th>
				</table>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<?php
						while ($row = mysql_fetch_array($data)) {
							$sts=$row['status']; 
							if($sts=='new'){$background="EDF3FB";}else{$background='#fff';}
							?>			  
							<tr bgcolor="<?php echo $background;?>" onmouseover="this.style.color='red';this.style.cursor='pointer';"onmouseout="this.style.color='#000';">
								<td width="11%" class="mail"><?php echo getTanggal($row['tanggal']); ?></td>
								<td width="26%" class="mail"><?php echo $row['dari']; ?></td>
								<td width="40%" class="mail">
								<?php echo $row['rangkuman']; ?>
								</td>
								<td width="19%" class="mail">
								<?php 
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
													<img src="img/file-lampiran.png" alt="" class="media"/>
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
</div>
