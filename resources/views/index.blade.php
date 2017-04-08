@extends('./layouts/master')

@section('content')
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">M.R. 中鑒者</h1>
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
                    <h2 class="section-heading">Find what you desire!</h2>
                    <hr class="light">
                    <h4 class="text-faded">不再被廣告所欺騙，不再讓網路垃圾訊息掩蓋住你所需要的商品資訊，我們透過大量的使用者體驗，找到最真實，最符合您的需求的商品</h4>
                    <a href="#classification" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="classification">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Classification</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <i class="fa fa-4x fa-cutlery text-primary sr-icons"></i>
                        <h3>Foods</h3>
                        <p class="text-muted">來自各國各地的美食饗宴滿足你的味蕾，擺脫你總是找不到美食的惡夢！ </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <i class="fa fa-4x fa-user text-primary sr-icons"></i>
                        <h3>Dresses</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <i class="fa fa-4x fa-plane text-primary sr-icons"></i>
                        <h3>Travel</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="classification-box">
                        <i class="fa fa-4x fa-laptop text-primary sr-icons"></i>
                        <h3>Digital</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
       @foreach($pixnetdata as $data)
        <div class="container-fluid">
            <div class="row no-gutter ">
                <div class="col-lg-4 col-sm-6">
                    <a href="{{$data->search_href}}" class="portfolio-box">
                       <img class="img-responsive" src="{{$data->article_picture}}" alt="圖片未能抓取"  width="60%">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    {{$data->search_title}}
                                </div>
                                <div class="project-name">
                                   {{$data->search_time}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
    @endforeach
      {{$pixnetdata->links()}}
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
