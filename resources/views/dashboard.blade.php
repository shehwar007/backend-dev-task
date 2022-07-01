@extends('layouts.app')
@section('PageTitle', 'Dashboard')
@push('mycss')
<!--here is you css-->
@endpush

<!--here is content-->
@section('page_content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h1>Welcome {{session('AdminData')['admin_name']}}</h1> <br> 
                 <h2>Role:{{session('AdminData')['admin_role']}}</h2>

            </div>
        </div>
    </div>
</div>

@endsection
@push('myscript')
<!--here is your js-->
@endpush