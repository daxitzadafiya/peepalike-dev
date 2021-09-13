<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readiwork Jobs Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="https://fonts.googleapis.com/css?family=Mali|Josefin+Sans|Bree+Serif|Abel|Anton|Quicksand|Montserrat|Raleway|Noto+Sans+HK|Noto+Sans|Oswald&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="head">
            <span class="logo">
                <img src="{{ asset('frontend/assets1/img/logo4.png') }}">
            </span>
            <h2>Jobs Portal</h2>
            @if(session()->has('u_id'))
             <a  href="/career/admin/?exp=1" class="fa fa-sign-out" style="float:right;color:black;position:absolute;top:10px;right:15px;font-size:15px;"></a>
             @endif
        </div>
       
    </header>

    
    <div class="main">
        
        @if(session()->has('u_id'))
        <br>
        <center>
            <h2>Manage Records</h2>
        <p style="font-size:13px;">Welcome to Readiwork Jobs Portal | Admin Section. Here you can Add and Remove various Jobs and Companies which are present in the Readiwork Database.</p>
    </center>
        <div class="info-edit-form" id="job-form">
            <h1>Create a Job</h1>
            <form action="/career/admin/jobs" method="POST">
    
                <input type="text" name="job_title" placeholder="Job Title" required>
                <select name="company_id" id="company_id"  required>
                    
                    @foreach($companies as $c)
                    <option value="{{ $c->company_id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                <textarea name="post_description" id="" cols="30" rows="10" placeholder="Describe the Job Post" required></textarea>
                <textarea name="post_experience" id="" cols="30" rows="10" placeholder="Experience Required and Skills preferred" required></textarea>
                <input type="number" name="max_applicants" id="" placeholder="Maximum No. of Applicants">
                <input type="number" name="stipend" id="" placeholder="Approx Stipend(optional)">
                <button>Submit</button>
                    
                
            </form>
             <div class="controls">
                <p>
                    <button onclick="goBack();">
                        <i class="fa fa-chevron-left"></i>
                    </button> Back
                </p>
            </div>

        </div>
        <div class="info-edit-form" id="company-form">
            <h1>Create a Company</h1>
            <form action="/career/admin/companies" method="POST">
                <input type="text" name="company_name" placeholder="Company Name" required>
                <input type="text" name="manager" placeholder="Person Incharge" required>
                <input type="text" name="email" placeholder="Email" >
                <input type="text" name="contact" placeholder="Contact" required>
                <input type="text" name="logo_url" placeholder="URL for Company Logo" required>
                <input type="text" name="web_link" placeholder="Company Website">
                <input type="number" name="employees" id="" placeholder="No. of Employees" required>
                <input type="text" name="country" placeholder="Country of Origin" required>
                <input type="text" name="city" placeholder="City" required>
                
                <textarea name="company_overview" id="" cols="30" rows="10" placeholder="Overview(optional)" required></textarea>

                <button>
                    Submit
                </button>
            </form>
             <div class="controls">
                <p>
                    <button onclick="goBack();">
                        <i class="fa fa-chevron-left"></i>
                    </button> Back
                </p>
            </div>

        </div>

        <hr style="background:darkgray;height:2px;">
        <div class="info-view-table">
            <h1>Jobs Record</h1>
            <br>
            <table>
                <tr class="head-row">
                    <th>S.No.</th>
                    <th>Post</th>
                    <th>Max Applicants</th>
                    <th>Added on</th>
                    <th>Action</th>
                </tr>
                @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->job_id }}</td>
                    <td><strong>{{ $job->post_title }}</strong></td>
                    <td>{{ $job->post_max_applicants }}</td>
                    <td>{{  $job->date_created }}</td>
                    <td><a href="/career/admin/jobs/?oautht={{ $job->job_id }}" class="fa fa-trash"></a></td>
                </tr>
                @endforeach
            </table>
            <hr>
            <div class="controls">
                <p><button onclick="openCard('job-form')"> <i class="fa fa-plus"></i></button> Add a Job </p>
            </div>
            <div class="overview">
                <p>There are {{ count($jobs) }} jobs in all.</p>
            </div>
        </div>
        <br>
        <hr style="width:100%;background:aliceblue">
        <div class="info-view-table">
            <h1>Companies Record</h1>
            <table>
                <tr class="head-row">
                    <th>Company ID</th>
                    <th>Name</th>
                    <th>Employees</th>
                    <th>Total Jobs Posted</th>
                    <th>Action</th>
                </tr>
                 @foreach($companies as $c)
                <tr>
                    <td>{{ $c->company_id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->employees }}</td>
                    <td>{{  $c->count_posted_jobs }}</td>
                    <td><a href="/career/admin/companies/?oautht={{ $c->company_id }}" class="fa fa-trash"></a></td>
                </tr>
                @endforeach
            </table>
            <hr>
            <div class="controls">
                <p><button onclick="openCard('company-form')"> <i class="fa fa-plus" ></i></button> Add a Company </p>

            </div>
            <div class="overview">
                <p>There are {{ count($companies) }} Companies in all.</p>
            </div>
        </div>
        @else
        <div class="login-container">
            <div class="bar">
                <h4>Login</h4>
            </div>
            <p>Login to proceed</p>
            <form action="" method="POST">

                <input type="text" name="username" id="name" placeholder="Username">

                <input type="password" name="password" id="pass" placeholder="Pasword">
                <button>
                    Login
                </button>
            </form>
        </div>
        @endif
    </div>
    <br><br>
<hr style="width:100%;background:gray;border:none;outline:none;">

<br><br>
 <div>
     <p style="font-size:12px;">Only Admins are allowed to access this section of Readiwork.</p>
 </div>

    </div>
</body>
<script>
    var form_open = "";
    var cards = {
        'company-form': false,
        'job-form': false
    };
    let openCard = (id) => {
        var block = document.querySelector("#" + id);
        console.log(block);
        document.querySelector(".main").innerHTML = '';
        block.style.display = "flex";
        document.querySelector(".main").append(block);

    }
      let goBack = () => {
        window.location.reload();
    }
</script>
<style>
    h2 {
        font-family: "Abel", sans-serif;
        font-weight: bolder;
    }
    
    h1 {
        font-family: "Quicksand", sans-serif;
    }
    
    p {
        font-family: 'Montserrat', sans-serif;
        line-height: 1.02em;
        color: gray;
        text-align: center;
    }
    
    .head {
        display: flex;
        background: rgb(255, 255, 255);
        justify-content: center;
        padding: 5px;
        
        min-height: 70px;
        position: fixed;
        box-sizing:border-box;
        top: 0;
        width: 100vw;
        z-index: 10;
        border-bottom: 1px solid lightgray;
    }
    
    .head .logo {
        width: 70px;
        height: 70px;
    }
    
    .head .logo img {
        width: 100%;
        height: 100%;
    }
    
    .main {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 120px;
        padding: auto;
        height: max-content;
    }
    
    @keyframes zoom {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1.2);
        }
    }
    @keyframes zoom2{
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }
    .login-container {
        background: #fff;
        height: 300px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        width: 300px;
        transition: all .5s ease-in-out;
        border: 1px solid lightgray;
        animation: zoom .5s ease-in-out forwards;
   
    }
    
    .login-container .bar {
        background: linear-gradient(90deg, rgb(70, 138, 226), rgb(31, 83, 226));
        z-index: 1;
        margin-bottom: 20px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        width: 100%;
        height: 50px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        padding-left: 10px;
        align-items: left;
        box-sizing: border-box;
    }
    
    .login-container .bar h4 {
        color: #fff;
        font-family: 'montserrat', sans-serif;
        font-weight: lighter;
    }
    
    .login-container form {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: flex-start;
        height: 30%;
        width: 100%;
        padding: 10px 10px;
    }
    
    form input,
    textarea,
    select {
        padding: 8px;
        width: 93%;
        margin-bottom: 6px;
        margin-left: -2.5%;
        border: 1px solid;
        outline: none;
        border-radius: 4px;
        border-color: lightgray;
        font-family: sans-serif;
    }
    
    select {
        width: 94%;
    }
    
    input::placeholder,
    textarea::placeholder {
        color: gray;
    }
    
    form input[type='submit'],form button {
        background: linear-gradient(90deg, rgb(29, 114, 226), rgb(7, 58, 199));
        color: #fff;
        width: 200px;
        padding: 10px;
        font-size: 15px;
        border-radius: 3px;
        border: none;
        margin-top: 10px;
        outline: none;
    }
    
    button:hover {
        transform: scale(1.05);
        transition: all .2s ease-in-out;
    }
    
    .info-view-table {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        /* display: none; */
        height: 100%;
    }
    
    .info-edit-form {
        width: 90%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        box-shadow: 0 0 3px 3px rgb(233, 230, 230);
        padding-bottom: 20px;
        display: none;
        margin-top: 50px;
        transition: all .3s ease-in-out;
        animation: zoom2 .3s ease-in-out forwards;
    }
    
    .info-edit-form form {
        width: 90%;
    }
    
    .info-view-table table {
        /* padding: 5px; */
        column-gap: 0;
        column-fill: balance;
        transform: scale(1.05);
    }
    
    table td,
    table th {
        text-align: center;
        padding: 7px;
        margin: 0;
        width: max-content;
        max-width:30%;
        border: none;
        column-gap: 0;
        font-family: 'Lato', sans-serif;
        line-height: 1.3rem;
    }
    
    table tr {
        width: 100%;
        background: aliceblue;
    }
    
    tr.head-row,
    th.head-row th {
        background: linear-gradient(90deg, rgb(29, 114, 226), rgb(7, 58, 199));
        font-family: "Abel", sans-serif !important;
        color: #fff;
    }
    
    table .head-row th {
        font-family: "Abel", sans-serif;
        font-size:12px;
    }
    
    .controls button {
        border: none;
        padding: 3px;
        background: linear-gradient(90deg, rgb(29, 114, 226), rgb(7, 58, 199));
        color: #fff;
        font-family: 'montserrat';
        width: 37px;
        height: 37px;
        border-radius: 100%;
    }
    @media only screen and (max-width:800px){
        .info-edit-form {
            width:99%;
            margin-top:10px;
        }
        form input,
    textarea,
    select{
        width:100%;
    }
    select{
        width:100%;
    }
    .head{
        margin-left:-10px;
    }
    header{
        margin:0;
        padding:0;
    }
    .login-container {
        margin-top:100px;
    }
    .login-container form input,.login-container form select,.login-container form textarea{
        width:92.5%;
    }
    .login-container button{
        width:93%;
    }
    table td{
        font-size:12px;
    }
    }
    .fa.fa-trash:hover{
        color:red;
    }
</style>

</html>