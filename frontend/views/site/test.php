<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--强制IE用最新模式渲染-->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--检测屏幕宽度,并以缩放率为1来初始显示-->
    <title>标题</title>
<<<<<<< HEAD:frontend/views/site/test.html
    <link rel="stylesheet" href="./source/bootstrap-3.3.6-dist/css/bootstrap.css">
   	<link rel="stylesheet" type="text/css" href="../../../backend/study/source/bootstrap-3.3.6-dist/css/bootstrap.css"/>
    <style>
        body{margin:30px;padding:30px;}
    </style>
=======
    <link rel="stylesheet" href="/source/bootstrap-3.3.6-dist/css/bootstrap.css">
    <!--开发用-->
    <link rel="stylesheet" href="../../web/source/bootstrap-3.3.6-dist/css/bootstrap.css">
>>>>>>> 17938b4d538039c51ab0dd23c98758d871cd8e17:frontend/views/site/test.php
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="navbar-header">
        <a href="#" class="navbar-brand">
            猛男哦吧
        </a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="">MySQL</a></li>
        <li><a href="">MySQL</a></li>
        <li><a href="">MySQL</a></li>
        <li><a href="">MySQL</a></li>
    </ul>
    <form action="" class="navbar-form navbar-right" >
        <div class="form-group">
            <input type="text" class="form-control">
            <a href="" type="button" class="btn btn-default">搜索</a>
        </div>
    </form>
</div>

   <!-- <ul class="breadcrumb">
        <li><a href="">我勒个去</a></li>
        <li><a href="">我勒个去</a></li>
        <li class="active">我勒个去</li>
    </ul>-->
<!--<div class="btn-group dropup">
    <btton class="data-toggle btn btn-default" data-toggle="dropdown" id="dropdownmenu1">
        下拉
        <span class="caret"></span>
    </btton>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownmenu1">
        <li role="presentation">
            <a href="" role="menuitem" tabindex="-1">1</a>
        </li>
        <li class="divider" role="presentation"></li>
        <li role="presentation">
            <a href="" role="menuitem" tabindex="-1">2</a>
        </li>
    </ul>
</div>-->

<!--<div class="dropdown">
    <btton class="data-toggle btn btn-default" data-toggle="dropdown" id="dropdownmenu1">
        下拉
        <span class="caret"></span>
    </btton>
    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownmenu1">
        <li role="presentation" class="active">
            <a href="" role="menuitem" >1</a>
        </li>
        <li class="dropdown-header">我是标题</li>
        <li role="presentation" class="disabled">
            <a href="" role="menuitem" >2</a>
        </li>
    </ul>
</div>-->
<!--
<span class="glyphicon glyphicon-search col-lg-2"></span>
&lt;!&ndash;标题&ndash;&gt;
    <h1>
        猛男哦吧<br>
        <small>人如果没有梦想,和咸鱼有什么分别</small>
    </h1>

&lt;!&ndash;文章&ndash;&gt;
    <p>我是普通文章</p>
    <p class="lead">我是需要强调的文章</p>
    <p>最后两个字需要<strong>加粗</strong></p>
    <p>最后两个字需要是<em>斜体</em></p>

&lt;!&ndash;强调相关的class&ndash;&gt;
    <p class="text-muted">我是text-muted效果</p>
    <p class="text-primary">我是text-primary效果</p>
    <p class="text-success">我是text-success效果</p>
    <p class="text-info">我是text-info效果</p>
    <p class="text-warning">我是text-warning效果</p>
    <p class="text-danger">我是text-danger效果</p>

&lt;!&ndash;文本对齐&ndash;&gt;
    <p class="text-left">text-left左对齐</p>
    <p class="text-right">text-right右对齐</p>
    <p class="text-center">text-center居中对齐</p>
    <p class="text-justify">text-justify两端对齐</p>

&lt;!&ndash;列表&ndash;&gt;
    &lt;!&ndash;bootstrap默认情况下的无序列表和有序列表都是有符号的,可以添加.list-unstyled去掉&ndash;&gt;
    <ul class="list-unstyled">
        <li>去掉列表前面的圆点</li>
    </ul>
    <ol class="list-unstyled">
        <li>1</li>
        <li>2</li>
    </ol>
    &lt;!&ndash;内联列表,让列表横向显示&ndash;&gt;
    <ul class="list-inline">
        <li>内联列表</li>
        <li>内联列表</li>
    </ul>
    &lt;!&ndash;定义列表 貌似和有序无序列表差不多,多了一个着重显示的表头而已&ndash;&gt;
    <dl>
        <dt>表头</dt>
        <dd>我文字少</dd>
        <dd>我文字多多肚兜哦多多欧多发发发</dd>
    </dl>
    &lt;!&ndash;定义列表的水平显示,加.dl-horizontal 可以像内联列表一样&ndash;&gt;
    <dl class="dl-horizontal">
        <dt>头</dt>
        <dd>内容</dd>
        <dd>内容</dd>
        <dd>内容</dd>
        <dt>头</dt>
        <dd>内容</dd>
    </dl>

&lt;!&ndash;代码 有三种标签,
code, 单行代码
pre,多行代码
kbd,用户输入代码

想控制代码最高显示行数,加.pre-scrollable可以控制高度最大340px
&ndash;&gt;


&lt;!&ndash;表格&ndash;&gt;
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>1</th>
                <th>2</th>
            </tr>
        </thead>
        <tbody>
            <tr class="success">
                <td>3</td>
                <td>4</td>
            </tr>
            <tr class="active">
                <td>3</td>
                <td>4</td>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
        </tbody>
    </table>

&lt;!&ndash;表单&ndash;&gt;
<form action="" class="form-inline">
    <div class="form-group has-error has-feedback">
        <label for="username" class="control-label">用户名</label>
        <input id="username" type="text" name="username" class="form-control">
        <span class="help-block">提示信息</span>
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
    </div>
    <div class="checkbox-inline">
        <label>
            <input type="checkbox">记住密码
        </label>
    </div>
    <div class="form-group">
        &lt;!&ndash;添加 multiple可以变成多选&ndash;&gt;
        <select multiple name="" id="">
            <option value="">1</option>
            <option value="">2</option>
        </select>
    </div>
</form>

<form role="form">
    <div class="form-group">
        <label class="radio-inline">
            <input type="radio" name="gender" class="form-control">男性
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" class="form-control">女性
        </label>
    </div>
</form>
<button class="btn btn-success btn-sm btn-block">按钮</button>
<img class="col-lg-2 img-circle" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcT9c2D10g2FBSqOLbwtWQDr7o6913xL0MsbUW9yvZ82pY1kfWM4uw" alt="">
-->
<script src="source/bootstrap-3.3.6-dist/js/jquery-1.12.3.js"></script>
<script src="./source/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
</body>
</html>