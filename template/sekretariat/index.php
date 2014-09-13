<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layanan Biro Hukum dan Organisasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Stylesheet files import here -->
    <!--        <link rel="stylesheet" type="text/css" href="css/dusk.min.css">
            <link rel="stylesheet" type="text/css" href="css/font-embedding-standard.min.css">
            <link rel="stylesheet" type="text/css" href="css/dikbud.css">-->
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/dusk.min.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/jquery.ui.datepicker.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/font-embedding-standard.min.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/dikbud.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/rulycon.css">
    <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/rulycons.min.css">

    <style type="text/css">
        .container-fluid {
            padding: 0;
        }

        .dropdown-menu .divider {
            border-bottom: 1px solid #ddd !important;
        }
    </style>

    <!-- HTML5 shiv -->
    <!--[if lt IE 9]>
    <script src="../sekretariat/template/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="../sekretariat/template/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="../sekretariat/template/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="../sekretariat/template/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../sekretariat/template/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../sekretariat/template/ico/favicon.ico">

    <script type="text/javascript">
        var baseUrl = '{{ URL::to('/') }}';

        //      alert(baseUrl);
    </script>

</head>
<body class="main-layout">
<div class="container-fluid">
<div class="row-fluid">
<header id="user-header">
    <?php include("template/user-header.php"); ?>
<!--    @include('user-header')-->
</header>
<div class="span24" style="margin-left: 0;">
<div class="span6 sidebar">
    <?php include("mod/$home_module/left.php"); ?>
<!--<div id="dialog" title="FORUM" style="display: none;">-->
<!--    <p>Silahkan klik LOGIN terlebih dahulu untuk masuk kedalam Forum. Jika belum mempunyai akun, silakan klik DAFTAR untuk registrasi</p>-->
<!--</div>-->
<h6 id="copyright">© 2014 Biro Hukum dan Organisasi</h6>
</footer>
</div>
<div class="span18 main-content" style="padding-top: 120px;">
        <div class="row-fluid">
        <?php include("mod/$_mod/$task.php"); ?>
        </div>


<!--    @yield('content')-->
</div>
</div>
</div>
</div>

<script src="../sekretariat/template/js/jquery-1.10.1.min.js"></script>
<script src="../sekretariat/template/js/dusk.min.js"></script>
<script src="../sekretariat/template/js/jquery-ui.js"></script>
<script src="../sekretariat/template/js/jquery.ui.datepicker.js"></script>
<script src="../sekretariat/template/js/jquery.dataTables.min.js"></script>
<script src="../sekretariat/template/js/DatatableReloadAjax.js"></script>

<script>
    $(document).ready(function() {
        $("<select />", {
            "id": "select-menu-helper"
        }).appendTo(".select-on-mobile");

        $("<option />", {
            "selected": "selected",
            "value": "",
            "text": "~ Please select menu ~"
        }).appendTo("#select-menu-helper");

        $("<optgroup />", {
            "id": "optgroup-label-user-menu",
            "label": "Menu user"
        }).appendTo("#select-menu-helper");

        $(".welcome-message.user-not-null-links a").each(function() {
            var userMenuLinks = $(this);
            $("<option />", {
                "value": userMenuLinks.attr("href"),
                "text": userMenuLinks.text()
            }).appendTo("#optgroup-label-user-menu");
        });

        $("<optgroup />", {
            "id": "optgroup-label-app-menu",
            "label": "Menu aplikasi"
        }).appendTo("#select-menu-helper");

        $("#menu-beranda a, #menu-profile a, #menu-produk-hukum a, #menu-call-center a").each(function() {
            var appMenuLinks = $(this);
            $("<option />", {
                "value": appMenuLinks.attr("href"),
                "text": appMenuLinks.text()
            }).appendTo("#optgroup-label-app-menu");
        });

        $(".select-on-mobile > #select-menu-helper").change(function() {
            window.location = $(this).find("option:selected").val();
        });

        // THE MOST COMPLICATED THINGS IN THIS PAGE BEGINS HERE
        /*$(".accordion-toggle").each(function() {
         var listOfOptGroup = $(this);
         $("<optgroup />", {
         "label": listOfOptGroup.text()
         }).appendTo("#select-menu-helper");

         $(".accordion-inner a").each(function() {
         var listOfLinks = $(this);
         $("<option />", {
         "value": listOfLinks.attr("href"),
         "text": listOfLinks.text()
         }).appendTo("#select-menu-helper");
         });

         });*/
    });
</script>
</body>
</html>




