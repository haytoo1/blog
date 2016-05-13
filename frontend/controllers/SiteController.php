<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//        return $this->render('index');
//        p('site/index');
//        phpinfo();
        $a = yii::$app->mailer
            ->compose('@common/mail/test',['contents'=>['name'=>'lsit','link'=>'http://www.google.com']])
            ->setFrom(yii::$app->params['adminEmail'])
            ->setTo('466594257@qq.com')
            ->setSubject('ping不通呢')
//            ->setHtmlBody('<img src="data:image/jpeg;base64,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">')
            ->send(); // 发送成功返回true，否则返回false
        //return $this->render('index');
        var_dump($a);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
