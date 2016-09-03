@extends('layouts.app')

@section('content')

	@foreach($branches as $branch)
	{
		{{ $branch }}
	}
	@endforeach

@endsection