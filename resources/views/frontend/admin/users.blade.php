@extends('frontend.admin.master')

@section('topbar-header', 'Kullanıcılar')

@section('topbar-icon', 'fas fa-users')

@section('users-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">
            <table class="table table-hover" style="text-align: center;">
                <table class="table table-hover" style="text-align: center;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Kullanıcı ID</th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">E-mail Adresi</th>
                            <th scope="col">Kullanıcı Rolü</th>
                            <th scope="col">Kullanıcı Durumu</th>
                            <th scope="col">Kullanıcıyı Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="text-transform: capitalize;">{{ $user->roles->first()->name }}</td>
                                <td><span class="badge badge-pill" style="background-color: green;">Mevcut</span></td>
                                <td><i class="fas fa-edit"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
        </div>
    </div>
</div>

@endsection
