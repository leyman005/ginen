<?php

    session_start();
    isset($_SESSION['user_info']) ? $_SESSION['user_info'] : header('location: ../logout.php');
    echo time('H:s:i');
    require('../classes/Quotation.php');

    $objQuotes = new Quotation();

    $quote_id = $_GET['id']; 

    $quotes = $objQuotes->getAllInfoQuote($quote_id);

    $quotes = json_decode($quotes);

    $client_name = isset($quotes->client) ? ucwords($quotes->client->contact_name) : ucwords($quotes->quote->fullname);
    $company     = isset($quotes->client) ? ucwords($quotes->client->client_name)  : ucwords($quotes->quote->company_name);
    $address     = isset($quotes->client) ? strtoupper($quotes->client->address)   : strtoupper("N/A");
    $telephone   = isset($quotes->client) ? ucwords($quotes->client->telephone)    : ucwords($quotes->quote->telephone);
    $email       = isset($quotes->client) ? ucwords($quotes->client->email)        : ucwords($quotes->quote->email);

    $file_ref    = 'GN01'.date('Ymd').'_'.substr(strtoupper($company), 0, 3);
    $request_for_quote = 'N/A';
    $client_ref = 'N/A';
    $client_req = 'N/A';
    $employer_name = ucwords($quotes->company->Fullname);
    $employer_tel = $quotes->company->cellphone;
    $employer_email = $quotes->company->email;



    // echo '<pre>'; print_r($_SESSION['user_info']); echo '</pre>';

    $table_quotes = "";
    // die();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ginen Admin</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/quotation.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />


   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
      <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Welcome <?= substr(ucwords($_SESSION['user_info']['firstname']), 0,1). " . " .ucwords($_SESSION['user_info']['surname']) ?></a>
                    </li>
                    <li class="menu-title">UI elements</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Components</a>
                        <ul class="sub-menu children dropdown-menu">                            <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">Buttons</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="ui-badges.html">Badges</a></li>
                            <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Tabs</a></li>

                            <li><i class="fa fa-id-card-o"></i><a href="ui-cards.html">Cards</a></li>
                            <li><i class="fa fa-exclamation-triangle"></i><a href="ui-alerts.html">Alerts</a></li>
                            <li><i class="fa fa-spinner"></i><a href="ui-progressbar.html">Progress Bars</a></li>
                            <li><i class="fa fa-fire"></i><a href="ui-modals.html">Modals</a></li>
                            <li><i class="fa fa-book"></i><a href="ui-switches.html">Switches</a></li>
                            <li><i class="fa fa-th"></i><a href="ui-grids.html">Grids</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="ui-typgraphy.html">Typography</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>
                            <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Users</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-user-md"></i><a href="#" onclick='location.href="client.php"'>Client</a></li>
                            <li><i class="menu-icon fa fa-users"></i><a href="#" onclick='location.href="user.php"'>User</a></li>
                        </ul>
                    </li>

                    <!-- <li>
                        <a href="#" onclick='location.href="quote.php"' class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa a fa-file-text-o"></i>Quotation</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                        </ul>
                    </li> -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Quotations</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa a fa-file-text-o"></i> <a href="#" onclick='location.href="quotation.php"'>New</a></li>
                            <li><i class="menu-icon fa fa-users"></i> <a href="#" onclick='location.href="quote.php"'>List</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">Icons</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Extras</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Register</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./dashboard.php"><img src="../../images/logo.png" alt="Logo" width="90" height="40"></a>
                    <!-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> -->
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="slider-bar">
                 <input type="range" min="75" max="100" value="100" class="slider" id="myRange">
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="../logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

       <!--  <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Basic</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Manley's code -->
        <div id='quotation'>
            <form action="" method="post">
                <section id='sec-1'></section>

                <section id='sec-2'>

                    <div id='sec-2a'>
                        <ul>
                            <li><img src=''></li>
                            <li><input class="address" name="address" value="<?= $address ?>"></li>
                            <li><span>Client name:</span>&nbsp;<input class="name" name="client_comp_name" value="<?= $company?>"></li>
                            <li><span>Contact name:</span>&nbsp;<input class="name" name="client_name" value="<?= $client_name ?>"></li>
                            <li><span>Tel:</span>&nbsp;<input class="name" name="phone" value="<?= $telephone ?>"></li>
                            <li><span>E-mail:</span>&nbsp;<input class="name" name="email" value="<?= $email ?>"></li>
                        </ul>
                    </div>

                    <div id='sec-2b'>
                         <ul>
                            <li><span>File reference: </span>&nbsp;<input class="name" name="txtcname" value="<?= $file_ref ?>"></li>
                            <li><span>Request for quotation: </span>&nbsp;<input class="request" name="txtclname" value="<?= $request_for_quote ?> "></li>
                            <li><span>Client reference: </span>&nbsp;<input class="name" name="txtclname" value="<?= $client_ref ?>"></li>
                            <li><span>Client request: </span>&nbsp;<input class="name" name="txtclname" value="<?= $client_req ?>"></li>
                            <li><span>Date: </span>&nbsp;<input class="name" name="txtclname" value="<?= date('d/m/Y'); ?>" readonly></li>
                            <li><span>Contact: </span>&nbsp;<input class="name" name="txtclname" value="<?= $employer_name ?>"></li>
                            <li><span>Tel: </span>&nbsp;<input class="name" name="txtclname" value="<?= $employer_tel ?>"></li>
                            <li><span>E-mail:</span>&nbsp;<input class="email" name="txtclname" value="<?= $employer_email ?>"></li>
                        </ul>
                    </div>  
                </section>

                <section id='sec-3'>
                    <h4>COMMERCIAL OFFER</h4>
                    <a id='addRow' href='#'><span class='fa fa-plus'></span></a>
                </section>

                <section id='sec-4'>
                    <table id="my-table" class='table' align="center">
                        <tr>
                            <th>ITEM</th>
                            <th>DESIGNATION</th>
                            <th>BRAND</th>
                            <th>QTY</th>
                            <th>UNIT OF MEASUREMENT</th>
                            <th>UNIT PRICE(ZAR)</th>
                            <th>TOTAL PRICE(ZAR)</th>
                        </tr>
                       
                        <tr>
                            <td>1</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>2</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>3</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>4</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>5</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>6</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>7</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>8</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                         <tr>
                            <td>9</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr>

                      <!--    <tr>
                            <td>10</td> 
                            <td><input type="text" name="designation"></td> 
                            <td><input type="text" name="brand"></td> 
                            <td><input type="number" name="qty"></td> 
                            <td><input type="text" name="unit"></td>
                            <td><input type="text" name="price"></td> 
                            <td class="sum_total"><input type="text" name="total"></td>
                        </tr> -->
                 
                        <tr id="total">
                           <td colspan='5'></td>
                            <td>TOTAL (inc VAT)</td>
                            <td id='final'></td>
                        </tr>
                         <tr>
                           <td colspan='7'><input type='text' style='width:100%; text-align:center' name='amount'></td>
                        </tr>
                    </table>

                    <table id="acc" style='width:80%; text-align: center; margin: 10px auto'>
                        <tr>
                            <td colspan="4"><h5>Delivery Information</h5></td>
                        </tr>
                        <tr>
                            <td>Bank name</td>
                            <td>FNB</td>
                        </tr>
                         <tr>
                            <td>Account holder</td>
                            <td>Manley Louis</td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td>62398667033</td>
                        </tr>
                        <tr>
                            <td>Branch code</td>
                            <td>250655</td>
                        </tr>
                    </table>
                </section>
                
                <section id='sec-5'>
                    <!-- <a href ="#" class="btn btn-primary">Total</a><br><br> -->
                    <input type="submit" name="btn" class="btn btn-success" value='Create PDF'> <br><br>
                </section>
            </form>

            <footer id='footer'></footer>
        </div>
  
        <!-- <div class="clearfix"></div> -->
        <!-- Footer -->
      
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../js/logout_user_inactivity.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="../js/dashboard.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.4/jspdf.plugin.autotable.min.js"></script>



    <!--Local Stuff-->
    <script>
        var data = {}
        var id = "<?= $quote_id ?>"

        $(document).ready(function(){
            $('#my-table tr').find('input').each(function(i,v){
        
                $(this).blur(function()
                {
                    var that = $(this);
                    that.parent().text(that.val())
                    that.remove()
                })
            })
        })


        $('input[name=price').each(function()
        {
            var that = $(this)

            that.focusout(function(){
                var qty = that.parent().prev().prev().text()
                var total = that.val() * qty
                that.parent().next().children().val(total)
            })
        })

        $('input[name=total').blur(function()
        {
             setInterval(function(){
               var total = 0;
                $('td.sum_total').each(function(i, v){
                    var that = $(this)
                    if(that.text() != " ")
                    {              
                        total += Number(that.text())
                    } 
                })
               
                $('#final').text(total)
                
                return false
            },2000)
        })
       
        
            
    
     
       


      

        $('input[type=submit]').click(function()
        {
            var doc = new jsPDF();

            var headerimg = "data:image/jpeg;base64,iVBORw0KGgoAAAANSUhEUgAABdwAAAIECAMAAAA0IRyaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3FpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDozZDQ3NTk5NC1mZDBlLTQ3NDEtYTdiYy1kN2JjNzlhNDI2YzEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OUI2QjFGMUFCMjNBMTFFOUI5MzFFODU1RkRBMUJEQTYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OUI2QjFGMTlCMjNBMTFFOUI5MzFFODU1RkRBMUJEQTYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOmQzN2IwMTYxLTU4OGUtMzg0OS1hYWI3LTk2MjRiMWUzNTMzNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozZDQ3NTk5NC1mZDBlLTQ3NDEtYTdiYy1kN2JjNzlhNDI2YzEiLz4gPC9y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";

        
            var footerimg ="data:image/jpeg;base64,iVBORw0KGgoAAAANSUhEUgAABdwAAADACAMAAAApx1ERAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3FpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDozZDQ3NTk5NC1mZDBlLTQ3NDEtYTdiYy1kN2JjNzlhNDI2YzEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OUJBNkEzRjhCMjNBMTFFOUI5MzFFODU1RkRBMUJEQTYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OUJBNkEzRjdCMjNBMTFFOUI5MzFFODU1RkRBMUJEQTYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOmQzN2IwMTYxLTU4OGUtMzg0OS1hYWI3LTk2MjRiMWUzNTMzNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozZDQ3NTk5NC1mZDBlLTQ3NDEtYTdiYy1kN2JjNzlhNDI2YzEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6QToETAAADAFBMVEXpki1UVFT5qUyqqqrnlzj5rVT4oTn4lB5SMQrXhynzjBL3lSH4njPwkB1uQg327eHjjCWmYxTpo1HZtIj806L+9uzapmnq2sm3t7fku4zbgxv/+fP5sVtpaWn6vHKFhYX//Pn948T7zJPr6ur+7tvzkh7j0LrLy8v////4khr93rnalkb19fXj4+P95cnT09PLl1r7xIPMiz3kqmX+9/DWq3n82bHOwbL6wHxpVDn5tWPt49mwahX5+fnns3jjmkPkiBz4pD/3mSqZmZn5vnjziAv6uWzly6yZWxPlwpnMehnz6t7ajDB0dHS1lnHam1Htjh2MVBH7yYz96tL5kBT94L7+8uX81qnEdhjc3NzDw8Px5NT+8eL3kRj//vzgxablzbD59fH4nC7n1L3+9er7+PTw8PDuiRLwnDn4lSD7zpnnn0r969VkPAzp5uP4p0XzjhjTfxrhhxvp0bXJi0L80J3Ur4P3lyPXzL/xkR/NnGL07+nevJM9JAf83LXm3tTdsXzbkTnpzaz96M77xoj7+/zwmTL8///x3sf8+/na1M358unpiRnqjB3syaH68eb79u/vhw36+/zz2bvz8vH6/f/3mCbaoV739/j2jhLsv4v3jxX39PLxzaL3lB73+v3+7NfvjBi7cBfm0Lf14svqhxL6lBrwliuATRDw07P4kxztrWKGdmL82Kz0qE3x59ryw436t2gOdrzRoWr/+/fjyKf6lR7rixjJj038lBnukybujx+6fjiPv+D3lB9Om86/2u0ef8Dv9vvP5PLf7fY+kckuiMWfyORurddepNKv0el+ttv+/v7///7+8N7+///+9Ofnih35qEj827T0kBr9/f32kx71lCH359Ps2MH9/v7xoEHvqFX26Nju1rteRyzohRHgwZzmiBjEu7Hu0K23raL8+fTNqHyRjorz0Kbu4M71w4dGRUTGp4Lusmz59O778+rzkyPhrXDvuXnzvn+qm4mIWyaGZT/yxZLwyZ3nx6L//fv57+NyWj13Y0vIeBgTMffOAABCBUlEQVR42uydC3xcdZn3S2gytJNgsBegCTFNiZyE0hoo3W4s0sRsRajb0iu3Bg0VnVoordZs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";


            
            var client_info = {};
            $('#sec-2a').find('input[name]').each(function(index, value){
                client_info[$(this).prev().text()] = $(this).val();
            });
            
            // Set font
            doc.setFont("calibri");

            // Set font-size
            doc.setFontSize(11);

            // image header
            doc.addImage(headerimg, 'JPEG', 0, 0, 215, 70);

            // Client Info
            var positionY = 70;
      
            doc.roundedRect(5, 65, 80, 35, 3,3);

            $.each(client_info, function(index,value){
                positionY += 5;
                doc.text(index+' '+value,10,positionY);
            });

            // Company info

            var company_info = {};
            var positionY = 70;
            $('#sec-2b').find('input[name]').each(function(index, value){
                company_info[$(this).prev().text()] = $(this).val();
            });


            $.each(company_info, function(index,value){
                positionY += 5;
                doc.text(index+' '+value,205,positionY, null, null, 'right');
            });

             //Commercial offer
             doc.rect(10, 115, 190, 8);

             // Set font-size
             doc.setFontSize(14);
             doc.setFontStyle('bold');
             doc.text('Commercial Offer', 105, 120, null, null, 'center');

            
            
          

             //Add table with headers and contents
             // return false;
             doc.autoTable({html: '#my-table', startY: 130, theme: 'grid', font: 'calibri'})

             // doc.autoTable({
             //    head:[["ITEM", "DESIGNATION", "BRAND", "QTY", "UNIT OF MEASUREMENT", "UNIT PRICE", "TOTAL"]],
             //    startY: 130,
             //    body:[content]
             // });

            //  var generateData = function (amount) {
            //     var result = [];
            //     var data =
            //     {
            //         DESIGNATION: "100",
            //         BRAND: "GameGroup",
            //         QTY: "XPTO2",
            //         UNIT_OF_MEASUREMENT: "25",
            //         UNIT_PRICE: "20485861",
            //         TOTAL: "0"
            //     };
            //     for (var i = 0; i < amount; i += 1) {
            //         data.id = (i + 1).toString();
            //         result.push(Object.assign({}, data));
            //     }
            //     return result;
            // };

            // function createHeaders(keys) {
            //     var result = [];
            //     for (var i = 0; i < keys.length; i += 1) {
            //         result.push({
            //             'id' : keys[i],
            //             'name': keys[i],
            //             'prompt': keys[i],
            //             'align': 'left',
            //             'padding': 0
            //         });
            //     }
            //     return result;
            // };

            // var headers = createHeaders(["id", "DESIGNATION", "BRAND", "QTY", "UNIT_OF_MEASUREMENT", "UNIT_PRICE", "TOTAL"]);

           
            // // var doc = new jsPDF({ putOnlyUsedFonts: true, orientation: 'landscape' });
            //  doc.table(1, 125, generateData(5), headers, { autoSize: true });
            doc.autoTable({html: '#acc', startY: 230, theme: 'grid', font: 'calibri'})

            // image footer
            doc.addImage(footerimg, 'JPEG', 0, 270, 200, 25);

            // doc.text(address,10,70);

            // doc.text(name,10,80);

            var filename = "<?= $file_ref ?>"
    
            doc.save(filename+'.pdf');

            // data['file_upload'] = filename+'.pdf'
            data['id'] = id

            // Update database

            $.ajax({
                url: '../ajax/update_quote.php',
                type: 'post',
                data: data,
                success: function(result){
                    console.log(JSON.stringify(result))
                },
                error: function(result){
                    console.log("Error "+JSON.stringify(result))
                }
            })

            // window.location.href="./quote.php"
            return false;
        });
    </script>
</body>
</html>
