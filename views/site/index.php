<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?php if(Yii::$app->user->isGuest): ?>
                    <p>Войдите, чтобы получить api-ключ</p>
                <?php elseif(Yii::$app->user->identity): ?>
                    <p>Ваш Api ключ: <?= Yii::$app->user->identity->token; ?></p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
