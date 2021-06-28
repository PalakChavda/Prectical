@extends('layouts.app')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-spacing">
        <div class="col-lg-12 layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <h5> @lang("user.user") <a class="btn btn-primary btn-sm float-right col-xl-2 col-md-2 col-sm-2 col-4" href="users/create"> @lang("user.add")<i class="fa fa-plus"></i></a></h5></br>
                    <div class="table-responsive mb-4">
                        <table id="style-3" class="table style-3 non-hover table-hover " style="margin-top: 10px !important; margin-bottom: 20px !important;">
                            <thead>
                                <tr>
                                    <th> @lang('user.first_name')</th>
                                    <th>@lang('user.last_name')</th>
                                    <th>@lang('user.email')</th>
                                    <th>@lang('user.mobile')</th>
                                    <th class="text-center">@lang('user.status')</th>
                                    <th class="text-center">@lang('user.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection