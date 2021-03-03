@extends('layouts.vue-app', ['component' => 'foo'])

@section('content')
    <foo :prop="{{ $someVarFromController }}"></foo>
    <div>Some divish thing</div>
@endsection
