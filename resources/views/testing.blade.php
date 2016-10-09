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

        * {
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "Open Sans",Arial,sans-serif;

            padding-top: 40px;
        }

        .form-group .myHeight{
            height: 50px;
        }

        textarea:focus, input:focus, input[type]:focus {
            border-color: lightgray;
            box-shadow: none;
        }

        .secondRow {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: column-reverse;
            padding: 1em;
        }

        .item {
            margin: 0;
        }


        /*
        *  Jeffy Way flex box example.
        */
        .myContainer{
            margin: auto;
        }

        .box {
            padding: 20px;
        }

        .box-left {
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .box-center {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .box-right {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        .columns {
            display: flex;
        }

        .column {
            flex: 1;
        }

        /* Rinse and repeat for is-1 .. is-11 */
        .column.is-2 {
            width: 16.66667%;
            flex: none;
        }

        .column.is-3 {
            width: 25%;
            flex: none;
        }

        .column.is-4 {
            width: 33.33333%;
            flex: none;
        }

        .column.is-6 {
            width: 50%;
            flex: none;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div>
            <div class="form-group col-md-7 col-sm-5" style="padding-left: 0;">
                <input style="border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="What are you working on">
            </div>
            <div class="form-group col-md-2 col-sm-2 col-xs-6" style="padding-left: 0;">
                <input style="outline: 0; border-left: hidden;border-left-color: transparent;border-right-color: transparent;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="Project">
            </div>
            <div class="form-group col-md-2 col-sm-2 col-xs-6" style="padding-left: 0;padding-right: 0">
                <input style="outline: 0;border-left: hidden;border-right: hidden;border-left-color: transparent;border-right-color: transparent;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="0 Secs">
            </div>
            <div class="form-group col-md-1 col-sm-1" style="padding-left: 0;">
                <input style="outline: 0;border-left: hidden;border-left-color: transparent;border-radius: 0;box-sizing: content-box;" name="workingOnWhat" id="id_workingOnWhat" type="text" class="form-control myHeight" placeholder="Save">
            </div>
        </div>
    </div>

    <div class="row secondRow">
        <h3 class="item">flex box</h3>
        <h3 class="item">testing</h3>
    </div>

    <div class="myContainer">
        <div class="columns">
            <div class="column is-3">
                <input class="box box-left" placeholder="what are you working on">
            </div>

            <div class="column is-3">
                <div class="box box-center">Hello World</div>
            </div>

            <div class="column is-3">
                <div class="box box-center">Hello World</div>
            </div>

            <div class="column is-3">
                <div class="box box-right">Buttons</div>
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