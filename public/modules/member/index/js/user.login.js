/*!
 * Item Name : pp社区
 * Copyright 2012, 25pp.com
 *
 * Creator : X_Pilot(Inv)
 * Created Date : 2012.11.21
 */

//登陆页面
(function(ppZ) {
    var frmLogin, iptUser, iptPass, btnSubmit, loginTips, oLoginPage, bAutoLogin, yzmInput
        ppZ_common = ppZ.common;

    //页面事件定义
    oLoginPage = {
        submitBtn_init : function() {
            btnSubmit = $id("btnSubmit");
            ppZ_common.setMouseHover($(btnSubmit));
            btnSubmit.onclick = oLoginPage.fSubmit;
			var lastKeyDown = '';
			$(document).keydown(function(e){
				if(lastKeyDown != 38 && lastKeyDown != 40 && e.keyCode==13) btnSubmit.onclick; //回车提交 
				lastKeyDown = e.keyCode;
			})
			yzmInput.keyup(function(){
				var val = this.value;
				if(val.length > 4){
					this.value = val.substring(0,4);	
				} 	
			});
        },

        //提交表单
        fSubmit : function() {
            var yzmLen = yzmInput.val(), loginStatus = { dic: { '0' : "", '1' : "用户名不能为空",'2' : "密码不能为空", '3' : "用户名和密码均不能为空", '4' : "用户名、密码和验证码不能为空", '5' : "验证码错误", '6' : "验证码不能为空", '7' : "验证码为四位数字母或数字集合", '8' : "密码和验证码不能为空", '9' : "用户名和验证码不能为空" },error:0 };
            loginTips.innerHTML = "";
            loginTips.style.display = "none";
            bAutoLogin = $id("autoLogin").checked;
			
			
			
			
			if(yzmInput.length > 0){
			
				if(!iptUser.value && !iptPass.value && !yzmLen){
                	loginStatus.error = 4;
				}else if(!iptUser.value && !iptPass.value){
					loginStatus.error = 3;	
				}else if(!iptUser.value && !yzmLen){
					loginStatus.error = 9;	
				}else if(!iptPass.value && !yzmLen){
					loginStatus.error = 8;	
				}else if(!iptUser.value){
					loginStatus.error = 1;
				}else if(!iptPass.value){
					loginStatus.error = 2;
				}else if(!yzmLen){
					loginStatus.error = 6;	
				}else if(yzmLen.length != 4){
					loginStatus.error = 7;
				}else{
				/*
					$.ajax({
						type: "GET",
						url: "/user/check_reg_code/",
						dataType: "json",
						data: "preg_code=" + yzmLen,
						success: function(result){
							if(result == 0){
								loginStatus.error = 5;
								loginTips.innerHTML = loginStatus.dic[loginStatus.error];
                				loginTips.style.display = "block";
								return false;
							}else{
								loginTips.style.display = "none";
								frmLogin.submit();
							}
						}
					});	
					*/
					
					
				}
			}else{
				if(!iptUser.value && !iptPass.value){
					loginStatus.error = 3;	
				}else if(!iptUser.value){
					loginStatus.error = 1;
				}else if(!iptPass.value){
					loginStatus.error = 2;
				}
				else{
					loginTips.style.display = "none";
					//frmLogin.submit();	
				}	
			}
            
			
			if(loginStatus.error == 0)  {
			
				
				$('#btnSubmit').val('登录中......');	//.attr('disabled',true)
				
				var pass_val = iptPass.value;
				
				$.ajax({
						type: "post",
						url: "/user/ajax_login_verify",
						dataType: "json",
						data: "preg_code=" + yzmLen + "&username="+encodeURIComponent(iptUser.value) + "&password="+ encodeURIComponent(pass_val),
						success: function(result){
							// 重新加载页面
							if(result.status == '-5'){
								location.reload();                                                                                                                      
							}
							if(result.status == '-10'){
								$('#regCodeImg').attr('src', '/user/create_code/2?mt='+Math.random());                                                                                                                    
							}
						
							if(result.status == '1'){
							
								loginTips.style.display = "none";
								
								frmLogin.submit();							
							}else{
							
								loginStatus.error = 5;
								$('#loginTips').text(result.msg);
								
								//loginTips.innerHTML = loginStatus.dic[loginStatus.error];
                				loginTips.style.display = "block";
							}
							
						}
					});
				
				$('#btnSubmit').val('登 录');
				return false;
			}
			
			
			
            if(loginStatus.error != 0)  {
                loginTips.innerHTML = loginStatus.dic[loginStatus.error];
                loginTips.style.display = "block";
                return false;
            }
            
            return false;	//frmLogin.submit();
        }
    }

    //页面初始化
    oLoginPage.init = function() {
        frmLogin = $id("frmLogin");
        iptUser = $id("username");
        iptPass = $id("password");
        loginTips = $id("loginTips");
		yzmInput = $('input[name=regCode]');
		
        ppZ_common.fIpttext_hideLabel(iptUser);
        ppZ_common.fIpttext_hideLabel(iptPass);
        oLoginPage.submitBtn_init();
		
		iptUser.focus();

        //记住密码自动完成和提示信息重叠补丁
        var patcher = setInterval(function(){
            if(iptPass.value != ''){
                ppZ_common.fIpttext_hideLabel(iptPass);
                clearInterval(patcher);
            }
        },100);

        //百度浏览器表单自动完成高亮显示补丁
        if (window.navigator.userAgent.indexOf("BIDUBrowser")>=0) {
            var ts = setInterval(function(){
                $('input.user').css('background','transparent');
            },10);
//            setTimeout(function(){
//               clearInterval(ts);
//            },1000)
        }
    }

    ppZ.loginPage = oLoginPage; 
})(ppZone);