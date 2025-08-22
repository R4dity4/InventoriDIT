@extends('welcome')
{{-- @extends('title', 'dashboard') --}}
@section('content')
    <h1>Admin Dashboard</h1>
    <p>{{ auth()->user()->name }} telah datang</p>
@endsection
