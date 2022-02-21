<?php 
function bienvenido($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../dialogs/modalViews.php"); 

$css_dreconstec = array();
//$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

$js_dreconstec = array();
//$js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';

template_head($pdo,$dataSesion,$css_dreconstec);

$sql="SELECT *
      FROM dct_sistema_tbl_rol_aplicacion up, dct_sistema_tbl_aplicacion app
      WHERE app.apl_id_aplicacion  = up.rla_id_aplicacion 
      AND up.rla_id_rol  = :rla_id_rol 
      /*AND up.rla_id_aplicacion  NOT IN (1)*/
      AND app.apl_estado = 'A';";
$query=$pdo->prepare($sql);
$query->bindValue(':rla_id_rol', $dataSesion['id_role']);
$query->execute();
$row = $query->fetchAll();
$color_icon_main = array("small-box bg-aqua", "small-box bg-green", "small-box bg-yellow", "small-box bg-red");
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <section class="content">
        <div class="row">
        <?php
          $count_icon_main = 0;
          foreach ($row as $row) {
        ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 main_identificador_div" id=<?php echo $row["apl_id_htm"]; ?>>
            <div class='<?php echo $color_icon_main[$count_icon_main]; ?>' >
              <div class="inner">
                <h3><?php echo $row["apl_nom_superior"]; ?></h3>

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
      </section>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
              <th scope="col">Header</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>text</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
              <td>layout</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
              <td>tabular</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>information</td>
              <td>placeholder</td>
              <td>illustrative</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>text</td>
              <td>random</td>
              <td>layout</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>dashboard</td>
              <td>irrelevant</td>
              <td>text</td>
              <td>placeholder</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>dashboard</td>
              <td>illustrative</td>
              <td>rich</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>placeholder</td>
              <td>tabular</td>
              <td>information</td>
              <td>irrelevant</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
              <td>text</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
              <td>layout</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
              <td>tabular</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>information</td>
              <td>placeholder</td>
              <td>illustrative</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>text</td>
              <td>placeholder</td>
              <td>layout</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>dashboard</td>
              <td>irrelevant</td>
              <td>text</td>
              <td>visual</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>dashboard</td>
              <td>illustrative</td>
              <td>rich</td>
              <td>data</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>random</td>
              <td>tabular</td>
              <td>information</td>
              <td>text</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  


<?php 
	modalViews();
	template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>