@extends('layouts.admin')
@section('content')
<div class="px-5">
    <div class="row">
        <h2>Dossier Medical</h2>
    </div>
    <div class="row">
        <div class="col-6">
            <input type="text" name="PatientName" id="InputPatientName" class="form-control" placeholder="Nom du Patient">
        </div>
        <div class="col-2">
            <button class="btn btn-success">Chercher</button>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        // alert('hello Blade');
    });
</script>
@endsection