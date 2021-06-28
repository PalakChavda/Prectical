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
                                <h4> @lang("user.edit_user") </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6 pt-0">
                        <form class="simple-example user_manag" id="user_form" action="{{ route('users.update',$user->id) }}" method="POST" novalidate autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="colFormLabel">@lang('user.first_name')<span class="validate">*</span></label>
                                    >
                                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name" placeholder="@lang('user.first_name')">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="colFormLabel">@lang("user.last_name")<span class="validate">*</span></label>
                                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" id="last_name" placeholder="@lang('user.last_name')">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="colFormLabel">@lang('user.email')<span class="validate">*</span></label>

                                    <input type="text" class="form-control" value="{{ $user->email }}" name="email" id="email" placeholder="@lang('user.email')" required>
                                </div>
                                <div class="col-md-6 mb-3" id="date_time_picker">
                                    <label for="colFormLabel">@lang('user.dob')<span class="validate">*</span></label>
                                    <input type="text" class="form-control form-control flatpickr flatpickr-input active" id="dob" value="{{ $user->dob }}" name="dob" placeholder="@lang('user.dob')" class="form-control flatpickr flatpickr-input active">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="colFormLabel">@lang('user.mobile') <span class="validate">*</span></label>
                                    <input type="nume" class="form-control" value="{{ $user->phone }}" name="phone" id="phone" placeholder="@lang('user.mobile')" required>
                                </div>

                               
                            </div>

                            <!-- hidden filed -->
                            <input type="hidden" name="password" value="123456789">

                            <a class="btn btn-danger mt-2 float-right " href="{{ route('users.index') }}"> @lang('user.cancel')</a>
                            <button class="btn btn-primary float-right mr-2 submit-fn mt-2" id="btn-submit" type="submit"> @lang('user.update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection