@extends('frontend.layout1.app')

@section('content')
    <link
      href="{{ asset('frontend/assets1/vendor/bootstrap/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
    <link href="{{ asset('frontend/assets1/vendor/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/icofont/icofont.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/venobox/venobox.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/owl.carousel/assets/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets1/vendor/aos/aos.css') }}" rel="stylesheet" />
    <!--App Carousel-->
    <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets1/app-carousel/assets/vendor/aos/aos.css') }}" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/assets1/app-carousel/assets/css/style.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#1e4356"/>
    
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-cntent-center align-items-center">
      <div
        id="heroCarousel"
        class="container carousel carousel-fade"
        data-ride="carousel">
        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">
              Welcome to <span>Readiwork Jobs</span>
            </h2>
            <p class="animate__animated animate__fadeInUp">
              Get your Dream Job Today
            </p>
            <p>
           Search over a large collection of jobs from 1000+ companies
            </p>
          
          </div>
          <form action="" method="GET" style="display: flex;flex-direction: column;width: 100%;justify-content: center;align-items: center;">
           <div>
                   <input id="country_name" type="text" name="country" placeholder="Country" style="width: 300px;margin-bottom:10px;border-radius: 10px;outline: none;border: none;background: transparent;border: 1px solid lightgray;padding: 7px;color: #fff;">
                    <ul id="country_list" style="border-radius:5px;display:none;background: #fff;list-style: none;padding: 5px;font-size: 12px;color: #000;">
                       
                    </ul>
              </div>
                 <div>
                   
              <input id="job_title" type="text" name="job_title" placeholder="Job Position" style="width: 300px;border-radius: 10px;outline: none;border: none;background: transparent;border: 1px solid lightgray;padding: 7px;color: #fff;">
                    <ul id="jobs_list" style="border-radius:5px;display:none;background: #fff;list-style: none;padding: 5px;font-size: 12px;color: #000;">
                     
                    </ul>
              </div>
              
              <button id='search-submit' style="border-radius:10px !important;background-color:transparent !important;width:100px;box-shadow:none !important;color:#fff;border-color:#b3d4ec  !important;outline:none !important;margin-top:5px;padding:7px;">Search</button>
          </form>
        </div>
</section>
<script>
var items1=[];
    var items2=[];
    document.querySelector("#country_name").onkeyup=()=>{
        var val = document.querySelector("#country_name").value;
         var items=[];
           
        var searchlist=document.querySelector("#country_list");
          
            if(val==""){
                searchlist.style.display='none';
                return;
                
            }
        $.get("?country="+val+"&json=1", function(data, status){
            searchlist.style.display="block";
            var obj = JSON.parse(data);
            for(var item in obj){
                if(items2.indexOf(obj[item]['location'])==-1){
                     var li = document.createElement("LI");
            var i = document.createElement("i");
            // i.className="fa fa-map-marker";
            li.append(i);
          
            li.innerHTML ="<i class='fa fa-map-marker'></i> " + obj[item]['location'];
            li.addEventListener("click",()=>{
                 document.querySelector("#country_name").value=obj[item]["location"];
                 searchlist.style.display='none';
            });
            searchlist.append(li);
            
            items2.push(obj[item]['location']);
                }
           
            }
          
  });
        if(val==""){
                searchlist.style.display='none';
            }
  
    }
  
    document.querySelector("#job_title").onkeyup=()=>{
        var val = document.querySelector("#job_title").value;
         
        var searchlist=document.querySelector("#jobs_list");
    if(val==""){
                searchlist.style.display='none';
        return;    
        
    }
        $.get("?job_title="+val+"&json=1", function(data, status){
            searchlist.style.display="block";
            var obj = JSON.parse(data);
            for(var item in obj){
                console.log(obj[item]);
                console.log(item);
                if(items1.indexOf(obj[item]['post_title'])==-1){
                     var li = document.createElement("LI");
            var i = document.createElement("i");
            // i.className="fa fa-map-marker";
            li.append(i);
           
            li.innerHTML ="<i class='fa fa-user'></i> " + obj[item]['post_title'];
            li.addEventListener("click",()=>{
                 document.querySelector("#job_title").value=obj[item]["post_title"];
                 searchlist.style.display='none';
            });
            searchlist.append(li);
            items1.push(obj[item]['post_title']);
                }
           
            }
            
            
  });
  
        
    }
</script>
   <!--List-->
   <br>
      <center>
   @if(count($results))
   <h1 style="font-family:'montserrat',sans-serif;text-align:center;">Jobs in {{ $results[0] }}, {{ $results[1] }} </h1><br>
   @else
   <h1 style="font-family:'montserrat',sans-serif;text-align:center;">Look for Jobs</h1><br>
   @endif
   @if(count($results)>1)
   <p>{{ $results[2] }}</p>
   @endif
   
   </center>
   <div class="cards-container">
       @foreach($data as $item)
        <div class="card">
            
            <img src="{{ $item[1]->logo_url }}" alt="" srcset="">
            <h3>{{ $item[1]->name }}</h3>
            <p>{{ $item[0]->post_title }}</p>
            <span><i class="fa fa-calendar"></i> {{ $item[0]->date_created }}</span>
              <span><i class="fa fa-users"></i> {{ $item[0]->post_applicants_applied }}</span>
            <a href="/career/jobs/view/?job_id={{ $item[0]->job_id }}">Apply now</a>
        </div>
      
      @endforeach
    </div>
   <!--List Ends-->
        

        <!--<a-->
        <!--  class="carousel-control-prev"-->
        <!--  href="#heroCarousel"-->
        <!--  role="button"-->
        <!--  data-slide="prev"-->
        <!-->-->
          <!--<span-->
          <!--  class="carousel-control-prev-icon bx bx-chevron-left"-->
          <!--  aria-hidden="true"-->
          <!--></span>-->
        <!--  <span class="sr-only">Previous</span>-->
        <!--</a>-->

        <!--<a-->
        <!--  class="carousel-control-next"-->
        <!--  href="#heroCarousel"-->
        <!--  role="button"-->
        <!--  data-slide="next"-->
        <!-->-->
        <!--  <span-->
        <!--    class="carousel-control-next-icon bx bx-chevron-right"-->
        <!--    aria-hidden="true"-->
        <!--  ></span>-->
        <!--  <span class="sr-only">Next</span>-->
        <!--</a>-->
      </div>
  
    <!-- End Hero -->
<style>
    * {
        margin: 0;
    }
    
    .cards-container {
        
        display: grid;
        grid-template-columns: 20fr 20fr 20fr 20fr 20fr;
        width: 95%;
        margin-left: 2.5%;
        align-items: center;
        align-content: center;
        grid-column-gap: 10px;
        grid-row-gap: 10px;
        padding-top: 10px;
        padding-bottom: 50px;
    }
    
    .cards-container .card {
        position: relative;
        background: #fff;
        width: 100% !important;
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
        height: max-content;
        min-height:400px !important;
        align-items: center;
        /*justify-items: space-evenly;*/
        /* height: 500px; */
        box-sizing: border-box;
        box-shadow: 0 0 2px 2px lightgray;
    }
    #job_title::placeholder,#country_name::placeholder{
        color:#fff;
    }
    .cards-container .card img {
        width: 100%;
        height: auto;
        max-height: 200px;l
        border-bottom: 1px solid lightgray;
    }
    
    .card h3 {
        font-family: "Montserrat", sans-serif;
        line-height: 3rem;
    }
    
    .card p {
        font-family: "Lato", sans-serif;
        font-weight: lighter;
        /* line-height: 0.8rem; */
    }
    
    .card span {
        line-height: 1.2rem;
        font-size: 11px;
        font-family: "montserrat", sans-serif;
    }
    
    .card a {
        border: none;
        outline: none;
        background: #1e4356;
        color: #fff;
        width: 100%;
        text-align:center;
        font-family: "Quicksand", sans-serif;
        padding: 10px;
        position: absolute;
        bottom: 0;
    }
    
    .card a:hover {
        background: rgb(8, 23, 165) !important;
        color:#fff;
        cursor:pointer;
    }
    #search-submit:hover{
        background:#fff !important;
    }
    @media only screen and (max-width:800px) {
        .cards-container {
            grid-template-columns: 80fr;
        }
    }
</style>

@endsection