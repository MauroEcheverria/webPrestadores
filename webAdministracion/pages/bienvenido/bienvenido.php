<?php 
  function bienvenido($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();

  $js_dreconstec = array();

  template_head($pdo,$dataSesion,$css_dreconstec);

  $sql="SELECT *
        FROM dct_sistema_tbl_rol_aplicacion up, dct_sistema_tbl_aplicacion app
        WHERE app.apl_id_aplicacion  = up.rla_id_aplicacion 
        AND up.rla_id_rol  = :rla_id_rol 
        /*AND up.rla_id_aplicacion  NOT IN (1)*/
        AND app.apl_estado = 1;";
  $query=$pdo->prepare($sql);
  $query->bindValue(':rla_id_rol',$dataSesion['id_role'],PDO::PARAM_INT);
  $query->execute();
  $row = $query->fetchAll();
  $color_icon_main = array("small-box bg-green", "small-box bg-aqua", "small-box bg-yellow", "small-box bg-red");
?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
        <?php
          $count_icon_main = 0;
          foreach ($row as $row) {
        ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 main_identificador_div" id=<?php echo $row["apl_id_htm"]; ?>>
            <div class='<?php echo $color_icon_main[$count_icon_main]; ?>' >
              <div class="inner">
                <span><?php echo $row["apl_nom_superior"]; ?></span>

                <p><?php echo $row["apl_nom_inferior"]; ?></p>
              </div>
              <div class="icon">
                <i class='<?php echo $row["apl_id_imagen"]; ?>' ></i>
              </div>
              <a href=<?php echo $row["apl_ruta"]."/pages/principal"; ?> class="small-box-footer">Acceder <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php
          if ($count_icon_main >= 3) { $count_icon_main = 0; } else { $count_icon_main += 1; }
          }
        ?>
        </div>
      
      </div>
    </section>
  </div>

<?php 
	modalViews();
	template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>