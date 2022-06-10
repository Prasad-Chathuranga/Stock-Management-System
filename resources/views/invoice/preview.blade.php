@extends('layouts.app')

@section('title', 'Payments')
@section('subtitle', 'Preview Invoice')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Preview Invoice</a></li>
@endsection

@section('content')
<section>
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">Preview Invoice</h6>
        <a type="button" class="btn btn-success me-2 d-flex" href="{{route('download_invoice', $payment->id)}}">Export</a>
    </div>
    <hr />
  <div class="card-body">
    <div class="invoice-box mb-3">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{asset('img/logo/logo2.png')}}" style="width: 100%; max-width: 100px" />
                            </td>

                            <td>
                                Invoice #:  {{$payment->payment_no}}<br />
                                Created On: {{date('Y-m-d', strtotime($payment->created_at))}}<br />
                                At: {{date('h:i:s A', strtotime($payment->created_at))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br />
                                12345 Sunny Road<br />
                                Sunnyville, CA 12345
                            </td>

                            <td>
                                {{$payment->customer->first_name}} {{$payment->customer->last_name}}<br />
                                {{$payment->customer->mobile_1}} , {{$payment->customer->mobile_2}}<br />
                                {{$payment->customer->email}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>

                <td>Order #</td>
            </tr>

            <tr class="details">
                <td>{{$payment->method}}</td>

                <td>{{$payment->order->order_no}}</td>
            </tr>

            <tr class="heading">
                <td>Item</td>

                <td></td>

                {{-- <td>Price</td> --}}
            </tr>
            @foreach ($items as $key => $item )
            <tr class="item">
                <td>{{$item->item->name}}</td>

                <td>{{number_format($item->price, 2)}} x {{$item->quantity}}</td>

                {{-- <td>{{number_format($item->total, 2)}}</td> --}}
            </tr>
            @endforeach

            {{-- <tr class="item">
                <td>Hosting (3 months)</td>

                <td>$75.00</td>
            </tr>

            <tr class="item last">
                <td>Domain name (1 year)</td>

                <td>$10.00</td>
            </tr> --}}

            <tr class="total">
                <td></td>

                <td>Total: {{number_format($payment->order->total, 2)}}</td>
            </tr>
        </table>
    </div>
  </div>
  {{-- <input type="hidden" ng-init="url='{{ route('rentout.store') }}'; order_details_url='{{route('order_details')}}'" /> --}}
</section>

@endsection

@section('style')
<style>
  .invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
</style>
@endsection

@section('script')

<script src="{{ asset('js/angular/invoice.js') }}"></script>

@endsection