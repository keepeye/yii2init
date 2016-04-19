<?php
/**
 * ControllerBase.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
namespace app\controllers\admin;

use yii\web\Controller;

abstract class ControllerBase extends Controller
{
    public $layout = 'admin';
}