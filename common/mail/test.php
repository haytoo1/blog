<div style="width:600px">
    <div style="padding:20px 0px 20px 0px;">
        <span style="color: red"> 亲爱的用户您好,你注册的账号是:</span><?php echo $contents['name']; ?>：
    </div>

    <p style="margin:0px 0px 10px 0px;">请点击下面的链接激活账号完成注册。（48小时内完成）</p>

    <a href=<?php echo '"' . $contents['link'] . '"'; ?>>
        <p style="margin:0px 0px 10px 0px;word-wrap: break-word;word-break: break-all;"><?php echo $contents['link']; ?></p>
    </a>
    <p style="margin:0px 0px 10px 0px;">如果该链接无法点击，请直接复制以上链接到浏览器访问激活。</p>

    <div style="margin:5px 0px 5px 0px;border-bottom: 1px solid #000000;"></div>

    <div>
        <p style="margin:5px 0px 5px 0px;font-size: 12px;">此信息由<a href="http://www.bing.com">猛男网</a>系统发出，如有疑问,可直接回复。</p>
        <p style="margin:5px 0px 5px 0px;font-size: 12px;">如有疑问请<a href="#">联系我们</a>。</p>
    </div>
</div>