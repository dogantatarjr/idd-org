@extends('frontend.admin.master')

@section('topbar-header', 'Kullanıcılar')

@section('topbar-icon', 'fas fa-users')

@section('users-sit', 'active')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-hover" style="text-align: center; border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #6c757d;">
                    <tr>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kullanıcı ID</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kullanıcı Adı</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">E-mail Adresi</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kullanıcı Rolü</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kullanıcı Durumu</th>
                        <th scope="col" style="color: white; background-color: gray; padding: 15px;">Kullanıcıyı Düzenle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row" style="padding: 15px;">{{ $user->id }}</th>
                            <td style="padding: 15px;">
                                <a href="javascript:void(0)" style="text-decoration: none; color: #007bff; cursor: pointer;"
                                   onclick="showUserDetails({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ ucfirst($user->roles->first()->name) }}', '{{ $user->created_at->format('d.m.Y H:i') }}', '{{ $user->status }}')">
                                   {{ $user->name }}
                                </a>
                            </td>
                            <td style="padding: 15px;">{{ $user->email }}</td>
                            <td style="text-transform: capitalize; padding: 15px;"><span class="badge" style="background-color: {{ $user->roles->first()->name === 'admin' ? 'red' : ($user->roles->first()->name === 'writer' ? 'blue' : 'orange') }}; color: white;">{{ $user->roles->first()->name }}</span></td>
                            <td style="padding: 15px;">
                                <span class="badge badge-pill" style="background-color: {{ $user->status === 'active' ? 'green' : ($user->status === 'passive' ? 'gray' : 'red') }}; color: white;">{{ $user->status }}</span>
                            </td>
                            <td style="padding: 15px;">
                                <i class="fas fa-edit" href="javascript:void(0)" style="cursor: pointer; color: orange;"
                                    onclick="showUserEdit({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->roles->first()->name }}', '{{ $user->status }}')">
                                </i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('frontend.admin.users.user-detail')

@include('frontend.admin.users.user-edit')

@endsection
