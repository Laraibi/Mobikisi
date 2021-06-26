@extends('layouts.admin')
<style>
    li img {
        height: 90px !important;
        width: 100px !important;
    }

    .users-list>li {
        width: 10% !important;
        margin-right: 20px;
    }
</style>
@section('content')
<div class="px-5">
    @if($errors->any())
    <div class="d-none" id="errors">
        <ul>
            @foreach($errors->all() as $error )
            <li class="errorItem">{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @isset($successMsg)
    <div class="d-none" id="successMsg">
        <ul>
            <li class="successItem">{{$successMsg}}</li>            
        </ul>
    </div>
    @endif
    <div class="modal" tabindex="-1" id="addMedecinModal">
        <form action="/Medecin" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="inputMethodValue" value="POST" />
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
                                placeholder="Nom complet" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="inputSpecialite">Specialite :</label>
                            <select class="form-control" name="Specialite" id="inputSpecialite">
                                <option value="Specialite_1">
                                    Specialite_1
                                </option>
                                <option value="Specialite_2">
                                    Specialite_2
                                </option>
                                <option value="Specialite_3">
                                    Specialite_3
                                </option>
                            </select>
                        </div>
                        <div class="fprm-group">
                            <label class="form-label" for="sexe">Sexe :</label>
                            <div class="form-control" id="sexe">
                                <div class="form-ckeck form-check-inline">
                                    <label class="form-check-label mr-2" for="inputSexeM">M :</label>
                                    <input type="radio" class="form-check-input" id="inputSexeM" value="1"
                                        name="sexe" />
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label mr-2" for="inputSexeM">F :</label>
                                    <input type="radio" class="form-check-input" id="inputSexeF" value="2"
                                        name="sexe" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="inputDOB">Date de Naissance :</label>
                            <input type="date" name="DateOfBirth" class="form-control" id="inputDOB"
                                placeholder="Date de naissance" />
                        </div>
                        <div class="
                                row
                                text-center
                                d-flex
                                align-items-center
                                justify-content-center
                            " id="previewFile">
                            <div class="custom-file col-6">
                                <input type="file" class="custom-file-input d-none" name="photo_path"
                                    id="inputGroupFile01" />
                                <button type="button" class="btn btn-secondary" id="browse">
                                    <i class="fas fa-file-upload"></i>
                                </button>
                            </div>
                            <div class="col-6">
                                <img src="{{
                                        asset(
                                            '/storage/Images/Medecins_Photos/doc_default.jpg'
                                        )
                                    }}" alt="" class="img-fluid rounded hover-shadow" id="imgMedecin" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @isset($Medecins)
    <div class="row mt-2">
        <div class="card w-100" id="doctorsList">
            <div class="card-header">
                <h3 class="card-title">Liste des Medecins</h3>
                <div class="card-tools">
                    <button href="#" id="btnModdal" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul class="users-list">
                    @foreach($Medecins as $Medecin)
                    <li class="">
                        <button type="button" class="
                                btnDeleteMedecin
                                text-red
                                close
                                d-none
                                position-absolute
                            " aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img src="{{ asset('/storage/Images/Medecins_Photos/' . $Medecin->photo_path) }}"
                            alt="User Image" class="hover-shadow" />
                        <a class="users-list-name" data="{{ $Medecin->id }}" href="#">Dr.{{ $Medecin->fullName }}
                        </a>
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
    $(document).ready(function () {
        makeNavLinkActive(0);
        $('.errorItem').each(function(){
            let msg=$(this).text();
            $(document).Toasts("create", {
                        title: "Mobikisi",
                        body: msg,
                        autohide: true,
                        delay: 2000,
                        class: "bg-danger",
                    });
        });
        $('.successItem').each(function(){
            let msg=$(this).text();
            $(document).Toasts("create", {
                        title: "Mobikisi",
                        body: msg,
                        autohide: true,
                        delay: 2000,
                        class: "bg-success",
                    });
        });
        $(".users-list li")
            .mouseenter(function () {
                $(this).find("button.close").removeClass("d-none");
            })
            .mouseleave(function () {
                $(this).find("button.close").addClass("d-none");
            });
        $("#btnModdal").click(function () {
            $("#addMedecinModal").modal("toggle");
        });
        $(".modal-footer .btn-secondary").click(function () {
            $("#addMedecinModal").modal("toggle");
        });
        $("#inputGroupFile01").change(function (input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#previewFile img").attr("src", reader.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("#browse").click(function () {
            $("#inputGroupFile01").click();
        });
        $("a.users-list-name").click(function () {
            $.ajax({
                url: "/Medecin/" + $(this).attr("data"),
                type: "get",
                dataType: "json",
                success: (data) => {
                    $(".modal form").attr({
                        action: "/Medecin/" + data.id,
                    });
                    $(".modal form #inputMethodValue").val("PUT");
                    $(".modal .btn-primary")
                        .removeClass("btn-primary")
                        .addClass("btn-warning");
                    $("#inputFullName").val(data.fullName);
                    $("#inputSpecialite").val(data.Specialite);
                    $("#inputDOB").val(data.DateOfBirth);
                    $("input:radio[name=sexe][value=" + data.sexe + "]").prop(
                        "checked",
                        true
                    );
                    $("#imgMedecin").attr(
                        "src",
                        "/storage/Images/Medecins_Photos/" + data.photo_path
                    );
                    $("#addMedecinModal").modal("toggle");
                },
            });
        });
        $(".btnDeleteMedecin").click(function () {
            let MedecinId = $(this)
                .parent()
                .find("a.users-list-name")
                .attr("data");
            // alert(MedecinId);
            $.ajax({
                url: "/Medecin/" + MedecinId,
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                },
                type: "DELETE",
                success: (data) => {
                    console.log("deleted");
                    $(this).parent().fadeOut(2000);
                    $(document).Toasts("create", {
                        title: "Mobikisi",
                        body: "Medecin supprimé",
                        autohide: true,
                        delay: 2000,
                        class: "bg-danger",
                    });
                },
                error: (error) => {
                    console.log(error);
                },
            });
        });
    });

</script>
@endsection