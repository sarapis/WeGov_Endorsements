@include('layouts.style')
<title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="../css/treeview.css" rel="stylesheet">
    <style>
    .alert{
        display: none;
    }
    .panel{
        cursor: pointer;
    }
    </style>
<div>

    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
     @include('layouts.header')
    <!--END TOPBAR-->
    
        <!--BEGIN SIDEBAR MENU-->
        @include('layouts.menu')
        <!--END SIDEBAR MENU-->

        <!--BEGIN PAGE WRAPPER-->
        <div id="wrapper">
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        Home</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <div id="tab-general">
                <div class="mbl">
                    <div class="col-lg-12">

                        <div class="col-md-12">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                        </div>

                    </div>

                    <div>
                    <button class="cornsilk btn-blue" style="position: absolute;top: 7px;left: auto;" id="menu-toggle">
                        <a href="" class="btn btn-secondary" style="padding: 0px;font-size: 25px;"><i class="fa  fa-search" style="color: #fff;font-size: 25px;"></i></a>
                    </button>
                   
                        <div class="page-content">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="panel income">
                                        <div class="panel-body">
                                            <h4>{{$posts->title}}</h4>
                                            {!! $posts->body !!}
                                        </div>                                                                  
                                    </div>

                                    <div class="panel">
                                        <div class="row" style="margin:20px;">
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    You can view the budget of each organization on their profile pages under the “Budgets” tab.
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            
                                            <div id="sum_box" class="row mbl">
                                                <div class="col-sm-6 col-md-3 block-space">
                                                    <div class="panel profit db mbm" onclick="location.href='organizations';">
                                                        <div class="panel-body">
                                                            <p class="icon">
                                                                <i class="icon icon-users"></i>
                                                            </p>
                                                            <p class="description">
                                                                Agencies</p>
                                                            <h4 class="value">
                                                                {{number_format($quantity_organizations)}}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3 block-space">
                                                    <div class="panel income db mbm budgets">
                                                        <div class="panel-body">
                                                            <div class="col-sm-6">
                                                                <p class="description">
                                                                    Expenses</p>
                                                                <h4 class="value">
                                                                    ${{$budgets}}</h4>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p class="description">
                                                                    Capital
                                                                </p>
                                                                <h4 class="value">
                                                                    ${{$capital}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3 block-space">
                                                    <div class="panel task db mbm" onclick="location.href='services';">
                                                        <div class="panel-body">
                                                            <p class="icon">
                                                                <i class="icon icon-check"></i>
                                                            </p>
                                                            <p class="description">
                                                                Services</p>
                                                            <h4 class="value">
                                                                {{number_format($quantity_services)}}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="panel visit db mbm" onclick="location.href='projects';">
                                                        <div class="panel-body">
                                                            <p class="icon">
                                                                <i class="icon icon-basket"></i>
                                                            </p>
                                                            <p class="description">
                                                                Projects</p>
                                                            <h4 class="value">
                                                                {{$quantity_project}}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <iframe src="https://feed.mikle.com/widget/v2/58831/" height="402px" width="100%" class="fw-iframe" scrolling="no" frameborder="0"></iframe>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Begin MailChimp Signup Form -->
                                                    <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
                                                    <style type="text/css">
                                                     #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
                                                     /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                                        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                                    </style>
                                                    <div id="mc_embed_signup">
                                                    <form action="https://municipalist.us14.list-manage.com/subscribe/post?u=bc85158717f189878a1a9cf42&amp;id=7ab01d02e4" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                        <div id="mc_embed_signup_scroll">
                                                     <label for="mce-EMAIL">Get Updates in your Inbox</label>
                                                     <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bc85158717f189878a1a9cf42_7ab01d02e4" tabindex="-1" value=""></div>
                                                        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                                        </div>
                                                    </form>
                                                    </div>

                                                    <!--End mc_embed_signup-->
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>

            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                    <a href="#">&copy; ThemesGround 2015. Designed by ThemesGround </a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END CONTENT-->
    </div>
    <!--END PAGE WRAPPER-->
</div>
@include('layouts.script')
<script type="text/javascript">
$(document).ready(function(){
    $('.budgets').click(function(){
        $('.alert').show()
    }) 
});
</script>
