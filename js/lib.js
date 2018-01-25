// JavaScript Document
function cek(){select();}
function select(){
	var x=document.getElementById('sel').checked;
	if(x==true){
		menuShow();
		var theForm = document.MyForm;
		for (i=0; i<theForm.elements.length; i++) {
			if (theForm.elements[i].name=='pilih[]')
				theForm.elements[i].checked = 1;
		}
	}else{
		menuHide();
		var theForm = document.MyForm;
		for (i=0; i<theForm.elements.length; i++) {
			if (theForm.elements[i].name=='pilih[]')
				theForm.elements[i].checked = 0;
		}
	}
}
function hapus_in(id,dt){
	$.ajax({
		type:'post',
		url:'page/surat/prc_mail.php',
		data:'btn=hapus&dt='+dt+'&id='+id,
		cache :false,
		success:function(){
			location.reload();
		}
	});
}
function hapus_int(id,dt){
	$.ajax({
		type:'post',
		url:'page/surat/prc_mail.php',
		data:'btn=hapus_int&dt='+dt+'&id='+id,
		cache :false,
		success:function(res){
			location.reload();
		}
	});
}
function hapus_int_out(id,dt){
	$.ajax({
		type:'post',
		url:'page/surat/prc_mail.php',
		data:'btn=hapus_int_out&dt='+dt+'&id='+id,
		cache :false,
		success:function(res){
			location.reload();
		}
	});
}
function pilih_menu(){
	var theForm = document.MyForm;
	for (i=0; i<theForm.elements.length; i++) {
		//if (theForm.elements[i].name=='pilih[]')
	var x=theForm.elements[i].checked;
	if(x==true)
			menuShow();
		else
			menuHide();
	}
}
function menuHide(){
	$("#menu_right").animate({right: '-80px'});
	//$('#menu_right').slideToggle();
}
function menuShow(){
	//$('#menu_right').slideToggle();
	$("#menu_right").animate({right: '0px'});
}
/*
$("#flip").click(function(){
    $("#panel").slideToggle();
});
$("button").click(function(){
	$("#menu_right").animate({left: '250px'});
});
*/
