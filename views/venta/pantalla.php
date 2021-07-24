<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title="Pedidos en cocina"
?>

<div id="cocina" class="row">

</div>

<script>
	$(document).ready(function () {
			CargarListaEnviados()
			setTimeout(function () {
				fx_update_lista_token()
			}, 10000);

		});

	function fx_update_lista_token() {

			CargarListaEnviados();
			setTimeout(function () {
				fx_update_lista_token()
			}, 10000);
		}
	function CargarListaEnviados() {
			var url = '<?= Url::to(['venta/monitor'])?>';
			$('#cocina').load(url);
		}
</script>