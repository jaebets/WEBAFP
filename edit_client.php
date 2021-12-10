<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Afrique Pesage S.A</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/style.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/main-responsive.css">
        <link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
        <link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
        <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
        <!--<style>html { overflow-y: hidden; }</style>-->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="page-full-width">
        <!-- start: HEADER -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <!-- start: TOP NAVIGATION CONTAINER -->
            <div class="container">
                <div class="navbar-header">
                    <!-- start: RESPONSIVE MENU TOGGLER -->
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="clip-list-2"></span>
                    </button>
                    <!-- end: RESPONSIVE MENU TOGGLER -->
                    <!-- start: LOGO -->
                    <a class="navbar-brand" href="#">
                        <img src="assets/images/signature.png" alt="log AFP"/>
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class="navbar-tools">
                    <!-- start: TOP NAVIGATION MENU -->
                    <ul class="nav navbar-right">
                        <li>
                            <a >
                                Date:
                            </a>
                        </li>
                        <!-- start: NOTIFICATION DROPDOWN -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <?php
                                /* set default time zone 
                                  date_default_timezone_set('UTC');
                                  echo date('l j F Y, H:i');
                                 * 
                                 */
                                include 'dateconfig/date.php';
                                ?>
                            </a>
                        </li>
                        <!-- end: NOTIFICATION DROPDOWN -->
                    </ul>
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
                <!-- start: HORIZONTAL MENU -->
                <div class="horizontal-menu navbar-collapse collapse" style="background-color: #f5f5f5;">
                    <ul class="nav navbar-nav" style="float: right !important;">
                        <!-- start: USER DROPDOWN -->
                        <li class="dropdown current-user" >
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                <span class="username"><?php echo $_SESSION['nom_utilisateur']; ?></span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" style="width: -2px;">
                                <li>
                                    <a href="#"><i class="clip-home-2"></i>
                                        &nbsp;Site: <?php echo 'nom du site'; //$_SESSION['login_utilisateur'];                                        ?></a></li>
                                <li>
                                    <a href="#"><i class="clip-locked"></i>
                                        &nbsp;Changer le mot <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de passe </a>
                                </li>
                                <li>
                                    <a href="logout.php">
                                        <i class="clip-exit"></i>
                                        &nbsp;D&eacute;connexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: USER DROPDOWN -->
                    </ul>

                </div>
                <!-- end: HORIZONTAL MENU -->
            </div>
            <!-- end: TOP NAVIGATION CONTAINER -->
        </div>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <!-- start: PAGE -->
            <div class="main-content">
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-header">
                                <h1>
                                    Compte Client
                                    <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%"/>
                                </h1>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-group"></i>
                                    Liste des clients
                                    <div class="panel-tools">
                                        <a class="btn btn-xs btn-link " HREF="javascript:history.go(0)"> <i class="fa fa-refresh"></i> </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="panel-body">
                                        <h2><i class="fa fa-pencil-square teal"></i> REGISTER</h2>
                                        <p>
                                            Create one account to manage everything you do with ClipOne, from your shopping preferences to your ClipOne activity.
                                        </p>
                                        <hr>
                                        <form action="#" role="form" id="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="errorHandler alert alert-danger no-display">
                                                        <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                                    </div>
                                                    <div class="successHandler alert alert-success no-display">
                                                        <i class="fa fa-ok"></i> Your form validation is successful!
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            First Name <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text" placeholder="Insert your First Name" class="form-control" id="firstname" name="firstname">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Last Name <span class="symbol required"></span>
                                                        </label>
                                                        <input type="text" placeholder="Insert your Last Name" class="form-control" id="lastname" name="lastname">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Email Address <span class="symbol required"></span>
                                                        </label>
                                                        <input type="email" placeholder="Text Field" class="form-control" id="email" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Password <span class="symbol required"></span>
                                                        </label>
                                                        <input type="password" class="form-control" name="password" id="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Confirm Password <span class="symbol required"></span>
                                                        </label>
                                                        <input type="password" class="form-control" id="password_again" name="password_again">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group connected-group">
                                                        <label class="control-label">
                                                            Date of Birth <span class="symbol required"></span>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <select name="dd" id="dd" class="form-control" >
                                                                    <option value="">DD</option>
                                                                    <option value="01">1</option>
                                                                    <option value="02">2</option>
                                                                    <option value="03">3</option>
                                                                    <option value="04">4</option>
                                                                    <option value="05">5</option>
                                                                    <option value="06">6</option>
                                                                    <option value="07">7</option>
                                                                    <option value="08">8</option>
                                                                    <option value="09">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                    <option value="13">13</option>
                                                                    <option value="14">14</option>
                                                                    <option value="15">15</option>
                                                                    <option value="16">16</option>
                                                                    <option value="17">17</option>
                                                                    <option value="18">18</option>
                                                                    <option value="19">19</option>
                                                                    <option value="20">20</option>
                                                                    <option value="21">21</option>
                                                                    <option value="22">22</option>
                                                                    <option value="23">23</option>
                                                                    <option value="24">24</option>
                                                                    <option value="25">25</option>
                                                                    <option value="26">26</option>
                                                                    <option value="27">27</option>
                                                                    <option value="28">28</option>
                                                                    <option value="29">29</option>
                                                                    <option value="30">30</option>
                                                                    <option value="31">31</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="mm" id="mm" class="form-control" >
                                                                    <option value="">MM</option>
                                                                    <option value="01">1</option>
                                                                    <option value="02">2</option>
                                                                    <option value="03">3</option>
                                                                    <option value="04">4</option>
                                                                    <option value="05">5</option>
                                                                    <option value="06">6</option>
                                                                    <option value="07">7</option>
                                                                    <option value="08">8</option>
                                                                    <option value="09">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" placeholder="YYYY" id="yyyy" name="yyyy" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Gender <span class="symbol required"></span>
                                                        </label>
                                                        <div>
                                                            <label class="radio-inline">
                                                                <input type="radio" class="grey" value="" name="gender" id="gender_female">
                                                                Female
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" class="grey" value="" name="gender"  id="gender_male">
                                                                Male
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Zip Code <span class="symbol required"></span>
                                                                </label>
                                                                <input class="form-control" type="text" name="zipcode" id="zipcode">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    City <span class="symbol required"></span>
                                                                </label>
                                                                <input class="form-control tooltips" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <hr>
                                                        <label class="control-label">
                                                            <strong>Signup for Clip-One Emails</strong> <span class="symbol required"></span>
                                                        </label>
                                                        <p>
                                                            Would you like to review Clip-One emails?
                                                        </p>
                                                        <div>
                                                            <label class="radio-inline">
                                                                <input type="radio" class="grey" value="" name="newsletter">
                                                                No
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" class="grey" value="" name="newsletter">
                                                                Yes
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <span class="symbol required"></span>Required Fields
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p>
                                                        By clicking REGISTER, you are agreeing to the Policy and Terms &amp; Conditions.
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-yellow btn-block" type="submit">
                                                        Register <i class="fa fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    end: FORM VALIDATION 1 PANEL -->

                                </div>
                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                    </div>
                    <div class="row" style="margin-top: 3%;margin-bottom: 3%;">
                        <div style="width: 15%;margin: 0 auto;">
                            <a class="btn btn-red btn-lg" href="intro_caissiere.php">
                                FERMER
                                <i class="fa fa-times fa fa-white"></i>
                            </a>
                        </div>
                    </div>
                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script type="text/javascript" src="assets/plugins/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
        <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
        <script src="assets/js/table-data.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                TableData.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>