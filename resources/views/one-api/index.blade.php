@extends('master')
@section('container')
    <style type="text/css">
        .orderstatdatatable tbody tr:hover {
            background: #eae4e4;
        }
    </style>
    <!-- START WIDGETS -->
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
            <input type="hidden" value="{{ date("F d, Y H:i:s", time()) }}" name="serverdate"/>
            <!-- START WIDGET CLOCK -->
            <div class="widget widget-danger widget-padding-sm">
                <div class="widget-big-int plugin-clock">00:00</div>
                <div class="widget-subtitle plugin-date">Loading...</div>
                <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left"
                       title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
                <div class="widget-buttons widget-c3">
                    {{ date_default_timezone_get() }}
                </div>
            </div>

            <!-- END WIDGET CLOCK -->
            <a href="#" id="update">
                <div class="widget widget-primary widget-item-icon">
                    <div class="widget-item-right">
                        <span class="fa fa-download"></span>
                    </div>
                    <div class="widget-data-left">
                        <div class="widget-title">Manual Sync</div>
                       <div class="widget-subtitle"><img src="spinner.gif" style="height:60px;width:60px" id="loading"></img></div>
                    </div>
                </div>
            </a>
           

        </div>


       
    </div>
    <div class="row">
        <div class="col-md-12">

            <!-- List of orders -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3> Logs</h3>
                        <span>List of Manual Sync Logs</span>
                    </div>
                    <ul class="panel-controls pull-right">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                    
                </div>
               
                <div class="panel-body" style="overflow:auto;">
                    <table class="table  ordertable table-responsive">
                       <thead>
                                        <tr>
                                            <td>Message</td>
                                        </tr>
                                    </thead>
                        <tbody id="logs">
                                       
                                    </tbody>
                                        
                    </table>
                </div>
                <div class="panel-footer">
                </div>
            </div>
            <!-- END List of orders -->


        </div>
      


    </div>
    <!-- END WIDGETS -->
    <div class="row">
        <div class="col-md-12">

            <!-- List of orders -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3> Logs</h3>
                        <span>List of Logs</span>
                    </div>
                    <ul class="panel-controls pull-right">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                    
               
                <div class="panel-body" style="overflow:auto;">
                    <table class="table  ordertable table-responsive">
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
                                    </tbody>
                                         <tfoot>
                                        <tr>
                                            <td colspan="13"
                                                style="text-align: right !important;">{!! $logs->appends($request)->render() !!}</td>
                                        </tr>
                                        </tfoot>
                    </table>
                </div>
                <div class="panel-footer">
                </div>
            </div>
            <!-- END List of orders -->


        </div>
      


    </div>
     <script>
            $(document).ready(function(){
                $('#loading').hide();
                $('#update').click(function(){
                    $('#loading').show();
                   $.ajax({
                        url:" {{url('/synconeapi')}} ",
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
    
@stop
