@extends('layouts.app')
@section('title')
    تسجيل عضوية جديدة
@endsection
@section('content')

<div class="container">
<div class="contact_bottom">
  <h3>تسجيل عضوية جديدة</h3>
  <hr/>
  <form class="form-horizontal" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


          <div class="col-md-12">
              <input id="name" type="text" class="form-control" name="name" placeholder="الإسم" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

          <div class="col-md-12">
              <input id="email" type="email" class="form-control" placeholder="الايميل" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


          <div class="col-md-12">
              <input id="password" type="password" class="form-control" placeholder="كلمة السر" name="password" required>

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group">


          <div class="col-md-12">
              <input id="password-confirm" type="password" class="form-control" placeholder="اعادة كلمة السر" name="password_confirmation" required>
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="btn btn-primary">
                  عضوية جديدة
              </button>
          </div>
      </div>
  </form>

</div>
</div>




@endsection
