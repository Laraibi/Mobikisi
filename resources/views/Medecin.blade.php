@extends('layouts.admin')
<style>
    li img {
        height: 90px !important;
        width: 100px !important;
    }

</style>
@section('content')
    <div class="p-2">
        @if ($errors->any())
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur ! </strong> {{ $errors->first() }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <a href="#" id="btnModdal" class="btn btn-success col-1">Ajouter</a>
        </div>
        <div class="modal" tabindex="-1" id="addMedecinModal">
            <form action="/Medecin" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter Medecin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="inputFullName">Full Name :</label>
                                <input type="text" name="fullName" class="form-control" id="inputFullName"
                                    placeholder="Nom complet">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="inputSpecialite">Specialite :</label>
                                <select class="form-control" name="Specialite" id="inputSpecialite">
                                    <option value="Specialite_1">Specialite_1</option>
                                    <option value="Specialite_2">Specialite_2</option>
                                    <option value="Specialite_3">Specialite_3</option>
                                </select>
                            </div>
                            <div class="fprm-group">
                                <label class="form-label" for="sexe">Sexe :</label>
                                <div class="form-control" id="sexe">

                                    <div class="form-ckeck form-check-inline">
                                        <label class="form-check-label mr-2" for="inputSexeM">M :</label>
                                        <input type="radio" class="form-check-input" id="inputSexeM" value="1" name="sexe">
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label mr-2" for="inputSexeM">F :</label>
                                        <input type="radio" class="form-check-input" id="inputSexeF" value="2" name="sexe">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="inputDOB">Date de Naissance :</label>
                                <input type="date" name="DateOfBirth" class="form-control" id="inputDOB"
                                    placeholder="Date de naissance">
                            </div>

                            <div class="row text-center d-flex align-items-center justify-content-center" id="previewFile">
                                <div class="custom-file col-6 ">
                                    <input type="file" class="custom-file-input d-none" name="photo_path"
                                        id="inputGroupFile01">
                                    <button type="button" class="btn btn-secondary" id="browse"><i
                                            class="fas fa-file-upload"></i></button>
                                </div>
                                <div class="col-6">

                                    <img src="{{ asset('/storage/Images/Medecins_Photos/doc_default.png') }}" alt=""
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @isset($Medecins)
            <div class="row mt-2">
                <div class="card" id="doctorsList">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Medecins</h3>
                    </div>
                    <div class="card-body">
                        <ul class="users-list">
                            @foreach ($Medecins as $Medecin)
                                <li>
                                    <img src="{{ asset('/storage/Images/Medecins_Photos/' . $Medecin->photo_path) }}"
                                        alt="User Image">
                                    <a class="users-list-name" href="#">Dr.{{ $Medecin->fullName }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endisset
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btnModdal').click(function() {
                $('#addMedecinModal').modal('toggle');
            });
            $('.modal-footer .btn-secondary').click(function() {
                $('#addMedecinModal').modal('toggle');
            })

            $('#inputGroupFile01').change(function(input) {
                var file = $("input[type=file]").get(0).files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.onload = function() {
                        $("#previewFile img").attr("src", reader.result);
                    }

                    reader.readAsDataURL(file);
                }
            });
            $('#browse').click(function() {
                // e.preventDefault();
                $('#inputGroupFile01').click();
            });
        });

    </script>
@endsection
