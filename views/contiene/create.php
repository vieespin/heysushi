<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contiene */

$this->title = 'Create Contiene';
$this->params['breadcrumbs'][] = ['label' => 'Contienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contiene-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
