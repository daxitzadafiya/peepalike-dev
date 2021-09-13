@extends('frontend.layout.app')

@section('content')
    <div class="page-contant">
        <div class="page-contant-inner">
            <h2 class="header-page-ab">Payment Notification</h2>

            <p class="head-p">Payment Id 		 :  {{$transaction->id}}</p>
            <p class="head-p">Transaction Status :  {{$transaction->status}}</p>
            <p class="head-p">Name 				 :  {{$transaction->first_name}} {{$transaction->last_name}}</p>
            <p class="head-p">Amount 			 :  {{$transaction->amount}}</p>
            <p class="head-p">Transaction Id 	 :  {{$transaction->principal_transaction_id}}</p>
            <p class="head-p">Reference Id		 :  {{$transaction->reference_id}}</p>
            
			
			<!-- contact page -->
            <div style="clear:both;"></div>
            <div style="clear:both;"></div>
            
			
			
			<div style="clear:both;"></div>
        </div>
    </div>
@endsection
