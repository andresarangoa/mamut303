@extends('layout')

@php
    $headers = ['First Name', 'Last Name', 'CIN', 'Phone Number'];
    if ($mechanics->isNotEmpty()) {
        $columns = array_keys($mechanics->first()->toArray());
    } else {
        $columns = []; // Or set default columns if necessary
    }
@endphp

@section('content')
    <x-table route="mechanics" title="Mechanics" :headers="$headers" :columns="$columns" :list="$mechanics" />
@endsection
