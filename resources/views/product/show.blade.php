@extends('layouts.app')

@section('nav')

    <header-component
        :routes="{{ $routes }}"
    ></header-component>

@endsection

@section('content')

    <product-component
        :routes="{{ $routes }}"
        :product="{{ $product }}"
    ></product-component>

@endsection
