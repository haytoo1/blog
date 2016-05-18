(function(){
var phone = false;
if(document.body.offsetWidth < 768){
	phone = true;
}
var selecttoggle = function(){
	$('#select-toggle').click(function(){
		if($('.daohang').css('display') == 'none'){
			$('.daohang').show();
			if(phone){
				$('body').css('overflow', 'hidden');
			}
		}else{
			$('.daohang').hide();
			if(phone){
				$('body').css('overflow', 'auto');
			}
		}
		
	});
};

/*分页*/
var createPaginator = function(page, totalPages){
	if(phone){
		$('#jqPaginator').jqPaginator({
		    totalPages: totalPages,
		    visiblePages: 1,
		    currentPage: page,
		
		    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">上一页</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">下一页</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num) {
		    	
		    }
		});
	}else{
		$('#jqPaginator').jqPaginator({
		    totalPages: totalPages,
		    visiblePages: 5,
		    currentPage: page,
		
		    first: '<li class="first"><a href="javascript:void(0);">首页</a></li>',
		    prev: '<li class="prev"><a href="javascript:void(0);">上一页</a></li>',
		    next: '<li class="next"><a href="javascript:void(0);">下一页</a></li>',
		    last: '<li class="last"><a href="javascript:void(0);">尾页</a></li>',
		    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
		    onPageChange: function (num) {
		    	
		    }
		});
	}
	
};

/*导航*/
(function(){
	$('.daohang li').click(function(){
		$('.daohang li').removeClass('active');
		$(this).addClass('active');
		if(phone){
			$('#select-toggle').click(); 
		}
	});
})();

/*判断客服端类型*/
var clienttype = function() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = 'PC';
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = Agents[v];
            if(Agents[v] == 'Windows Phone'){
        		flag = 'WindowsPhone';
        	}
            break;
        }
    }
    return flag;
}

/*qq群和qq交谈类型选择*/
var qq_check_type = function(){
	var type = clienttype();
	$('.client').children('.child').hide();
	$('.client .'+type).show();
	switch (type){
		case 'PC':
			$.getScript('http://v3.jiathis.com/code/jia.js');
			break;
		case 'iPhone':
			$.getScript('http://v3.jiathis.com/code/jiathis_m.js');
		break;
		default:
			break;
	}
	
};
/*发送重新激活请求*/
var sendactiveuser = function(){
	$('#activeuser').click(function(){
		var email = $('#userid').val();
		var date = $.ajax({
			type:'get',
			url:activeuser,
			dataType:'json',
			data:{
				token:email,
			}, 
			
			success:function(date){
				layer.closeAll('loading');
				if(date.status == 1){
					alert('发送成功，请到邮箱中激活。');
				}else{
					alert('请求失败：'+date['msg']);
				}
			},
			error:function(){
				layer.closeAll('loading');
				alert('网络错误');
			},
			complete:function(){
				self.obj = null;
			},
		});
	});
};

/*发送注册请求*/
var sendregisterrequest = function(username, pass1, pass2){
	layer.load(2);
	var date = $.ajax({
		type:'post',
		url:registerurl,
		dataType:'json',
		data:{
			account:username,
			user_passwd:pass1,
			repasswd:pass2,
			_csrf:csrf,
		}, 
		
		success:function(date){
			layer.closeAll('loading');
			if(date.status == 1){
				layer.open({
					type: 1,
					title: false,
					closeBtn: 0,
					shadeClose: true,
					skin: 'yourclass',
					content: $('#activate'),
				});
				getloadstatus(date.userinfo);
			}else{
				alert('注册失败：'+date['msg']);
			}
		},
		error:function(){
			layer.closeAll('loading');
			alert('网络错误');
		},
		complete:function(){
			self.obj = null;
		},
	});
}
/*发送登陆请求*/
var sendloadingrequest = function(username, pass1){
	layer.load(2);
	var date = $.ajax({
		type:'post',
		url:loginurl,
		dataType:'json',
		data:{
			account:username,
			user_passwd:pass1,
			_csrf:csrf,
		},
		
		success:function(date){
			layer.closeAll('loading');
			if(date.status == 1){
				getloadstatus(date.userinfo);
				store.set('username',username);
				$('.close .close-tips').click();
			}else{
				alert('登陆失败：'+date['msg']);
			}
		},
		error:function(){
			layer.closeAll('loading');
			alert('网络错误');
		},
		complete:function(){
			self.obj = null;
		},
	});
}

/*注册登录tips句柄*/
var usernameindex = '';
var password1index = '';
var password2lindex = '';
var loadusername ='';
var loadpassword ='';

/*登陆注册退出按钮*/
var registered = function(){
	$('#zhuce').click(function(){
		$('.registered').css('display', 'block');
		$('.registered').animate({
			left:'0px',
			top:'0px',
			opacity:'1',
		},300);
	});
	
	$('#reload').click(function(){
		$('.registered').css('display', 'block');
		$('.registered').animate({
			left:'350px',
			top:'-100px',
			opacity:'0',
		},300,function(){
			$('.registered').css('display', 'none');
		});
	});
	
	$('#landing').click(function(){
		$('.registered').css('left', '350px');
		$('.registered').css('top', '-100px');
		$('.registered').css('opacity', '0');
	});
	
	$('#registering').click(function(){
		$('.registered').css('left', '0px');
		$('.registered').css('top', '0px');
		$('.registered').css('opacity', '1');
	}); 
	/*推出按钮*/
	$('#exit').click(function(){
		$('.user-info').removeClass('islanding');
		$('#password').val('');
		var data = $.ajax({
			type:"get",
			url:logout,
			
			complete:function(){
				self.obj = null;
			}
		});
	});
	
	$('#reg').click(function(){
		/*验证用户名*/
		var send = true;
		var username = $('#reg-username').val();
        var res = username.match(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-z]+$/);  
        if(res==null)  { 
        	layer.close(usernameindex);
            usernameindex = layer.tips('请输入有效邮箱地址作为用户名', '#reg-username', {
				tips: [2, '#FFB330'],
				time: 0,
				tipsMore: true
			});
			send = false;
        }  
		/*验证密码*/
		var pass1 = $('#reg-password1').val();
		var passmsg = false;
		var length = parseInt(pass1.length);
		if(length<8 || length>12){
			passmsg = '请输入8-12位有效密码';
		}
		if(!passmsg){
			reg = pass1.match(/^[a-zA-Z0-9~!@#$%^&*()_\+.,|*-=/\\;'":\[\]\{\}]+$/);  
			if(reg == null){
				passmsg = '请输入字母、数字和普通字符组成的密码';
			}
		}
		if(passmsg){
			layer.close(password1index);
			password1index  = layer.tips(passmsg, '#reg-password1', {
				tips: [2, '#FFB330'],
				time: 0,
				tipsMore: true
			});
			send = false;
		}
		
		var pass2 = $('#reg-password2').val();
		if(pass1 != pass2){
			layer.close(password2lindex);
			password2lindex  = layer.tips('两次输入密码不一样', '#reg-password2', {
				tips: [2, '#FFB330'],
				time: 0,
				tipsMore: true
			});
			send = false;
		}
		
		if(send){
			sendregisterrequest(username, pass1, pass2);
		}
	});
	
	$('#reg-password1').bind('input propertychange', function() { 
		layer.close(password1index);
	});
	$('#reg-password2').bind('input propertychange', function() { 
		layer.close(password2lindex);
	});
	$('#reg-username').bind('input propertychange', function() { 
		layer.close(usernameindex);
	});
	$('.close-tips').click(function(e){
		if(e.target && $(e.target).hasClass('close-tips')){
			layer.closeAll();
		}
	});
	
	$('#goloading').click(function(){
		var username = $('#userid').val();
		var password = $('#password').val();
		var send = true;
		
		var res = username.match(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-z]+$/);  
        if(res==null)  { 
        	layer.close(usernameindex);
            usernameindex = layer.tips('请输入有效邮箱地址作为用户名', '#userid', {
				tips: [2, '#FFB330'],
				time: 0,
				tipsMore: true
			});
			send = false;
        }
		
		if(send){
			sendloadingrequest(username, password);
		}
	});
	
	$('.warning-close').click(function(){
		$('.warning-activate').css('display', 'none');
	});
}

/*邮件提示悬浮事件*/
$('.mail-img').mouseover(function(){
	$('.mail-list').css('display','block');
});
$('.mail-img').mouseout(function(){
	$('.mail-list').css('display','none');
});
$('.mail-list').mouseover(function(){
	$('.mail-list').css('display','block');
});
$('.mail-list').mouseout(function(){
	$('.mail-list').css('display','none');
});

/*reload-page 刷新页面*/
$('.reload-page').click(function(){
	location.reload();
});

/*更新页面登陆状况*/
(function(){
	var username = store.get('username');
	if(username){
		$('#userid').val(username);
	}
})();

(function(){
	$.ajax({
		type:"get",
		url:getuserinfo,
		datatype:'json',
		
		success:function(data){
			getloadstatus(data.userinfo);
		},
		complete:function(){
			self.obj = null;
		}
	});
})();

var getloadstatus = function(userinfo){
	if(!userinfo){
		$('.user-info').removeClass('islanding');
		return true;
	}
	if(userinfo['user_nickname']){
		$('#user-name').text(userinfo['user_nickname']);
	}
	if(!userinfo['user_active']){
		$('.warning-activate').css('display', 'block');
	}
	$('.user-info').addClass('islanding');
};

/*请求文章数据*/ 
(function(){
	if(!$('.lists')[0]){
		return true;
	}
	var data = $.ajax({
		type:"get",
		url:getlists,
		dataType:'json',
		
		success:function(data){
			if(data.status==1){
				getloadstatus(data.userinfo);
			}
		},
		error:function(){
		},
		complete:function(){
			self.obj = null;
		}
	});
})();

/*自适应页面高度*/
(function(){
	var height = document.body.clientHeight-$('.htitle').height()-$('.footer').outerHeight();
	height = height+'px';
	$('.hcontainer').css('min-height', height);
})();

var init = function(){
	qq_check_type();
	selecttoggle();
	createPaginator(1,20);
	registered();
	sendactiveuser();
};

$(document).ready(init);
})()


