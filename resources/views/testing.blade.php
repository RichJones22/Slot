<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <link rel="stylesheet" media="screen" href="/css/app.css" >


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            padding-top: 40px;
        }
        /*@media (max-width: 10px) {*/
            /*body {*/
                /*padding-top: 0;*/
            /*}*/
        /*}*/
        /*fieldset {*/
            /*margin: 30px*/
        /*}*/
        /*.myWidth {*/
            /*width: 100%;*/
        /*}*/
        .form-group .myHeight{
            height: 50px;
        }
        /*input::-moz-focus-inner {*/
            /*border: 0;*/
        /*}*/
        /*input:focus {*/
            /*!*outline: none;*!*/
            /*border: none;*/
            /*!*margin: 0;*!*/
            /*!*padding: 0;*!*/
            /*!*border-color: ;*!*/
            /*!*-webkit-box-shadow: none;*!*/
            /*!*box-shadow: none;*!*/
        /*}*/
        /*.form-group  {*/
            /*outline: none;*/
            /*border: none;*/
            /*margin: 0;*/
            /*padding: 0;*/
            /*border-color: inherit;*/
            /*-webkit-box-shadow: none;*/
            /*box-shadow: none;*/
        /*}*/
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div>
            <div class="form-group col-md-7 col-sm-5" style="padding-left: 0;">
                <input style="outline: 0; border-right: hidden; border-right-color: white;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="What are you working on">
            </div>
            <div class="form-group col-md-2 col-sm-2 col-xs-6" style="padding-left: 0;outline: 0">
                <input style="outline: 0; border-left: hidden;border-left-color: white;border-right-color: white;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="Project">
            </div>
            <div class="form-group col-md-2 col-sm-2 col-xs-6" style="padding-left: 0;padding-right: 0">
                <input style="border-left: hidden;border-right: hidden;border-left-color: white;border-right-color: white;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="0 Secs">
            </div>
            <div class="form-group col-md-1 col-sm-1" style="padding-left: 0;">
                <input style="border-left: hidden;border-left-color: white;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="Save">
            </div>
        </div>
    </div>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/all.js"></script>
</body>
</html>