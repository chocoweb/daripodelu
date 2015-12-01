<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = Yii::t('app', 'Update page') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
    $this->title = $this->title . ' :: ' . Yii::$app->params['SITE.TITLE'];

    if( Yii::$app->session->hasFlash('error') ) 
    {
        echo Alert::widget ([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => Yii::$app->session->getFlash('error'),
        ]);    
    }
    ?>
    
    <?php
    if( Yii::$app->session->hasFlash('success') ) 
    {
        echo Alert::widget ([
            'options' => [
                'class' => 'alert-success'
            ],
            'body' => Yii::$app->session->getFlash('success'),
        ]);    
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>