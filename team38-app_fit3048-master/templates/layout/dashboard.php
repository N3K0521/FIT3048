<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
namespace App\Controller;

$cakeDescription = 'Smart Business Advisors Portal';
if (!isset($_SESSION['Auth'])) {
    session_start();
}

?>
<!DOCTYPE html>
<html>
<style>
  .unread{
    display: inline-block;
    width: 18px;
    height: 18px;
    text-align: center;
    background-color: red;
    border: red 1px solid;
    border-radius: 50%;
    line-height: 15px;
    color: white;
    font-size: 12px;
    margin-left: 5px;
    padding-top: 0px;

  }
</style>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?> -
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', './img/sba-logo-notext.png') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <?= $this->Html->css([ 'cake','nucleo-icons','nucleo-svg','argon-dashboard']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <?= $this->Html->image('sba-logo.png', ['style' => 'height: 90%; display: block; margin: auto; padding-top: 10px']); ?>

    </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

          <!--Client Search-->
          <?php
            if ($_SESSION['Auth']['User']['user_type'] == 'staff'){
                echo $this->Html->link('
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-zoom-split-in text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Search Client</span>',['controller'=>'Users','action'=>'search'],['class'=>'nav-link','escape'=>false]);
            }
          ?>

        <!--Files-->
        <li class="nav-item">
            <?php
                if ($_SESSION['Auth']['User']['user_type'] == 'client') {
                    echo $this->Html->link('
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-archive-2 text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">
                    Files
                    </span>', ['controller' => 'Files', 'action' => 'index', $_SESSION['Auth']['User']['id']], ['class' => 'nav-link', 'escape' => false]);
                }
            ?>
        </li>


        <li class="nav-item">
            <?php
                if ($_SESSION['Auth']['User']['user_type'] != 'admin') {
                    echo $this->Html->link('
                     <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="ni ni-bell-55 text-danger text-sm opacity-10"></i>
                     </div>
                     <span class="nav-link-text ms-1">
                     Notifications
                     </span><span class="unread">' . $this->getRequest()->getSession()->read('notification') . '</span>', ['controller' => 'Comments', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]);
                }
              ?>
        </li>

        <li class="nav-item">
            <?php
              if ($_SESSION['Auth']['User']['user_type'] == 'admin'){
              echo $this->Html->link('
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">
              User Management
              </span>',['controller'=>'Users','action'=>'index'],['class'=>'nav-link','escape'=>false]);
              }
            ?>
        </li>

          <li class="nav-item">
              <?php
              if ($_SESSION['Auth']['User']['user_type'] == 'admin'){
                  echo $this->Html->link('
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-secondary text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">
              API Info
              </span>',['controller'=>'Graphapi','action'=>'edit', 1],['class'=>'nav-link','escape'=>false]);
              }
              ?>
          </li>

          <li class="nav-item">
              <?php
              if ($_SESSION['Auth']['User']['user_type'] == 'admin'){
                  echo $this->Html->link('
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-square-pin text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">
              Edit Contact Info
              </span>',['controller'=>'Contactus','action'=>'edit', 1],['class'=>'nav-link','escape'=>false]);
              }
              ?>
          </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>

        <!--Log Out-->
        <li class="nav-item">
        <?php if($this->request->getSession()->read('Auth')){
          echo $this->Html->link('
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">
          Log Out
          </span>',['controller'=>'Users','action'=>'logout'],['class'=>'nav-link','escape'=>false]);
        }else{
            echo $this->Html->link('
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">
            Sign in
            </span>',['controller'=>'Users','action'=>'login'],['class'=>'nav-link','escape'=>false]);
        } ?>



        </li>

      </ul>
    </div>

    <!--FOOTER-->
    <div class="sidenav-footer" style="position: absolute; bottom: 0; border-radius: 25px; background: #ececec; width: 90%; margin-left: 5%; margin-bottom: 5%; padding-top: 20px; padding: 10px">

        <?php $contactdetails = $this->getRequest()->getSession()->read('contactus_details'); ?>

        <div style="display: flex;">
            <div style="flex: 20%;"><?= $this->Html->image('contacticon.png', ['style' => 'height: 32px']); ?> </div>
            <div class="h5" style="flex: 80%; font-weight: bold; font-size: 20px; color: #30a6db">Contact Us</div>
        </div>

        <div style="display: flex; padding-top: 10px">
            <div style="flex: 10%;"><?= $this->Html->image('callicon.png', ['style' => 'height: 22px']); ?></div>
            <div style="flex: 90%;"><a style="font-size: 12px; padding-left: 5%; font-weight: bold; overflow-wrap: break-word;" href="tel:<?php echo $contactdetails->phone; ?>">
                    <?php
                        echo $contactdetails->phone;
                    ?>
                </a></div>
        </div>

        <div style="display: flex; padding-top: 10px">
            <div style="flex: 10%;"><?= $this->Html->image('emailicon.png', ['style' => 'height: 22px']); ?></div>
            <div style="flex: 90%;"><a style="display: table-cell; vertical-align: middle; font-size: 12px;
                    font-weight: bold; padding-left: 5%; overflow-wrap: anywhere;"
                    href="mailto:<?php echo $contactdetails->email; ?>">
                    <?php echo $contactdetails->email; ?>
                </a></div>
        </div>

        <div style="display: flex; padding-top: 10px">
            <div style="flex: 10%;"><?= $this->Html->image('locationpin.png', ['style' => 'height: 22px']); ?></div>
            <div style="flex: 90%;"><a href="http://maps.google.com?q=<?php echo $contactdetails->address; ?>"
                    style="display: table-cell; vertical-align: middle; font-size: 12px; font-weight: bold; padding-left: 5%; overflow-wrap: break-word;" target="_blank" rel="noopener noreferrer"><?php
                    echo $contactdetails->address;
                    ?></a></div>
        </div>



    </div>



  </aside>
    <main class="main-content position-relative border-radius-lg ps">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>



          </ul>
        </div>
      </div>

    </nav>
        <div class="container-fluid">

            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>

    </main>

    <footer>
        <!--   Core JS Files   -->
        <?= $this->Html->script(['popper.min','bootstrap.min','perfect-scrollbar.min','smooth-scrollbar.min','chartjs.min']) ?>


  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <?= $this->Html->script(['argon-dashboard.min.js']) ?>

    </footer>
</body>
</html>
