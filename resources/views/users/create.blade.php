@extends('layouts.app')

@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> @lang("user.add_user") </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form class="simple-example" action="{{route('users.store')}}" autocomplete="off" method="post" id="user_form">
                        @csrf
                        <div class="form-group row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="colFormLabel">@lang('user.first_name')<span class="validate">*</span></label>
                                <input type="text" name="first_name" autocomplete="off" class="form-control" id="first_name" value="{{old('first_name')}}" placeholder="@lang('user.first_name')">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="colFormLabel">@lang("user.last_name")<span class="validate">*</span></label>
                                <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" id="last_name" placeholder="@lang('user.last_name')">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="colFormLabel">@lang('user.email')<span class="validate">*</span></label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" id="email" placeholder="@lang('user.email')">
                            </div>
                            <div class="col-md-6 mb-3" id="date_time_picker">
                                <label for="colFormLabel">@lang('user.dob')<span class="validate">*</span></label>
                                <input type="text" class="form-control form-control flatpickr flatpickr-input active" id="dob" value="" name="dob" placeholder="@lang('user.dob')" class="form-control flatpickr flatpickr-input active">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="colFormLabel">@lang('user.mobile')<span class="validate">*</span></label>
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="phone" placeholder="@lang('user.mobile')">
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label for="colFormLabel">@lang('user.password') </label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="@lang('user.password')">
                            </div>
                        </div>

                        <!-- hidden filed -->
                        <a class="btn btn-danger float-right mt-2" href="{{ route('users.index') }}"> @lang('user.cancel')</a>
                        <button class="btn btn-primary float-right mr-2 submit-fn mt-2" type="submit" id="btn-submit">@lang('user.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection