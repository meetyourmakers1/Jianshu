@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">增加权限</h3>
                            </div>
                            <form role="form" action="/admin/permission/create" method="POST">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label >权限名</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>描述</label>
                                        <input type="text" class="form-control" name="description">
                                    </div>
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