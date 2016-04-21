<?php
/**
 * ControllerBase.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
namespace app\controllers\admin;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;

abstract class ControllerBase extends Controller
{
    public $layout = 'admin';

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

    /**
     * ajax错误信息
     *
     * @param $message
     * @param array $extra
     * @return mixed
     */
    public function error($message,$extra=[])
    {
        return $this->out(0,$message,$extra);
    }

    /**
     * ajax成功信息
     *
     * @param string $message
     * @param array $extra
     * @return mixed
     */
    public function success($message="",$extra=[])
    {
        return $this->out(1,$message,$extra);
    }

    /**
     * ajax信息
     *
     * @param $status
     * @param $message
     * @param $extra
     * @return mixed
     */
    public function out($status,$message,$extra)
    {
        $data = ['status'=>$status,'message'=>$message];
        if (!empty($extra)) {
            $data = array_merge($data,$extra);
        }
        return json_encode($data);
    }
}