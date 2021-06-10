@extends('layouts.app')
@section('content')
<img src="asset" alt="">
    <div class="row">
        <a href="#" id="btnModdal" class="btn btn-success">Ajouter</a>
    </div>
    <div class="row">
        <div class="modal" tabindex="-1" id="addMedecinModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($Medecins)
        <div class="row">
            @foreach ($Medecins as $Medecin)
                <div class="card col-4">
                    <ul>
                        <li>Name: Dr.{{ $Medecin->specialite }}</li>
                        <li>Specialite: {{ $Medecin->specialite }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endisset
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btnModdal').click(function() {
                $('#addMedecinModal').modal('toggle');
            });
        });

    </script>
@endsection
