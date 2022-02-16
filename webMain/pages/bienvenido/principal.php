<?php 
function principal($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../dialogs/modalViews.php"); 
template_head($pdo,$dataSesion); modalViews();?>

<link rel="stylesheet" href="../../../dist/css/webSaludGeneral.css?v1.1">

<div class="cotainer">
	
	Hola Mundo
</div>


<?php template_footer(); } ?>