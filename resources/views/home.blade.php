@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($users->isEmpty())
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <h3 class="text-danger text-center">Nothing found!</h3>
                </div>
            @else
                {{-- <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr style="margin-bottom:10px;">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-info">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                <create></create>
                <edit></edit>
                <contacts :users="'{{ $users->toJson() }}'"></contacts>
            @endif
        </div>
    </div>
</div>
@endsection
