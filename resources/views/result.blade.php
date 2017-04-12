@extends('./layouts/master')

@section('content')



  
    <header-result>
        <div class="header-content">
         

       
                <form id="searchForm" method="get" action="result">
                <input type="text"  class="searchbar" name="search" placeholder="search..." value="{{$search}}">
                
                <input type="submit" value="Find Out" id="submitButton" class="btn btn-primary btn-xl" />
                </form>
       
        </div>
    </header-result>

    <!-- Page Content -->
    <div class="container">
    
 

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">搜尋結果:{{$search}} </h2>
                   <h3> <a href=""  onclick="sort(id)">以人氣排名</a>|<a href="">以日期排名</a></h3>
                    
                     

               
            </div>
        </div>
                   
        <!-- /.row -->
  

        <!-- Project One -->


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
                <button type="button">覺得有用</button><button type="button">覺得無趣</button>
            </div>
        </div>
        <!-- /.row -->
        @endforeach
            
  


     

      <!--  -->
          
        <!-- Pagination -->
    {{$resultdata->links()}}

     

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
