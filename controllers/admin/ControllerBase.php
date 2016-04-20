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
            ],
            //设置响应内容自动转换json
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'text/html' => Response::FORMAT_HTML,
                    '*/*' => Response::FORMAT_RAW
                ],
            ],
        ];
    }

    public function error($message,$extra=[])
    {
        return $this->out(0,$message,$extra);
    }

    public function success($message="",$extra=[])
    {
        return $this->out(1,$message,$extra);
    }

    public function out($status,$message,$extra)
    {
        $data = ['status'=>$status,'message'=>$message];
        if (!empty($extra)) {
            $data = array_merge($data,$extra);
        }
        return $data;
    }
}