@extends('master')
@section('container')

                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                            <input type="hidden" value="{{ date("F d, Y H:i:s", time()) }}" name="serverdate" />
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    {{ date_default_timezone_get() }}
                                </div>                            
                            </div>
                            
                            {{ date_default_timezone_set('US/Eastern') }}
                            <input type="hidden" value="{{ date("F d, Y H:i:s", time()) }}" name="serverdate2" />
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock2">00:00</div>                            
                                <div class="widget-subtitle plugin-date2">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                     {{ date_default_timezone_get() }}
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                        
                    <!-- END WIDGETS -->
                    
@stop