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

        <div style="padding: 15px 10px;">
            <p>Loại mẫu tin: <span style="font-weight: bold;">{{ $template->is_global ? 'Hệ thống' : 'Cá nhân' }}</span></p>
        </div>
        <div style="background: white; padding: 15px 10px;">
            {!! $template->content !!}
        </div>
        <div style="padding: 15px 10px;">
            <p><a href="{{ url('freshdesk/template') }}">Trở về danh sách mẫu tin</a></p>
        </div>
</div>
@endsection


@section('footer')

@endsection

@section('breadcrumb')

<div class="page-title">
    <h3>Mẫu tin: {{ $template->title }}</h3>
</div>

@stop
