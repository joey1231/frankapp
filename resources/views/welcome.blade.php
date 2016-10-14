<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manual Sync</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"  crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000;
                
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: top;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
                width: 100%;
               color: #636b6f;
               height: 500px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
                <div class="top-right links">
                    <a href="{{ url('/logs') }}">Logs</a>
                    <a href="{{ url('/') }}">Manual</a>
                </div>
          
            <div class="content">
               <div class="panel panel-default">
                  <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12">
                            <button class="btn btn-primary" id="update">Manualy Update AppThis</button>
                            <img src="spinner.gif" style="height:60px;width:60px" id="loading"></img>
                    </div>
                    <div class="col-md-12">
                            <div class="panel panel-default">
                              <!-- Default panel contents -->
                              <div class="panel-heading">Manual Update Logs</div>

                              <!-- Table -->
                              <table class="table m\">
                                    <thead>
                                        <tr>
                                            <td>Message</td>
                                        </tr>
                                    </thead>
                                     <tbody id="logs">
                                       
                                    </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                              <!-- Default panel contents -->
                              <div class="panel-heading">Logs</div>

                              <!-- Table -->
                              <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Message</td>
                                        </tr>
                                    </thead>
                                     <tbody>
                                      @foreach($logs as $log)
                                        <tr>
                                            <td>{{$log->message}}</td>
                                        </tr>
                                     @endforeach
                                         <tfoot>
                                        <tr>
                                            <td colspan="13"
                                                style="text-align: right !important;">{!! $logs->appends($request)->render() !!}</td>
                                        </tr>
                                        </tfoot>
                                    </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                       
                  </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#loading').hide();
                $('#update').click(function(){
                    $('#loading').show();
                   $.ajax({
                        url:" {{url('/syncappthis')}} ",
                        type:'GET',
                        dataType:'JSON',
                        success:function(data){
                            $('#logs').html('');
                            var html="";
                            for(var i=0;i<data.logs.length;i++){
                                html+="<tr>";
                                html+="<td>"+data.logs[i].log.message+"</td>";
                                html+="</tr>"
                            }
                             $('#logs').html(html);
                            $('#loading').hide();
                        },
                        error:function(error){
                            console.log(error);
                            alert('Have Exception ERROR');
                              $('#loading').hide();
                        }
                   });
                })
            })
        </script>
    </body>
</html>
