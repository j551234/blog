@extends('./layouts/master')

@section('content')


  
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">M.R. 中鑒者</h1>
                <hr>
                <form id="searchForm" method="get" action="result">
                <p><input type="text"  class="searchbar" name="search" placeholder="search..." value="{{$search}}"></p>
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
                <h1 class="page-header">搜尋結果:{{$search}} </h1>
                <h2><a href="http://search.ruten.com.tw/search/s000.php?enc=u&searchfrom=indexbar&k={{$search}}&t=0" target="_blank">露天拍賣</a>
                |<a href="https://tw.search.bid.yahoo.com/search/auction/product?kw={{$search}}&p={{$search}}" target="_blank">yahoo拍賣</a>
                |<a href="http://ecshweb.pchome.com.tw/search/v3.3/?q={{$search}}" target="_blank">pchome</a></h2>

                    
                
                     

               
            </div>
        </div>
                   
        <!-- /.row -->
  

        <!-- Project One -->


    @foreach($resultdata as $data)
  
       
        <div class="row">
            <div class="col-md-7">
                <a href="{{$data->search_href}}" target="_blank">
                    <img class="img-responsive" src="{{$data->article_picture}}" alt="圖片未能抓取" align>

                </a>
            </div>
            <div class="col-md-5">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
                <h5>瀏覽人次:{{$data->search_view}}</h5>
                <h5 id="scorepeople{{$data->id}}">評分人次:{{$data->scorepeople}}</h5>
                <h5 id="avgscore{{$data->id}}">平均評分:{{round($data->totalscore/$data->scorepeople,2)}}</h5>

                <p>{{$data->search_subtitle}}</p>
             
                <div class="my-rating-4" id="{{$data->id}}"></div>
                
  
                <script type="text/javascript">                      
                    $(".my-rating-4").starRating({
                        totalStars: 5,
                        emptyColor: 'lightgray',
                        hoverColor: 'salmon',
                        activeColor: 'cornflowerblue',
                        initialRating: 0,
                        strokeWidth: 0,
                        useGradient: false,
                        useFullStars: true,
                        callback: function(currentRating, $el){
                            alert('rated ' + currentRating);
                            console.log('DOM element ', $el);
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },  
                                url:"{{URL('score')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                    $('#scorepeople{{$data->id}}').text('評分人次:'+msg.scorepeople);
                                
                                    $('#avgscore{{$data->id}}').text('評分:'+msg.totalscore/msg.scorepeople,2);

                                },
                            });
                        }
                    });
                 
         
                                                  
                </script>  
                <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
               
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
