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


 
    <div class="result-contain">
        
    
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                    <h4 class="page-header">搜尋結果: {{$search}} </h4>
            </div>
        </div>
                   
        <!-- /.row -->
  

    

    @foreach($pixnetdata as $data)
        <!-- Pixnet -->
       
        <div class="row">
            <div class="col-md-7">
                <a href="{{$data->search_href}}" target="_blank">
                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" align>

                </a>
            </div>
            <div class="col-md-5">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
                <h5>瀏覽人次:{{$data->search_view}}</h5>
                
                <h5 id="pixnetscore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                   <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
               
            
                <div class="my-rating-4" id="{{$data->id}}"> </div>
                
  
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
                                url:"{{URL('pixnetscore')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                  
                                
                                  
                                    $('#pixnetscore{{$data->id}}').text('評分:'+msg.total_score/msg.score_people);

                                },
                            });
                        }
                    });
                 
         
                                                  
                </script>  
             
            </div>
        </div>
        <!-- /.row -->
        <hr class="result">
        @endforeach
        
        <!--xuitedata-->
       
        @foreach($xuitedata as $data)
  
       
        <div class="row">
            <div class="col-md-7">
                <a href="{{$data->search_href}}" target="_blank">
                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" align>

                </a>
            </div>
            <div class="col-md-5">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
               
               
                <h5 id="xuitescore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                 <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
             
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
                                url:"{{URL('xuitescore')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                                                 
                                   $('#xuitescore{{$data->id}}').text('評分:'+msg.total_score/msg.score_people);

                                },
                            });
                        }
                    });
                 
         
                                                  
                    </script>   
            </div>
        </div>
        <!-- /.row-->
        <hr class="result">
        @endforeach

        <!--pttdata-->
      
        @foreach($pttdata as $data)
  
       
        <div class="row">
            <div class="col-md-7">
                 <a href="{{$data->search_href}}" target="_blank">
                    <img class="img-result" src="https://lh4.ggpht.com/XsAo-Kbh6o4Hm5s5c4zz3YaErInIWdD-7CR1zjEWp0v-kR76xW1kAk5A4RiKc_wNAlU=w300" alt="圖片未能抓取" width="50%">

                </a>
            </div>
            <div class="col-md-5">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
                <h4>推:{{$data->push_count}}</h4>
                <h4>噓:{{$data->boo_count}}</h4>
                <h4>箭頭:{{$data->arrow_count}}</h4>
                <h5 id="pttscore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
               

              
             
                <div class="my-rating-4" id="{{$data->id}}">  </div>
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
                                url:"{{URL('pttscore')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                
                                  
                                    $('#pttscore{{$data->id}}').text('評分:'+msg.total_score/msg.score_people);

                                },
                            });
                        }
                    });
                 
         
                                                  
                    </script>  
             
            </div>
                
        </div>
        <!-- /.row -->
        <hr class="result">
        @endforeach
        <!--youtubedata-->
        @foreach($youtubedata as $data)
  
       
        <div class="row">
            <div class="col-md-7">
               <a href="{{$data->search_href}}" target="_blank">

                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" align>

                </a>
               
            </div>
            <div class="col-md-5">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:{{$data->search_author}}</h4>
                <h4>喜歡:{{$data->push_count}}</h4>
                <h4>討厭:{{$data->boo_count}}</h4>

               
               
               
                <h5 id="youtubescore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                   <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
                
             
               
             
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
                                url:"{{URL('pttscore')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                   
                                
                                  
                                    $('#youtubescore{{$data->id}}').text('評分:'+msg.total_score/msg.score_people);

                                },
                            });
                        }
                    });
                 
         
                                                  
                    </script>  
             
   
            </div>
        </div>
        <!-- /.row -->
        <hr class="result">

        @endforeach










  


     


          
        <!-- Pagination -->
        <div class="paginate">

            {{$pixnetdata->links()}}
          


        </div>

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
    <!-- /.result-contain -->

    </div>
    <!-- /.container -->
   @endsection
