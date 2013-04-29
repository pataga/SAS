<!DOCTYPE html>
    <head>
        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SAS &middot; #{PAGE_NAME}</title>
        <meta name="application-name" content="Server-Admin-System">
        <meta name="robots" content="noindex,nofollow">
        <!-- CSS -->
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/icons/css/fontello.css">
        <link rel="stylesheet" href="css/notifications.css">
        <link rel="shortcut icon" href="img/fav.ico">
        <!-- JS -->
        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="js/vendor/jquery-1.8.2.min.js"></script>
        <script src="js/vendor/tablesorter/jquery.tablesorter.min.js"></script>
        <script src="js/vendor/mousetrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/notifications.js"></script>
        <script src="js/shortcuts.js"></script>
        <!-- external JS -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <!--[if IE]>
            <script  src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <noscript>
            <div id="nojsactive">
               <p>Um ein besseres Nutzererlebnis im Server Admin System zu haben, <a href="http://www.enable-javascript.com/de/">aktiviere bitte JavaScript</a> in deinem Browser.</p>
            </div>
        </noscript>
        <div class="top">
            <div class="logo" style="#{VISIBILITY}">
                <h1>Server <span>Admin</span> System</h1>                       
            </div>
            <div class="usermenu" style="#{VISIBILITY}">
                <img src="img/profile/ubuntu.png" alt="Profilbild">
                <h3>#{USERNAME}</h3><a href="?server=change"><i class="icon-database"></i> Server wechseln</a><br>
                <a href="javascript:poppy();"><i class="icon-list"></i>SAS Notification Center
                    <div id="notify">
                        <div class="notify_bubble">#{NOTIFICATION_COUNT}</div>
                    </div>
                </a><br>
                <a href="?user=logout"><i class="icon-export"></i> Logout</a>
            </div>
        </div>
        <div id="wrapper">
            <div id="nav">
                <ul>
-----MENUSTART-----<li><a  class="#{STATUS}" href="?p=#{PAGE_PARAM}">#{PAGE_NAME}</a></li>-----MENUEND-----
                </ul>
                <br style="clear:left"></div>
                <div id="main">
                    <div id="sidebar">
                        <ul>
-----SIDEBARSTART----- <li class="#{STATUS}"><a href="?p=#{PAGE_PARAM}&s=#{SUBPAGE_PARAM}">#{SUBPAGE_NAME}</a></li>-----SIDEBAREND-----
                        </ul>
                    </div>
                    <div id="content">
