<?php
/**
 * ProfileSettingsController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use Yii;

class ProfileSettingsController extends ControllerBase
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[

        ]);
    }

    public function actionPassword()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('password');
        } else {
            $oldpassword = $request->post('oldpassword');
            $password = $request->post('password');
            $repeatPassword = $request->post('repeat-password');
            if (!$oldpassword || !$password) {
                return $this->error('你有未填写的表单项');
            }
            if ($password != $repeatPassword) {
                return $this->error('重复输入密码和新密码不一致');
            }
            $identity = Yii::$app->administrator->identity;
            if (!$identity->validatePassword($oldpassword)) {
                return $this->error('原密码验证失败，密码错误');
            }
            if (!$identity->renewPassword($password)) {
                return $this->error('更新密码失败，数据库错误');
            }
            return $this->success();
        }
    }
}