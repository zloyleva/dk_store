@extends('layouts.app')

@section('nav')

    <header-component
            :routes="{{ $routes }}"
    ></header-component>

@endsection

@section('content')

    <cart-component
        :items="{{ $items }}"
        :routes="{{ $routes }}"
    ></cart-component>

@endsection
