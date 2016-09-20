@extends('layouts.app')

@section('styles')
<style>
    #user-table { margin-bottom:20px; }
    #user-table_length, #user-table_info { padding-left:8px; }
    #user-table_filter, #user-table_paginate { padding-right:8px; }
</style>
@endsection

@section('content')
    <div class="primary-content" id="page-content">
        <h2 class="page-header mb30">All Users
            <span class="pull-right">
                <small><span style="text-transform:uppercase;font-size:70%;font-weight:700;"><i class="fa fa-users"></i> Total Users: <span class="font-weight:400">{{ $users->count() }}</span></span></small>
            </span>
        </h2>

        @include('layouts.partials.flash')      
        @include('admin.users.partials.menu')

        <div class="content-box">      

            <div class="row">
                <div class="user-heading text-left {{ getColumns(6) }}" style="padding-left: 30px;">
                    <p style="top: 46px;position: relative;"><strong>Users</strong></p>
                </div>
                <div class="user-actions text-right {{ getColumns(6) }}">
                    <ul class="breadcrumb" style="background:transparent;margin-bottom: 0px;padding-right:8px;">
                        <li><a href="" class="btn btn-link disabled" style="padding:0px;opacity: .4">Delete All</a></li>
                        <li><a href="" class="btn btn-link disabled" style="padding:0px;opacity: .4">Assign Role</a></li>
                        <li><a href="" class="btn btn-link disabled" style="padding:0px;opacity: .4">Assign Tag</a></li>
                </div>
            </div>
            
            <div class="table-responsive">
                <table id="user-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 30px;"></th>
                            <th style="width: 20px;padding-left: 10px;padding-right: 10px;"></th>
                            <th style="width: 40px;"></th>
                            <th></th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                            <tr id="{{ $user->id }}">
                                <td style="padding-top: 21px;text-align: center;"><input id="{{ $user->id }}" type="checkbox"></td>
                                <td style="padding-top: 20px;text-align: center;">
                                    {!! makeRoleLabel($user->getHighestRole()['name'], true) !!}
                                </td>
                                <td>
                                    {!! getUserImage($user->id, $user->img, $user->email, 45, 'float-left img-circle') !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}">
                                    {{ $user->first }} {{ $user->last }}</a> 
                                    <br/>
                                    <small>{{ $user->email }}</small>
                                </td>
                                <td class="text-right" style="padding-top: 15px;">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-success btn-sm"><i class="fa fa-globe"></i></a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('admin.users.edit.auth', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-lock"></i></a>
                                    <a href="{{ route('admin.users.edit.avatar', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user"></i></a>
                                    <a @click.prevent="confirmDelete({!! $user->id !!}, $event)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right plato-pagination">
                {{ $users->links() }}
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
            // SweetAlert -> Send the AJAX Call to Delete the User w/ Confirmation & Error States
            const userArchiveLimit = {!! Config::get('settings.user_archive_limit') !!}
            const adminURI = "{!! env('ADMIN_URI') !!}"
            
            const vm = new Vue({
                el: '#page-content',
                data: {
                    name: 'Vue.js'
                },
                // define methods under the `methods` object
                methods: {
                    confirmDelete: function (id, event) {
                        swal({
                            title: 'Are you sure?',
                            text: "The user, and their information, will be removed from the archive in " + userArchiveLimit + " days!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            confirmButtonClass: 'btn btn-success mr20',
                            cancelButtonClass: 'btn btn-danger',
                            buttonsStyling: false
                        })
                        .then(function() {

                            // Send the AJAX that deletes the user
                            Vue.http.delete('/' + adminURI + '/users/' + id, {}).then((response) => {

                                $('#' + id).hide();
                                swal({
                                    title: 'Archive Complete',
                                    text: "This user has been archived.",
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Got it!',
                                    confirmButtonClass: 'btn btn-success',
                                    buttonsStyling: false
                                })

                            }, (response) => {
                                console.log(response);
                                // error callback
                                swal(
                                    'Sorry!',
                                    'There was an error with your request!',
                                    'error'
                                )
                            });                            

                        }, function(dismiss) {
                        })
                    }
                }
            })

    </script>
@endsection