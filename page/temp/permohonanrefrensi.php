<script>
	function cariData(){
		var key=document.getElementById('key').value;
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=caridata&key='+key+'',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
			}
		});
	}
	function viewData(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=viewdata',
			cache:false,
			success:function(data){
				$('#contentref').html(data);
				$('#key').focus();
			}
		});
	}
	function sendData(id){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=addTempPermohonan&id='+id,
			cache:false,
			success:function(data){
				window.location="?p=<?php echo encrypt_url('permohonan');?>";
			}
		});
	}
</script>
	<body onLoad="viewData();">
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
		<div id="p-main"style="margin-top:-40px;">
			<div id="contentref"></div>
		</div>
	</div>
	</body>
	<script>
	function setfocus(){$('#key').focus();}
	document.onkeydown = function(e){setfocus();}
	</script>
