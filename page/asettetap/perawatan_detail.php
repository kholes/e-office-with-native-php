<?php
$id=$_GET['idt'];
$kib=substr($id,0,4);
?>
<script>
	$(document).ready(function(){
		get_kib();
		$("#pelaksana").autocomplete("page/barang/srcsuplayer.php", {
			selectFirst: true
		});
	});
	function get_kib(){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_kib&kib=<?php echo $kib;?>',
			cache :false,
			success:function (data){
				$('#infKib').html(data);
			}
		});
	}
	function get_item(idt,id){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_item&id='+id+'&idt='+idt,
			cache :false,
			success:function (data){
				val=eval(data);
				$('#jenis').val(val[1]);
				$('#harga').val(val[2]);
				$('#keterangan').val(val[3]);
				$('#tanggal').val(val[4]);
				$('#sparepart').val(val[5]);
				$('#status').val(val[6]);
				$.ajax({
					type:'post',
					url:'page/asettetap/prc_aset.php',
					data:'req=get_kib&kib=<?php echo $kib;?>&id='+val[0],
					cache :false,
					success:function (data){
						$('#infKib').html(data);
					}
				});
			}
		});
	}
	function update_perawatan(){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=update&id='+$('#idt').val()+'&tgl='+$('#tgl').val()+'&kategori='+$('#kategori').val()+'&pelaksana='+$('#pelaksana').val()+'',
			cache :false,
			success:function (data){
				history.back();
			}
		});
	}
	function insert_item(){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=insert_item&idt='+$('#idt').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&keterangan='+$('#keterangan').val()+'&tanggal='+$('#tanggal').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'',
			cache :false,
			success:function (data){
				location.reload();
			}
		});
	}
	function update_item(){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=update_item&idt='+$('#idt').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&keterangan='+$('#keterangan').val()+'&tanggal='+$('#tanggal').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'',
			cache :false,
			success:function (data){
				location.reload();
			}
		});
	}
	function delete_item(idt,id){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=delete_item&idt='+idt+'&id='+id+'',
			cache :false,
			success:function (data){
				location.reload();
			}
		});
	}
	function delete_perawatan(idt){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=delete&idt='+$('#idt').val(),
			cache :false,
			success:function (data){
				history.back();
			}
		});
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h3>DETAIL PERAWATAN ASET <?php echo $kib;?></h3>
		</div>
		<form method="post" action="<?php echo $link;?>&m=per_detail" id="perawatan">
			<div id="form">
				<ul>
					<li><b style="font-weight:bold">A. Transaksi</b>
						<ul class="col">
							<li>1. No. Registrasi</li>
							<li><input type="text" name="idt" id="idt" value="<?php echo $id;?>" /></li>
							<div class="c"></div>
							<li>2. Tanggal Registrasi </li>
							<li><input type="text" class="tgl" name="tgl" id="tgl" value="<?php echo tgl_eng_to_ind($dtperawatan->get_field('tanggal',$id)); ?>"  onclick="return showCalendar('tgl', 'dd-mm-y')"/></li>
							<div class="c"></div>
							<li>3. Kategori</li>
							<li>
								<select name="kategori" id="kategori">
								<?php 
								$kategori=$dtperawatan->get_field('kategori',$id);
								if(isset($kategori)){
									echo '<option value="'.$kategori.'" selected="selected">'.$kategori.'</option>';
								}else{
									echo '<option value="KIBA" selected="selected">KIBA</option>';
								}
								?>
								<option value="KIBA">KIBA</option>
								<option value="KIBB">KIBB</option>
								<option value="KIBC">KIBC</option>
								<option value="KIBE">KIBE</option>
								</select>
							</li>
							<div class="c"></div>
							<li>4. Pelaksana</li>
							<li>
							  <input type="text" name="pelaksana" id="pelaksana" value="<?php echo $dtperawatan->get_field('pelaksana',$id).'.'.$toko->get_field('nama',$dtperawatan->get_field('pelaksana',$id));?>" />
							</li>
						</ul>
				  </li>
					<div class="c"></div>
					<li><b style="font-weight:bold">B. Detail Transaksi</b>
					  <ul class="col">
							<li>1. ID Aset </li>
							<li><span id="infKib"></span></li>
							<div class="c"></div>
							<li>2. Tanggal perawatan </li>
							<li><input type="text" class="tanggal" name="tanggal" id="tanggal" value=""  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></li>
							<div class="c"></div>
							<li>3. Jenis perawatan</li>
							<li><input type="text" name="jenis" id="jenis" value=""></li>
							<div class="c"></div>
							<li>4. Sparepart</li>
							<li><input type="text" name="sparepart" id="sparepart" value=""></li>
							<div class="c"></div>
							<li>5. Harga / Biaya</li>
							<li>
							  <input type="text" name="harga" id="harga" value="" />
							</li>
							<div class="c"></div>
							<li>6. Status</li>
							<li>
							  <select name="status" id="status">
                                <option value="B">Baik</option>
                                <option value="KB">Kurang Baik</option>
                                <option value="RB">Rusak Berat</option>
                              </select>
							</li>
							<div class="c"></div>
							<li>7. Keterangan</li>
							<li>
							  <input type="text" name="keterangan" id="keterangan" value="" />
						</li>
					</ul>
				</li>
				<div class="c"></div>
				<li>
					<ul class="col">
						<li>&nbsp;</li>
						<li>
							<input type="button" name="insert" id="insert" onclick="insert_item()" value="Tambah" />
							<input type="button" name="update" id="update" onclick="update_item()" value="Ubah" />
						</li>
					</ul>
				</li>
				<div class="c"></div>
				<li><b style="font-weight:bold;">C. Rincian Perwatan</b>
					<ul>
						<li>
						<table cellpadding="0" cellspacing="0" width="100%" class="table">
							<th width="9%" align="left">ID.ASET</th>
							<th width="12%" align="left">TANGGAL</th>
							<th width="13%" align="left">JENIS</th>
							<th width="14%" align="left">SPAREPART</th>
							<th width="8%" align="right">HARGA</th>
							<th width="9%" align="center">STATUS</th>
							<th width="27%" align="left">KETERANGAN</th>
							<th width="4%" align="left">&nbsp;</th>
						</table>
						<div class="all-row">
							<table cellpadding="0" cellspacing="0" width="100%" class="table">
								<?php
								$data=$dtperawatan->get_all_item($id);
								if($data!=array()){
									foreach($data as $row){
								?>
								<tr>
									<td width="9%"><?php echo $row['id'];?></td>
									<td width="12%"><?php echo getTanggal($row['tanggal']);?></td>
									<td width="9%"><?php echo $row['jenis'];?></td>
									<td width="18%"><?php echo $row['sparepart'];?></td>
									<td width="8%" align="right"><?php echo format_angka($row['harga']);?></td>
									<td width="9%" align="center">
										<?php
										switch($row['status']){
											case 'B':
												echo "BAIK";
											break;
											case 'KB':
												echo "KURANG BAIK";
											break;
											case 'RB':
												echo "RUSAK BERAT";
											break;
										}
										?>									</td>
									<td width="25%"><?php echo $row['keterangan'];?></td>
									<td width="10%" align="right" style="vertical-align:top"><a onclick="get_item('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><img src="img/edit.png" /></a><a onclick="delete_item('<?php echo $row['idt'];?>','<?php echo $row['id'];?>');"><img src="img/hapus.png" /></a></td>
								</tr>
								<?php }}?>
							</table>
						</div>
						<div class="c5"></div>
						<table cellpadding="0" cellspacing="0" width="100%" class="table">
							<th style="text-align:left">TOTAL</th>
							<th style="text-align:right"><?php echo format_angka($dtperawatan->get_total_item($id));?></th>
						</table>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="head_content" style="box-shadow:none;" >
			<input type="button" name="simpan" id="simpan" onclick="update_perawatan()" value="Simpan" />
			<input type="button" name="hapus" id="hapus" onclick="delete_perawatan()" value="Hapus" />
			&nbsp;
			<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
		</div>
	</form>
</div>
