@extends('./layouts/master')

@section('content')


  
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">M.R. 中鑒者</h1>
                <hr>
                <form id="searchForm" method="get" action="result">
                <p><input type="text"  class="searchbar" name="search" placeholder="search..."></p>
                <br>
                <input type="submit" value="Find Out" id="submitButton" class="btn btn-primary btn-xl" />
                </form>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">
    
 

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">搜尋結果

                   
        <!-- /.row -->
  

        <!-- Project One -->
    @if(count($resultdata)>0)

        @foreach($resultdata as $data)
  
       
        <div class="row">
            <div class="col-md-7">
                <a href="{{$data->search_href}}">
                    <img class="img-responsive" src="{{$data->article_picture}}" alt="圖片未能抓取" align>

                </a>
            </div>
            <div class="col-md-5">
                <h3>{{$data->search_title}}</h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:{{$data->search_author}}</h4>
                <h5>瀏覽人次:{{$data->search_view}}</h5>
                <p>{{$data->search_subtitle}}</p>
                 
                
                <a class="btn btn-primary" href="{{$data->search_href}}">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
        <!-- /.row -->
        @endforeach

    @else
        return view('index');
    @endif


        <hr>

      <!--  -->
              {{$resultdata->links()}}
        <!-- Pagination -->


        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

   @endsection
