


    <div class="text2{{ $errors->has('name') ? ' has-error' : '' }}">


        <div class="col-md-12">

             {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'الاسم'])!!}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    @if(!isset($showformuser))
    <div class="text2{{ $errors->has('admin') ? ' has-error' : '' }}">


        <div class="col-md-12">

             {!!Form::select('admin',['0' => 'user', '1' => 'admin'],null,['class'=>'form-control'])!!}
            @if ($errors->has('admin'))
                <span class="help-block">
                    <strong>{{ $errors->first('admin') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    @endif

    <div class="text2{{ $errors->has('email') ? ' has-error' : '' }}">

        <div class="col-md-12">
          {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'البريد الالكترونى'])!!}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    @if(isset($pagename))
    <div class="text2{{ $errors->has('password') ? ' has-error' : '' }}">


        <div class="col-md-12">
            <input id="password" type="password" class="form-control" placeholder="كلمة السر" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2">


        <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control" placeholder="اعادة كلمة السر" name="password_confirmation" required>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
  @endif
    <div class="text2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-warning">
              تنفيذ
            </button>
        </div>
    </div>
