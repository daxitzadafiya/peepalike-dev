@extends('eventusers.layout.app')
@section('style')
  <link rel="stylesheet" href="{{ asset('eventadmin/summernote/dist/summernote.css') }}">
  <style>
      #frame {
        width: 100%;
        min-width: 100%;
        max-width: 100%;
        height: 92vh;
        min-height: 400px;
        max-height: 720px;
        background: #E6EAEA;
      }
      #frame .content {
        float: right;
        width: 60%;
        height: 100%;
        overflow: hidden;
        position: relative;
      }
      #frame .content {
        float: right;
        width: 60%;
        height: 100%;
        overflow: hidden;
        position: relative;
      }
      @media screen and (max-width: 735px) {
        #frame .content {
          width: 100%;
          min-width: 300px !important;
        }
      }
      @media screen and (min-width: 900px) {
        #frame .content {
          width: 100%;
        }
      }
      #frame .content .contact-profile {
        width: 100%;
        height: 60px;
        line-height: 60px;
        background: #f5f5f5;
      }
      #frame .content .contact-profile img {
        width: 40px;
        border-radius: 50%;
        float: left;
        margin: 9px 12px 0 9px;
      }
      #frame .content .contact-profile p {
        float: left;
      }
      #frame .content .contact-profile .social-media {
        float: right;
      }
      #frame .content .contact-profile .social-media i {
        margin-left: 14px;
        cursor: pointer;
      }
      #frame .content .contact-profile .social-media i:nth-last-child(1) {
        margin-right: 20px;
      }
      #frame .content .contact-profile .social-media i:hover {
        color: #435f7a;
      }
      #frame .content .messages {
        height: auto;
        min-height: calc(100% - 93px);
        max-height: calc(100% - 93px);
        overflow-y: scroll;
        overflow-x: hidden;
      }
      @media screen and (max-width: 735px) {
        #frame .content .messages {
          max-height: calc(100% - 105px);
        }
      }
      #frame .content .messages::-webkit-scrollbar {
        width: 8px;
        background: transparent;
      }
      #frame .content .messages::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
      }
      #frame .content .messages ul li {
        display: inline-block;
        clear: both;
        float: left;
        margin: 15px 15px 5px 15px;
        width: calc(100% - 25px);
        font-size: 0.9em;
      }
      #frame .content .messages ul li:nth-last-child(1) {
        margin-bottom: 20px;
      }
      #frame .content .messages ul li.sent img {
        margin: 6px 8px 0 0;
      }
      #frame .content .messages ul li.sent p {
        background: #435f7a;
        color: #f5f5f5;
      }
      #frame .content .messages ul li.replies img {
        float: right;
        margin: 6px 0 0 8px;
      }
      #frame .content .messages ul li.replies p {
        background: #f5f5f5;
        float: right;
      }
      #frame .content .messages ul li img {
        width: 22px;
        border-radius: 50%;
        float: left;
      }
      #frame .content .messages ul li p {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 20px;
        max-width: 205px;
        line-height: 130%;
      }
      @media screen and (min-width: 735px) {
        #frame .content .messages ul li p {
          max-width: 300px;
        }
      }
      #frame .content .message-input {
        position: absolute;
        bottom: 0;
        width: 100%;
        z-index: 99;
      }
      #frame .content .message-input .wrap {
        position: relative;
      }
      #frame .content .message-input .wrap input {
        font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
        float: left;
        border: none;
        width: calc(100% - 90px);
        padding: 11px 32px 10px 8px;
        font-size: 0.8em;
        color: #32465a;
      }
      @media screen and (max-width: 735px) {
        #frame .content .message-input .wrap input {
          padding: 15px 32px 16px 8px;
        }
      }
      #frame .content .message-input .wrap input:focus {
        outline: none;
      }
      #frame .content .message-input .wrap .attachment {
        position: absolute;
        right: 60px;
        z-index: 4;
        margin-top: 10px;
        font-size: 1.1em;
        color: #435f7a;
        opacity: .5;
        cursor: pointer;
      }
      @media screen and (max-width: 735px) {
        #frame .content .message-input .wrap .attachment {
          margin-top: 17px;
          right: 65px;
        }
      }
      #frame .content .message-input .wrap .attachment:hover {
        opacity: 1;
      }
      #frame .content .message-input .wrap button {
        float: right;
        border: none;
        width: 50px;
        padding: 12px 0;
        cursor: pointer;
        background: #32465a;
        color: #f5f5f5;
      }
      @media screen and (max-width: 735px) {
        #frame .content .message-input .wrap button {
          padding: 16px 0;
        }
      }
      #frame .content .message-input .wrap button:hover {
        background: #435f7a;
      }
      #frame .content .message-input .wrap button:focus {
        outline: none;
      }
  </style>
@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
     
    </div>
<!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Chat View </h3>
                </div>
               
              </div>
            </div>
            <div class="card-body">
              <form action="#" method="post" >
                {{ csrf_field() }}
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Select User</label>
                        <select class="form-control" name="chat_user" id="chat_user" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Select Type</label>
                        <select class="form-control" name="chat_type" id="chat_type" required>
                            <option value="">Select Type</option>
                            <option value="user">User</option>
                            <option value="event">Event</option>
                            <option value="group">Group</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Select Chater</label>
                        <select class="form-control" name="chat_chater" id="chat_chater" required>
                            <option value="">Select Chater</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" type="button" id="get_chat">View Chat</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Chat</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="frame">
                <div class="content">
                  <div class="messages">
                    <ul>
                      <li class="sent">
                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                        <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>When you're backed against the wall, break the god damn thing down.</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>Excuses don't win championships.</p>
                      </li>
                      <li class="sent">
                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                        <p>Oh yeah, did Michael Jordan tell you that?</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>No, I told him that.</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>What are your choices when someone puts a gun to your head?</p>
                      </li>
                      <li class="sent">
                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                        <p>What are you talking about? You do what they say or they shoot you.</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                      </li>
                      <li class="sent">
                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                        <p>Oh yeah, did Michael Jordan tell you that?</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>No, I told him that.</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>What are your choices when someone puts a gun to your head?</p>
                      </li>
                      <li class="sent">
                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                        <p>What are you talking about? You do what they say or they shoot you.</p>
                      </li>
                      <li class="replies">
                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                        <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
@endsection
@section('script')
  <script src="{{ asset('eventadmin/summernote.bundle.js') }}"></script>
  <script src="{{ asset('eventadmin/summernote.js') }}"></script>
  <script src="{{ asset('eventadmin/jquery.validate.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#chat_user').change(function(){

        var chat_user=$('#chat_user').val();
        var chat_type=$('#chat_type').val();
        if(chat_user == ''){
          alert('Please select user first');return;
        }
        if(chat_type == ''){
          alert('Please select type first');return;
        }
        $.ajax({
            type: 'POST',
            url : "{{ url('/eventuser/getChatUserList') }}",
            data:{chat_user:chat_user,chat_type:chat_type},
            dataType:'JSON',
            success : function (data) {
                    
                var innerHtml='';
                innerHtml +='<option value="">Select</option>';
                if(chat_type == 'user'){
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].user_meetup_id + '"> ' + data[i].first_name+ ' ' +data[i].last_name+ '</option>';
                    }

                  }
                }else if(chat_type == 'event'){
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].event_id + '"> ' + data[i].event_name+ '</option>';
                    }

                  }
                }else{
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].user_meetup_group_id + '"> ' + data[i].group_name+ '</option>';
                    }

                  }
                }
                
                $('#chat_chater').html(innerHtml);
                
            },error: function(xhr, ajaxOptions, thrownError){
               $('.preloader').hide();
                Swal.fire("Error!", "Internal server error, Please try after some time.", "error");
            },
        });

    });

    $('#chat_type').change(function(){

        var chat_user=$('#chat_user').val();
        var chat_type=$('#chat_type').val();
        if(chat_user == ''){
          alert('Please select user first');return;
        }
        if(chat_type == ''){
          alert('Please select type first');return;
        }
        $.ajax({
            type: 'POST',
            url : "{{ url('/eventuser/getChatUserList') }}",
            data:{chat_user:chat_user,chat_type:chat_type},
            dataType:'JSON',
            success : function (data) {
                    
                var innerHtml='';
                innerHtml +='<option value="">Select</option>';
                if(chat_type == 'user'){
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].user_meetup_id + '"> ' + data[i].first_name+ ' ' +data[i].last_name+ '</option>';
                    }

                  }
                }else if(chat_type == 'event'){
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].event_id + '"> ' + data[i].event_name+ '</option>';
                    }

                  }
                }else{
                  if(data.length > 0) {
                    for(var i=0;i<data.length;i++){
                        innerHtml += '<option value="' + data[i].user_meetup_group_id + '"> ' + data[i].group_name+ '</option>';
                    }

                  }
                }
                
                $('#chat_chater').html(innerHtml);
                
            },error: function(xhr, ajaxOptions, thrownError){
               $('.preloader').hide();
                Swal.fire("Error!", "Internal server error, Please try after some time.", "error");
            },
        });

    });

    $('#get_chat').click(function(){

        var chat_user=$('#chat_user').val();
        var chat_type=$('#chat_type').val();
        var chat_chater=$('#chat_chater').val();
        $.ajax({
            type: 'POST',
            url : "{{ url('/eventuser/getUserChat') }}",
            data:{chat_user:chat_user,chat_type:chat_type,chat_chater:chat_chater},
            dataType:'JSON',
            success : function (data) {

              $('.messages').html(data.html);
                
            },error: function(xhr, ajaxOptions, thrownError){
              alert("Internal server error, Please try after some time.");
            },
        });

    });
  </script>
@endsection