<?php

/************************************ CONFIGURATION *********************************/
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require "../classes/User.php";
    require "../classes/Ticket.php";
    include "../function/function.php";

/************************************ DECLARATION ***********************************/
    $users = new User();
    $ticket = new Ticket();

    // Get all the users
    $userLists = $users->getUsers();

    $ownerOptions = "<option value='' label='default'></option>";

/************************************ OPERATION *************************************/
    foreach($userLists as $user)
    {
        $name = ucwords($user['fullname']);
        $ownerOptions .= "<option value='{$user['user_id']}'>{$name}</option>";
    }

    // Get all the ticket components

    $ticketComponents = $ticket->getComponents();
    $componentOptions = "<option value='' label='default'></option>";

    foreach($ticketComponents as $component)
    {
        $label = ucwords($component['label']);
        $componentOptions .= "<option value='{$component['ticket_component_id']}'>{$label}</option>";
    }

    // Submit form
    $loggedInUser = $_SESSION['user_info']['firstname']. ' ' .$_SESSION['user_info']['surname'];
    
    if(isset($_POST['create']))
    {
        $ticket->addTicket(
            $_POST["summary"], $_POST["txtEditor1"], $_POST["prior"], $_POST["type"], 
            $_POST["owner"], $_POST['duration'], $_POST["amount"], $loggedInUser, $_POST["component"]
        );  

        // uploadticket_files($_FILES);
        // echo "<pre>"; var_dump($_FILES["files"]); die("<pre>");
    }
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

    <link rel="apple-touch-icon" href="../../images/logo.png">
    <link rel="shortcut icon" href="../../images/logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>

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
                    <li class="menu-item-has-children active dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
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
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->


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
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-bell-o"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>New Ticket</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">New Ticket</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">

                <div class="row">

                    <div class="col-lg-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Add New Ticket</strong>
                                </div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label class=" form-control-label">Summary:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input class="form-control" type="text" name="summary" required>
                                        </div>
                                        <!-- <small class="form-text text-muted">ex. 99/99/9999</small> -->
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Reporter: </label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input class="form-control" type="text" readonly value="<?= ucwords($loggedInUser) ?>">
                                        </div>
                                        <!-- <small class="form-text text-muted">ex. (999) 999-9999</small> -->
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Description: </label>
                                       
                                        <!-- <div class="input-group-addon"><i class="fa fa-usd"></i></div> -->
                                        <textarea name="txtEditor1" class="form-control" placeholder="Page Body" rows="20" cols="5" required></textarea>
                                        
                                        <!-- <small class="form-text text-muted">ex. 99-9999999</small> -->
                                    </div>


                                    <div class="col-lg-6" style="float: left;">
                                        <!-- <div class="form-group">
                                            <label class=" form-control-label">Social Security Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                                <input class="form-control">
                                            </div>
                                            <small class="form-text text-muted">ex. 999-99-9999</small>
                                        </div> -->

                                        <div class="form-group">
                                            <label class="form-control-label">Type</label>
                                            <select data-placeholder="Choose Type..." class="standardSelect" tabindex="1" name="type">
                                                <option value="" label="default"></option>
                                                <option value="defect">Defect</option>
                                                <option value="enhancement">Enhancement</option>
                                                <option value="task">Task</option>
                                                <option value="idea">Idea</option>
                                                <option value="quoted">Quoted</option>
                                                <option value="request">Request</option>
                                            </select>  
                                        </div>

                                        <div class="form-group">
                                          
                                            <label class="form-control-label">Priority</label>
                                            <select data-placeholder="Choose Priority..." class="standardSelect" name="prior">
                                                <option value="" label="default"></option>
                                                <option value="2">Critical</option>
                                                <option value="1">Normal</option>
                                                <option value="0">Low</option>  
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Duraton of ticket</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                <input class="form-control" type="number" name="duration" value="0">
                                            </div>
                                            <small class="form-text text-muted">ex. 7 (Remember number represents number of days)</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="float: right;">
                                        <div class="form-group">
                                            <label class=" form-control-label">Owner: </label>
                                            <select data-placeholder="Choose Owner..." class="standardSelect" tabindex="1" name="owner">
                                                <?= $ownerOptions ?>                                                
                                            </select>  
                                            <!-- <small class="form-text text-muted">ex. ~9.99 ~9.99 999</small> -->
                                        </div>
                                         <div class="form-group">
                                          
                                            <label class="form-control-label">Component</label>
                                            <select data-placeholder="Choose Component..." class="standardSelect" name="component" required>
                                                <?= $componentOptions ?>                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Amount quoted: </label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                                <input class="form-control" type="number" name="amount" value="0">
                                            </div>
                                            <!-- <small class="form-text text-muted">ex. 9999 9999 9999 9999</small> -->
                                        </div>
                                    </div>
                                </div>

                                <div id="dropFile">
                                    <input type="file" name="files[]" id="fileInput" multiple onchange="showFiles(event);">
                                    <label for="fileInput" id="fileLabel" ondragover="drag_drop(event); fileHover()" ondragenter="drag_drop(event); fileHover()" ondragleave="drag_drop(event); fileHoverEnd();" ondrop="drag_drop(event); fileHoverEnd(); addFiles(event);">
                                        <i class="fa fa-download fa-5x"></i>
                                        <br>
                                        <span id="fileLabelText">
                                            Choose a file or drag it here
                                        </span>
                                    </label>
                                </div>

                                <div class="row" style="padding: 150px 0 50px 0">  
                                  <div class="col-md-5"></div>
                                  <div class="col-md-2">
                                    <button type="submit" name="create" class="btn btn-primary main-color-bg">Create</button>
                                  </div>
                                  <div class="col-md-5"></div>   
                                </div>

                            </div>
                        </form>
                    </div>

                   <!--  <div class="col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Standard Select</strong>
                            </div>
                            <div class="card-body">

                              <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1">
                                <option value="" label="default"></option>
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Aland Islands">Aland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                            </select>
                        </div>
                    </div> -->

                   <!--  <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Multi Select</strong>
                        </div>
                        <div class="card-body">

                          <select data-placeholder="Choose a country..." multiple class="standardSelect">
                            <option value="" label="default"></option>
                            <option value="United States">United States</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Aland Islands">Aland Islands</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                        </select>

                    </div> 
                </div> -->

                <!-- <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Multi Select with Groups</strong>
                    </div>
                    <div class="card-body">

                      <select data-placeholder="Your Favorite Football Team" multiple class="standardSelect" tabindex="5">
                        <option value="" label="default"></option>
                        <optgroup label="NFC EAST">
                          <option>Dallas Cowboys</option>
                          <option>New York Giants</option>
                          <option>Philadelphia Eagles</option>
                          <option>Washington Redskins</option>
                      </optgroup>
                      <optgroup label="NFC NORTH">
                          <option>Chicago Bears</option>
                          <option>Detroit Lions</option>
                          <option>Green Bay Packers</option>
                          <option>Minnesota Vikings</option>
                      </optgroup>
                      <optgroup label="NFC SOUTH">
                          <option>Atlanta Falcons</option>
                          <option>Carolina Panthers</option>
                          <option>New Orleans Saints</option>
                          <option>Tampa Bay Buccaneers</option>
                      </optgroup>
                      <optgroup label="NFC WEST">
                          <option>Arizona Cardinals</option>
                          <option>St. Louis Rams</option>
                          <option>San Francisco 49ers</option>
                          <option>Seattle Seahawks</option>
                      </optgroup>
                      <optgroup label="AFC EAST">
                          <option>Buffalo Bills</option>
                          <option>Miami Dolphins</option>
                          <option>New England Patriots</option>
                          <option>New York Jets</option>
                      </optgroup>
                      <optgroup label="AFC NORTH">
                          <option>Baltimore Ravens</option>
                          <option>Cincinnati Bengals</option>
                          <option>Cleveland Browns</option>
                          <option>Pittsburgh Steelers</option>
                      </optgroup>
                      <optgroup label="AFC SOUTH">
                          <option>Houston Texans</option>
                          <option>Indianapolis Colts</option>
                          <option>Jacksonville Jaguars</option>
                          <option>Tennessee Titans</option>
                      </optgroup>
                      <optgroup label="AFC WEST">
                          <option>Denver Broncos</option>
                          <option>Kansas City Chiefs</option>
                          <option>Oakland Raiders</option>
                          <option>San Diego Chargers</option>
                      </optgroup>
                  </select>

              </div> 
          </div>

      </div> -->



  </div>


</div><!-- .animated -->
</div><!-- .content -->
    <div class="clearfix"></div>

    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2018 Ela Admin
                </div>
                <div class="col-sm-6 text-right">
                    Designed by <a href="https://colorlib.com">Colorlib</a>
                </div>
            </div>
        </div>
    </footer>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->

<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });



    CKEDITOR.replace('txtEditor1');

// jQuery("select#owner.standardSelect").change(function(){

//     var data = {};

//     data['owner'] = jQuery(this).val();

//     jQuery.ajax({

//     })
// });

var dropFile = jQuery("#dropFile");
var droppedFiles;
var fileLabelText = jQuery("#fileLabelText");
function drag_drop(event)
{

    event.preventDefault();
    event.stopPropagation();
    // alert(e.dataTransfer.files[0]);
    // alert(e.dataTransfer.files[0].name);
    // alert(e.dataTransfer.files[0].size);
}

function fileHover()
{
    dropFile.addClass('fileHover');
}


function fileHoverEnd()
{
    dropFile.removeClass('fileHover');
}

function addFiles(event)
{
    droppedFiles = event.target.files || event.dataTransfer.files;
    showFiles(droppedFiles);
}


function showFiles(files)
{
    if(files.length > 1)
    {
        fileLabelText.text(files.length + " files selected");
    }
    else
    {
        fileLabelText.text(files[0].name);
    }
}

</script>

</body>
</html>
