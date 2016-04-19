<?php
/**
 * AdminAuthEvent.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\events;
use app\models\AdministratorLogin;
use Yii;

class AdminAuthEvent
{
    const TYPE_LOGIN = '登录';
    const TYPE_LOGOUT = '注销';

    public function onLogin($event)
    {
        $this->loginRecord(self::TYPE_LOGIN,$event);
    }

    public function onLogout($event)
    {
        $this->loginRecord(self::TYPE_LOGOUT,$event);
    }

    protected function loginRecord($type,$event)
    {
        $identity = $event->identity;
        $record = new AdministratorLogin;
        $record->uid = $identity->getId();
        $record->username = $identity->username;
        $record->type = $type;
        $record->ip = Yii::$app->request->getUserIP();
        $record->created_at = date('Y-m-d H:i:s');
        return $record->save();
    }
}