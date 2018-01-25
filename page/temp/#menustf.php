<script>
	$(document).ready(function(){
		getRev();
		getNew();
		getSend();
	});
	setInterval(function(){
		getRev();
		getNew();
		getSend();
		//$('#chatAudio')[0].play();
		//alert();
		
	}, 2000);
	function getNew(){
		$.ajax({
			type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=out&sts=proses',cache :false,success:function (data){
				$('#infNew').html(data);
			}
		});
	}
	function getRev(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=out&sts=revisi',cache :false,success:function (data){$('#infRev').html(data);}});
	}
	function getSend(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=out&sts=terkirim',cache :false,success:function (data){$('#infSend').html(data);}});
	}
</script>
<ul>
	<li class="menutip">
		<a class="menu">Menu</a>
		<span><b></b>
		<ul>
			<li><a style="color:#fff" href="<?php echo $link; ?>&m=fmail">Tulis Surat</a></li>
			<li><a style="color:#fff" href="<?php echo $link; ?>&m=fdraftsurat">Tulis Keluar</a></li>
		</ul>
		</span>
	</li>
	<li><a href="<?php echo $link; ?>&mail=out&sts=proses">Surat Keluar <span class="counter" id="infNew"></span></a></li>
	<li><a href="<?php echo $link; ?>&mail=out&sts=revisi">Surat Revisi <span class="counter" id="infRev"></span></a></li>
	<li><a href="<?php echo $link; ?>&mail=out&sts=terkirim">Surat Terkirim <span class="counter" id="infSend"></span></a></li>
</ul>