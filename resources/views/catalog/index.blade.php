@extends('layouts.app')

@section('content')

    <catalog-component
        :products="{{ $products }}"
        :request="{{ $request }}"
        :routes="{{ $routes }}"
    ></catalog-component>

@endsection
