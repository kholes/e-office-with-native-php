<script>
	$(document).ready(function(){
		getIn();
		getOut();
		getPrc();
		getRem();
	});
	setInterval(function(){
		getIn();
		getOut();
		getPrc();
		getRem();
		//$('#chatAudio')[0].play();
		//alert();
		
	}, 2000);
	function getIn(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getIn',cache :false,success:function (data){
			var oldMail=document.getElementById('infIn').innerHTML;
			if(parseInt(data) > parseInt(oldMail)){
				$('#chatAudio')[0].play();
				alert('Surat baru masuk');
				window.location='<?php echo $link; ?>';
			}
			$('#infIn').html(data);
		}});
	}
	function getOut(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getOut',cache :false,success:function (data){
			var oldMail=document.getElementById('infOut').innerHTML;
			if(parseInt(data) > parseInt(oldMail)){
				$('#chatAudio')[0].play();
			}
			$('#infOut').html(data);
		}});
	}
	function getPrc(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=prc',cache :false,success:function (data){$('#infPrc').html(data);}});
	}
	function getRem(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&mail=in&sts=rem',cache :false,success:function (data){$('#infRem').html(data);}});
	}

</script>
	<ul class="dropmenu">
	<li><a href="<?php echo $link; ?>&m=minbox">Menu</a>
		<ul>
			<div class="mn"><b></b>
				<li><a href="<?php echo $link;?>&m=fmail">Tulis Surat</a></li>
				<li><a>Registrasi Index</a></li>
			</div>
		</ul>
	</li>
	<li><a href="<?php echo $link; ?>&m=minbox">Surat Masuk <span id="infIn" style="color:#FA3605;"></span></a>
		<ul>
			<div class="mn"><b></b>
				<li><a>Surat Baru </a></li>
				<li><a>Surat Disposisi </a></li>
				<li><a>Surat Proses </a></li>
				<li><a>Surat Berbatas </a></li>
			</div>
		</ul>
	</li>
	<li><a href="<?php echo $link; ?>&m=moutbox">Surat Keluar <span id="infOut" style="color:#FA3605; padding:5px;"></span></a></li>
</ul>