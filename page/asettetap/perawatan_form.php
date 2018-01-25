<script>
	$(document).ready(function(){
		$("#pelaksana").autocomplete("page/barang/srcsuplayer.php", {
			selectFirst: true
		});
		clearForm();
		get_kib();
		get_all_temp();
	});
	function get_kib(){
		get_id();
		var kib=$('#kategori').val();
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_kib&kib='+kib,
			cache :false,
			success:function (data){
				$('#infKib').html(data);
			}
		});
	}
	function get_id(){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=get_id&kategori='+$('#kategori').val(),
				cache :false,
				success:function (data){
					$('#infId').html(data);
					$('#kode').val(data);
				}
			});
	}
	function clearForm(){
		$('#jenis').val('');
		$('#harga').val('');
		$('#keterangan').val('');
		$('#tanggal').val('');
		$('#sparepart').val('');
		$('#status').val('');
		$('#jenis').focus();
		//getAllTemp();
		get_id();
	}
	function insert_temp(){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=insert_temp&kategori='+$('#kategori').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&tanggal='+$('#tanggal').val()+'&keterangan='+$('#keterangan').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'&jenis='+$('#jenis').val(),
			cache :false,
			success:function (data){
				clearForm();
				get_all_temp();
			}
		});
	}
	function update_temp(){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=update_temp&kategori='+$('#kategori').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&tanggal='+$('#tanggal').val()+'&keterangan='+$('#keterangan').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'&jenis='+$('#jenis').val(),
				cache :false,
				success:function (data){
					clearForm();
					get_all_temp();
				}
			});
	}
	function get_all_temp(id='<?php echo $id;?>'){
		var act;
		if(id!=''){act='item';}else{act='temp';}
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=get_all_temp&act='+act+'&idt='+id,
				cache :false,
				success:function (data){
					$('#infPerawatan').html(data);
					clearForm();
				}
			});
	}
	function delete_temp(idt,id){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=delete_temp&id='+id+'&idt='+idt,
				cache :false,
				success:function (data){
					get_all_temp();
				}
			});
	}
	function get_temp(idt,id){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_temp&id='+id+'&idt='+idt,
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
					data:'req=get_kib&kib='+$('#kategori').val()+'&id='+val[0],
					cache :false,
					success:function (data){
						$('#infKib').html(data);
					}
				});
			}
		});
	}
	function insert_perawatan(){
		if($('#pelaksana').val()==''){
			alert('Data pelaksana belum diisi');
			$('#pelaksana').focus();
		}else{
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=insert&kategori='+$('#kategori').val()+'&tgl='+$('#tgl').val()+'&pelaksana='+$('#pelaksana').val(),
				cache :false,
				success:function(data){
					clearForm();
					get_all_temp();
				}
			});
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-wrench">   <label>REGISTRASI PERAWATAN</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<div class="page-header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%"><label>Kategori</label></td>
            <td width="8%">
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
				<option value="KIBB" selected="selected">KIBB</option>
				<option value="KIBC">KIBC</option>
				<option value="KIBE">KIBE</option>
            </select>
			</td>
            <td width="6%" align="left"><label>Tanggal</label></td>
            <td width="17%"><span class="frm">
              <input type="text" class="tgl" name="tgl" id="tgl" value="<?php if(isset($act)){echo tgl_eng_to_ind($dtperawatan->get_field('tanggal',$id));}else{echo $date->format('d-m-Y');} ?>"  onclick="return showCalendar('tgl', 'dd-mm-y')"/>
            </span> </td>
            <td width="7%"><label></label>
            <label>Pelaksana</label></td>
            <td width="21%"><span class="frm">
              <input type="text" name="pelaksana" id="pelaksana" />
            </span> </td>
          </tr>
        </table>
		</div>
		<div class="c10"></div>
		<form method="post" action="<?php echo $link;?>&m=fper">
			<input type="hidden" name="mtgl" value="<?php echo $_GET['mtgl'];?>" />
			<input type="hidden" name="stgl" value="<?php echo $_GET['stgl'];?>" />
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
	  			<tr>
					<td width="19%"><label>ID Barang</label></td>
					<td width="36%">
						<span id="infKib"></span>
					</td>
					<td width="4%">&nbsp;</td>
					<td width="13%"><label>Tanggal</label></td>
					<td width="28%"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo tgl_eng_to_ind($dtperawatan->get_field('tanggal',$id));?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
				</tr>
				<tr>
					<td><label>Jenis Perawatan </label></td>
					<td><input type="text" name="jenis" id="jenis" value="<?php echo $dtperawatan->get_field('jenis',$id);?>"></td>
					<td>&nbsp;</td>
					<td><label>Sparepart</label></td>
					<td><input type="text" name="sparepart" id="sparepart" value="<?php echo $dtperawatan->get_field('sparepart',$id);?>"></td>
				</tr>
				<tr>
					<td><label>Harga / Biaya</label></td>
					<td><input type="text" name="harga" id="harga" value="<?php echo $dtperawatan->get_field('harga',$id);?>"></td>
					<td>&nbsp;</td>
					<td><label>Status</label></td>
					<td>
						<select name="status" id="status">
							<option value="B">Baik</option>
							<option value="KB">Kurang Baik</option>
							<option value="RB">Rusak Berat</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label>Keterangan</label></td>
					<td><input type="text" name="keterangan" id="keterangan" value="<?php echo $dtperawatan->get_field('keterangan',$id);?>"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
					  <input type="button" name="tombol" id="tombol" value="Tambah" onclick="insert_temp();" />
					  <input type="button" name="update" id="update" onclick="update_temp()" value="Ubah" />
					</td>
				</tr>
			</table>
	<div class="c5"></div>
	<div id="infPerawatan">
	</div>
	<div class="c5"></div>
		  <div class="head_content" style="box-shadow:none;" >
				<input type="button" name="btn" value="Simpan" onclick="insert_perawatan();">
		    &nbsp;</div>
</form>
	</div>
</div>
<script>
		get_kib();
	$('#kategori').change(function(){
		get_kib();
	});
</script>
