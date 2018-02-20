@extends('layouts.master')

@section('content')

@include('game.canceled')


@if(\Carbon\Carbon::parse($game['date'] . 'EST')->diffInDays(\Carbon\Carbon::now()) < 5)

@include('game.weather')

@endif

@include('game.info_header')
@include('game.info')

@include('game.attendance')

@include('game.settings')

@endsection