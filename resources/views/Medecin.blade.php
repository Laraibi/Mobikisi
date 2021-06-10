@extends('layouts.app')
<style>
    .form-group {
        margin-bottom: 1em;
    }

    img {
        border-radius: 50% !important;
    }

    .col-3 {
        padding: 2px;
    }
    #browse{
        width: 50%;
        margin: 0 auto !important;
    }
    #previewFile img{
        height:300px;
        /* width:200px; */
    }

</style>
@section('content')
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="inputFullName">Full Name :</label>
                            <input type="text" name="fullName" class="form-control" id="inputFullName"
                                placeholder="Nom complet">
                        </div>
                        <div class="form-group">
                            <label class="form-label" class="form-label" for="inputSpecialite">Specialite :</label>
                            <select class="form-select" name="Specialite" id="inputSpecialite">
                                <option value="Specialite_1">Specialite_1</option>
                                <option value="Specialite_2">Specialite_2</option>
                                <option value="Specialite_3">Specialite_3</option>
                            </select>
                            {{-- <input type="text" name="medecinFN" class="form-control" id="inputSpecialite" placeholder="Nom complet"> --}}
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" class="form-label" for="inputSexeM">M :</label>
                            <input type="radio" class="form-check-input" id="inputSexeM" value="1" name="sexe">
                            <label class="form-check-label" for="inputSexeM">F :</label>
                            <input type="radio" class="form-check-input" id="inputSexeF" value="2" name="sexe">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="inputDOB">Date de Naissance :</label>
                            <input type="date" name="DateOfBirth" class="form-control" id="inputDOB"
                                placeholder="Date de naissance">
                        </div>
                  
                        <div class="row" id="previewFile">
                            <div class="custom-file col-6 text-center d-flex align-items-center justify-content-center">
                                <input type="file" class="custom-file-input d-none"  name="photo_path" id="inputGroupFile01">
                                <button type="button" class="btn btn-secondary" id="browse"><i class="bi bi-cloud-arrow-up" style="font-size: 5rem;"></i></button>
                            </div>
                            <img src="{{ asset('/storage/Images/Medecins_Photos/doc_default.png') }}" alt="" class="img col-6">
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
            @foreach ($Medecins as $Medecin)
                <div class="card col-2">
                    <img src="{{ asset('/storage/Images/Medecins_Photos/' . $Medecin->photo_path) }}"
                        class="card-img-top h-75" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Dr.{{ $Medecin->fullName }}</h5>
                        <a href="#" class="btn btn-primary">Profil</a>
                    </div>
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
            $('#browse').click(function(){
                // e.preventDefault();
                $('#inputGroupFile01').click();
            });
        });

    </script>
@endsection
