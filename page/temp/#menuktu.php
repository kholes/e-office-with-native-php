<script>
	$(document).ready(function(){
		getDis();
		getOut();
		getPrc();
		getRem();
	});
	setInterval(function(){
		getDis();
		getOut();
		getPrc();
		getRem();
		//$('#chatAudio')[0].play();
		//alert();
		
	}, 2000);
	function getAll(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=all',cache :false,success:function (data){$('#infAll').html(data);}});
	}
	function getNew(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=new',cache :false,success:function (data){
			var oldMail=document.getElementById('infNew').innerHTML;
			if(parseInt(data) > parseInt(oldMail)){
				$('#chatAudio')[0].play();
				alert('Surat baru masuk');
				window.location='<?php echo $link; ?>';
			}
			$('#infNew').html(data);
		}});
	}
	function getOut(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=out&sts=terkirim',cache :false,success:function (data){$('#infOut').html(data);}});
	}
	function getDis(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=dis',cache :false,success:function (data){$('#infDis').html(data);}});
	}
	function getPrc(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=prc',cache :false,success:function (data){$('#infPrc').html(data);}});
	}
	function getRem(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getRem&mail=in&sts=all',cache :false,success:function (data){$('#infRem').html(data);}});
	}

</script>
					<ul>
						<li><a href="<?php echo $link; ?>&mail=in&sts=dis">Surat Masuk <span class="counter" id="infDis"></span></a></li>
						<li><a href="<?php echo $link; ?>&m=dtoutbox&mail=out&sts=proses">Surat Keluar <span class="counter" id="infOut"></span></a></li>
						<li><a href="<?php echo $link; ?>&mail=in&sts=prc">Surat Proses <span class="counter" id="infPrc"></span></a></li>
						<li><a href="<?php echo $link; ?>&mail=in&sts=rem">Surat Berbatas <span class="counter" id="infRem"></span></a></li>
						<!--<li><a href="<?php echo $link; ?>&sts=all">Total Surat <span class="counter" id="infAll"></span></a></li>-->
					</ul>
