<?php
use backend\assets\AppAsset;
use app\assets\BootboxAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
BootboxAsset::overrideSystemConfirm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Панель администратора',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left', 'style' => 'margin-left: 40px;'],
                'items' => [
                    ['label' => 'Меню', 'url' => ['/menutree/index']],
                    [
                        'label' => 'Контент',
                        'items' => [
                            ['label' => 'Страницы', 'url' => ['/page/index']],
                            ['label' => 'Новости', 'url' => ['/news/index']],
//                            ['label' => 'Фотогалерея', 'url' => ['/gallery/index']],
//                            ['label' => 'Баннеры', 'url' => ['/banners/index']],
                        ]
                    ],
                    ['label' => 'Настройки', 'url' => ['/settings/index']],
                    ['label' => 'Пользователи', 'url' => ['/user/index']],
                ]
            ]);
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    [
                        'label' => Yii::$app->user->identity->username,
                        'items' => [
                            ['label' => 'Профиль', 'url' => ['/user/index']],
                            ['label' => 'Выйти','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
                        ]
                    ]
                ]
            ]);
            NavBar::end();
        ?>
        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink'=>[
                'label' => 'Главная',
                'url' => ['site/index'],
            ],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?> <?= Yii::$app->config->siteName; ?></p>
        <p class="pull-right"><?/*= Yii::powered()*/ ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>