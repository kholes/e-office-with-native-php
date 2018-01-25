<script>
		$("#chatData").focus(); 
		$('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.wav" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
		$("#trig").on("click",function(){
			var a = $("#chatData").val().trim();
			if(a.length > 0){
				$("#chatData").val('');   
				$("#chatData").focus(); 
				$("<li></li>").html('<img src="small.jpg"/><span>'+a+'</span>').appendTo("#chatMessages");
				$("#chat").animate({"scrollTop": $('#chat')[0].scrollHeight}, "slow");
				$('#chatAudio')[0].play();
			}
		});

</script>
<div id='chatBox' style='margin-top:20px'>
        <h3>CHAT</h3>
        <div id='chat'>
            <ul id='chatMessages'>
                <li>
                	<img src="small.jpg"/>
                    <span>Hello Friends</span>
                </li>
                <li>
                	<img src="small.jpg"/>
                    <span>How are you?</span>
                </li>
            </ul>
        </div>
		<input type="text" id="chatData" placeholder="Message" />
	    <input type="button" value=" Send " id="trig" />
    </div>