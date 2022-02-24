<?php 
  function template_head($pdo,$dataSesion,$css_dreconstec){ 
?>
  <!doctype html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prestores IESS</title>
     
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
        <link href="../../../plugins/fontawesome-free-5.15.4-web/css/all.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="../../../dist/css/adminlte.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../plugins/select2/dist/css/select2.min.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../plugins/DataTables/media/css/jquery.dataTables.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../dist/css/webSistema.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">

        <?php
          for ($i = 0; $i < count($css_dreconstec); ++$i){
            echo $css_dreconstec[$i];
          }
        ?>

      </head>

      <body class="hold-transition sidebar-mini layout-fixed">
        <div id="loading">
          <img src="../../../dist/img/loading.gif" style="margin-top: 15%;"/>
        </div>
        <div class="wrapper">
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
          </div>
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                  <form class="form-inline">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                    <div class="media">
                      <img src="../../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <div class="media">
                      <img src="../../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          John Pierce
                          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <div class="media">
                      <img src="../../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Nora Silvester
                          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../../controller/cerrarSesionLogin" role="button">
                  <i class="fas fa-sign-out-alt"></i>
                </a>
              </li>
            </ul>
          </nav>

          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
              <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <div class="sidebar">
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img src="../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
                </div>
              </div>
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>

              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <?php 
                    $sql="SELECT up.rla_id_aplicacion, app.apl_aplicacion, app.apl_ruta 
                          FROM dct_sistema_tbl_rol_aplicacion up, dct_sistema_tbl_aplicacion app
                          WHERE up.rla_id_aplicacion = app.apl_id_aplicacion
                          AND app.apl_estado = 'A'
                          AND up.rla_id_rol = :id_role
                          ORDER BY 1;";
                    $query=$pdo->prepare($sql);
                    $query->bindValue(':id_role',$dataSesion['id_role'],PDO::PARAM_INT);
                    $query->execute();
                    $row = $query->fetchAll();
                    foreach ($row as $row1) {
                      ?>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                              <?php echo $row1["apl_aplicacion"]; ?>
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <?php 
                            $sql="SELECT opt.opc_opcion, opt.opc_ruta
                                      FROM dct_sistema_tbl_opcion opt
                                      WHERE opt.opc_id_opcion  IN (SELECT rp.rlo_id_opcion
                                      FROM dct_sistema_tbl_rol_opcion rp, dct_sistema_tbl_opcion op
                                      WHERE rp.rlo_id_opcion = op.opc_id_opcion
                                      AND op.opc_estado = 'A'
                                      AND rp.rlo_id_rol = :id_role)
                                      AND opt.opc_id_aplicacion = :id_application
                                      ORDER BY opt.opc_orden;";
                            $query=$pdo->prepare($sql);
                            $query->bindValue(':id_role',$dataSesion['id_role'],PDO::PARAM_INT);
                            $query->bindValue(':id_application',$row1["rla_id_aplicacion"],PDO::PARAM_INT);
                            $query->execute();
                            $row = $query->fetchAll();
                            foreach ($row as $row2) {
                              $route = $row1["apl_ruta"].$row2["opc_ruta"];
                              ?>
                                <li class="nav-item">
                                  <a href="<?php echo $route; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?php echo $row2["opc_opcion"]; ?></p>
                                  </a>
                                </li>
                              <?php 
                            } 
                          ?>
                          </ul>
                        </li>
                      <?php
                    }
                  ?>

                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                      <i class="nav-icon far fa-calendar-alt"></i>
                      <p>
                        Calendar
                        <span class="badge badge-info right">2</span>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-envelope"></i>
                      <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Inbox</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Compose</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Read</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>

            </div>
          </aside>
<?php 
  } 
?>