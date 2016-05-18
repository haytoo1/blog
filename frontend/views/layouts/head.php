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
   	<script src="/static/js/store.js/store.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="container-fluid hpage">
    <div class="row htitle">
    	<div class="navbar navbar-default navbar-fixed-top">
		    <div class="navbar-header">
		        <span class="navbar-brand">开发者之家</span>
		    </div>
		
		
		
		    <ul class="nav navbar-nav">
		        <li><a href="">PHP</a></li>
		        <li><a href="">MySQL5.7中文手册</a></li>
		        <li><a href="">iOS</a></li>
		        <li><a href="">前端</a></li>
		    </ul>
		
		    <div class="user-info">
                <span id="landing" data-toggle="modal" data-target="#myModal">登陆</span>
                <span class="warning-close" id="exit">退出</span>
                <span class="fenge">|</span>
                <span id="registering" data-toggle="modal" data-target="#myModal">注册</span>
                <span id="user-name"></span>
                <!--登陆后提示激活开始-->
				<div class="warning-activate">
					<span class="warning-img">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
						   <polyline points="0,10 7,0 14,10" style="fill:#ffffff;stroke:#484848;stroke-width:1" />
						</svg>
					</span>
					<div>
						<span>您的账号尚未激活，可能导致部分功能不能正常使用，点击<a href="#">重新激活</a>进行激活。</span>
					</div>
					<span class="warning-close">×</span>
				</div>
				<!--登陆后提示激活结束-->
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
		
		    <form action="" class="navbar-form navbar-right">
		        <div class="form-group">
		            <input type="text" class="form-control">
		            <a type="button" class="btn btn-default">搜索</a>
		        </div>
		    </form>
		
		
		</div>
    </div>