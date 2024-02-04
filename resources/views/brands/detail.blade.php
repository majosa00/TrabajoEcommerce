@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <table class="table table-responsive-sm table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="2">Brand Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $brand->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
