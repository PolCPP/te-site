@extends('layouts.app')

@section('page-title')My students @endsection

@section('content')

<div class="container">
  <div class="row">
    <h1 class="page-title">My students</h1>
    <div class="v-container">
      <students-validation></students-validation>
    </div>
  </div>
</div>
@endsection
