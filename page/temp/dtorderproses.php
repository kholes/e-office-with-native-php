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
				$('#load'+idt).fadeOut('slow');
				$('#infEdit'+idt).html(res);
			}
		});		
	}
	function approveOreder(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=updateStatus&id='+id,
			cache :false,
			success: function(res){
				window.location="?p=<?php echo encrypt_url('dtorderkeluarbarang'); ?>&idt="+id;
			}
		});	
	}
	function printOrder(id){
		var ord=null;
		if (ord==null){
			ord=open('print/tandaterima.php?id='+id,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1100,height=1600');
		}
	}
	function getOrder(){
		$.ajax({
			type:'post',
			url:'ajaxtemp.php',
			data:'req=prcOrderPrc',
			cache :false,
			success:function (data){
				$('#infOrderPrc').html(data);	
			}
		});		
	}
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
				<div id="right">
					<input type="text" name="barcode" id="barcode">
				</div>
				<div id="left">
					<?php include 'dtordermenu.php'; ?>
				</div>
			</div>
		</div>		
	<div class="p-wrapper">
		<div id="p-main" style="margin-top:-40px">
				<span id="infOrderPrc"></span>
		</div>
	</div>
</body>