@extends('layouts.app')
<style>
    .form-group {
        margin-bottom: 1em;
    }
</style>
@section('content')
    <div class="row">
        <a href="#" id="btnModdal" class="btn btn-success">Ajouter</a>
    </div>
    <div class="modal" tabindex="-1" id="addMedecinModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter Medecin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="inputFullName">Full Name :</label>
                        <input type="text" name="medecinFN" class="form-control" id="inputFullName"
                            placeholder="Nom complet">
                    </div>
                    <div class="form-group">
                        <label class="form-label" class="form-label" for="inputSpecialite">Specialite :</label>
                        <select  class="form-select"  name="medecinSP" id="inputSpecialite">
                            <option value="Specialite_1">Specialite_1</option>
                            <option value="Specialite_2">Specialite_2</option>
                            <option value="Specialite_3">Specialite_3</option>
                        </select>
                        {{-- <input type="text" name="medecinFN" class="form-control" id="inputSpecialite" placeholder="Nom complet"> --}}
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" class="form-label" for="inputSexeM">M :</label>
                        <input type="radio" class="form-check-input" id="inputSexeM" value="1" name="medecinSexe">
                        <label class="form-check-label" for="inputSexeM">F :</label>
                        <input type="radio" class="form-check-input" id="inputSexeF" value="2" name="medecinSexe">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="inputDOB">Date de Naissance :</label>
                        <input type="date" name="medecinFN" class="form-control" id="inputDOB"
                            placeholder="Date de naissance">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="form-label" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
