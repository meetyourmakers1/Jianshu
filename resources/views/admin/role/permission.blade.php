@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">权限列表</h3>
                        </div>
                        <div class="box-body">
                            <form action="/admin/role/permission/{{$role->id}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    @foreach($permissions as $permission)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="permissions[]"
                                                       @if($rolePermissions->contains($permission))
                                                        checked
                                                       @endif
                                                       value="{{$permission->id}}">
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection