@extends('template')

@section('title', "Клиент: {$user->name}")

@section('nav')
<li class="page-scroll">
  <a href="#info">Debtor</a>
</li>
<li class="page-scroll">
  <a href="#debt">Pay</a>
</li>
<li class="page-scroll">
  <a href="#contact">Contact us</a>
</li>
@endsection

@section('content')
    <!-- Portfolio Grid Section -->
    <section id="info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Debtor</h2>
                    <hr class="star-primary">
					<div class="username row">
						<div class="leftcol col-lg-4 col-lg-offset-2">
							Name:
						</div>
						<div class="rightcol col-lg-4">
							{{ $user->name }}
						</div>
					</div>
					<div class="username row">
						<div class="leftcol col-lg-4 col-lg-offset-2">
							Phone:
						</div>
						<div class="rightcol col-lg-4">
							{{ $user->phone }}
						</div>
					</div>
					<div class="username row">
						<div class="leftcol col-lg-4 col-lg-offset-2">
							History:
						</div>
						<div class="rightcol col-lg-4">
							<a href="#textTalk" data-toggle="modal">More</a>
						</div>
					</div>
					<div class="username row">
						<div class="leftcol col-lg-4 col-lg-offset-2">
							Records of calls:
						</div>
						<div class="rightcol col-lg-4">
							<a href="#audioTalk" data-toggle="modal">More</a>
						</div>
					</div>					
                                
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="debt">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Debt</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="debt-val text-center col-lg-6 col-lg-offset-3">
                    <h2>Total {{ $user->debt }} rub</h2>
                </div>
  
                <div class="paid-but col-lg-8 col-lg-offset-2 text-center">
					@if ($user->status)
                    <span class="btn btn-lg btn-outline">
                        <i class="glyphicon glyphicon-ruble"></i> Paid
                    </span>
                    @else
                    <a href="#debtPaid" data-toggle="modal" class="btn btn-lg btn-outline">
                        <i class="glyphicon glyphicon-ruble"></i> Pay
                    </a>                    
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    @include('contact')
    
@endsection

@section('textTalk')
{!! nl2br(e($user->textTalk)) !!}
@endsection

@section('audioTalk')
@if($user->audioTalk)
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<audio id="audio" preload="auto" tabindex="0" controls="" >
			<source src="/uploads/{{ $user->audioTalk[0]['track'] }}">
			Your Fallback goes here
		</audio>
		<ul class="list-unstyled text-center" id="playlist">
		@foreach ($user->audioTalk as $index => $element)
			<li>
				<a @if($index==0)class="active"@endif href="/uploads/{{ $element['track'] }}">
				 Record - {{ $index+1 }}
				</a>
			</li>
		@endforeach
		</ul>
   </div>
</div>
@endif
@endsection

@section('debtPaid')
<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account=41001502536815&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0+%D0%B4%D0%BE%D0%BB%D0%B3%D0%B0&targets-hint=&default-sum={{ $user->debt }}&button-text=01&fio=on&successURL=http%3A%2F%2Flocalhost%3A8000%2Fuser%2Fpaid" width="450" height="198"></iframe>
@endsection


