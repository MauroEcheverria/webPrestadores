<?php 
function administrarContrasena($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../dialogs/modalViews.php");
template_head($pdo,$dataSesion); modalViews();?>

<?php template_footer(); } ?>