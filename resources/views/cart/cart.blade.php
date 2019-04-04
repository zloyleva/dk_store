@extends('layouts.app')

@section('content')

    <cart-component
        :items="{{ $items }}"
        :routes="{{ $routes }}"
    ></cart-component>

@endsection
