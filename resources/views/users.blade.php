@extends('layouts.master')

@section('title')
  <title>Project 3</title>
@stop
 
@section('content')
  <hr>
  <h1>Random User Generator</h1>

  {!! Form::open(array('action' => 'UsersController@showPost')) !!}
  {!! Form::label('How many users? (max:10)') !!}

  {!! Form::text('Size', '1', array('class' => 'ipsum')) !!}
  <br>
  {!! Form::checkbox('date', 'set') !!}
  {!! Form::label('Birthdate') !!}
  <br>
  {!! Form::checkbox('profile', 'set') !!}
  {!! Form::label('Profile') !!}
  <br>
  {!! Form::checkbox('password', 'set') !!}
  {!! Form::label('Password') !!}
  <br>
  {!! Form::submit('Generate') !!}
  {!! Form::close() !!}
  <hr>
@stop

@section('response')
  <br> 
  {!! isset($users) ? $users : '' !!}
  <br>
@stop
 
