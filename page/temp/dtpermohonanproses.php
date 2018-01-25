<script type="text/javascript" src="js/autocomplete.js"></script>		
<script>
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getItem&id='+id+'',
			success: function(res){
				$('#infItem'+id).fadeIn('slow').html(res);
			}
		});		
	}
	function viewHide(id){
		$('#infItem'+id).fadeOut('slow');
	}
	function orderHide(id){
		$('#orderID'+id).fadeOut('slow');
	}
	function editQty(idt,id){
		var qty=document.getElementById('qty'+idt+id).value;
		var ket=document.getElementById('ket'+idt+id).value;
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=editQty&idt='+idt+'&id='+id+'&qty='+qty+'&ket='+ket+'',
			beforeSend: function(data){$("#load"+idt).fadeIn(1000,0).html('<img src="img/spinner.gif">Proses edit...')},	
			success: function(res){
				alert(res);
				$('#load'+idt).fadeOut('slow');
				$('#infEdit'+idt).html(res);
				getStok();
			}
		});		
	}
	function approveOreder(id){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=approveOreder&sts=terima&id='+id+'&user=<?php echo $logid; ?>',
			cache :false,
			success:function (data){
				alert(data);
				//viewHide(id);
				//orderHide(id);
				//getStok();
			}
		});		
	}
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=getOrderProses&status=terima',
			cache :false,
			success:function (data){
				$('#infOrder').html(data);	
			}
		});		
	});
	function getStok(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=getStok',
			cache :false,
			success:function (data){
				$('#infStok').html(data);	
			}
		});		
	}
</script>
<body onLoad="getOrder();getStok();">
	<div class="p-menu"><?php include "menu.php"; ?></div>
	<div class="p-head">
      <div class="p-head-c">
        <div id="right"> Cari &raquo;
            <input type="text" class="cri" name="key" id="key" onKeyPress="cariData();">
        </div>
        <div id="left">
			<?php include 'dtpermohonanmenu.php'; ?>
        </div>
      </div>
	</div>
	<div class="p-wrapper">
		<div id="p-main">
				<span id="infOrder"></span>
		</div>
	</div>
</body>