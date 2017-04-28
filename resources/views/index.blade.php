@extends('./layouts/master')

@section('content')
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">M.R.中鑒者</h1>
                <hr>
                <form id="searchForm" method="get" action="result">
                <p><input type="text" class="searchbar" name="search" placeholder="search..."></p>
                <br>
                <input type="submit" value="Find Out" id="submitButton" class="btn btn-primary btn-xl" />
                </form>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">What you desire!</h2>
                    <hr class="light">
                    <h4 class="text-faded aside">不再被廣告所欺騙，不再讓網路垃圾訊息掩蓋住你所需要的商品資訊，我們透過大量的使用者體驗，找到最真實，最符合您的需求的商品</h4>
                    <br>
                    <br>
                    <a href="#classification" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="classification">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section">Classification</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <a class="btn" href="#">
                        <i class="fa fa-4x fa-cutlery text-primary sr-icons" ></i></a>
                        <h3>Foods</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                         <a class="btn" href="#">
                        <i class="fa fa-4x fa-user text-primary sr-icons"></i></a>
                        <h3>Dresses</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <a class="btn" href="#">
                        <i class="fa fa-4x fa-plane text-primary sr-icons"></i></a>
                        <h3>Travel</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <a class="btn" href="#">
                        <i class="fa fa-4x fa-laptop text-primary sr-icons"></i></a>
                        <h3>Digital</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div> 
            <!--  row end -->
        </div>
        <!--  container end -->
        <div class="menu text-center">
        <ul class="submenu">
    
        
            <li class="mainlink"><a href="" class="firstMenu">Pixnet</a>
                <ul class="sublink">
                    <li> <a class="sequence page-scroll" href="{{URL('popular')}}#classification">熱門文章</a> </li>
                    <li> <a class="sequence page-scroll" href="{{URL('appraise')}}#classification">評價最高</a></li>
                    <li> <a class="sequence page-scroll" href="{{URL('random')}}#classification">隨機選取</a></li>
                </ul>
            </li>
            <li class="mainlink"><a href="" class="firstMenu">Xuite</a>
                <ul class="sublink">
                    <li> <a class="sequence page-scroll" href="{{URL('popular')}}#classification">熱門文章</a> </li>
                    <li> <a class="sequence page-scroll" href="{{URL('appraise')}}#classification">評價最高</a></li>
                    <li> <a class="sequence page-scroll" href="{{URL('random')}}#classification">隨機選取</a></li>
                </ul>
            </li>
            <li class="mainlink"><a href="" class="firstMenu">Ptt</a>
                <ul class="sublink">
                    <li> <a class="sequence page-scroll" href="{{URL('popular')}}#classification">熱門文章</a> </li>
                    <li> <a class="sequence page-scroll" href="{{URL('appraise')}}#classification">評價最高</a></li>
                    <li> <a class="sequence page-scroll" href="{{URL('random')}}#classification">隨機選取</a></li>
                </ul>
            </li>
            <li class="mainlink"><a href="" class="firstMenu">Youtube</a>
                <ul class="sublink">
                    <li> <a class="sequence page-scroll" href="{{URL('popular')}}#classification">熱門文章</a> </li>
                    <li> <a class="sequence page-scroll" href="{{URL('appraise')}}#classification">評價最高</a></li>
                    <li> <a class="sequence page-scroll" href="{{URL('random')}}#classification">隨機選取</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </section>

    <section class="no-padding" id="artical">

	

        <div class="container-fluid">
            <div class="row no-gutter ">
            @foreach($pixnetdata as $data)
                <div class="col-lg-2 col-sm-3">
                    <a href="{{$data->search_href}}" class="artical-box">
                       <img class="img-responsive" src="{{$data->article_picture}}" alt="圖片未能抓取"  width="100%">
                        <div class="artical-box-caption">
                            <div class="artical-box-caption-content">
                                <div class="project-category text-faded">
                                    {{$data->search_title}}
                                </div>
                                <div class="project-name text-faded">
                                   {{$data->search_author}}
                                </div>
                                <div class="avgscore text-faded">
                                    {{round($data->total_score/$data->score_people,2)}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>



            
            @endforeach
            </div>
            <!--  Pagination -->
            <div class="paginate">
             {{$pixnetdata->fragment('classification')->links()}} 
            </div>
        </div>

    </section>


@endsection
