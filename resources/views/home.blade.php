@extends('template')

@section('title', 'Home')

@section('nav')
<li class="page-scroll">
  <a href="#search">Search</a>
</li>
<li class="page-scroll">
  <a href="#contact">Contact us</a>
</li>
@endsection

@section('content')
    <!-- Header -->
    <header id="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div id="search" class="intro-text">
			
			<div id="custom-search-input">
                <div class="input-group col-md-12">
                    <form id="seachShow" action="query" method="post">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input name="phone" id="users" type="text" class="form-control input-lg" placeholder="phone number or name debtor" />
                    </form>
                    <span class="input-group-btn">
                        <button id="seach-but" class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                    
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contact Section -->
    @include('contact')
@endsection
