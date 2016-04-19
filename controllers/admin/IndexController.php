<?php
namespace app\controllers\admin;

use yii\filters\AccessControl;

/**
 * IndexController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class IndexController extends ControllerBase
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'administrator',
                'rules' => [
                    ['allow' => false, 'roles' => ['?']],//游客禁止访问
                    ['allow' => true, 'roles' => ['@']],//已登录用户允许访问
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}