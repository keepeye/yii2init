<?php
/**
 * AuthController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use yii\base\Event;
use yii\web\Controller;
use yii\web\User;
use Yii;
use app\models\Administrator as Identity;
use app\events\AdminAuthEvent;

class AuthController extends Controller
{
    public $layout = false;

    public function init()
    {
        $eventHandler = new AdminAuthEvent();
        Yii::$app->administrator->on(User::EVENT_AFTER_LOGIN,array($eventHandler,'onLogin'));
        Yii::$app->administrator->on(User::EVENT_AFTER_LOGOUT,array($eventHandler,'onLogout'));
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('login');
        } else {
            if ($identify = Identity::findOne([
                'username' => $request->post('username','')
            ])) {
                if ($identify->validatePassword($request->post('password',''))) {
                    if (Yii::$app->administrator->login($identify)) {
                        //此处登录成功
                        return json_encode(['status'=>1,'redirect'=>Yii::$app->administrator->getReturnUrl('/')]);
                    } else {
                        return json_encode(['status'=>0,'error'=>'登录失败']);
                    }
                } else {
                    //密码错误
                    return json_encode(['status'=>0,'error'=>'用户名或密码错误']);
                }
            } else {
                return json_encode(['status'=>0,'error'=>'用户名或密码错误']);
            }

        }
    }

    /**
     * 注销
     */
    public function actionLogout()
    {
        Yii::$app->administrator->logout();
        return $this->redirect(['login']);
    }
}