<style>
      .user-left-menu{
        background: #343353 !important;
        color: #fff !important;
      }
      .user-left-menu i{
        color: #fff !important;
      }
      .user-left-menu li a{
        border-bottom: 1px solid #52516d;
        border-radius: 0px !important;
        align-items: center;
        border-bottom: 1px solid rgba(255,255,255,.15);
        font-weight: 700 !important;
      }
      .navbar-light .nav-link{
        color: #fff !important;
      }
      .user-profile{
        padding: 25px 0;
      }
      .nav-link {
        padding: 0 !important;
      }
      .navbar-vertical.navbar-expand-xs .navbar-nav > .nav-item > .nav-link.active{
        color: #e8665b !important;
        background: #343353 !important;
        position: unset;
        margin-top: 77px;
        z-index: -1;
      }
      .navbar-vertical.navbar-expand-xs .navbar-nav .nav-link {
          margin: 0px 25px;
          padding: 20px 0 !important;
          color: #fff !important;
      }
      .navbar-vertical.navbar-expand-xs .navbar-nav > .nav-item > .nav-link.active {
        margin: 0 25px !important;
      }
      .user-side-nav{
        position: fixed;
        top: 0;
        background: #fff;
        width: 100% !important;
      }
      .user-side-nav .top-option li a{
        padding: 0 12px;
        columns: #000 !important;
      } 
      .user-side-nav .top-option li a:hover{
        color: #e8665b !important;
        cursor: pointer;
      }
      .dashboard-content{
        margin: 100px 0 0 250px !important;
        z-index: -1 !important;
      }
      .event-content{
        margin: 100px 0 0 280px !important;
        z-index: -1 !important;
        position: unset !important;
      }
      .user-name{
        color: #fff;
      }
      .event-content .card-header h3{
        font-weight: 700;
      }
      .btn-save{
        background: #e86c60;
        color: #fff;
        border-color: #e86c60;
        box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
      }
      .btn-edit{
          background: #45a845;
          color: #FFFFFF;   
      }
      .btn-delete{
        background: #e86c60;
        color: #FFFFFF;
      }
      .btn-edit:hover, .btn-delete:hover,.btn-info-color:hover{
        color: #FFFFFF;
      }
      .btn-save:hover{
        color: #fff;
      }
      .btn-info-color{
        background: #46a2b8;
        color: #fff;
      }
      .event-banner-info h4{
        font-weight: 700;
      }
      .event-banner-edit .editEvent{
        width: 135px !important;
      }
      .event-form-option ul{
        list-style: none;
        display: flex;
        padding: 0 !important;
        margin-bottom: 0px; 
      }
      .event-form-option ul li{
        margin-right: 10px;
        background: rgb(202, 200, 200) !important;
        border-radius: 2px;
      }
      .event-form-option ul li a{
        color: #000 !important;
        cursor: pointer;
        font-weight: 700;
      }
      .event-form-option .active{
        color: #fff !important;
        background: #e86c60 !important;
      }
      .event-form-option ul li a:hover{
        color: #fff !important;
        background: #e86c60 !important;
        cursor: pointer;
      }
      .event-heading h3{
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 32px 0;
        padding-left: 15px;
      }
      .dashboard-content h6{
        font-size: 25px !important;
        font-weight: 600 !important;
        color: #000;
      }
      .dashboard-content hr{
        border-bottom: 1px solid #e4e2e2 !important;
      }
      .dashboard-content .card-body h5{
        font-size: 20px !important;
      }
      .checkbox-inline {
          display: inline-block;
          padding-left: 20px;
          margin-bottom: 0;
          font-weight: normal;
          vertical-align: middle;
          cursor: pointer;
      }
      .switch {
          position: relative;
          display: block;
          vertical-align: top;
          width: 100px;
          height: 30px;
          padding: 3px;
          margin: 0 10px 10px 0;
          background: linear-gradient(to bottom, #FFFFFF, #FFFFFF 25px);
          /* background-image: -webkit-linear-gradient(top, #FFFFFF, #FFFFFF 25px); */
          /* border-radius: 18px; */
          box-shadow: inset 0 -1px #FFFFFF, inset 0 1px 1px rgba(0, 0, 0, 0.05);
          cursor: pointer;
      }
      .switch-input {
          position: absolute;
          top: 0;
          left: 0;
          opacity: 0;
      }
      .switch-label {
          position: relative;
          display: block;
          height: inherit;
          font-size: 10px;
          text-transform: uppercase;
          /* background: #4EA5E0; */
          background: #e86c60;
          font-weight: 700;
          /* border-radius: inherit; */
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
      }
      .switch-label:before, .switch-label:after {
          position: absolute;
          top: 50%;
          margin-top: -.5em;
          line-height: 1;
          -webkit-transition: inherit;
          -moz-transition: inherit;
          -o-transition: inherit;
          transition: inherit;
      }
      .switch-label:before {
          content: attr(data-off);
          right: 11px;
          color: #ffffff;
          text-shadow: 0 1px rgba(255, 255, 255, 0.5);
      }
      .switch-label:after {
          content: attr(data-on);
          left: 11px;
          color: #FFFFFF;
          font-weight: 700;
          text-shadow: 0 1px rgba(0, 0, 0, 0.2);
          opacity: 0;
      }
      .switch-input:checked ~ .switch-label {
          /* background: #4ea5e0; */
          background: #343353;
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
      }
      .switch-input:checked ~ .switch-label:before {
          opacity: 0;
      }
      .switch-input:checked ~ .switch-label:after {
          opacity: 1;
      }
      .switch-handle {
          position: absolute;
          top: 4px;
          left: 4px;
          width: 18px;
          height: 28px;
          background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
          /* background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
          border-radius: 100%; */
          box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
      }
      .switch-handle:before {
          content: "";
          position: absolute;
          top: 50%;
          left: 50%;
          margin: -6px 0 0 -6px;
          width: 12px;
          height: 12px;
          background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
          /* background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
          border-radius: 6px; */
          box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
      }
      .switch-input:checked ~ .switch-handle {
          left: 78px;
          box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
      }
      /* Transition
      ========================== */
      .switch-label, .switch-handle {
          transition: All 0.3s ease;
          -webkit-transition: All 0.3s ease;
          -moz-transition: All 0.3s ease;
          -o-transition: All 0.3s ease;
      }
      @media (max-width: 1200px) and  (min-width: 993px){
        .dashboard-content,.event-content{
          margin: 100px 0 0 0px !important;
        }
        .sidenav-toggler-dark .sidenav-toggler-line {
            background-color: #000;
        }
        .top-option{
          display: none;
        }
        .nav-side-option{
          margin-left: auto !important;
        }
        .user-detail{
          margin-left: 0 !important;
        }
        .user-detail .media-body{
          display: block !important;
        }
      }
      @media (max-width: 992px) and  (min-width: 768px){
        .dashboard-content,.event-content{
          margin: 100px 0 0 0px !important;
        }
        .sidenav-toggler-dark .sidenav-toggler-line {
            background-color: #000;
        }
        .top-option{
          display: none;
        }
        .nav-side-option{
          margin-left: auto !important;
        }
        .user-detail{
          margin-left: 0 !important;
        }
        .user-detail .media-body{
          display: block !important;
        }
      }
      @media (max-width: 767px) and  (min-width: 576px){
        .dashboard-content,.event-content{
          margin: 100px 0 0 0px !important;
        }
        .sidenav-toggler-dark .sidenav-toggler-line {
            background-color: #000;
        }
        .top-option{
          display: none;
        }
        .nav-side-option{
          margin-left: auto !important;
        }
        .user-detail{
          margin-left: 0 !important;
        }
        .user-detail .media-body{
          display: block !important;
        }
      }
      @media (max-width: 575px) and  (min-width: 432px){
        .dashboard-content,.event-content{
          margin: 100px 0 0 0px !important;
        }
        .sidenav-toggler-dark .sidenav-toggler-line {
            background-color: #000;
        }
        .top-option{
          display: none;
        }
        .nav-side-option{
          margin-left: auto !important;
        }
        .user-detail{
          margin-left: 0 !important;
        }
        .user-detail .media-body{
          display: block !important;
        }
        .event-content .event-form-wrapper .form-group{
          margin-bottom: 0 !important;
        }
        .event-form-option ul li a {
          font-weight: 500; 
          padding: 10px 18px !important;
        }
        .event-banner-info .btn,.event-banner-edit .editEvent{
          width: 135px !important;
        }
      }
      @media (max-width: 431px) and  (min-width: 320px){
        .dashboard-content,.event-content{
          margin: 75px 0 0 0px !important;
        }
        .sidenav-toggler-dark .sidenav-toggler-line {
            background-color: #000;
        }
        .top-option{
          display: none;
        }
        .nav-side-option{
          margin-left: auto !important;
        }
        .user-detail{
          margin-left: 0 !important;
        }
        .user-detail .media-body{
          display: block !important;
        }
        .navbar-vertical.navbar-expand-xs {
          margin-top: 70px;
        }
        .event-content .event-form-wrapper{
          padding-left: 30px;
        }
        .event-content .event-form-wrapper .form-group{
          margin-bottom: 0 !important;
        }
        .event-form-option ul li a {
          font-weight: 500; 
          padding: 3px 4px !important;
        }
        .event-form-option ul li{
          margin-right: 4px;
        }
        .event-banner-info .btn,.event-banner-edit .editEvent{
          width: 135px !important;
        }
      }
    </style>