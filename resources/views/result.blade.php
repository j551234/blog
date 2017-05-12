@extends('./layouts/master')

@section('content')




<!-- //                                 |~~~~~~~|
//                                 |       |
//                                 |       |
//                                 |       |
//                                 |       |
//                                 |       |
//      |~.\\\_\~~~~~~~~~~~~~~xx~~~         ~~~~~~~~~~~~~~~~~~~~~/_//;~|
//      |  \  o \_         ,XXXXX),                         _..-~ o /  |
//      |    ~~\  ~-.     XXXXX`)))),                 _.--~~   .-~~~   |
//       ~~~~~~~`\   ~\~~~XXX' _/ ';))     |~~~~~~..-~     _.-~ ~~~~~~~
//                `\   ~~--`_\~\, ;;;\)__.---.~~~      _.-~
//                  ~-.       `:;;/;; \          _..-~~
//                     ~-._      `''        /-~-~
//                         `\              /  /
//                           |         ,   | |
//                            |  '        /  |
//                             \/;          |
//                              ;;          |
//                              `;   .       |
//                              |~~~-----.....|
//                             | \             \
//                            | /\~~--...__    |
//                            (|  `\       __-\|
//                            ||    \_   /~    |
//                            |)     \~-'      |
//                             |      | \      '
//                             |      |  \    :
//                              \     |  |    |
//                               |    )  (    )
//                                \  /;  /\  |
//                                |    |/   |
//                                |    |   |
//                                 \  .'  ||
//                                 |  |  | |
//                                 (  | |  |
//                                 |   \ \ |
//                                 || o `.)|
//                                 |`\\\\) |
//                                 |       |
//                                 |       |
//    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                      耶穌保佑                永無 BUG
 -->










  
    <header-result>
        <div class="header-content">
         

       
                <form id="searchForm" method="get" action="result">

                
                <div class="search">
                    <input type="text"  class="searchbar" name="search" placeholder="search..." value="{{$search}}">
                    
                        <div class="searchtype">
                        <input type="radio" name="searchtype" value="author" id="a" /><label for="a">作者</label>
                        <input type="radio" name="searchtype" value="title" id="t" /><label for="t">標題</label>
                        </div>
                        <div class="searchweb">
                        <input type="checkbox" name="searchweb[]" value="rpixnet" id="p"><label for="p">Pixnet</label>
                        <input type="checkbox" name="searchweb[]" value="rxuite" id="x"><label for="x">Xuite</label>
                        <input type="checkbox" name="searchweb[]" value="rptt" id="pt"><label for="pt">Ptt</label>
                        <input type="checkbox" name="searchweb[]" value="ryoutube" id="y"><label for="y">Youtube</label>
                        <input type="checkbox" name="searchweb[]" value="rmobile01" id="m"><label for="m">Mobile01</label>
                        </div>
                        <div class="subbotton">
                         <input type="submit" value="Find Out" id="submitButton" class="btn btn-primary btn-xl" /> 
                        </div>
                </div>
                </form>


                
        </div>
    </header-result>

    <!-- Page Content -->
    
    <div class="container"> 


 
    <div class="result-contain">
        
    
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">搜尋結果: {{$search}}                 
                    <ul>
                        <li> <a href="http://search.ruten.com.tw/search/s000.php?enc=u&searchfrom=indexbar&k={{$search}}&t=0" target="_blank">露天拍賣</a> </li>
                        <li> <a href="https://tw.search.bid.yahoo.com/search/auction/product?kw={{$search}}&p={{$search}}" target="_blank">yahoo拍賣</a> </li>
                        <li> <a href="http://ecshweb.pchome.com.tw/search/v3.3/?q={{$search}}" target="_blank">pchome</a> </li>
                    </ul>
                    <a class="btn btn-default analysis">請稍後...</a>
                </h4>
                <script type="text/javascript">                      

                setTimeout(()=>{
                    let el=document.querySelector('.analysis')
                    el.innerHTML="點擊分析"
                    el.style.backgroundColor="#F05F40"
                    el.style.color="#fff"
                    el.onclick=()=>window.location.reload()
                },3000)
     
                </script> 
            </div>
            <div class="menu text-right">
                <ul class="submenu">
                    <li class="mainlink"><a href='' class="firstMenu">排序</a>
                        <ul class="sublink">
                            <li> <a class="sequence page-scroll" href='{{URL("popular?search=$search&searchtype=$searchtype&searchweb=$searchweb")}}'>熱門文章</a> </li>
                                <li> <a class="sequence page-scroll" href='{{URL("appraise?search=$search&searchtype=$searchtype&searchweb=$searchweb")}}'>評價最高</a></li>
                            <li> <a class="sequence page-scroll" href='{{URL("random?search=$search&searchtype=$searchtype&searchweb=$searchweb")}}'>隨機選取</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
        </div>

                   
        <!-- /.row -->
  

    @foreach($pixnetdata as $data)
        <!-- Pixnet -->
       
        <div class="row">
            <div class="col-md-7 ">
                <a href="{{$data->search_href}}" target="_blank">
             
                 <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" onerror="this.src='./img/nodoge.jpg'">

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
                <div class="percentBall1">
                    <div class="percentBall" data-percent="{{$data->content_analyst}}" id="{{$data->id}}"></div>
                </div>
                <div class="percentBall2">
                    <div class="percentBall" data-percent="{{$data->title_analyst}}" id="{{$data->id}}"></div>
                </div>
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
                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" onerror="this.src='./img/nodoge.jpg'">

                </a>
            </div>
            <div class="col-md-5 detail">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
               
               
                <h5 id="xuitescore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                 <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
             
                 <div class="my-rating-4" id="{{$data->id}}">
                 <div class="percentBall1">
                    <div class="ballTitle text-muted">內文分析</div>                    
                    <div class="percentBall" data-percent="{{$data->content_analyst}}" id="{{$data->id}}"></div>
                </div>
                <div class="percentBall2">
                    <div class="ballTitle text-muted">標題分析</div>
                    <div class="percentBall" data-percent="{{$data->title_analyst}}" id="{{$data->id}}"></div>
                </div>
                </div>
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
                    <img class="img-result" src="./img/ptt.jpg" width="50%">

                </a>
            </div>
            <div class="col-md-5 detail">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
                <h4>推:{{$data->push_count}}</h4>
                <h4>噓:{{$data->boo_count}}</h4>
                <h4>評論:{{$data->push_count+$data->arrow_count+$data->boo_count}}</h4>
                <h4 id="pttscore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h4>
                <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
               

              
             
                <div class="my-rating-4" id="{{$data->id}}">  </div>
                <div class="percentBall1">
                    <div class="percentBall" data-percent="{{$data->content_analyst}}" id="{{$data->id}}"></div>
                </div>
                <div class="percentBall2">
                    <div class="percentBall" data-percent="{{$data->title_analyst}}" id="{{$data->id}}"></div>
                </div>
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
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
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

                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" onerror="this.src='./img/nodoge.jpg'">

                </a>
               
            </div>
            <div class="col-md-5 detail">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:<a href="{{$data->author_href}}" target="_blank">{{$data->search_author}}</a></h4>
                <h4>喜歡:{{$data->push_count}}</h4>
                <h4>討厭:{{$data->boo_count}}</h4>

               
               
               
                <h5 id="youtubescore{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                   <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
                
             
               
             
                <div class="my-rating-4" id="{{$data->id}}"></div>
         <!--        <div class="percentBall1">
                    <div class="percentBall" data-percent="{{$data->content_analyst}}" id="{{$data->id}}"></div>
                </div>
                <div class="percentBall2">
                    <div class="percentBall" data-percent="{{$data->title_analyst}}" id="{{$data->id}}"></div>
                </div> -->
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
                                url:"{{URL('youtubescore')}}",
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
        <!--mobile01bedata-->
        @foreach($mobile01data as $data)
  
       
        <div class="row">
            <div class="col-md-7">
               <a href="{{$data->search_href}}" target="_blank">

                    <img class="img-result" src="{{$data->article_picture}}" alt="圖片未能抓取" onerror="this.src='./img/nodoge.jpg'">

                </a>
               
            </div>
            <div class="col-md-5 detail">
                <h3><a href="{{$data->search_href}}" target="_blank">{{$data->search_title}}</a></h3>
                <h4>{{$data->search_time}}</h4>
                <h4>作者:{{$data->search_author}}</h4>  
                <h5 id="mobile01score{{$data->id}}">網站評分:{{round($data->total_score/$data->score_people,2)}}</h5>
                <div class="subtitle">
                <p class="JQellipsis">{{$data->search_subtitle}}</p>
                </div>
                   <a class="btn btn-primary" href="{{$data->search_href}}" target="_blank">查看更多 <span class="glyphicon glyphicon-chevron-right"></span></a>
                
             
               
             
                <div class="my-rating-4" id="{{$data->id}}"></div>
                <div class="percentBall1">
                    <div class="percentBall" data-percent="{{$data->content_analyst}}" id="{{$data->id}}"></div>
                </div>
                <div class="percentBall2">
                    <div class="percentBall" data-percent="{{$data->title_analyst}}" id="{{$data->id}}"></div>
                </div>
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
                                url:"{{URL('mobile01score')}}",
                                data:{    currentRating:currentRating,id: {{$data->id}}   },
                                type: "POST",
                                success: function(msg){
                                    msg = JSON.parse(msg);
                                    console.log(msg)
                                   
                                
                                  
                                    $('#mobile01score{{$data->id}}').text('評分:'+msg.total_score/msg.score_people);

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

            {{$whoIsTheBestDog->links()}}
          


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
    <script type="text/javascript">
            let search=window.location.search.match(/search=[^&]+/)
            let searchtype=window.location.search.match(/searchtype=[^&]+/)
            let searchweb=window.location.search.match(/searchweb=[^&]+/)

           
            Array.from(document.querySelectorAll(".pagination a")).forEach(a=>{                   
                    if(search)
                        a.href += "&"+search[0];
                    if(searchtype)
                        a.href += "&"+searchtype[0];
                    if(searchweb)
                        a.href += "&"+searchweb[0];
            })

            const makePie = (where, percent) => {
               let foregroundColor
               let fontcolor
               let backgroundColor
               console.log(percent)
               if (percent >= 75) {
                   foregroundColor = "red"
                   fontcolor = "red"
               } else if (percent >= 50) {
                   foregroundColor = "orange"
                   fontcolor = "orange"
               } else if (percent <50 && percent > 0) {
                   foregroundColor = "green"
                   fontcolor = "green"
               } else if (percent == 0) {
                   backgroundColor = "#404040"
                   fontcolor = "red"
               }
               else {
                   percent = null
                   fontcolor = "rgba(255,255,255,0)"
               }


               $(where).circliful({
                   animation: 1,
                   animationStep: 5,
                   foregroundColor: foregroundColor,
                   backgroundColor: backgroundColor,
                   foregroundBorderWidth: 15,
                   backgroundBorderWidth: 15,
                   textSize: 28,
                   textStyle: 'font-size: 12px;',
                   textColor: '#666',
                   fontColor: fontcolor,
                   percent: percent,
                   multiPercentage: 1,
                   percentages: [10, 20, 30]
               });
           }

           $(document).ready(function() {
            Array.from(document.querySelectorAll(".percentBall")).forEach((el)=>{
                makePie(el,el.dataset.percent)
            })

           });
        </script>
        
        

        
   @endsection
        