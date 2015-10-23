@extends('layouts.master')

@section('title')
  <title>Project 3</title>
@stop
 
@section('content')
  <hr>
  <h1>Lorem Ipsum Generator</h1>

  {!! Form::open(array('action' => 'IpsumController@showPost')) !!}
  {!! Form::label('How many paragraphs do you want?(Max:99)') !!}

  {!! Form::text('Size', '1', array('class' => 'ipsum')) !!}
  <br>
  {!! Form::submit('Generate') !!}
  {!! Form::close() !!}
  <hr>
@stop

@section('response')
  <br> 
  {!! isset($ipsum) ? $ipsum : '' !!}
@stop
 
