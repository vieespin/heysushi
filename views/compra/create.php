<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = 'Agregar producto';
$this->params['breadcrumbs'][] = ['label' => 'Compra', 'url' => '#'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-create">

    <?= $this->render('_form', [
        'model' => $model,
        'producto' => $producto,
    ]) ?>

</div>
