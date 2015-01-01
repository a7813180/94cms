	$(function(){
		$('#tosubmitforma').click(function(){
			$('#submitformm').toggleClass('hover');
			$('.submitBox').slideToggle();
		});

		$('#submitformm').click(function(){
			$('#submitformm').toggleClass('hover');
			$('.submitBox').slideToggle();
		});
		

	})
	function change_code(obj){
		$("#code").attr("src",URL+Math.random());
		return false;
	}
	var URL = '/Index/Index/verify/';


function submitcheck(){

	//验证邮箱
	var str = document.submitform.email.value;
	var result=str.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/); 
	if(result==null){
		alert('邮箱格式不正确');
		return false; 
		
	} 

	if (document.submitform.name.value == "" || document.submitform.name.value == "您的称呼") {
		alert("请填写您的称呼。");
		document.submitform.name.focus();
		return false;
	}

	//验证手机号码
	var tel = document.submitform.tel.value;
	var resulttel=tel.match(/1[3-9]+\d{9}/); 
	if(resulttel==null){
		alert('手机格式不正确');
		return false; 
	} 
	if (document.submitform.tel.value == "" || document.submitform.tel.value == "你的手机号") {
		alert("请填写你的手机号。");
		document.submitform.name.focus();
		return false;
	}

	if (document.submitform.code.value == "") {
		alert("请填写验证码。");
		document.submitform.name.focus();
		return false;
	}

	return true;
}

