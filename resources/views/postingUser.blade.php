@extends('templatePost')

@section('title','Dashboard User')

@section('content')

<h3 class="fw-bold mb-4">Dashboard</h3>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card card-stat p-4">
            <h6 class="text-muted">Total Postingan</h6>
            <h2 class="fw-bold">12</h2>
            <i class="fa-solid fa-newspaper fa-2x text-primary"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stat p-4">
            <h6 class="text-muted">Postingan Publish</h6>
            <h2 class="fw-bold">8</h2>
            <i class="fa-solid fa-check fa-2x text-success"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stat p-4">
            <h6 class="text-muted">Draft</h6>
            <h2 class="fw-bold">4</h2>
            <i class="fa-solid fa-file fa-2x text-warning"></i>
        </div>
    </div>

</div>

@endsection
