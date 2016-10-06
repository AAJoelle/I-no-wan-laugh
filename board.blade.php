<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
  <title>
    {{$board->sitename}}
    &middot; 
    @section('title') 
    @show
    @if(isset($headerTitle))
    &middot; {{$headerTitle}}
    @endif 
  </title>
  <meta property="og:title" content="{{$board->sitename}}
  &middot; 
  @section('title') 
  @show
  @if(isset($headerTitle))
  &middot; {{$headerTitle}}
  @endif "/>
  <meta property="og:type" content=""/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="{{URL::to('images')}}/nukeboard_fav.png"/>
  <meta property="og:site_name" content="  {{$board->sitename}} "/>
  <meta property="og:description" content="@section('description') @show"/>
  <meta name="description" content="@section('description') @show"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{URL::to('images')}}/nukeboard_fav.png">
  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="{{URL::to('assets')}}/css/bootstrap-search.css" media="screen">
  <!-- Custom CSS -->
  <link href="{{URL::to('assets')}}/css/search-green.css" rel="stylesheet">


  <link rel="stylesheet" href="{{URL::to('assets')}}/css/bootstrapValidator.css"/>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
  <script>tinymce.init({selector:'#description'});</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
          {{$board->css}}
        </style>

        {{$board->analytics}}

      </head>

      <body>
       <div id="fb-root"></div>
       <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <div class="container" >
        <div class="pull-right">
          {{-- load content for users and employer modules --}}
          @foreach($board->modules()->get() as $userModules)
          @if($userModules->id == 2)
          @include('site.userModule')
          @endif
          @if($userModules->id == 1)
          @include('site.employerModule')
          @endif
          @endforeach

        </div>
      </div>

      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">{{$board->sitename}}</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li>
                <a href="{{URL::to('/')}}">{{ucfirst(Lang::get('board.jobs_link'))}}</a>
              </li>
              @foreach($board->modules()->get() as $userModules)
              @if($userModules->id == 3)
              <li>
                <a href="{{URL::to('trainings')}}">{{ucfirst(Lang::get('training.home_link'))}}</a>
              </li>
              @endif
              @endforeach
              
              @foreach($board->modules()->get() as $userModules)
              @if($userModules->id == 4)
              <li><a href="{{URL::to('blogs')}}"> Blog</a>
              </li>
              @endif
              @endforeach
              
              <li>
                <a href="{{URL::to('about')}}">{{ucfirst(Lang::get('board.about_link'))}}</a>
              </li>
              @if($board->facebook != NULL)
              <li>
                <a href="{{$board->facebook}}" target="_blank">Facebook</a>
              </li>
              @endif
              @if($board->twitter != NULL)
              <li>
                <a href="{{$board->twitter}}" target="_blank">Twitter</a>
              </li>
              @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="{{URL::to('postjob')}}"> <strong>{{ucfirst(Lang::get('board.post_link'))}}</strong> </a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
      </nav>

      <!-- Page Content -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3">
                <p>
                  <h1>{{$board->logo != NULL ? "<img src=".URL::to('logo/'.$board->logo).">" : $board->sitename}}</h1>
                </p>
                <p> How are you doing</p>
              </div>
              <div class="col-md-9">
                <p>
                  @if(Widget::where('user_id','=',$board->id)->where('type','=','BANNER')->where('status','=','ON')->first() != NULL)
                  {{Widget::where('user_id','=',$board->id)->where('type','=','BANNER')->where('status','=','ON')->first()->content}}
                  @endif
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <p>
              {{substr(strip_tags($board->about), 0, 130)}} ... <a href="{{URL::to('about')}}" class="btn btn-info btn-xs pull-right"><strong>{{ucfirst(Lang::get('start.know_more'))}}</strong></a>
            </p>
          </div>
        </div>
        <div class="clear">    
        </div>

        <div class="row hidden-sm hidden-xs">
          <div class="col-md-12">    
            <form class="form-horizontal  search-section" action="{{URL::to('search')}}" method="get">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <input name="search" placeholder="{{ucfirst(Lang::get('board.keywords'))}} ..." value="{{Input::get('search')}}" class="form-control input-lg" style="float: left; width: 50%;" type="text">

                        <select name="category" class="form-control input-lg" style="float: left; width: 25%;">
                          <option selected="" value="{{ Input::get('category') ? Input::get('category')  : NULL }}">{{ Input::get('category') ? Input::get('category')  : ucfirst(Lang::get('board.category')) }}</option>
                          @foreach(Job::distinct()->select('category')->where('user_id','=',$board->id)->groupBy('category')->get() as $cate)
                          <option name="category" value="{{$cate->category}}">{{$cate->category}}</option>
                          @endforeach
                        </select>

                        <select name="location" class="form-control input-lg" style="float: left; width: 25%;">
                          <option selected="" value="{{ Input::get('location') ? Input::get('location')  : NULL }}">{{ Input::get('location') ? Input::get('location')  : ucfirst(Lang::get('board.location')) }}</option>
                          @foreach(Job::distinct()->select('location')->where('user_id','=',$board->id)->groupBy('location')->get() as $cate)
                          <option name="location" value="{{$cate->location}}">{{$cate->location}}</option>
                          @endforeach
                        </select>

                        
                        <span class="input-group-btn ">
                          <button class="btn btn-default btn-lg" type="submit">
                            <span class="fa fa-search"></span> {{Lang::get('board.search_button')}}
                          </button>
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="row hidden-lg hidden-sm visible-xs">
          <div class="col-md-10 col-md-offset-1">    
            <form class="form-horizontal  search-section" action="{{URL::to('search')}}" method="get">

            <div class="form-group col-md-10 col-md-offset-1">
              <label  class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="search" placeholder="{{ucfirst(Lang::get('board.keywords'))}} ..." value="{{Input::get('search')}}">
              </div>
            </div>

            <div class="form-group col-md-10 col-md-offset-1">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">
                  <span class="fa fa-search"></span> {{Lang::get('board.search_button')}}
                </button>
              </div>
            </div>
              
            </form>
          </div>
        </div>

        
        <div class="clear">    
        </div>
        
        @yield('content')

        <hr>

        <!-- Footer -->
        <footer>
          <div class="row">
            <div class="col-lg-12">
              <p>
                <a href="{{URL::to('language/en')}}">English</a>&nbsp;&nbsp;
                <a href="{{URL::to('language/fr')}}">Français </a>&nbsp;&nbsp;
                <br>
                &copy; {{$board->sitename}} {{date('Y')}} &bull; Powered with <i class=" fa fa-heart"></i> by <a href="http://nukeboard.co" target="_blank">Nukeboard</a>
              </p>
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <!-- /.row -->
        </footer>

      </div>
      <!-- /.container -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="{{URL::to('assets')}}/js/bootstrapValidator.js"></script>
      <script type="text/javascript" src="{{URL::to('assets')}}/js/applicationValidate-{{App::getLocale()}}.js"></script>
      <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
      <script>
        $(function() {
          var availableLocations = [
          @if(isset($jobLocations))
          @foreach($jobLocations as $jobLocation)
          "{{$jobLocation->title}}",
          @endforeach
          @endif
          ];
          $( "#locations" ).autocomplete({
            source: availableLocations
          });
        });
      </script>
      <script>
        $(function() {
          var availableCategories = [
          @if(isset($jobCategories))
          @foreach($jobCategories as $jobCategory)
          "{{$jobCategory->title}}",
          @endforeach
          @endif
          ];
          $( "#categories" ).autocomplete({
            source: availableCategories
          });
        });
      </script>

      
    </body>

    </html>
