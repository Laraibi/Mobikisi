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
    <div class="row">
        <button class="btn btn-success" id="addPatient">Ajouter</button>
    </div>
    <div class="modal modal-dialog modal-lg" tabindex="-1" id="addPatientModal">
        <div class="modal-content">
            <form action="/Patient" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="POST" id="inputMethodValue">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter Patient</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group d-none" id="FG_PatientGID">
                                <label for="inputPatientGID">Generated ID :</label>
                                <input type="text" class="form-control" readonly disabled id="inputPatientGID" />
                            </div>
                            <div class="form-group">
                                <label for="inputPatientFN">Full Name :</label>
                                <input type="text" class="form-control" name="fullName" id="inputPatientFN" />
                            </div>
                            <div class="form-group">
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
                            <div class="row text-center d-flex align-items-center justify-content-center "
                                id="previewFile">
                                <div class="custom-file col-6">
                                    <input type="file" class="custom-file-input d-none" name="photo_path"
                                        id="inputGroupFile01" />
                                    <button type="button" class="btn btn-secondary" id="browse">
                                        <i class="fas fa-file-upload"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <img src="{{asset('/storage/Images/Patients_Photos/pat_default.png')}}" alt=""
                                        class="img-fluid rounded hover-shadow" id="imgMedecin" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="customRange1">Poids <small>(kg)</small>:</label>
                                <input type="range" min="30" max="200" class="custom-range" id="inputWeightRange"
                                    wtx-context="E3A568E7-7021-4E82-B4AD-1A14D4A8E32B">
                                <input name="weight_kg" type="text" class="form-control" id="inputWeight" value="115"
                                    wtx-context="E3A568E7-7021-4E82-B4AD-1A14D4A8E32B">
                            </div>
                            <div class="form-group">
                                <label for="customRange1">Taille <small>(cm)</small> :</label>
                                <input type="range" min="100" max="200" class="custom-range custom-teal"
                                    id="inputHeightRange" wtx-context="E3A568E7-7021-4E82-B4AD-1A14D4A8E32B">
                                <input name="height_cm" type="text" class="form-control" id="inputHeight" value="150"
                                    wtx-context="E3A568E7-7021-4E82-B4AD-1A14D4A8E32B">
                            </div>
                            <div class="form-group">
                                <label>Groupe Sanguin</label>
                                <select name="grpSanguin" multiple="" id="SelectGrpSanguin" class="custom-select"
                                    wtx-context="FDE32BE7-8072-4DAF-BB5E-C3838BC8577D">
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPatientFN">Mutuelle :</label>
                                <input name="Mutuelle" type="text" class="form-control" id="inputPatientMutuelle" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    @isset($Patients)
    <div class="row mt-2">
        <div class="card w-100" id="doctorsList">
            <div class="card-header">
                <h3 class="card-title">Liste des Patients</h3>
            </div>
            <div class="card-body">
                <ul class="users-list">
                    @foreach($Patients as $Patient)
                    <li class="">
                        <button type="button" class="
                                btnDeletePatient
                                text-red
                                close
                                d-none
                                position-absolute
                            " aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img src="{{ asset('/storage/Images/Patients_Photos/' . $Patient->photo_path) }}"
                            alt="User Image" class="hover-shadow" />
                        <a class="users-list-name" data="{{ $Patient->id }}" href="#">Dr.{{ $Patient->fullName }}
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
    $("document").ready(function () {
        $('.errorItem').each(function () {
            let msg = $(this).text();
            $(document).Toasts("create", {
                title: "Mobikisi",
                body: msg,
                autohide: true,
                delay: 2000,
                class: "bg-danger",
            });
        });
        $('.successItem').each(function () {
            let msg = $(this).text();
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
        $(".btn#addPatient").click(() => {
            $(".modal").modal("toggle");
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
        $('.custom-range').change(function () {
            // console.log();
            let val = $(this).val();
            $(this).next().val($(this).val());
        });
        $('a.users-list-name').click(function () {
            let PatientID = $(this).attr('data');
            $.ajax({
                url: '/Patient/' + PatientID,
                type: 'get',
                dataType: 'json',
                success: (data) => {
                    // console.log(data);
                    $(".modal form").attr({
                        action: "/Patient/" + data.id,
                    });
                    $(".modal form #inputMethodValue").val("PUT");
                    $(".modal .btn-primary")
                        .removeClass("btn-primary")
                        .addClass("btn-warning");
                    $("#inputPatientFN").val(data.fullName);
                    $("#inputDOB").val(data.DateOfBirth);
                    $("input:radio[name=sexe][value=" + data.sexe + "]").prop(
                        "checked",
                        true
                    );
                    $("#imgMedecin").attr(
                        "src",
                        "/storage/Images/Patients_Photos/" + data.photo_path
                    );
                    $('#inputWeight').val(data.weight_kg);
                    $('#inputWeightRange').val(data.weight_kg);
                    $('#inputHeight').val(data.height_cm);
                    $('#inputHeightRange').val(data.height_cm);
                    $('#SelectGrpSanguin').val(data.grpSanguin);
                    $('#inputPatientMutuelle').val(data.Mutuelle);
                    let GID = data.sexe.toString() + '-' + data.DateOfBirth.toString() + '-' + pad(data.id,6);
                    $('#inputPatientGID').val(GID);
                    $('#FG_PatientGID').removeClass('d-none');

                    $("#addPatientModal").modal("toggle");
                }
            });
        });
        $(".btnDeletePatient").click(function () {
            let PatientId = $(this)
                .parent()
                .find("a.users-list-name")
                .attr("data");
            // alert(MedecinId);
            $.ajax({
                url: "/Patient/" + PatientId,
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                },
                type: "DELETE",
                success: (data) => {
                    // console.log("deleted");
                    $(this).parent().fadeOut(2000);
                    $(document).Toasts("create", {
                        title: "Mobikisi",
                        body: "Patient supprimé",
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
    function pad(num, size) {
        num = num.toString();
        while (num.length < size) num = "0" + num;
        return num;
    }
</script>
@endsection