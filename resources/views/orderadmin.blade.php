<!-- @ extends('auth.template')    Antiguo navbar-->

@extends('layaouts.app')

@section('content')
    <div class="container">
        <h1>PEDIDOS</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>ID Order</th>
                    <th>State</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id_user }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->state }}</td>
                </tr>
            @endforeach
        </table>
    @endsection
