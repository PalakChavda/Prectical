@extends('layouts.app')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-spacing">
        <div class="col-lg-12 layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <h5> @lang("global.blog") </h5></br>
                    <div class="table-responsive mb-4">
                        <table id="style-3" class="table style-3 non-hover table-hover " style="margin-top: 10px !important; margin-bottom: 20px !important;">
                            <thead>
                                <tr>
                                    <th> @lang('user.name')</th>
                                    <th>@lang('user.detail')</th>
                                    <th>@lang('user.user_id')</th>
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