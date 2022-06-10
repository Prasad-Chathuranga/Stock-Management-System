<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;
  /* -webkit-print-color-adjust: exact; */
}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.col-left {
    float: left;
}
.col-right {
    float: right;
}
h1{
  font-size: 1.5em;
  color: #444;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .75em;
  color: #666;
  line-height: 1.2em;
}
a {
    text-decoration: none;
    color: #00a63f;
}

#invoiceholder{
  width:100%;
  height: 100%;
  padding: 50px 0;
}
#invoice{
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
/*  border-bottom: 1px solid #EEE;*/
  padding: 20px;
}

#invoice-top{border-bottom: 2px solid #00a63f;}
#invoice-mid{min-height: 110px;}
#invoice-bot{ min-height: 240px;}

.logo{
    display: inline-block;
    vertical-align: middle;
	width: 110px;
    overflow: hidden;
}
.info{
    display: inline-block;
    vertical-align: middle;
    margin-left: 20px;
}
.logo img,
.clientlogo img {
    width: 100%;
}
.clientlogo{
    display: inline-block;
    vertical-align: middle;
	width: 50px;
}
.clientinfo {
    display: inline-block;
    vertical-align: middle;
    margin-left: 20px
}
.title{
  float: right;
}
.title p{text-align: right;}
#message{margin-bottom: 30px; display: block;}
h2 {
    margin-bottom: 5px;
    color: #444;
}
.col-right td {
    color: #666;
    padding: 5px 8px;
    border: 0;
    font-size: 0.75em;
    border-bottom: 1px solid #eeeeee;
}
.col-right td label {
    margin-left: 5px;
    font-weight: 600;
    color: #444;
}
.cta-group a {
    display: inline-block;
    padding: 7px;
    border-radius: 4px;
    background: rgb(196, 57, 10);
    margin-right: 10px;
    min-width: 100px;
    text-align: center;
    color: #fff;
    font-size: 0.75em;
}
.cta-group .btn-primary {
    background: #00a63f;
}
.cta-group.mobile-btn-group {
    display: none;
}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
    padding: 10px;
    border-bottom: 1px solid #cccaca;
    font-size: 0.70em;
    text-align: left;
}

.tabletitle th {
  border-bottom: 2px solid #ddd;
  text-align: right;
}
.tabletitle th:nth-child(2) {
    text-align: left;
}
th {
    font-size: 0.7em;
    text-align: left;
    padding: 5px 10px;
}
.item{width: 50%;}
.list-item td {
    text-align: right;
}
.list-item td:nth-child(2) {
    text-align: left;
}
.total-row th,
.total-row td {
    text-align: right;
    font-weight: 700;
    font-size: .75em;
    border: 0 none;
}
.table-main {
    
}
footer {
    border-top: 1px solid #eeeeee;;
    padding: 15px 20px;
}
.effect2
{
  position: relative;
}
/* .effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
} */
@media screen and (max-width: 767px) {
    h1 {
        font-size: .9em;
    }
    #invoice {
        width: 100%;
    }
    #message {
        margin-bottom: 20px;
    }
    [id*='invoice-'] {
        padding: 20px 10px;
    }
    .logo {
        width: 140px;
    }
    .title {
        float: none;
        display: inline-block;
        vertical-align: middle;
        margin-left: 40px;
    }
    .title p {
        text-align: left;
    }
    .col-left,
    .col-right {
        width: 100%;
    }
    .table {
        margin-top: 20px;
    }
    #table {
        white-space: nowrap;
        overflow: auto;
    }
    td {
        white-space: normal;
    }
    .cta-group {
        text-align: center;
    }
    .cta-group.mobile-btn-group {
        display: block;
        margin-bottom: 20px;
    }
     /*==================== Table ====================*/
    .table-main {
        border: 0 none;
    }  
      .table-main thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }
      .table-main tr {
        border-bottom: 2px solid #eee;
        display: block;
        margin-bottom: 20px;
      }
      .table-main td {
        font-weight: 700;
        display: block;
        padding-left: 40%;
        max-width: none;
        position: relative;
        border: 1px solid #cccaca;
        text-align: left;
      }
      .table-main td:before {
        /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: normal;
        text-transform: uppercase;
      }
    .total-row th {
        display: none;
    }
    .total-row td {
        text-align: left;
    }
    footer {text-align: center;}
}

</style>
</head>

<body>

    {{-- <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                  
                </small>
            </h1>

   
            <div class="page-tools">
                <div class="action-buttons">
                   
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
            </div>
        </div>
    
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                               
                                    <img width="50" height="50" src="{{asset('img/logo/logo2.png')}}">
                                 
                                <span class="text-default-d3">SM Store</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->
    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{$payment->customer->first_name}} {{$payment->customer->last_name}}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    {{$payment->customer->email}}
                                </div>
                                
                                <div class="my-1">
                                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> 
                                    <b class="text-600">{{$payment->customer->mobile_1}}</b>
                                </div>
    
                                <div class="my-1">
                                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> 
                                    <b class="text-600"> {{$payment->customer->mobile_2}}</b>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
    
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> {{$payment->payment_no}}</div>
    
                                 <div class="my-2"><i class="fa fa-circle t/ext-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issued at:</span> 
                                    {{date('Y-m-d h:i:s A', strtotime($payment->created_at))}}</div> 
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Order Status:</span>
                                    @if ($payment->order->status == 0)
                                    <label class="badge badge-warning">
                                        <i class="" >Incomplete</i>
                                    </label>
                                    @else
                                    <label class="badge badge-warning">
                                        <i class="" >Completed</i>
                                    </label>
                                    @endif
                                    </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
    
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Item</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Quantity</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2">Amount</div>
                        </div>
    
             @foreach ($items as $key => $item)
            <div class="text-95 text-secondary-d3">
                <div class="row mb-2 mb-sm-0 py-25">
                    <div class="d-none d-sm-block col-1">{{$key+1}}</div>
                    <div class="col-9 col-sm-5">{{$item->item->name}}</div>
                    <div class="d-none d-sm-block col-2">{{number_format($item->quantity, 2)}}</div>
                    <div class="d-none d-sm-block col-2 text-95">{{number_format($item->price, 2)}}</div>
                    <div class="col-2 text-secondary-d2">{{number_format($item->total, 2)}}</div>
                </div>
            </div>
            @endforeach 
                         
    
                        <div class="row border-b-2 brc-default-l2"></div>
    
                 
                
    
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Extra note such as company or payment information...<br>
                              
                                {{$payment->notes}}
                                
                            </div>
    
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Total
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1">{{number_format($payment->order->total, 2)}}</span>
                                    </div>
                                </div>
    
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Paid 
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{number_format($payment->amount, 2)}}</span>
                                    </div>
                                </div>
    
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Due Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">{{number_format($payment->due, 2)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <hr />
    
                        
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    
        <div id="invoiceholder">
        <div id="invoice" class="effect2">
          
          <div id="invoice-top">
            <div class="logo"><img src="public/img/logo/logo2.png" alt="Logo" /></div>
            <div class="title">
              <h1>Invoice #<span class="invoiceVal invoice_num">tst-inv-23</span></h1>
              <p>Invoice Date: <span id="invoice_date">01 Feb 2018</span><br>
                 GL Date: <span id="gl_date">23 Feb 2018</span>
              </p>
            </div><!--End Title-->
          </div><!--End InvoiceTop-->
      
      
          
          <div id="invoice-mid">   
            <div id="message">
              <h2>Hello Andrea De Asmundis,</h2>
              <p>An invoice with invoice number #<span id="invoice_num">tst-inv-23</span> is created for <span id="supplier_name">TESI S.P.A.</span> which is 100% matched with PO and is waiting for your approval. <a href="javascript:void(0);">Click here</a> to login to view the invoice.</p>
            </div>
             <div class="cta-group mobile-btn-group">
                  <a href="javascript:void(0);" class="btn-primary">Approve</a>
                  <a href="javascript:void(0);" class="btn-default">Reject</a>
              </div> 
              <div class="clearfix">
                  <div class="col-left">
                      <div class="clientlogo"><img src="{{asset('img/logo/logo2.png')}}" alt="Sup" /></div>
                      <div class="clientinfo">
                          <h2 id="supplier">TESI S.P.A.</h2>
                          <p><span id="address">VIA SAVIGLIANO, 48</span><br><span id="city">RORETO DI CHERASCO</span><br><span id="country">IT</span> - <span id="zip">12062</span><br><span id="tax_num">555-555-5555</span><br></p>
                      </div>
                  </div>
                  <div class="col-right">
                      <table class="table">
                          <tbody>
                              <tr>
                                  <td><span>Invoice Total</span><label id="invoice_total">61.2</label></td>
                                  <td><span>Currency</span><label id="currency">EUR</label></td>
                              </tr>
                              <tr>
                                  <td><span>Payment Term</span><label id="payment_term">60 gg DFFM</label></td>
                                  <td><span>Invoice Type</span><label id="invoice_type">EXP REP INV</label></td>
                              </tr>
                              <tr><td colspan="2"><span>Note</span>#<label id="note">None</label></td></tr>
                          </tbody>
                      </table>
                  </div>
              </div>       
          </div><!--End Invoice Mid-->
          
          <div id="invoice-bot">
            
            <div id="table">
              <table class="table-main">
                <thead>    
                    <tr class="tabletitle">
                      <th>Type</th>
                      <th>Description</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Taxable Amount</th>
                      <th>Tax Code</th>
                      <th>%</th>
                      <th>Tax Amount</th>
                      <th>AWT</th>
                      <th>Total</th>
                    </tr>
                </thead>
                <tr class="list-item">
                  <td data-label="Type" class="tableitem">ITEM</td>
                  <td data-label="Description" class="tableitem">Servizio EDI + Traffico mese di novembre 2017</td>
                  <td data-label="Quantity" class="tableitem">46.6</td>
                  <td data-label="Unit Price" class="tableitem">1</td>
                  <td data-label="Taxable Amount" class="tableitem">46.6</td>
                  <td data-label="Tax Code" class="tableitem">DP20</td>
                  <td data-label="%" class="tableitem">20</td>
                  <td data-label="Tax Amount" class="tableitem">9.32</td>
                  <td data-label="AWT" class="tableitem">None</td>
                  <td data-label="Total" class="tableitem">55.92</td>
                </tr>
               <tr class="list-item">
                  <td data-label="Type" class="tableitem">ITEM</td>
                  <td data-label="Description" class="tableitem">Traffico mese di novembre 2017 FRESSNAPF TIERNAHRUNGS GMBH riadd. Almo DE</td>
                  <td data-label="Quantity" class="tableitem">4.4</td>
                  <td data-label="Unit Price" class="tableitem">1</td>
                  <td data-label="Taxable Amount" class="tableitem">46.6</td>
                  <td data-label="Tax Code" class="tableitem">DP20</td>
                  <td data-label="%" class="tableitem">20</td>
                  <td data-label="Tax Amount" class="tableitem">9.32</td>
                  <td data-label="AWT" class="tableitem">None</td>
                  <td data-label="Total" class="tableitem">55.92</td>
                </tr>
                  <tr class="list-item total-row">
                      <th colspan="9" class="tableitem">Grand Total</th>
                      <td data-label="Grand Total" class="tableitem">111.84</td>
                  </tr>
              </table>
            </div><!--End Table-->
            <div class="cta-group">
              <a href="javascript:void(0);" class="btn-primary">Approve</a>
              <a href="javascript:void(0);" class="btn-default">Reject</a>
          </div> 
            
          </div><!--End InvoiceBot-->
          <footer>
            <div id="legalcopy" class="clearfix">
              <p class="col-right">Our mailing address is:
                  <span class="email"><a href="mailto:supplier.portal@almonature.com">supplier.portal@almonature.com</a></span>
              </p>
            </div>
          </footer>
        </div><!--End Invoice-->
      </div><!-- End Invoice Holder-->
        
        
      
 
</body>

</html>
