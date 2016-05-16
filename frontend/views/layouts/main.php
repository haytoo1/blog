<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
    <title><?php echo $this->context->title ?></title>
    <meta name="description" content="<?php echo $this->context->desc ?>">
    <meta name="keywords" content="<?php echo $this->context->keyword ?>">

    <link rel="shortcut icon" href="/static/img/favicon.ico">
    <link rel="stylesheet" href="/static/bootstrap-3.3.5-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/static/css/page.css"/>
    <script src="/static/jquery-2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="/static/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/static/js/jqPaginator.js" type="text/javascript"></script>
    <script src="/static/layer/layer.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid hpage">
    <div class="row htitle">
        <div class="row">
            <div class="user-info islanding">
                <span id="landing" data-toggle="modal" data-target="#myModal">登陆</span>
                <span id="exit">退出</span>
                <span class="fenge">|</span>
                <span id="registering" data-toggle="modal" data-target="#myModal">注册</span>
                <span id="user-name">d2050838808</span>
            	<span class="loadsee fenge">|</span>
            	<span class="loadsee mail">
            		<span class="mail-count">1</span>
            		<span class="mail-img glyphicon glyphicon-envelope"></span>
            		<div class="hint"></div>
            		<div class="mail-list">
            			<span class="list-img">
            				<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
							   <polyline points="0,10 7,0 14,10" style="fill:#ffffff;stroke:#484848;stroke-width:1" />
							</svg>
						</span>
            			<ul class="list">
            				<li><a href="#">你关注的文章已经更新，可以前往查看更新内容</a></li>
            				<li><a href="#">你关注的文章已经更新，可以前往查看更新内容</a></li>
            				<li><a href="#">你关注的文章已经更新，可以前往查看更新内容</a></li>
            				<li><a href="#">你关注的文章已经更新，可以前往查看更新内容</a></li>
            				<li><a href="#">你关注的文章已经更新，可以前往查看更新内容</a></li>
            				<li class="more"><a class="right" href="#">查询更多>></a></li>
            			</ul>
            		</div>
            	</span>
            </div>
            <span id="select-toggle">-</span>
        </div>
        <div class="row logo-row">
            <div class="col-xs-12 col-md-8">
                <a href="#">
                    <h1>猛男哦吧</h1>
                    <h4>人如果没有梦想,和酸菜鱼又有什么区别  - by 周星吃</h4>
                </a>
            </div>
        </div>
        <div class="login"></div>
    </div>
    <div class="row hcontainer">
        <div class="row daohang">
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="#">首页</a></li>
                <li role="presentation"><a href="#">PHP</a></li>
                <li role="presentation"><a href="#">HTML</a></li>
                <li role="presentation"><a href="#">CSS</a></li>
                <li role="presentation"><a href="#">YII2</a></li>
            </ul>
        </div>
        <div class="row overview">
			<div class="left-con  col-md-12">
				
        		<?php echo $content;?>
        			
			</div>
        	<div class="row right-con col-xs-8 col-md-8">
	            <div class="module-right">
	                <span class="title-right">关于我们</span>
	                <p>1、PHP程序员雷雪松的博客主要记录了Linux学习，PHP开发与编程，Web前端开发，MySQL学习和教程，NoSQL数据库教程以及个人的人生经历和观点。一个人的力量是有限的，但我们尽量不要去重复造轮子，分享更多知识给身边的朋友。</p>
	                <p>
	                    2、欢迎志同道合的PHP爱好者点击加入PHP程序员交流QQ群：
	                <div class="client">
	                    <a class="PC child" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=8028785edba3d6c77c7e75f5829e2735ca7a28b4d00fbde8879d07e26f54c0cc"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="web测试" title="web测试"></a>
	                    <a class="iPhone child" target="_blank" href="mqqapi://card/show_pslcard?src_type=internal&version=1&uin=498901255&card_type=group&source=qrcode"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="web测试" title="web测试"></a>
	                </div>
	                </p>
	                <p>3、如果觉得PHP程序员雷雪松的博客还不错可以把链接分享给身边的朋友、打赏任意金额或者支持下赞助的广告！</p>
	                <p>
	                    <span>4、分享本页</span>
	                <div class="client">
	                    <div class="jiathis_style PC child">
	                        <a class="jiathis_button_qzone"></a>
	                        <a class="jiathis_button_tsina"></a>
	                        <a class="jiathis_button_tqq"></a>
	                        <a class="jiathis_button_weixin"></a>
	                        <a class="jiathis_button_renren"></a>
	                    </div>
	                    <div class="iPhone child">
	                        <div class="jiathis_style_m"></div>
	                    </div>
	                </div>
	                </p>
	                <p>5、有什么问题，请联系我们：
	                <div class="client">
	                    <a class="PC child" target="_blank" href="http://sighttp.qq.com/authd?IDKEY=02f31b91f66909dab361ec0ae47017131836dbd6572f62f0"><img border="0" src="http://wpa.qq.com/imgd?IDKEY=02f31b91f66909dab361ec0ae47017131836dbd6572f62f0&pic=51" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
	                    <a class="iPhone child" target="_blank" href="mqqwpa://im/chat?chat_type=wpa&uin=438843562&version=1&src_type=web&web_src=oicqzone.com"><img border="0" src="http://wpa.qq.com/imgd?IDKEY=02f31b91f66909dab361ec0ae47017131836dbd6572f62f0&pic=51" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
	                </div>
	                </p>
	            </div>
	            <div class="module-right">
	                <span class="select">搜索：</span>
	                <div>
	                    <input type="text" id="selectinput"/><span class="goselect">搜索</span>
	                </div>
	
	            </div>
	            <div class="module-right">
	                <span class="title-right">使用工具</span>
	                <div class="tools">
	                    <div><a href="#">工具1</a></div>
	                    <div><a href="#">工具2</a></div>
	                    <div><a href="#">工具3</a></div>
	                    <div><a href="#">工具4</a></div>
	                    <div><a href="#">工具5</a></div>
	                    <div><a href="#">工具6</a></div>
	                </div>
	            </div>
	            <div class="module-right">
	                <span class="title-right">常见标签</span>
	                <div class="commonlabel">
	                    <a href="#">常见标签1</a>
	                    <a href="#">常见标签2</a>
	                    <a href="#">常见标签3</a>
	                    <a href="#">常见标签4</a>
	                    <a href="#">常见标签5</a>
	                    <a href="#">常见标签6</a>
	                    <a href="#">常见标签7</a>
	                    <a href="#">常见标签8</a>
	                </div>
	            </div>
	            <div class="module-right">
	                <span class="title-right">最近文章</span>
	                <div class="newarticle">
	                    <div><a href="#">最近文章1</a></div>
	                    <div><a href="#">最近文章2</a></div>
	                    <div><a href="#">最近文章3</a></div>
	                    <div><a href="#">最近文章4</a></div>
	                    <div><a href="#">最近文章5</a></div>
	                    <div><a href="#">最近文章6</a></div>
	                </div>
	            </div>
        	</div>
    	</div>
	</div>
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
	var csrf = '<?php echo \yii::$app->getRequest()->getCsrfToken();?>';
    $("#reg").on('click',function () {
        register.fetch();
    })
</script>
<script src="/static/js/user/register.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/homepage.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
