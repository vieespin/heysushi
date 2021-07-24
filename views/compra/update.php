<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = 'Compra: ' . $model->ID_COMPRA;
$this->params['breadcrumbs'][] = ['label' => 'Compras'];
$this->params['breadcrumbs'][] = ['label' => $model->ID_COMPRA, 'url' => ['view', 'id' => $model->ID_COMPRA]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="compra-update">

<!--     <h1><?= Html::encode($this->title) ?></h1>
 -->
    <?= $this->render('_form', [
        'model' => $model,
        'producto' => $producto
    ]) ?>

</div>
