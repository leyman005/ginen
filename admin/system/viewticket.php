<?php

/************************************ CONFIGURATION *********************************/
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include '../classes/User.php';
    isset($_SESSION['user_info']) ? $_SESSION['user_info'] : header('location: ../logout.php');
    include '../classes/Ticket.php';
    include '../function/function.php';

/************************************ DECLARATION *********************************/
    $objTickets  = new Ticket();
    $objUsers    = new User();

    if(isset($_GET['id'])) $ticketID = urlencode(trim($_GET['id']));

    $list_tickets   = $objTickets->getTicket($ticketID);
    $reporter       =  ucwords($list_tickets->created_by);
    $owner          = ucwords($list_tickets->fullname);

    $priority = 
    [
        "0" => "<span style='color:#F6931E'>Low</span>", 
        "1" => "<span style='color:#F6931E'>Normal</span>", 
        "2" => "<span style='color:red'>Critical</span>"
    ];

    $ticketStatus = ["0" => "Closed", "1" => "New", "2" =>"Assigned"];

    // Get user lists
    $ownerOptions = "<option value='' label='default'></option>";
    $userLists = $objUsers->getUsers();

/************************************ OPERATION *********************************/
    foreach($userLists as $user)
    {

        $name = ucwords($user['fullname']);

        if(!empty($list_tickets->assign))
        {

            if($objUsers->getUser($list_tickets->assign)->user_id == $user['user_id'])
            {
                $ownerOptions .= "<option selected value='{$user['user_id']}'>{$name}</option>";
                continue;
            }
        }
       
        $ownerOptions .= "<option value='{$user['user_id']}'>{$name}</option>";
    }

    // Load ticket comments
    $table_rows = "";
    $list_ticket_comments = $objTickets->getTicketComments($ticketID);
    $comment_count = 0;

    foreach($list_ticket_comments as $comment)
    { 
        ++$comment_count;
        $table_rows .= 
        "<tr>
            <td><small>Changed on {$comment['date_create']} by {$comment['updated_by']}</small></td>
            <td colspan='3' align='right'><small>Comment {$comment_count}</small></td>
        </tr> ";

        $table_rows .= 
        "<tr>
            <td colspan='4'><small>{$comment['comment']}</small></td>
        </tr> ";
    }

    // Submit form

    if(isset($_POST['submit']))
    {
        $objTickets->addTicketComment($ticketID, $_POST["reassign"], $_POST["txtEditor1"]);
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
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>


    <style type="text/css">
        .body-container
        {
            padding: 15px;
            min-height: 25vh;
        }
    </style>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body>
   
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel" style="margin-left: 0">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./dashboard.php"><img src="../../images/logo.png" alt="Logo" width="90" height="40"></a>
                    <!-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> -->
                    <!-- <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a> -->
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

                            <a class="nav-link" href="../logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs col-lg-8 offset-2">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>View Ticket</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="./dashboard.php">Dashboard</a></li>
                                    <li><a href="listticket.php">Tickets</a></li>
                                    <li><a href="#" class="active">View Ticket</a></li>
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

                    <div class="col-lg-8 offset-2">
                     
                        <div class="card">
                            <div class="card-header">
                                <strong>Ticket # <?=$list_tickets->ticket_id?> - <?=ucwords($list_tickets->title) ?> (<?=$ticketStatus[$list_tickets->ticket_status] ?>) - <?=$list_tickets->created_date ?></strong>

                                <label id="progress_bar" title="<?=$list_tickets->remaining_days ?> days remains" style="position: absolute;"> 
                                    <h5><?= date_format(date_create($list_tickets->formatted_date), "M d") ?> - <?= date_format(date_create($list_tickets->ticket_expired_date), "M d") ?></h5>
                                    <progress id="timeline_progress" value="<?= $list_tickets->passed_days ?>0" max="<?=$list_tickets->timeline ?>0">
                                </label> 
                            </div>

                            <form action="" method="post">

                                <div class="card-body card-block">

                                    <table class="table">
                                        <tbody>
                                        <tr bgcolor="#F1F2F7">
                                            <td>Reported by: </td>
                                            <td><span style="color:#F6931E"><?=$reporter?></span></td>
                                            <td>Owned by:</td>
                                            <td><span style="color:#F6931E"><?=$owner?></span></td>
                                        </tr>
                                        <tr bgcolor="#F1F2F7">
                                            <td>Priority: </td>
                                            <td><?=$priority[$list_tickets->priority] ?></td>
                                            <td>Component: </td>
                                            <td><span style="color:#F6931E"><?=ucwords($list_tickets->label)?></span></td>
                                        </tr>
                                        <tr bgcolor="#F1F2F7">
                                            <td>Amount Quoted</td>
                                            <td><span style="color:#F6931E">R <?=$list_tickets->amount?></span></td>
                                            <td>Status: </td>
                                            <td><span style="color:#F6931E"><?=$ticketStatus[$list_tickets->ticket_status] ?></span></td>
                                        </tr>
                                         <tr bgcolor="#F1F2F7">
                                            <td colspan="4"><div class="body-container"><?= $list_tickets->description ?></div></td>
                                        </tr>

                                        <?=$table_rows ?>

                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <label class=" form-control-label">Description: </label>
                                        <textarea name="txtEditor1" class="form-control" placeholder="Page Body" rows="20" cols="5" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class=" form-control-label">reassign  to: </label>
                                        <select data-placeholder="Choose Owner..." class="standardSelect" tabindex="1" name="reassign">
                                            <?= $ownerOptions ?>                                                
                                        </select>  
                                    </div>

                                    <div class="form-group">
                                          
                                        <label class="form-control-label">resolve as: </label>
                                        <select data-placeholder="Choose Resolution..." class="standardSelect" name="resolve">
                                            <option value="" label="default"></option>
                                            <option value="fixed">Fixed</option>
                                            <option value="invalid">Invalid</option>
                                            <option value="wontfix">Wontfix</option>
                                            <option value="duplicate">Duplicate</option>
                                            <option value="suspended">Suspended</option>
                                            <option value="fixed and invoice">Fixed and invoiced</option>                  
                                            <option value="quote rejected">Quote rejected</option>                            
                                        </select>
                                    </div>
                                </div>
                

                                <div class="row" style="padding-bottom: 10px">  
                                  <div class="col-md-5"></div>
                                  <div class="col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary main-color-bg">Submit</button>
                                  </div>
                                  <div class="col-md-5"></div>   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->  
        </div><!-- .content -->


        <div class="clearfix"></div>

        <?php include_once 'includes/footer.php'; ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="../js/logout_user_inactivity.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

</body>
</html>

<script>
     jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });

    CKEDITOR.replace('txtEditor1');
</script>
