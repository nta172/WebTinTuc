<?php
session_start();
require_once '../../DB/dbConnect.php';
require_once '../../DB/checkUser.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <base href="http://localhost/webtintuc/">
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="admin/template/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="admin/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="admin/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="admin/template/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="admin/template/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="admin/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="admin/template/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="admin/template/plugins/summernote/summernote-bs4.min.css">
    
    <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->

    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="admin/template/dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
                    </div>

                    <div class="info">
                        <?php
                        $name = "ADMIN";
                        ?>
                        <a class="d-block"><?php echo $name ?></a>
                    </div>

                    <div class="logout">
                        <a href="admin/logout.php" class="btn btn-danger">Đăng xuất</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="admin/dashboard" class="nav-link">
                                <p>DANH MỤC
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <?php
                            if (isset($_SESSION['userAdmin']) ) {
                            ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="admin/dashboard" class="nav-link <?php if ($page == "DB") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Trang chủ</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin/tintuc" class="nav-link <?php if ($page == "TINTUC") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tin tức</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin/loaitin" class="nav-link <?php if ($page == "LOAITIN") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Loại tin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin/nhomtin" class="nav-link <?php if ($page == "NHOMTIN") {
                                                                                echo 'active';
                                                                            } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nhóm tin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="admin/binhluan" class="nav-link <?php if ($page == "BINHLUAN") {
                                                                                echo 'active';
                                                                            } ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bình luận</p>
                                        </a>
                                    </li>
                                </ul>
                            <?php
                            } else {

                            ?>

                            <?php

                            } ?>
                        </li>

                </nav>
            </div>
        </aside>