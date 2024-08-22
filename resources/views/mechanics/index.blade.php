@extends('layout')

@php
    $headers = [ __('messages.first_name'), __('messages.last_name'), __('messages.DNI'), __('messages.phone_number')];
    if ($mechanics->isNotEmpty()) {
        $columns = array_keys($mechanics->first()->toArray());
    } else {
        $columns = []; // Or set default columns if necessary
    }
@endphp

@section('content')
    <x-table route="mechanics" title="{{ __('messages.mechanics') }}" :headers="$headers" :columns="$columns" :list="$mechanics" />
@endsection
