<?php 
namespace frontend\controllers;
	
class UsercontrolController extends \yii\web\Controller{
	public $title = '从PHP到全栈|猛男哦吧';
    public $desc = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public $keyword = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
	public $layout = 'main-user';
	
	public function actionIndex(){
		
		return $this->render('index');
	}
	
	public function actionRepassword(){
		return $this->render('repassword');
	}
	public function actionActiveuser(){
		return $this->render('activeuser');
	}
	
	public function actionHome(){
		return $this->renderPartial('home.html');
	}
}	
?>