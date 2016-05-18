<style>
.repassword{
    width: 100%;
    padding: 20px;
}	
.repassword ul{
	list-style: none;
    padding: 0px;
    width: 665px;
    height: 30px;
    margin: auto;
}
.repassword ul li{
	float: left;
    width: 227px;
    height: 30px;
    text-align: center;
    line-height: 30px;
}

.back-img1{
	background: url(/static/img/sprites.png) 0px -90px;
	z-index: 30px;
}
.back-img2{
	background: url(/static/img/sprites.png) 0px -120px;
	margin-left: -13px;
}
.back-img3{
	background: url(/static/img/sprites.png) 0px -150px;
	margin-left: -4px;
}
.img1 .back-img1{
	background: url(/static/img/sprites.png) 0px 0px;
	color: #eee;
}
.img2 .back-img2{
	background: url(/static/img/sprites.png) 0px -30px;
	color: #eee;
}
.img3 .back-img3{
	background: url(/static/img/sprites.png) 0px -60px;
	color: #eee;
}
.page1, .page2, .page3{
	width: 665px;
    margin: auto;
    margin-top: 60px;
    text-align: center;
    display: none;
}
.img1 .page1,.img2 .page2,.img3 .page3{
	display: block;
}
.page1 div, .page2 div, .page3 div{
	width: 400px;
    margin: auto;
    margin-bottom: 20px;
}
.repassword label{
	width: 100px;
    text-align: right;
    float: left;
    height: 34px;
    line-height: 34px;
}
.repassword input{
	width: 230px;
}
#e-code{
	width: 133px;
    float: left;
    margin-right: -56px;
}
#no-sendmail{
	cursor: no-drop;
    width: 82px;
    background-color: #eee
}
#gopage3{
	margin-left: 10px;
}
.tishi{
	width: 665px;
    margin: auto;
    margin-top: 200px;
    text-align: center;
}
.tishi label{
	width: 100%;
	text-align: left;
}
.tishi span{
	width: 100%;
	display: block;
	text-align: left;
}
</style>


<div class="repassword img2">
	<!--<ul>
		<li class="back-img1">确认账号信息</li>
		<li class="back-img2">填写新密码</li>
		<li class="back-img3">找回密码完成</li>
	</ul>-->
	<!--<div class="page1">
		<div class="row">
			<label>邮箱地址：</label>
			<input class="form-control" id="e-mail" type="text" placeholder="输入需要找回密码的邮箱地址"/>
		</div>
		<div class="row">
			<label>验证码：</label>
			<input class="form-control" id="e-code" type="text" placeholder="输入邮箱验证码"/>
			<span class="btn btn-default" id="sendmail">发送邮件</span>
		</div>
		<span class="btn btn-default" id="gopage2">下一步</span>
	</div>-->
	<div class="page2">
		<div class="row">
			<label>邮箱地址：</label>
			<input class="form-control" id="e-mail" type="text" placeholder="输入需要找回密码的邮箱地址"/>
		</div>
		<div class="row">
			<label>验证码：</label>
			<input class="form-control" id="e-code" type="text" placeholder="输入邮箱验证码"/>
			<span class="btn btn-default" id="sendmail">发送邮件</span>
		</div>
		<div class="row">
			<label>输入新密码：</label>
			<input class="form-control" id="pass1" type="password" placeholder="输入8-12位新密码"/>
		</div>
		<div class="row">
			<label>确认新密码：</label>
			<input class="form-control" id="pass2" type="password" placeholder="再次确认新密码"/>
		</div>
		<!--<span class="btn btn-default" id="gopage1">上一步</span>-->
		<span class="btn btn-default" id="gopage3">提交</span>
	</div>
	<div class="page3">
		<div>
			<span>恭喜您成功找回密码，立即前往<a href="/">登陆</a>吧！</span>
		</div>
		
	</div>
	<div class="tishi">
		<div>
			<label>温馨提示：</label>
			<span>第一步：输入你要找回密码的邮箱地址，然后点击发送邮件获取验证码。</span>
			<span>第二步：输入新密码点击下一步完成密码找回。</span>
		</div>
	</div>
</div>


<script type="text/javascript">
var pass1index = '';
var pass2index = '';
var emailindex = '';
var codeindex = '';
function verifyCode(){
	var email = $('#e-mail').val();
	var ecode = $('#e-code').val();
	
	return true;
}
function changePassword(){
	var email = $('#e-mail').val();
	var ecode = $('#e-code').val();
	var pass1 = $('#pass1').val();
	var pass2 = $('#pass2').val();
	var send = true;
	
	var res = email.match(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-z]+$/);  
    if(res==null)  { 
    	layer.close(emailindex);
        emailindex = layer.tips('请输入有效邮箱地址作为用户名', '#e-mail', {
			tips: [2, '#FFB330'],
			time: 0,
			tipsMore: true
		});
		send = false;
    }  
    if(ecode.length != 6){
    	layer.close(codeindex);
		codeindex = layer.tips('请输入8-12位密码', '#pass1', {
			tips: [2, '#FFB330'],
			time: 0,
			tipsMore: true
		});
		send = false;
    }
	if(pass1.length < 8 || pass1.length > 12){
		layer.close(pass1index);
		var tips = '#sendmail';
		if(!$('#sendmail')[0]){
			tips = '#no-sendmail';
		}
		pass1index = layer.tips('请输入6位验证码', tips, {
			tips: [2, '#FFB330'],
			time: 0,
			tipsMore: true
		});
		send = false;
	}
	if(pass1 != pass2){
		layer.close(pass2index);
		pass2index = layer.tips('两次密码输入不一样', '#pass2', {
			tips: [2, '#FFB330'],
			time: 0,
			tipsMore: true
		});
		send = false;
	}
	
	if(!send){
		return false;
	}
	var data = $.ajax({
		type:"get",
		url:'<?php echo \yii\helpers\Url::to(['user/findpwd']);?>',
		datatype:'json',
		
		data:{
			account:email,
			verifycode:ecode,
			user_passwd:pass1,
			repasswd:pass2
		},
		
		success:function(data){
			if(data.status==1){
				$('.repassword').addClass('img3');
				$('.repassword').removeClass('img1');
				$('.repassword').removeClass('img2');
			}else{
				layer.alert('请求错误：'+data.msg);
			}
		},
		error:function(){
			layer.alert('网络错误');
		},
		complete:function(){
			self.obj = null;
		}
	});
}
function gopage(){
//	$('#gopage2').click(function(){
//		//邮箱验证码验证通过后
//		if(verifyCode){
//			$('.repassword').addClass('img2');
//			$('.repassword').removeClass('img1');
//			$('.repassword').removeClass('img3');
//		}else{
//			layer.alert('验证码错误');
//		}
//	});
//	$('#gopage1').click(function(){
//		$('.repassword').addClass('img1');
//		$('.repassword').removeClass('img2');
//		$('.repassword').removeClass('img3');
//	});
	$('#gopage3').click(changePassword);
	$('#e-mail').bind('input propertychange',function(){
		layer.close(emailindex);
	});
	$('#pass1').bind('input propertychange',function(){
		layer.close(pass1index);
	});
	$('#pass2').bind('input propertychange',function(){
		layer.close(pass2index);
	});
}
var times = 0;
function daojishi(){
	$('#no-sendmail').html(times+'s');
	if(times == 0){
		$('#no-sendmail').html('发送邮件');
		return true;
	}
	times--;
	setTimeout(daojishi, 1000);
}
function sendmail(){
	$('#sendmail').click(function(e){
		if(!e.target || $(e.target).attr('id')=='no-sendmail'){
			return false;
		}
		var email = $('#e-mail').val();
		var res = email.match(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-z]+$/);  
	    if(res==null)  { 
	    	layer.close(emailindex);
	        emailindex = layer.tips('请输入有效邮箱地址作为用户名', '#e-mail', {
				tips: [2, '#FFB330'],
				time: 0,
				tipsMore: true
			});
			return false;
	    }  
		
		
		$('#sendmail').attr('id', 'no-sendmail');
		times = 120;
		setTimeout(daojishi, 1000);
		
		var data = $.ajax({
			type:"get",
			url:'<?php echo \yii\helpers\Url::to(['user/sendcode']);?>',
			datatype:'json',
			
			data:{
				account:email,
			},
			
			success:function(data){
				if(data.status==1){
					layer.alert('获取验证码成功，请到邮箱中查看！');
				}else{
					layer.alert('获取验证码失败：'+data.msg);
				}
			},
			error:function(){
				layer.alert('网络错误');
			},
			complete:function(){
				self.obj = null;
			}
		});
	});
}
function init(){
	gopage();
	sendmail();
}
$(document).ready(init);
</script>