@extends('layouts.app')

@section('content')
<div class="container">

Send your message to {{$user->username}} they wont know you are the one
    <form action="{{route('postMessage', $user->id)}}" method="post">
    @csrf
    <div class="form-group">
    <textarea name="message" class="form-control" cols="30" rows="10"> </textarea>
    @error('message')
<div class="alert alert-danger">{{$message}}</div>
@enderror
    <button class="btn btn-success" type="submit">Submit</button>
    </form>
    </div>
    </div>
@endsection