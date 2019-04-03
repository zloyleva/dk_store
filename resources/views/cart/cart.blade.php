@extends('layouts.app')

@section('content')

    <cart-component
        :items="{{ $items }}"
    ></cart-component>

@endsection
