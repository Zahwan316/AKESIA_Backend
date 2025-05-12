@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
    <div>
        <h1>Dashboard</h1>
        <p>{{auth()->user()->username}} test</p>
    </div>
@endsection
