<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style type="text/css">
            body {
                padding-top: 70px;
            }

            .btn-file {
                position: relative;
                overflow: hidden;
            }

            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }

            .img-zone {
                background-color: #F2FFF9;
                border: 5px dashed #4cae4c;
                border-radius: 5px;
                padding: 20px;
            }

            .img-zone h2 {
                margin-top: 0;
            }

            .progress,
            #img-preview {
                margin-top: 15px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="img-zone text-center" id="img-zone">
                        <div class="img-drop">
                            <h2><small>Drag &amp; Drop Photos Here</small></h2>
                            <p><em>- or -</em></p>
                            <h2><i class="glyphicon glyphicon-camera"></i></h2>
                            <span class="btn btn-success btn-file">
                                Click to Open File Browser<input type="file" multiple="" accept="image/*">
                            </span>
                        </div>
                    </div>
                    <div class="progress hidden">
                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                            <span class="sr-only">0% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="img-preview" class="row">

            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/ajax-upload.js"></script>

    </body>

</html>