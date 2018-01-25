// JavaScript Document
//=========================Handled Notification SURAT EXTERNAL==============
	function getmailin_star(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getmailin_star',cache :false,
			success:function (data){
				var old_mail_in=$('#old_mail_in').val();
				val=eval(data);
				$('#infmailin_star').html(val[1]);
				$('#infmailin_head_star').html(val[1]);
				if(val[0]>0){$('#infmailin_new').html('<span class="count_news">'+val[0]+'</span>');}else{$('#infmailin_new').html('');}
				if(parseInt(val[0]) > parseInt(old_mail_in)){
					$('#chatAudio')[0].play();
					getnotice_mailin();
					getold_mail_in();
				}
			}
		});		
	}
	function getnotice_mailin(mail){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getnoticein',cache :false,
			success:function (data){
				var obj=eval(data);
				var id=obj[0];
				var jab=obj[1];
				var sts=obj[2];
				notice_mailin(id,jab,sts);
			}
		});
	}
	function getold_mail_in(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getold_mail_in',cache :false,
			success:function (data){
				$('#old_mail_in').val(data);
			}
		});
	}
//=========================Handled Notification SURAT INTERNAL==============
	function getmailint_star(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getmailint_star',cache :false,
			success:function (data){
				var old_mail_int=$('#old_mail_int').val();
				val=eval(data);
				$('#infmailint_star').html(val[1]);
				$('#infmailint_head_star').html(val[1]);
				if(val[0]>0){$('#infmailint_new').html('<span class="count_news">'+val[0]+'</span>');}else{$('#infmailint_new').html('');}
				if(parseInt(val[0]) > parseInt(old_mail_int)){
					$('#chatAudio')[0].play();
					getnotice_mailint();
					getold_mail_int();
				}
			}
		});		
	}
	function getold_mail_int(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getold_mail_int',cache :false,
			success:function (data){
				$('#old_mail_int').val(data);
			}
		});
	}
	function getnotice_mailint(mail){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getnoticeint',cache :false,
			success:function (data){
				var obj=eval(data);
				var id=obj[0];
				var jab=obj[1];
				var sts=obj[2];
				notice_mailint(id,jab,sts);
			}
		});
	}

/*===================Handled sub menu count data surat keluar terkirim===================================*/
	function infmout(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getmout',cache :false,
			success:function (data){
				$('#infmout').html(data);
			}
		});
	}

/*============================= PENERIMAAN / PENGAJUAN BARANG ===================================*/
	function getpengajuan_star(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getpengajuan_star',cache :false,
			success:function (data){
				var old_pengajuan=$('#old_pengajuan').val();
				val=eval(data);
				$('#starPengajuan, #infpengajuan_head_star').html(val[1]);
				$('#infpengajuan_head_new').html('<span class="count_news">'+val[0]+'</span>');
				if(parseInt(val[0]) > parseInt(old_pengajuan)){
					$('#chatAudio')[0].play();
					getnotice_pengajuan();
					getold_pengajuan();
				}
			}
		});		
	}
	function getnotice_pengajuan(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getnotice_pengajuan',cache :false,
			success:function (data){
				var obj=eval(data);
				var id=obj[0];
				var jab=obj[1];
				var sts=obj[2];
				notic_pengajuan(id,jab,sts);
			}
		});
	}
	function getold_pengajuan(){
		$.ajax({type:'post',url:'lib/infnews.php',data:'req=getold_pengajuan',cache :false,
			success:function (data){
				$('#old_pengajuan').val(data);
			}
		});
	}

