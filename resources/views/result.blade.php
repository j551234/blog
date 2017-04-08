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
    
  @if(count($resultdata)>0)

       @foreach($resultdata as $data)

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">搜尋結果
                    <small><font color="blue">{{$search}}</font></small>
                    </h1>
                     <a href="{{$data->link}}">
                    <img class="img-responsive" src="{{$data->article_pic}}" alt="圖片未能抓取" align>

                </a>
                   
                    
                </h1>

            </div>
        </div>
        <!-- /.row -->
  

        <!-- Project One -->
  
       
        <div class="row">
            <div class="col-md-7">
                <a href="{{$data->link}}">
                    <img class="img-responsive" src="{{$data->article_pic}}" alt="圖片未能抓取" align>

                </a>
            </div>
            <div class="col-md-5">
                <h3>{{$data->title}}</h3>
                <h4>{{$data->date}}</h4>
                <p>{{$data->S_title}}</p>
                <a class="btn btn-primary" href="{{$data->link}}">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
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
