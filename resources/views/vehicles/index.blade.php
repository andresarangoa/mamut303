@extends('layout')

@php
    $headers = [
        __('messages.status'),
        __('messages.brand'),
        __('messages.model'),
        __('messages.license_plate'),
        __('messages.insurer'),
        __('messages.fuel_type'),
    ];
    $columns = [];
    if (!$vehicles->isEmpty()) {
        $columns = array_keys($vehicles->first()->toArray());
    }
@endphp

@section('content')
    <x-table route="vehicles" title="{{ __('messages.vehicles') }}" :headers="$headers" :columns="$columns" :list="$vehicles" />
@endsection
