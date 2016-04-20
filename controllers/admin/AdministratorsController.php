<?php
/**
 * AdministratorsController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use app\models\Administrator;
use Yii;

/**
 * Class AdministratorsController
 *
 * 系统用户管理
 *
 * @package app\controllers\admin
 */
class AdministratorsController extends ControllerBase
{
    //用户列表
    public function actionIndex()
    {
        $list = Administrator::find()->all();
        return $this->render('index',[
            'list' => &$list
        ]);
    }

    //添加
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('add');
        } else {

        }
    }

    //登录日志
    public function actionLogs()
    {

    }
}