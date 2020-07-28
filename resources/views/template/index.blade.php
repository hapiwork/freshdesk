@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {!! Session::get('message') !!}
            </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                {{{ Session::get('error') }}}
                </div>
            @endif

        </div>

        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Danh sách mẫu tin</h4>
                </div>
                <div class="panel-body">

                    <a href="/freshdesk/template/create" class="btn btn-info">Tạo mẫu tin mới</a>
                    <br>
                    
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($templates))
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><span style="text-transform: uppercase">Stt</span></th>
                                            <th style="text-align: center"><span style="text-transform: uppercase">Tên mẫu tin</span></th>
                                            <th><span style="text-transform: uppercase">Loại mẫu tin</span></th>
                                            <th><span style="text-transform: uppercase">Người tạo</span></th>
                                            <th><span style="text-transform: uppercase">Lần cập nhật cuối</span></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($templates as $template)
                                        <tr>

                                            <th scope="row">{{ $i }}</th>
                                            <th>{{ $template->title }}</th>
                                            <th>{{ $template->is_global ? 'Hệ thống' : 'Cá nhân' }}</th>
                                            <th>{{ $template->user->first_name }}, {{ $template->user->last_name }} </th>
                                            <th>{{ $template->updated_at }}</th>
                                            <th>
                                                <a href="{{ URL::to('freshdesk/template/'.$template->id) }}">Xem </a>&nbsp;
                                                
                                                @if($template->user_id == auth()->id())
                                                <a href="{{ URL::to('freshdesk/template/'.$template->id.'/edit') }}">Chỉnh sửa</a>
                                                <form onSubmit="return confirm('Bạn có chắc là bạn muốn xóa hay không?');" action="/freshdesk/template/{{ $template->id }}" method="post" class="display-inline" />
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="display-inline"
                                                        style="border: none;
                                                        background: none;
                                                        color: #607D8B;
                                                        ">Xóa</button>
                                                </form>
                                                @endif
                                            </th>
                                        </tr>
                                        <?php $i++; ?>
                                        @endforeach

                                    </tbody>
                                </table>

                            @else 
                                <p>Chưa có mẫu tin nào</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('breadcrumb')

<div class="page-title">
    <h3>Mẫu tin</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li>Danh sách Mẫu tin</li>
        </ol>
    </div>
</div>

@stop