<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Jobs;
use App\Companies;
use App\Admin;
use App\CareerAdmin;
use App\UserEvents;
use App\EventBenner;
use App\blogCategory;
use App\Blogs;
use App\BlogTags;

class FrontendController extends Controller
{
    public function index()
    {
        //  $users = DB::table('users')
        //     ->latest('id')->get();

        $events = UserEvents::where('event_start_date', '>=', date('Y-m-d'))->get();
        $categories = DB::table('service_category')->get();
        $BlogList = Blogs::where('status','active')->orderBy('id','desc')->get();
            
        // $address = DB::table('user_address')->get();
       
        //return view('frontend.index', get_defined_vars());
        return view('eventfrontend.index', get_defined_vars());
    }
    public function events()
    {
        //  $users = DB::table('users')
        //     ->latest('id')->get();
            
        // $address = DB::table('user_address')->get();

        $perPage = 9;
        $events = UserEvents::where('event_start_date', '>=', date('Y-m-d'))->paginate($perPage);
        // $events = UserEvents::paginate($perPage);
        $totalPages = ceil(count(UserEvents::where('event_start_date', '>=', date('Y-m-d'))->get()) / $perPage);
        return view('eventfrontend.event_list', get_defined_vars());
    }
    public function jobsList(Request $request){
        $jobs = Jobs::all();
        $companies = Companies::all();
        $data=[];
        $matched=[];
        $results=[];
          if($request->country && $request->json){
               $ctry = $request->country;
              foreach($companies as $company){
                $results=explode(",",$company->location);
                if(strpos(strtoupper($company->location),strtoupper($ctry))!==false ||strpos(strtoupper($results[0]),strtoupper($ctry))!==false || strpos(strtoupper($results[1]),strtoupper($ctry))!==false){
                    array_push($matched,$company);
                }
            }
            return json_encode($matched);
          }
        if($request->job_title && $request->json){
               $ctry = $request->job_title;
              foreach($jobs as $job){
                // $results=explode(",",$company->location);
                if(strpos(strtoupper($job->post_title),strtoupper($request->job_title))!==false){
                    array_push($matched,$job);
                }
            }
            return json_encode($matched);
          }
        if($request->country && $request->job_title){
            $ctry = $request->country;
            $job_title = $request->job_title;
            foreach($companies as $company){
                $results=explode(",",$company->location);
                if(strpos(strtoupper($company->location),strtoupper($ctry))!==false ||strpos(strtoupper($results[0]),strtoupper($ctry))!==false || strpos(strtoupper($results[1]),strtoupper($ctry))!==false){
                    array_push($matched,$company);
                }
            }
            foreach($jobs as  $job){
                if(strpos(strtoupper($job->post_title),strtoupper($job_title))!==false || strpos(strtoupper($job->post_title),strtoupper($job_title))!==false){
                    foreach($matched as $company){
                        if($job->company_id==$company->company_id){
                            $temp=[];
                            array_push($temp,$job);
                            array_push($temp,$company);
                              array_push($data,$temp);
                             break;
                        }
                    }
              }
            
        }
        if(!count($data)){
            array_push($results,"No Jobs Found!");
        }else{
            array_push($results,strval(count($data))." jobs found");
        }
        return view('frontend.jobs-list',get_defined_vars());
        }
        foreach($jobs as  $job){
            foreach($companies as $company){
                if(($company->company_id)==$job->company_id){
                 $temp=[];
                 array_push($temp,$job);
                 array_push($temp,$company);
                 array_push($data,$temp);
                 break;
                }
            }
        }
      
        return view('frontend.jobs-list',get_defined_vars());
    }
    public function jobsView(Request $request){
        if($request->job_id){
            $job = Jobs::where("job_id",$request->job_id)->get();
            $company = Companies::where("company_id",$job[0]['company_id'])->get();
            return view('frontend.job-view',get_defined_vars());
        }
    }
    public function aboutUs()
    {
        
        return view('frontend.about-us');
    }

    public function help()
    {
        return view('frontend.help');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function termsAndConditions()
    {
        //return view('frontend.terms-and-conditions');
        return view('eventfrontend.terms-and-conditions');
    }

    public function trustSafety()
    {
        return view('frontend.trust-safety');
    }

    public function userSignUp()
    {
        return view('frontend.sign-up-user');
    }

    public function providerSignUp()
    {
        return view('frontend.sign-up-provider');
    }

    public function signIn()
    {
        return view('frontend.sign-in');
    }

    public function providerLogin()
    {
        return view('frontend.login-provider');
    }

    public function userLogin()
    {
        return view('frontend.login-user');
    }

    public function eventUserLogin()
    {
        return view('eventusers.login-eventuser');
    }

    public function legal()
    {
        return view('frontend.legal');
    }

    public function howItWorks()
    {
        return view('frontend.how-it-works');
    }

    public function privacy()
    {
        //return view('frontend.privacy-policy');
        return view('eventfrontend.privacypolicy');
    }
    
    // Career Controllers - List Jobs/Modify Jobs
    
    
    public function careerManager(Request $request){
            // list jobs and companies on admin page
            if($request->isMethod('get')){
                if($request->exp){
                    $request->session()->forget('u_id');
                    return redirect("/career/admin");
                }
                if($request->session()->get('u_id')){
                                $jobs = Jobs::all();
                $companies = Companies::all();
                return view('frontend.career-admin',get_defined_vars());
                }else{
                    return view('frontend.career-admin');
                }
   
            }
            if($request->isMethod('post')){
                
                $obj = CareerAdmin::where("username",$request->username)->get();
                $exists = count($obj)?true:false;
                if($exists){
                    $obj=$obj[0];
                    if(($request->username == $obj['username']) && ($request->password==$obj['pass'])){
                        $request->session()->put('u_id',$obj->user_id);
                        return redirect("/career/admin");
                    }else{
                        return "Incorrect Username/Password";
                    }
                }else{
                    return "User not Found!";
                }
    }
    }
    public function modifyJobs(Request $request){
        
                    if($request->isMethod("get")){
                        if($request->oautht){
                            // return $request->oatht;
                        $obj_del = Jobs::where("job_id",$request->oautht)->delete();
                        return redirect("/career/admin");
                        }
                    }
                    $obj_job = new Jobs;
                    $obj_job->company_id = $request->company_id;
                    $obj_job->post_title = $request->job_title;
                    $obj_job->post_description = $request->post_description;
                    $obj_job->post_experience = $request->post_experience;
                    $obj_job->post_max_applicants = $request->max_applicants;
                    $obj_job->stipend = $request->stipend;
                    $obj_job->save();
                    $c = Companies::where("company_id",$request->company_id)->get();
                    $total_jobs = $c[0]['count_posted_jobs']+1;
                    $ca=Companies::where("company_id",$request->company_id)->update(array("count_posted_jobs"=>$total_jobs));
                
                    return redirect("/career/admin");
                    
                
    }
    public function modifyCompanies(Request $request){
        
                    if($request->isMethod("get")){
                        if($request->oautht){
                            // return $request->oatht;
                        $obj_del = Companies::where("company_id",$request->oautht)->delete();
                        return redirect("/career/admin");
                        }
                    }
                    $city = $request->city;
                    $country=$request->country;
                    $location = $city.", ".$country;
                    $obj_job = new Companies;
                    $obj_job->name = $request->company_name;
                    $obj_job->logo_url = $request->logo_url;
                    $obj_job->web_link = $request->web_link;
                    $obj_job->employees = $request->employees;
                    $obj_job->location = $location;
                    $obj_job->contact = $request->contact;
                    $obj_job->email = $request->email;
                    $obj_job->manager = $request->manager;
                    $obj_job->meta = $request->company_overview;
                    $obj_job->save();
                    return redirect("/career/admin");
                    
                
    }

    public function eventDetails(Request $request, $eventId){
        $event = UserEvents::find($eventId);
        $banners = EventBenner::where('event_id', $event->id)->get();
        return view('eventfrontend.event-details', get_defined_vars());
    }

    public function about(){
        return view('eventfrontend.about');
    }

    public function blogs(){
        $perPage = 6;
        $BlogList = Blogs::where('status','active')->orderBy('id','desc')->paginate($perPage);
        $Category = blogCategory::where('is_active','active')->orderBy('id','desc')->limit(5)->get();
        $Tags = BlogTags::where('status','active')->orderBy('id','desc')->limit(10)->get();
        $totalPages = ceil(count(Blogs::where('created_at', '>=', date('Y-m-d'))->get()) / $perPage);
        return view('eventfrontend.blogs', get_defined_vars());
    }

    public function blogsDetails(Request $request, $id)
    {
        $BlogList = Blogs::where('id',$id)->get();
        $Category = blogCategory::select('blog_categories.*')->join('blogs','blogs.category_type','=','blog_categories.category_name')->count();
        return view('eventfrontend.blog-details', get_defined_vars());
    }
    public function faqPage(){
        return view('eventfrontend.faq');
    }

    public function contact(){
        return view('eventfrontend.contact');
    }

}