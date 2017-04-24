@extends('./layouts/master')

@section('content')



  
    <header-result>
        <div class="header-content">
         

       
                <form id="searchForm" method="get" action="result">
                <input type="text"  class="searchbar" name="search" placeholder="search..." value="{{$search}}">
                
                <input type="submit" value="Find Out" id="submitButton" class="btn btn-primary btn-xl" />
                <ul>
                <li> <a href="http://search.ruten.com.tw/search/s000.php?enc=u&searchfrom=indexbar&k={{$search}}&t=0" target="_blank">露天拍賣</a> </li>
                <li> <a href="https://tw.search.bid.yahoo.com/search/auction/product?kw={{$search}}&p={{$search}}" target="_blank">yahoo拍賣</a> </li>
                <li> <a href="http://ecshweb.pchome.com.tw/search/v3.3/?q={{$search}}" target="_blank">pchome</a> </li>
                </ul>
                </form>
                
        </div>
    </header-result>

    <!-- Page Content -->
    <div class="container">
    
 

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                    <h3 class="page-header">搜尋結果:{{$search}} </h3>
            </div>
        </div>
                   
        <!-- /.row -->
  

        <!-- Project One -->


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
                <h5 id="score_people{{$data->id}}">評分人次:{{$data->score_people}}</h5>
                <h5 id="avg_score{{$data->id}}">平均評分:{{round($data->total_score/$data->score_people,2)}}</h5>

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
                                    $('#score_people{{$data->id}}').text('評分人次:'+msg.score_people);
                                
                                    $('#avg_score{{$data->id}}').text('評分:'+msg.total_score/msg.score_people,2);

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
