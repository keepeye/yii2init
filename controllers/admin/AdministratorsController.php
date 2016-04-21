<?php
/**
 * AdministratorsController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use app\models\Administrator;
use app\models\AdministratorLogin;
use app\repositories\AdministratorRepository as Repository;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

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
        $query = Administrator::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
        $list = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'list' => &$list,
            'pages' => $pages
        ]);
    }

    //添加
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('add');
        } else {
            $repository = new Repository();
            if ($repository->create($request->post(),$error)) {
                return $this->success();
            } else {
                return $this->error($error);
            }
        }
    }

    //修改
    public function actionEdit()
    {
        $request = Yii::$app->request;
        $repository = new Repository();
        $id = (int)$request->get('id',$request->post('id'));
        if (!$id) {
            throw new NotFoundHttpException('id不合法');
        }
        if (!$request->isPost) {
            if (!$model = $repository->find($id)) {
                throw new NotFoundHttpException('记录不存在');
            }
            return $this->render('edit',[
                'model' => $model
            ]);
        } else {
            if ($repository->update($id,$request->post(),$error)) {
                return $this->success();
            } else {
                return $this->error($error);
            }
        }
    }

    /**
     * 删除用户,支持批量删除
     * @return array
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function actionDelete()
    {
        $request = Yii::$app->request;
        $ids = $request->get('ids');
        if (!$ids) {
            return $this->error('请选中至少一个');
        }
        $ids = array_filter(explode(',',$ids));
        if (empty($ids)) {
            return $this->error('ids参数不合法');
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            Administrator::deleteAll([
                'id' => $ids
            ]);
            $transaction->commit();
            if ($request->isAjax) {
                return $this->success();
            } else {
                return $this->redirect(['index']);
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    //登录日志
    public function actionLogs()
    {
        $query = AdministratorLogin::find();
        //搜索
        $searchConditions = Yii::$app->request->get('search');
        if (!empty($searchConditions)) {
            if (!empty($searchConditions['username'])) {
                $query->where('username like :username',[':username'=>'%'.$searchConditions['username'].'%']);
            }
        }
//        var_dump($query->createCommand()->getRawSql());exit;
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
        $list = $query->offset($pages->offset)->limit($pages->limit)->orderBy('id desc')->all();
        return $this->render('logs',[
            'list' => &$list,
            'pages' => $pages
        ]);
    }
}