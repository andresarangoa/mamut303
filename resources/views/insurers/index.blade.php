@extends('layout')

@php
    $headers = [
        __('messages.insurer_name'),
        __('messages.insurer_nit'),
    ];
    $columns = [];
    if (!$insurers->isEmpty()) {
        $columns = array_keys($insurers->first()->toArray());
    }
@endphp

@section('content')
    <x-table route="insurers" title="{{ __('messages.insurers') }}" :headers="$headers" :columns="$columns" :list="$insurers" />
@endsection
