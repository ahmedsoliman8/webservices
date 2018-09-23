


    <div class="text2{{ $errors->has('bu_name') ? ' has-error' : '' }}">


        <div class="col-md-11">
             {!!Form::text('bu_name',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>اسم العقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>
    <div class="text2{{ $errors->has('bu_room') ? ' has-error' : '' }}">
        <div class="col-md-11">

            {!!Form::select('bu_room',roomnumber(),null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_room'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_room') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>عدد الغرف</label></div>
    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2{{ $errors->has('bu_price') ? ' has-error' : '' }}">
        <div class="col-md-11">

            {!!Form::text('bu_price',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_price'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_price') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>سعر العقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2{{ $errors->has('bu_rent') ? ' has-error' : '' }}">
        <div class="col-md-11">

            {!!Form::select('bu_rent',bu_rent(),null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_rent'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_rent') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>نوع العملية</label></div>
    </div>
    <div class="clearfix"></div>
    <br>
    <div class="text2{{ $errors->has('bu_square') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::text('bu_square',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_square'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_square') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>مساحة العقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2{{ $errors->has('bu_type') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::select('bu_type',bu_type(),null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_type'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_type') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>نوع العقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>
    @if(!isset($user))
    <div class="text2{{ $errors->has('bu_status') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::select('bu_status',bu_status(),null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_status'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_status') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>حالة العقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>
    @endif

    <div class="text2{{ $errors->has('bu_place') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::select('bu_place',bu_place(),null,['class'=>'form-control select2'])!!}
            @if ($errors->has('bu_place'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_place') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>المنطقة</label></div>

    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2{{ $errors->has('image') ? ' has-error' : '' }}">
        <div class="col-md-11">
            @if(isset($bu))
            @if($bu->image != '')
                <img src="{{Request::root().'/website/buImages/'.$bu->image}}" width="100"/>
                <div class="clearfix"></div>
                <br/>
            @else
             <img src="{{getSetting('no_image')}}" width="100"/>
             <div class="clearfix"></div>
             <br/>
            @endif
            @endif
            {!!Form::file('image',null,['class'=>'form-control '])!!}
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>صورة للعقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>



    <div class="text2{{ $errors->has('bu_meta') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::text('bu_meta',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_meta'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_meta') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>الكلمات الدلالية</label></div>

    </div>
    <div class="clearfix"></div>
    <br>

    @if(!isset($user))
    <div class="text2{{ $errors->has('bu_small_dis') ? ' has-error' : '' }}">


        <div class="col-md-11">
            {!!Form::textarea('bu_small_dis',null,['class'=>'form-control','rows'=>'4'])!!}
            @if ($errors->has('bu_small_dis'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_small_dis') }}</strong>
                </span>
            @endif
            <br/>
            <div class="alert alert-warning">
                لايمكن ادخال أكتر من 160 حرف على حسب معايير جوجل
            </div>
        </div>
        <div class="col-md-1"> <label>وصف العقار لمحركات البحث</label></div>

    </div>
    <div class="clearfix"></div>
    <br>
    @endif

    <div class="text2{{ $errors->has('bu_langtuide') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::text('bu_langtuide',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_langtuide'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_langtuide') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>خط الطول</label></div>

    </div>
    <div class="clearfix"></div>
    <br>


    <div class="text2{{ $errors->has('bu_laltitude') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::text('bu_laltitude',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_laltitude'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_laltitude') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>خط العرض</label></div>

    </div>
    <div class="clearfix"></div>
    <br>

    <div class="text2{{ $errors->has('bu_large_dis') ? ' has-error' : '' }}">
        <div class="col-md-11">
            {!!Form::textarea('bu_large_dis',null,['class'=>'form-control'])!!}
            @if ($errors->has('bu_large_dis'))
                <span class="help-block">
                    <strong>{{ $errors->first('bu_large_dis') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-1"> <label>الوصف المطول للعقار</label></div>

    </div>
    <div class="clearfix"></div>
    <br>











    <div class="text2">
        <div class="col-md-12">
            <button type="submit" class="btn btn-warning">
              تنفيذ
            </button>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
