@extends('eventusers.layout.app')
@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
 <style>
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
          background-image: -webkit-linear-gradient(top, #FFFFFF, #FFFFFF 25px);
          border-radius: 18px;
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
          background: #4EA5E0;
          border-radius: inherit;
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
          text-shadow: 0 1px rgba(0, 0, 0, 0.2);
          opacity: 0;
      }
      .switch-input:checked ~ .switch-label {
          background: #4ea5e0;
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
          width: 28px;
          height: 28px;
          background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
          background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
          border-radius: 100%;
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
          background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
          border-radius: 6px;
          box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
      }
      .switch-input:checked ~ .switch-handle {
          left: 74px;
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
  </style>
@endsection
@section('content')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 50px; margin-bottom: 10px;">
     
    </div>
    <?php
      $dummy = array (
                  0 => 
                  array (
                    0 => '1',
                    1 => 'WALLET0239',
                    2 => 'Catherine Demo',
                    3 => 'demo',
                    4 => '$1099',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  1 => 
                  array (
                    0 => '2',
                    1 => 'WALLET0238',
                    2 => 'Marvel Demo',
                    3 => 'demo',
                    4 => '$1000',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  2 => 
                  array (
                    0 => '3',
                    1 => 'PREMIUM0237',
                    2 => 'Jothi Demo',
                    3 => 'demo',
                    4 => '$20',
                    5 => 'Debit',
                    6 => 'PREMIUM',
                  ),
                  3 => 
                  array (
                    0 => '4',
                    1 => 'WALLET0235',
                    2 => 'Jothi Demo',
                    3 => 'demo',
                    4 => '$199',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  4 => 
                  array (
                    0 => '5',
                    1 => 'WALLET0232',
                    2 => 'Ravi Shankar',
                    3 => 'demo',
                    4 => '$100',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  5 => 
                  array (
                    0 => '6',
                    1 => 'WALLET0231',
                    2 => 'New User',
                    3 => 'demo',
                    4 => '$1099',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  6 => 
                  array (
                    0 => '7',
                    1 => 'PREMIUM0230',
                    2 => 'New User',
                    3 => 'demo',
                    4 => '$40',
                    5 => 'Debit',
                    6 => 'PREMIUM',
                  ),
                  7 => 
                  array (
                    0 => '8',
                    1 => 'WALLET0229',
                    2 => 'New User',
                    3 => 'demo',
                    4 => '$1099',
                    5 => 'Credit',
                    6 => 'ADDED',
                  ),
                  8 => 
                  array (
                    0 => '9',
                    1 => 'PREMIUM0228',
                    2 => 'Kgotso Mtsweni',
                    3 => 'demo',
                    4 => '$40',
                    5 => 'Debit',
                    6 => 'PREMIUM',
                  ),
                  9 => 
                  array (
                    0 => '10',
                    1 => 'PREMIUM0227',
                    2 => 'Ravi Demo',
                    3 => 'demo',
                    4 => '$30',
                    5 => 'Debit',
                    6 => 'PREMIUM',
                  )
                );
    ?>
<!-- Page content -->
   <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0" style="width: 80%; float: left;">Admin Transactions</h3>
            </div>
            <div class="table-responsive py-4">
              <h3 class="text-center">
                <img src="{{ asset('eventadmin/share-money.png') }}" style="height:50px" /> 
                Available Balance: $42007
              </h3>
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <tr>
                    <th>S. No</th>
                    <th>Transaction ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>Profile Status</th>
                    <th>Payment Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>S. No</th>
                    <th>Transaction ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>Profile Status</th>
                    <th>Payment Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($dummy as $row)
                  <tr>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[1] }}</td>
                    <td>{{ $row[2] }}</td>
                    <td>{{ $row[3] }}</td>
                    <td>{{ $row[4] }}</td>
                    <td>{{ $row[5] }}</td>
                    <td>{{ $row[6] }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
      </div>

    </div>
@endsection
@section('modal')
@endsection
@section('script')
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-basic').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
          ]
        });
    });
  </script>
@endsection
