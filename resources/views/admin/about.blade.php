@extends('admin.newlayout.layout')
@section('title', 'About')
@section('page')
    <div class="card">
        <div class="card-body text-center">
            <img src="{!! get_option('site_logo') !!}">
            <div class="h-10"></div>
            <h3>Tzenik LMS</h3>
            <h4>Version: 0.1</h4>
            <div class="h-10"></div>
        </div>
    </div>
@endsection
