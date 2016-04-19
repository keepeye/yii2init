<?php
/**
 * index.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
?>

<?php $this->beginBlock('header');//头部附加 ?>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>

<?php $this->endBlock(); ?>

<?=Yii::$app->administrator->getIdentity()->name;?>
