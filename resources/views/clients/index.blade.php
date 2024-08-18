@extends('layout')

@php
    $headers = ['First Name', 'Last Name', 'DNI', 'Phone Number'];
    $headers = [
        __('messages.first_name'),
        __('messages.last_name'),
        __('messages.DNI'),
        __('messages.phone_number'),
    ];
    $columns = [];
    if (!$clients->isEmpty()) {
        $columns = array_keys($clients->first()->toArray());
    }
@endphp

@section('content')
    <x-table route="clients" title="{{ __('messages.clients') }}" :headers="$headers" :columns="$columns" :list="$clients" />
@endsection
