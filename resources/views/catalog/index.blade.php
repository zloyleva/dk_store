@extends('layouts.app')

@section('nav')

    <header-component
        :routes="{{ $routes }}"
    ></header-component>

@endsection

@section('content')

    <catalog-component
        :products="{{ $products }}"
        :request="{{ $request }}"
        :routes="{{ $routes }}"
    ></catalog-component>

@endsection
