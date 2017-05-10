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
                    <h3 class="page-header" aling="center"> {{$search}}  未能找到結果 </h3>
                  
        </div>
                   
        <!-- /.row -->
   





@endsection
