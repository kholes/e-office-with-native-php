<?php
$id=$_GET['idt'];
$act=$_GET['act'];
if(isset($act)){
	switch($act){
		case 'edit':
			$btn='Edit';
			$val='EDIT';
		break;
	}
}else{
	$btn='Simpan';
	$val='SIMPAN';
}
?>
<script>
	$(document).ready(function(){
		$("#pelaksana").autocomplete("page/barang/srcsuplayer.php", {
			selectFirst: true
		});
		clearForm();
		getAllTemp();
	});
	function cekTombol(){
		switch($('#tombol').val()){
			case 'Edit': editTemp();break;
			case 'Tambah': tambahTemp();break;
		}
	}
	function getId(){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=getId&kategori='+$('#kategori').val(),
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
		getId();
	}
	function tambahTemp(){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=tambahTemp&kategori='+$('#kategori').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&tanggal='+$('#tanggal').val()+'&keterangan='+$('#keterangan').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'&jenis='+$('#jenis').val(),
				cache :false,
				success:function (data){
					clearForm();
					getAllTemp();
				}
			});
	}
	function editTemp(){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=editTemp&kategori='+$('#kategori').val()+'&id='+$('#id_barang').val()+'&jenis='+$('#jenis').val()+'&harga='+$('#harga').val()+'&tanggal='+$('#tanggal').val()+'&keterangan='+$('#keterangan').val()+'&sparepart='+$('#sparepart').val()+'&status='+$('#status').val()+'&jenis='+$('#jenis').val(),
				cache :false,
				success:function (data){
					clearForm();
					getAllTemp();
				}
			});
	}
	function getAllTemp(id='<?php echo $id;?>'){
		var act;
		if(id!=''){act='item';}else{act='temp';}
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=getAllTemp&act='+act+'&idt='+id,
				cache :false,
				success:function (data){
					$('#infPerawatan').html(data);
					clearForm();
				}
			});
	}
	function delTemp(idt,id){
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=delTemp&id='+id+'&idt='+idt,
				cache :false,
				success:function (data){
					getAllTemp();
				}
			});
	}
	function getTemp(idt,id){
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=getTemp&id='+id+'&idt='+idt,
			cache :false,
			success:function (data){
				val=eval(data);
				$('#jenis').val(val[1]);
				$('#harga').val(val[2]);
				$('#keterangan').val(val[3]);
				$('#tanggal').val(val[4]);
				$('#sparepart').val(val[5]);
				$('#status').val(val[6]);
				$('#tombol').val('Edit');
				$.ajax({
					type:'post',
					url:'page/asettetap/kibprc.php',
					data:'req=getkib&id='+val[0],
					cache :false,
					success:function (data){
						$('#infKib').html(data);
					}
				});
			}
		});
	}
	function addPerawatan(){
		if($('#pelaksana').val()==''){
			alert('Data pelaksana belum diisi');
			$('#pelaksana').focus();
		}else{
			$.ajax({
				type:'post',
				url:'page/asettetap/prc_aset.php',
				data:'req=addPerawatan&kategori='+$('#kategori').val()+'&tgl='+$('#tgl').val()+'&pelaksana='+$('#pelaksana').val()+'',
				cache :false,
				success:function(data){
					clearForm();
					getAllTemp();
				}
			});
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>PERAWATAN ASET</a></li>
			<li class="active"><span id="infId"></span></li>
		</ul>
	</h3>
	<div class="c5"></div>
	  <div style="background:#ccc; padding:5px 5px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%"><label>Kategori</label></td>
            <td width="8%">
			<select name="kategori" id="kategori">
				<?php 
				$kategori=$dtperawatan->getField('kategori',$id);
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
			</td>
            <td width="6%" align="left"><label>Tanggal</label>
            </h3></td>
            <td width="17%"><span class="frm">
              <input type="text" class="tgl" name="tgl" id="tgl" value="<?php if(isset($act)){echo tgl_eng_to_ind($dtperawatan->getField('tanggal',$id));}else{echo $date->format('d-m-Y');} ?>"  onclick="return showCalendar('tgl', 'dd-mm-y')"/>
            </span> </td>
            <td width="7%"><label></label>
            <label>Pelaksana</label></td>
            <td width="21%"><span class="frm">
              <input type="text" name="pelaksana" id="pelaksana" value="<?php echo $dtperawatan->getField('pelaksana',$id).'.'.$toko->getField('nama',$dtperawatan->getField('pelaksana',$id));?>" />
            </span> </td>
          </tr>
        </table>
      </div>
		
	<div class="c10"></div>
<form method="post" action="<?php echo $link;?>&m=fper">
	<input type="hidden" name="mtgl" value="<?php echo $_GET['mtgl'];?>" />
	<input type="hidden" name="stgl" value="<?php echo $_GET['stgl'];?>" />
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-left:15px;">
	  <tr>
		<td width="19%"><label>ID Barang</label></td>
		<td width="36%">
		<input type="hidden" name="id" value="<?php echo $id;?>" />
		<span id="infKib"></span>
		<?php
		/* 
		<select name="id_barang">
		$x=$dtkibb->getAll();
		foreach($x as $row){
		echo '<option value="'.$row['id'].'">'.$row['id'].'&nbsp;'.$row['nama'].'&nbsp;'.$row['merek'].'</option>';
		}
		</select>
		*/
		?>		
		</td>
		<td width="4%">&nbsp;</td>
		<td width="13%"><label>Tanggal</label></td>
		<td width="28%"><input type="text" class="tanggal" name="tanggal" id="tanggal" value="<?php echo tgl_eng_to_ind($dtperawatan->getField('tanggal',$id));?>"  onClick="return showCalendar('tanggal', 'dd-mm-y')"/></td>
	  </tr>
	  <tr>
		<td><label>Jenis Perawatan </label></td>
		<td><input type="text" name="jenis" id="jenis" value="<?php echo $dtperawatan->getField('jenis',$id);?>"></td>
		<td>&nbsp;</td>
		<td><label>Sparepart</label></td>
		<td><input type="text" name="sparepart" id="sparepart" value="<?php echo $dtperawatan->getField('sparepart',$id);?>"></td>
	  </tr>
	  <tr>
		<td><label>Harga / Biaya</label></td>
		<td><input type="text" name="harga" id="harga" value="<?php echo $dtperawatan->getField('harga',$id);?>"></td>
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
		<td><input type="text" name="keterangan" id="keterangan" value="<?php echo $dtperawatan->getField('keterangan',$id);?>"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
		  <input type="button" name="tombol" id="tombol" value="Tambah" onclick="cekTombol();" />
		</td>
	  </tr>
	</table>
	<div class="c5"></div>
	<div id="infPerawatan">
	</div>
	<div class="c5"></div>
			<div class="head_content" style="box-shadow:none;" >
				<input type="button" name="btn" value="<?php echo $btn;?>" onclick="addPerawatan();">
				&nbsp;
				<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
			</div>
</form>
	</div>
</div>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$tanggal=tgl_ind_to_eng($_POST['tanggal']);
	$id=$_POST['id'];
	$kategori=$_POST['kategori'];
	$mtgl=$_POST['mtgl'];
	$stgl=$_POST['stgl'];
	switch ($_POST['btn']){
		case 'Registrasi':
			$data=array('id'=>$date->format('Ymdhis'),'id_barang'=>$_POST['id_barang'],'tanggal'=>$tanggal,'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
			$dtperawatan->addData($data);
			header("location:$link&m=fper");
		break;
		case 'Edit':
			$data=array('id_barang'=>$_POST['id_barang'],'tanggal'=>$tanggal,'jenis'=>$_POST['jenis'],'sparepart'=>$_POST['sparepart'],'harga'=>$_POST['harga'],'status'=>$_POST['status'],'keterangan'=>$_POST['keterangan']);
			$dtperawatan->updateData($id,$data);		
			header("location:$link&m=repmain");	
		break;		
		case 'Hapus':
			$del=$dtperawatan->delData($id);
			if($del){
				header("location:$link&m=repmain&kategori=$kategori&mtgl=$mtgl&stgl=$stgl");
			}else{
				header("location:$link&m=repmain&kategori=$kategori&mtgl=$mtgl&stgl=$stgl");			
			}
		break;		
	}
}
?>
<script>
	$(document).ready(function(){
		getkib();
	});
	$('#kategori').change(function(){
		getkib();
	});
	function getkib(){
		getId();
		var kib=$('#kategori').val();
		$.ajax({
			type:'post',
			url:'page/asettetap/kibprc.php',
			data:'req=getkib&kib='+kib,
			cache :false,
			success:function (data){
				$('#infKib').html(data);
			}
		});
	}
</script>
