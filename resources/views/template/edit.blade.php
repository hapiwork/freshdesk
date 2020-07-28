@extends('layouts.default')

@section('content')
<div class="col-md-10">
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
        {{{ Session::get('message') }}}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
        {{{ Session::get('error') }}}
        </div>
    @endif

    <form action="/freshdesk/template/{{ $template->id }}" method="post"> 
        @method('PUT')
        @csrf
        <input type="hidden" name="user_id" value="{{ $template->user_id }}" />
        <div class="form-group">
            <label>Tên mẫu tin</label>
            <input required name="title" class="form-control" placeholder="Tên mẫu" value="{{ $template->title }}"/>
        </div>
        <div class="form-group">
            <textarea id="summernote" name="content" rows="5">{{ $template->content }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Sử dụng toàn hệ thống</label>
                    <select class="form-control" name="is_global">
                        <option value="0"  {{  $template->is_global ? '' : 'select'  }} >Không</option>
                        <option value="1"  {{  $template->is_global ? 'selected' : ''  }} >Có</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-info" type="submit">Lưu</button>
        </div>
    <form>
@endsection


@section('footer')
<script src="https://cdn.tiny.cloud/1/fekq8uwyab1i0apchinfnjrcivkbgmr8u4onti4gkegc3r3j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
$(document).ready(function() {
    tinymce.init({
        selector: '#summernote',
        height: 350,
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code',
        'insertdatetime media table paste code help wordcount textcolor table'
        ],
        toolbar:
        'undo redo | formatselect | bold italic forecolor | \
        alignleft aligncenter alignright alignjustify | \
        bullist numlist outdent indent code  | \
        table | tableprops ',
        content_style: `body { font-family: "Times New Roman"; }
            p, h1, h2, h3, h4, h5 {
            margin-bottom: 0;
            margin-top: 5px;
            }
            ul, table {
            margin-top: 8px;
            margin-bottom: 8px;
        }`
    });
});
</script>
@endsection

@section('breadcrumb')

<div class="page-title">
    <h3>Chỉnh sửa Mẫu tin: {{ $template->title }}</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li>Tạo mẫu tin mới</li>
        </ol>
    </div>
</div>

@stop
