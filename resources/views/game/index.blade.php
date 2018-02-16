@extends('layouts.master')

@section('content')

@include('game.canceled')

@include('game.weather')

@include('game.info_header')
@include('game.info')

@include('game.attendance')

@include('game.settings')

@endsection