@extends('layouts.master')
@section('css')
    @livewireStyles
@section('title')
    {{ trans('main-trans.Add_Parent') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main-trans.Add_Parent') }}
@stop
<!-- breadcrumb -->
{{--  <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('main-trans.Parents') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a class="default-color">{{ trans('main-trans.Parents') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('main-trans.List_Parents') }}</li>
            </ol>
        </div>
    </div>
</div>  --}}
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent />
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@livewireScripts
@endsection
