<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>testing02</title>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" media="screen" href="/css/app.css">
    <link rel="stylesheet" media="screen" href="/css/proj.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>

<div class="container">
    <div class="row">
        <form>
            <div class="box col-md-7 col-sm-7">
                <input class="input-left form-control" tabindex="1" type="text" name="workingOnName" id="workingOnId" placeholder="What are you working on">
            </div>

            <div class="box col-md-2 col-sm-2 col-xs-6">
                <input class="input-center form-control" tabindex="2" name="projectName" id="projectId" type="text" placeholder="Project">
            </div>

            <div hidden class="col-md-2 col-sm-2 col-xs-6" id="dialogMessageId" tabindex="3">
                <div>
                    <input class="project-dialog form-control" type="text" id="projectDialogId" placeholder="Project">
                </div>
                {{--<div style="width: 240px;">--}}
                    {{--<input class="form-control" type="checkbox" placeholder="from database">--}}
                {{--</div>--}}

                {{--<hr style="color: orange; width: 100%;padding-bottom: 10px;margin: 0;">--}}

                {{--<div style="margin-left: 23px;">--}}
                    {{--<p>--}}
                        {{--We're closed during the winter holiday from 21st of December, 2010 until 10th of January 2011.--}}
                        {{--<br /><br />--}}
                        {{--Our hotel will reopen at 11th of January 2011.<br /><br />--}}
                        {{--Another line which demonstrates the auto height adjustment of the dialog component.--}}
                    {{--</p>--}}
                {{--</div>--}}
            </div>


            <div class="box col-md-2 col-sm-2 col-xs-6">
                <input class="input-center form-control" tabindex="4" type="text" name="timeName" id="timeId" placeholder="0 secs">
            </div>

            <div class="box col-md-1 col-sm-1">
                <input class="input-right form-control" tabindex="5" type="text" name="saveName" id="saveId" placeholder="Save">
            </div>
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/all.js"></script>
{{--<script src="/js/app.js"></script>--}}

</body>
</html>