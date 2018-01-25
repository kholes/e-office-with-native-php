<?php
if(isset($_GET['s'])){
	$s=$_GET['s'];
}else{$s='tgl_prmohonan';}
?>
<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewPermohonanData&s=<?php echo $s; ?>',
			cache:false,
			success:function(data){
				$('#inf-permohonan').html(data);
			}
		});
	});
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getItemPermohonan&id='+id+'',
			success: function(res){
				$('#infItem'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
				$('#infItem'+id).fadeOut('slow');
	}
</script>
<body>
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head">
      <div class="p-head-c">
        <div id="right"> Cari &raquo;
            <input type="text" class="cri" name="key" id="key" onKeyPress="cariData();">
        </div>
        <div id="left">
			<?php include 'permohonanmenu.php'; ?>
        </div>
      </div>
	</div>
	<div class="p-wrapper">
			<div id="p-main" style="margin-top:-40px;">
				<div id="inf-permohonan"></div>
			</div>
	</div>
</body>
