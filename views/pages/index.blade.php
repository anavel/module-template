@extends('anavel::layouts.master')
@section('body-classes')
    sidebar-collapse
@stop
@section('content-header')
<h1>
    Test
</h1>
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ route('anavel-test.home') }}"><i class="fa fa-database"></i> {{ config('anavel-test.name') }}</a></li>
</ol>
@stop

@section('content')

@stop