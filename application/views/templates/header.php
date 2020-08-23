<?php 
$website = $this->KoreksoftModel->getWebsiteDetail();
if ( empty($product['title']) ) {
  $product['title'] = '';
}else{
  $product['title'] = " - " . $product['title'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $website['website_name'] ?><?= $product['title'] ?></title>
  <link rel="icon" type="image/png" href="<?= base_url('assets/koreksoft/') ?>img/logo.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <meta name="description" content="<?= $website['website_description'] ?>">
  <meta name="keywords" content="Snippet, Plugin, Source-code">
  <meta name="author" content="Widi Baka">
  <meta name="robots" content="index, follow" />
  <meta name="language" content="id" />
  <meta name="geo.country" content="id" />
  <meta http-equiv="content-language" content="In-Id" />
  <meta name="geo.placename" content="Indonesia" />


  <!-- S:fb meta -->
  <meta property="og:type" content="software" />
  <meta property="og:image" content="<?= base_url("assets/koreksoft/img/logo.jpg?ver3") ?>" />
  <meta property="og:title" content="<?= $website['website_name'] ?><?= $product['title'] ?>" />
  <meta property="og:description" content="<?= $website['website_description'] ?>">
  <meta property="og:url" content="<?= base_url() ?>" />
  <meta property="og:site_name" content="<?= $website['website_name'] ?>" />
  <!-- e:fb meta -->

  <!-- S:tweeter card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@korek_software" />
  <meta name="twitter:creator" content="@korek_software">
  <meta name="twitter:title" content="<?= $website['website_name'] ?><?= $product['title'] ?>" />
  <meta name="twitter:description" content="<?= $website['website_description'] ?>" />
  <meta name="twitter:image" content="<?= base_url("assets/koreksoft/img/logo.jpg?ver3") ?>" />
  <!-- E:tweeter card -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed sidebar-closed sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">

