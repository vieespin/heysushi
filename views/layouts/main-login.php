<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page" style="background-image: url(<?=Url::base(true)?>/files/kimagure-background.jpg); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-color: #66999;">
	<div class="item" style="text-align: center;">
	    <img src="<?=Url::base(true)?>/files/heysushi.png" class="img-rounded" style="width: 100%; max-width:250px; margin-top: 50px;">
	</div>
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
