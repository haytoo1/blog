	<div class="row footer">
	    <span>发个邮件? <email>hayto@foxmail.com</email></span>
	</div>
</div>

<!--登陆注册弹出层开始-->
<div class="modal fade close-tips" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="pages backpage1"></div>
        <div class="pages backpage2"></div>
        <div class="pages pagecontent">
            <div class="insight">
                <button type="button" class="close close-tips" data-dismiss="modal" aria-label="Close"><span class="close-tips" aria-hidden="true">×</span></button>
                <div id="title">
                    <span class="left-title"></span>
                    <span>账号登陆</span>
                    <span class="right-title"></span>
                </div>
                <div>
                    <div class="row-input"><span class="input-img glyphicon glyphicon-user"></span><input type="text" id="userid" placeholder="输入邮箱地址"/></div>
                    <div class="row-input"><span class="input-img glyphicon glyphicon-lock"></span><input type="password" id="password" placeholder="输入密码"/></div>
                </div>
                <div class="fottor">
                    <span class="btn btn-default" id="goloading">登陆</span>
                    <span class="btn btn-default close-tips" id='zhuce'>注册</span>
                </div>
                <a href="/usercontrol/repassword" class="forgot-password">忘记密码？</a>
            </div>
            <div class="registered">
                <button type="button" class="close close-tips" data-dismiss="modal" aria-label="Close"><span class="close-tips" aria-hidden="true">×</span></button>
                <div id="title">
                    <span class="left-title"></span>
                    <span>账号注册</span>
                    <span class="right-title"></span>
                </div>
                <div>
                    <div class="row-input"><span class="input-img glyphicon glyphicon-user">
                        </span><input id="reg-username" type="text" name="account" placeholder="输入邮箱地址"/>
                    </div>
                    <div class="row-input"><span class="input-img glyphicon glyphicon-lock">
                        </span><input id="reg-password1" type="password" name="password" placeholder="输入8-12位密码">
                    </div>
                    <div class="row-input"><span class="input-img glyphicon glyphicon-lock">
                        </span><input id="reg-password2" type="password" name="repassword" placeholder="再次输入密码">
                    </div>
                </div>
                <div class="fottor">
                    <span class="btn btn-default" id="reg">注册</span>
                    <span class="btn btn-default close-tips" id="reload">返回登陆</span>
                </div>
            </div>
        </div>
    </div> 
</div>
<!--登陆注册弹出层结束-->
<!--激活提示层开始-->
<div id="activate">
	<span class="activate-close reload-page">×</span>
	<p class="title">感谢您的注册，请立即激活账号</p>
	<p>为保护您的邮箱账号不被他人使用，请登录您的注册邮箱，点击邮箱中的链接即可激活。</p>
	<div class="tishi">
		<p>温馨提示：</p>
		<p>1.如果收件箱中找不到我们发送的邮件，请稍候片刻或者检查您的垃圾邮件。</p>
		<p>2.如果5分钟未收到邮件，请重新注册。</p>
		<p>3.如果长时间未收到邮件，请换个邮箱试试！</p>
	</div>
	<span class="btn btn-default reload-page" id="btn-loadding">立即刷新</span>
</div>
<!--激活提示层结束-->

<script>
	var registerurl = '<?php echo yii\helpers\Url::to(['user/register']); ?>';
	var loginurl = '<?php echo yii\helpers\Url::to(['user/login']);?>';
	var logout = '<?php echo yii\helpers\Url::to(['user/logout']);?>';
	var csrf = '<?php echo \yii::$app->getRequest()->getCsrfToken();?>';
	var activeuser = '<?php echo \yii\helpers\Url::to(['user/resendemail']);?>';
	var getuserinfo = '<?php echo \yii\helpers\Url::to(['user/resendemail']);?>';
    $("#reg").on('click',function () {
        register.fetch();
    })
</script>
<script src="/static/js/user/register.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/homepage.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>