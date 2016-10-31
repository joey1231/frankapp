<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Frank APP </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
                
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ url('') }}/media/css/theme-default.css"/>
        <link href="{{ url('')}}/media/js/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
        <!-- EOF CSS INCLUDE -->     
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js" ></script>
        
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="{{ url('/dashboard') }}">Frank App</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li class="@if($page=='dashboard') active @endif">
                        <a href="{{ url('/dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li class="@if($page=='appthis') active @endif">
                        <a href="{{ url('/appthis') }}"><span class="fa fa-tags"></span> <span class="xn-text">Appthis</span></a>
                    </li>
                    <li class="@if($page=='mgt') active @endif">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">HeadwayDigital</span></a>
                    </li>
                    <li class="@if($page=='mgt') active @endif">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Mobusi</span></a>
                    </li>
                     <li class="@if($page=='mgt') active @endif">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Persona.ly</span></a>
                    </li>
                    <li class="@if($page=='cpi') active @endif">
                        <a href="{{ url('/cpi') }}"><span class="fa fa-tags"></span> <span class="xn-text">CPIAPI</span></a>
                    </li>
                      <li class="@if($page=='mgt') active @endif">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Tapgrine</span></a>
                    </li>
                       <li class="@if($page=='crunch') active @endif">
                        <a href="{{ url('/crunchmedia') }}"><span class="fa fa-tags"></span> <span class="xn-text">Crunchiemedia</span></a>
                    </li>
                      <li class="@if($page=='mgt') active @endif">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Mobisummer</span></a>
                    </li>
                     <li class="@if($page=='adexperience') active @endif">
                        <a href="{{ url('/adx') }}"><span class="fa fa-tags"></span> <span class="xn-text">Adxperience</span></a>
                    </li>
                     <li class="@if($page=='oneapi') active @endif">
                        <a href="{{url('/oneapi')}}"><span class="fa fa-tags"></span> <span class="xn-text">One-api</span></a>
                    </li>
                      <li class="@if($page=='wadogo') active @endif">
                        <a href="{{url('/wadogo')}}"><span class="fa fa-tags"></span> <span class="xn-text">Wadogo</span></a>
                    </li>
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->            
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="#" class=""><span class="fa fa-unlock"></span> Change Password</a></li>
                            <li><a href="{{ url('/logout')}}" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                        
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                </ul>
                <!-- END BREADCRUMB -->  
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">   

                  @yield('container')

                 </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="#" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->           
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/jquery/jquery.min.js"></script>
      
        <script type="text/javascript" src="{{ url('') }}/media/js/plugins/bootstrap/bootstrap.min.js"></script>   
        <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>        
        <script src="{{ url('') }}/media/js/plugins/bootstrap/bootstrap-select.js" type="text/javascript"></script>
        <script src="{{ url('') }}/media/js/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='{{ url("") }}/media/js/plugins/icheck/icheck.min.js'></script>    
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/dropzone/dropzone.min.js"></script>  
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/fileinput/fileinput.min.js"></script>    
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/datatables/jquery.dataTables.min.js"></script>   
        
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='{{ url("")}}/media/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='{{ url("")}}/media/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='{{ url("")}}/media/js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        
        <script type="text/javascript" src="{{ url('')}}/media/js/plugins.js"></script>        
        <script type="text/javascript" src="{{ url('')}}/media/js/actions.js"></script>
        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->    
        
        
    </body>
</html>