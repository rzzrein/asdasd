@extends('backend.layouts.app', ['title' => 'Permission Matrix', 'menu' => '', 'breadcrumbs' => [
	'Permission Matrix' => route('admin.permission-roles.index')
]])

@section('content')
<div class="content-wrapper" id="permission-role-page">

	<div class="content">
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer table-hover" id="permission-role-datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data="name" name="name">Role</th>
                                        <th data="description" name="description">Display</th>
                                        @foreach ($role as $r)
                                        <th orderable="false" searchable="false" data="{{ \Str::slug($r->display_name) }}" name="{{ \Str::slug($r->display_name) }}">{{ $r->display_name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permission as $p)
                                    <tr>
                                        <th style="width:80px;">{{ $p->name }}</th>
                                        <th style="width:80px;">{{ $p->display_name }}</th>
                                        @foreach ($role as $r)
                                        <td>
                                            <input data-size="mini" class="w-30px h-20px" type="checkbox" {{ (isset($permissionRole[$p->id.'-'.$r->id])) ? 'checked' : '' }} id="kt_user_menu_dark_mode_toggle" data-permission_id="{{$p->id}}" data-role_id="{{$r->id}}">
                                        </td> 
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection