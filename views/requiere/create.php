<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requiere */

$this->title = 'Create Requiere';
$this->params['breadcrumbs'][] = ['label' => 'Requieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requiere-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
