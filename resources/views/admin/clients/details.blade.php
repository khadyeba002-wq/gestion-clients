@extends('layouts.app')

@section('content')

<div style="padding:30px">

<h2>👤 {{ $user->name }}</h2>

<p>Email : {{ $user->email }}</p>

<h3>📦 Commandes</h3>

@foreach($user->orders as $order)
    <p>#{{ $order->id }} - {{ $order->total }} FCFA</p>
@endforeach

</div>

@endsection
