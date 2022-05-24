@extends('layouts.app')
@section('content')
<checkout :cart="{{ json_encode($datax) }}" :user="{{ Auth::user()??'' }}" :address='{{ json_encode($address) }}'></checkout>
@endsection
