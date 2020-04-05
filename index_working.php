
<!DOCTYPE html>
<html lang="en">
<head>
<link type="text/css" rel="stylesheet" href="../bower_components/materialize/dist/css/materialize.min.css"
      media="screen,projection"/>
<script type="text/javascript" src="../bower_components/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="../bower_components/materialize/dist/js/materialize.min.js"></script>
<script src="../bower_components/jquery.cookie/jquery.cookie.js"></script>
    <style rel="stylesheet">
        /* TEMPLATE STYLES */

        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/

        .nav-wrapper {
            background-color: transparent;
        }
        .hide-on-med-and-down {
            background-color: transparent;
        }

        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }

        .top-nav-collapse {
            background-color: #1C2331;
        }

        footer.page-footer {
            background-color: #1C2331;
            margin-top: -1px;
        }

        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #ffffff;
                /*#1C2331;*/
            }
        }
        /*Call to action*/

        .flex-center {
            color: #fff;
        }

        .view {
            background: url("https://eofirmament.com/eofirmament1.png")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body>
<nav>
    <div class="nav-wrapper">

        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
    </div>
</nav>
</body>>