@extends('template')

@section('title', 'Добавление')

@section('nav')

@endsection

@section('content')
    <!-- Contact Section -->
    <section id="add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Add debtor</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
<form action="/add/{{ $token }}" enctype="multipart/form-data" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <input required="required" value="{{ old('name') }}" placeholder="Name" type="text" name ="name" class="form-control" />
  </div>
  <div class="form-group">
    <input required="required" value="{{ old('phone') }}" placeholder="Phone" type="text" name ="phone" class="form-control" />
  </div>
  <div class="form-group">
    <input required="required" value="{{ old('debt') }}" placeholder="Debt" type="text" name ="debt" class="form-control" />
  </div>
  <div class="form-group">
    <textarea name="textTalk" placeholder="History" class="form-control">{{ old('textTalk') }}</textarea>
  </div>
  <div class="form-group">
	<label>Record of call</label>
	<input type="file" multiple="multiple" name="audioTalk[]" accept="audio/*" title="You must select at least one file" />
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="status"@if (old('status')) checked @endif/> Paid
    </label>
  </div>
  <input type="submit" name='publish' class="btn btn-success" value = "Add"/>
</form>					
                </div>
            </div>
        </div>
    </section>
@endsection
