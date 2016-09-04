@extends('template')

@section('title', "Изменить польователя: {$user->name}")

@section('nav')

@endsection

@section('content')
    <!-- Contact Section -->
    <section id="edit">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Edit user</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
<form action="/update/{{ $token }}" enctype="multipart/form-data" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $user->id }}">
  <div class="form-group">
    <input required="required" placeholder="Name" type="text" name ="name" class="form-control" value="{{ $user->name }}" />
  </div>
  <div class="form-group">
    <input required="required" placeholder="Phone" type="text" name ="phone" class="form-control" value="{{ $user->phone }}" />
  </div>
  <div class="form-group">
    <input required="required" placeholder="Debt" type="text" name ="debt" class="form-control" value="{{ $user->debt }}" />
  </div>
  <div class="form-group">
    <textarea name="textTalk" placeholder="History" class="form-control">{{ $user->textTalk }}</textarea>
  </div>
  <div class="form-group">
	<input type="file" multiple="multiple" name="audioTalk[]" accept="audio/*" title="You must select at least one file" />
    <input placeholder="запись разговора" type="text" name ="audioFiles" class="form-control" value="{{ $user->audioTalk }}" disabled/>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="status"@if ($user->status) checked @endif/> paid
    </label>
  </div>
  <div class="buttons-edit row">
		<div class="col-lg-10">
	<input id="edit-but" type="submit" name='publish' class="btn btn-success" value = "Edit"/>
	<input id="view-but" type="button" class="btn btn-default" value = "View" onClick="window.open('/user/{{ $user->slug }}')" />
		</div>
		<div class="col-lg-2">		
	<input id="delete-but" type="button" class="btn btn-danger" value = "Remove" onClick="window.open('/delete/{{ $user->id }}/{{ $token }}')" />
		</div>
	
  </div>
</form>					
                </div>
            </div>
        </div>
    </section>
@endsection
