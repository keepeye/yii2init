<?php
/**
 * AdministratorRepository.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\repositories;

use app\models\Administrator;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

class AdministratorRepository
{
    /**
     * 查找一个用户
     *
     * @param $id
     * @return null|static
     */
    public function find($id)
    {
        if (!$id || !is_numeric($id)) {
            throw new InvalidParamException('参数不合法');
        }
        $row = Administrator::findOne($id);
        return $row;
    }

    /**
     * 创建新用户
     *
     * @param $data
     * @param $error
     * @return bool
     */
    public function create($data,&$error)
    {
        $model = new Administrator();
        $model->scenario = 'insert';//插入场景
        $model->attributes = $data;
        if ($model->save()) {
            return true;
        } else {
            $errors = $model->getErrors();
            $error = !empty($errors) ? reset($errors)[0] : '未知错误';
            return false;
        }
    }

    /**
     * 更新一条记录
     *
     * @param $id
     * @param $data
     * @param $error
     * @return bool
     * @throws NotFoundHttpException
     */
    public function update($id,$data,&$error)
    {
        if (!$id || !is_numeric($id)) {
            throw new InvalidParamException('参数不合法');
        }
        $model = Administrator::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('用户不存在或已被删除');
        }
        $model->setAttributes($data);
        if ($model->save()) {
            return true;
        } else {
            $errors = $model->getErrors();
            $error = !empty($errors) ? reset($errors)[0] : '更新失败';
            return false;
        }
    }
}