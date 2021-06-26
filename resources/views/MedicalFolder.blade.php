@extends('layouts.admin')
<style>
    #searchResponseArea {
        position: relative;
        margin: 0 !important;
        /* padding: 0 !important; */
    }

    form {
        margin: 0 !important;
        /* padding: 0 !important; */
    }

    ul#patientMatchedList {
        list-style: none;
        width: 100%;
        position: absolute;
        z-index: 9009;
        width: 60%;
        /* top: 0px; */
    }

    ul#patientMatchedList li {
        /* border-right:solid 1px;
        border-left:solid 1px;
        border-bottom:solid 1px;
        padding:2px;
         width: 100%; */
        cursor: pointer;
    }

    ul#patientMatchedList li:hover {
        background-color: rgb(98, 152, 202);
    }

    #imgProfile {
        margin: 5px;
        max-width: 80%;
        max-height: 80%;
        border-radius: 50%;
    }

    #gid {
        white-space: nowrap;
    }

    #profileSection .row .col-6:nth-child(2) {
        padding: 10% 2%;
        text-align: center;
    }

    ul {
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
    }

    #infosSection ul li {
        /* margin: 5px; */
    }

    .card-title {
        font-weight: bold !important;
        font-size: 0.9rem !important;
    }

    .card i:not(.fa-trash) {
        margin-right: 1rem;
        background-color: #BC0C37;
        border-radius: 20%;
        color: white;
        padding: 10px;
        width: 50px;
        text-align: center;
    }

    .fa-trash {
        cursor: pointer;
    }

    .card-header {
        padding-bottom: 0 !important;
    }

    .card.panel {
        /* height: 100%; */
    }

    .phoneNumber {
        font-size: 1rem;
        /* float: right; */
        margin-left: 0.5rem;
    }

    .fa-phone-volume {
        margin-right: 0px !important;
        float: right;
        /* top: 10%; */
        position: relative;
        top: 10px;
    }

    .btn-link {
        text-decoration: none;
    }

</style>
@section('content')
    <div class="">
        @if ($errors->any())
            <div class="d-none" id="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="errorItem">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @isset($successMsg)
            <div class="d-none" id="successMsg">
                <ul>
                    <li class="successItem">{{ $successMsg }}</li>
                </ul>
            </div>
        @endisset
        <div class="row">
            <h2 class="col-6">Dossier Medical</h2>
        </div>
        <form action="{{ route('getMedicalFolder') }}" method="post">
            <div class="row m-0">
                <div class="col-6">
                    <!-- <input type="hidden" value="" id="inputHiddenID"/> -->
                    @csrf
                    <input type="text" name="PatientFN" id="InputPatientName" class="form-control"
                        placeholder="Nom du Patient">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success" id="btnSearch">Chercher</button>
                </div>
            </div>
        </form>
        <div class="row" id="searchResponseArea">
            <ul class="col-6" id="patientMatchedList">

            </ul>
        </div>
    </div>
    @isset($Patient)
        <div class="row my-2">
            <div class="col-md-4 col-xs-12 " id="profileSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-alt"></i>Profile</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <img id="imgProfile"
                                    src="{{ asset('/storage/Images/Patients_Photos/' . $Patient->photo_path) }}"
                                    alt="User Image" class="image-fluid" />
                            </div>
                            <div class="col-6 ">
                                <h3 class="h3 font-weight-bold">{{ $Patient->fullName }}</h3>
                                <small id="gid" class="text-secondary">Numéro id:{{ $Patient->getGID() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12" id="infosSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info"></i>Informations Générales</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li class="font-weight-bold"><small
                                    class="font-weight-none text-secondary mx-2">Sexe:</small>{{ $Patient->Sexe == 1 ? 'Masculin' : 'Féminin' }}
                            </li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Date de
                                    Naissance:</small>{{ $Patient->DateOfBirth }}</li>
                            <li class="font-weight-bold"><small
                                    class="font-weight-none text-secondary mx-2">Poids:</small>{{ $Patient->weight_kg }} kg
                            </li>
                            <li class="font-weight-bold"><small
                                    class="font-weight-none text-secondary mx-2">Taille:</small>{{ $Patient->height_cm }} cm
                            </li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Groupe
                                    sanguin:</small>{{ $Patient->grpSanguin }}</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Mutuelle ou
                                    assurance:</small>{{ $Patient->Mutuelle }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12" id="contactsSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-address-card"></i>Contacts d'urgence</h3>
                    </div>
                    <div class="card-body">
                        <ul id="ContactUrgenceList">
                            @foreach ($Patient->ContactsUrgence as $Contact)
                                <li class="font-weight-bold">
                                    <i class="fas fa-phone-volume font-size-5 "></i>
                                    <div class="row">
                                        <small class="text-secondary">{{ $Contact->TypeContact }}</small>
                                    </div>
                                    <div class="row">
                                        <h6 class="font-weight-bold d-inline w-40">{{ $Contact->FullName }}</h6>
                                        <h6 class="d-inline phoneNumber">{{ $Contact->PhoneNumber }}</h6>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <i class="btn fas fa-user-plus" id="addContactUrgence"></i>
                        <div class="modal" id="modalAddContactUrgence" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Contact d'Urgence</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="patient-id" id="patient_id" value="{{ $Patient->id }}">
                                        <div class="form-group">
                                            <label for="ContactFullName">Full Name:</label>
                                            <input type="text" name="ContactFullName" id="ContactFullName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="ContactType">Contact Type:</label>
                                            <input type="text" name="ContactType" id="ContactType" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="ContactPhoneNumer">Tel</label>
                                            <input type="text" name="ContactPhoneNumer" id="ContactPhoneNumer"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-4 col-xs-12" id="AllergiesSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-virus"></i>Allergies & intolérances renseignées</h3>
                    </div>
                    <div class="card-body  ">
                        <div id="AllergieList" class="accordion mx-2">
                            @foreach ($Patient->Allergies as $Allergie)
                                <div class="card">
                                    <div class="card-header py-0" id="headingTwo_{{ $Allergie->id }}">
                                        <h2 class="mb-0">
                                            <small class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="#collapseTwo_{{ $Allergie->id }}" aria-expanded="false"
                                                aria-controls="collapseTwo_{{ $Allergie->id }}">
                                                {{ $Allergie->AllergieName }} </small>

                                        </h2>
                                    </div>
                                    <div class="collapse" id="collapseTwo_{{ $Allergie->id }}"
                                        aria-labelledby="headingTwo_{{ $Allergie->id }}" data-parent="#AllergieList">
                                        <div class="card-body">
                                            <p>
                                                {{ $Allergie->Solution }}
                                            </p>
                                            <i class="fas fa-trash text-danger text-bold float-right deleteAllergie"
                                                Allergie-id="{{ $Allergie->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <i class="btn fas fa-plus" id="addAllergieBtn"></i>
                        <div class="modal" id="modalAddAllergie" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Allergie</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="patient-id" id="patient_id" value="{{ $Patient->id }}">
                                        <div class="form-group">
                                            <label for="AllergieName">Allergie Name:</label>
                                            <input type="text" name="AllergieName" id="AllergieName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="AllergieSolution">Solution:</label>
                                            <textarea type="textarea" name="AllergieSolution" id="AllergieSolution"
                                                class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Pathologie --}}
            <div class="col-md-4 col-xs-12" id="PathologiesSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-disease"></i>Pathologies renseignées</h3>
                    </div>
                    <div class="card-body">
                        <div id="PathologieList" class="accordion mx-2">
                            @foreach ($Patient->Pathologies as $Pathologie)
                                <div class="card">
                                    <div class="card-header py-0" id="headingTwo_{{ $Pathologie->id }}">
                                        <h2 class="mb-0">
                                            <small class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="#collapseTwo_{{ $Pathologie->id }}" aria-expanded="false"
                                                aria-controls="collapseTwo_{{ $Pathologie->id }}">
                                                {{ $Pathologie->Name }} </small>

                                        </h2>
                                    </div>
                                    <div class="collapse" id="collapseTwo_{{ $Pathologie->id }}"
                                        aria-labelledby="headingTwo_{{ $Pathologie->id }}" data-parent="#PathologieList">
                                        <div class="card-body">
                                            <p>
                                                {{ $Pathologie->solution }}
                                            </p>
                                            <i class="fas fa-trash text-danger text-bold float-right deleteAllergie"
                                                Pathologie-id="{{ $Pathologie->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <i class="btn fas fa-plus" id="addPathologieeBtn"></i>
                        <div class="modal" id="modalAddPathologie" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Pathologie</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="patient-id" id="patient_id" value="{{ $Patient->id }}">
                                        <div class="form-group">
                                            <label for="PathologieName">Pathologie Name:</label>
                                            <input type="text" name="PathologieName" id="PathologieName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="PathologieSolution">Solution:</label>
                                            <textarea type="textarea" name="PathologieSolution" id="PathologieSolution"
                                                class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Pathologie --}}
            {{-- Traitements --}}
            <div class="col-md-4 col-xs-12" id="TraitementsSection">
                <div class="card panel">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pills"></i>Traitements renseignées</h3>
                    </div>
                    <div class="card-body  ">
                        <div id="TraitementsList" class="accordion mx-2">
                            @foreach ($Patient->Traitements as $Traitement)
                                <div class="card">
                                    <div class="card-header py-0" id="headingTwo_{{ $Traitement->id }}">
                                        <h6> <small class="text-small text-secondary float-right font-"> Depuis Le :
                                                {{ $Traitement->Date_Debut }}</small></h6>
                                        <h2 class="mb-0">
                                            <small class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="#collapseTwo_{{ $Traitement->id }}" aria-expanded="false"
                                                aria-controls="collapseTwo_{{ $Traitement->id }}">
                                                {{ $Traitement->Nom_Medicament }} </small>
                                        </h2>
                                    </div>
                                    <div class="collapse" id="collapseTwo_{{ $Traitement->id }}"
                                        aria-labelledby="headingTwo_{{ $Traitement->id }}" data-parent="#TraitementsList">
                                        <div class="card-body">
                                            <p>
                                                Durée du traitement : <strong>{{ $Traitement->duree }} jours</strong>
                                            </p>
                                            <p class="float-right">
                                                <i class="fas fa-trash text-danger text-bold   btn btn-sm deleteTraitement"
                                                    Traitement-id="{{ $Traitement->id }}"></i>
                                                <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                    data-target="#OrdonnanceModal_{{ $Traitement->id }}">Voir Ordonnance</a>
                                                <!-- Modal -->
                                            <div class="modal fade" id="OrdonnanceModal_{{ $Traitement->id }}" tabindex="-1"
                                                aria-labelledby="OrdonnanceModal_{{ $Traitement->id }}_Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="OrdonnanceModal_{{ $Traitement->id }}_Label">Ordonnance
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img class="img-fluid rounded"
                                                                src="{{ asset('/storage/Images/Ordonnances/' . $Traitement->ordonnance_path) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <i class="btn fas fa-plus" id="addTraitementBtn"></i>
                        <div class="modal" id="modalAddTraitement" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter Traitement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="TraitementForm" enctype="multipart/form-data">
                                            <input type="hidden" name="patient-id" id="patient_id"
                                                value="{{ $Patient->id }}">
                                            <div class="form-group">
                                                <label for="TraitementName">Nom Medicament:</label>
                                                <input type="text" placeholder="Depakine, Ventoline ..." name="TraitementName"
                                                    id="TraitementName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="TraitementStartDate"> Date Debut:</label>
                                                <input type="date" name="TraitementStartDate" class="form-control"
                                                    id="TraitementStartDate" placeholder="Date Debut" />
                                            </div>
                                            <div class="form-group">
                                                <label for="TraitmentDurationDays">Duree en jours:</label>
                                                <input type="number" name="TraitmentDurationDays" class="form-control"
                                                    id="TraitmentDurationDays" placeholder="Duree(j)" />
                                            </div>
                                            <div class="row text-center d-flex align-items-center justify-content-center "
                                                id="previewFile">
                                                <div class="custom-file col-6">
                                                    <h5>Ordonannce</h5>
                                                    <input type="file" class="custom-file-input d-none" name="OrdonnanceImage"
                                                        id="inputGroupFile01" />
                                                    <button type="button" class="btn" id="browse">
                                                        <i class="fas fa-file-upload"></i>
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <img src="{{ asset('/storage/Images/Ordonnances/Ordonnance_Default.jpg') }}"
                                                        alt="" class="img-fluid rounded hover-shadow" id="imgMedecin" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Traitements --}}
        </div>
    @endisset
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            makeNavLinkActive(2);
            $('#InputPatientName').keyup(function() {
                let SearchQuery = $('#InputPatientName').val();
                if (SearchQuery) {
                    $.ajax({
                        // url:'/SearchPatients',
                        url: '/SearchPatients/' + SearchQuery,
                        type: 'get',
                        data: {
                            _token: $("meta[name=csrf-token]").attr("content"),
                            // 'query':SearchQuery,
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#patientMatchedList').empty();
                            $('#searchResponseArea').removeClass('d-none');
                            for (Patient in data) {
                                $('#patientMatchedList').append('<li class="form-control">' +
                                    data[Patient].fullName + '</li>');
                            }
                        }
                    })
                }
            });
            $('ul#patientMatchedList').on('click', 'li', function() {
                $('#InputPatientName').val($(this).text());
                $('#searchResponseArea').addClass('d-none');
            });
            // add Contact urgence handling
            $('#addContactUrgence').click(function() {
                $('#modalAddContactUrgence').modal('toggle');
            });
            $('#modalAddContactUrgence .btn-primary').click(function() {
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'patient_id': $('#patient_id').val(),
                    'ContactFullName': $('#ContactFullName').val(),
                    'ContactType': $('#ContactType').val(),
                    'ContactPhoneNumer': $('#ContactPhoneNumer').val()
                };
                $.ajax({
                    url: '/addContactUrgence',
                    type: 'post',
                    data: formdata,
                    dataType: 'json',
                    error: (error) => {
                        console.log(error);
                    },
                    success: (data) => {
                        console.log(data);
                        let trDom = $(`<li class="font-weight-bold">
                                                                    <i class="fas fa-phone-volume font-size-5 "></i>
                                                                    <div class="row">
                                                                        <small class="text-secondary"></small>
                                                                    </div>
                                                                    <div class="row">
                                                                        <h6 class="font-weight-bold d-inline w-40"></h6>
                                                                        <h6 class="d-inline phoneNumber"></h6>
                                                                    </div>
                                                                </li>`);
                        $(trDom).find('small').text(data.TypeContact);
                        $(trDom).find('h6').eq(0).text(data.FullName);
                        $(trDom).find('h6').eq(1).text(data.PhoneNumber);
                        $('ul#ContactUrgenceList').append(trDom);
                        $('#modalAddContactUrgence').modal('toggle');
                    }
                });
            });
            // add Allergie Handling
            $('#addAllergieBtn').click(function() {
                $('#modalAddAllergie').modal('toggle');
            });
            $('#modalAddAllergie .btn-primary').click(function() {
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'patient_id': $('#patient_id').val(),
                    'AllergieName': $('#AllergieName').val(),
                    'AllergieSolution': $('#AllergieSolution').val(),
                };
                $.ajax({
                    url: '/addAllergie',
                    type: 'post',
                    data: formdata,
                    dataType: 'json',
                    error: (error) => {
                        console.log(error.responseText);
                    },
                    success: (data) => {
                        // console.log(data);
                        let trDom = $(`   <div class="card">
                                    <div class="card-header" id="">
                                        <h2 class="mb-0">
                                            <button class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="" aria-expanded="false"
                                                aria-controls="">/button>
                                        </h2>
                                    </div>
                                    <div class="collapse" id=""
                                        aria-labelledby="" data-parent="#AllergieList">
                                        <div class="card-body">
                                            <p></p>
                                            <i class="fas fa-trash text-danger text-bold float-right deleteAllergie" Allergie-id=""></i>
                                        </div>
                                    </div>
                                </div>`);
                        $(trDom).find('.btn-LINK-secondary').text(data.AllergieName);
                        $(trDom).find('.btn-LINK-secondary').attr('data-target',
                            '#collapseTwo_' + data.id);
                        $(trDom).find('.btn-LINK-secondary').attr('aria-controls',
                            'collapseTwo_' + data.id);
                        $(trDom).find('.card-body p').text(data.Solution);
                        $(trDom).find('.card-body i').attr('Allergie-id', data.id);
                        $(trDom).find('.card-header').attr('id', 'headingTwo_' + data.id);
                        $(trDom).find('.collapse').attr('id', 'collapseTwo_' + data.id);
                        $(trDom).find('.collapse').attr('aria-labelledby', 'headingTwo_' + data
                            .id);
                        $('#AllergieList').append(trDom);
                        $('#modalAddAllergie').modal('toggle');
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Allergie Ajoutée',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                    }
                });
            });
            $('#AllergiesSection .card').on('click', '.fa-trash', function(event) {
                event.stopPropagation();
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'AllergieID': $(this).attr('Allergie-id'),
                };
                // alert();
                $.ajax({
                    url: '/deleteAllergie',
                    type: 'post',
                    data: formdata,
                    error: (error) => {
                        console.log(error.responseText);
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: error.responseText,
                            autohide: true,
                            delay: 2000,
                            class: "bg-danger",
                        });
                    },
                    success: (data) => {
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Allergie Supprimée',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                        $(this).parent().parent().parent().remove();
                    }
                });
            });
            // add Pathologie Handling
            $('#addPathologieeBtn').click(function() {
                $('#modalAddPathologie').modal('toggle');
            });
            $('#modalAddPathologie .btn-primary').click(function() {
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'patient_id': $('#patient_id').val(),
                    'PathologieName': $('#PathologieName').val(),
                    'PathologieSolution': $('#PathologieSolution').val(),
                };
                $.ajax({
                    url: '/addPathologie',
                    type: 'post',
                    data: formdata,
                    dataType: 'json',
                    error: (error) => {
                        console.log(error.responseText);
                    },
                    success: (data) => {
                        // console.log(data);
                        let trDom = $(`   <div class="card">
                                    <div class="card-header" id="">
                                        <h2 class="mb-0">
                                            <button class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="" aria-expanded="false"
                                                aria-controls="">/button>
                                        </h2>
                                    </div>
                                    <div class="collapse" id=""
                                        aria-labelledby="" data-parent="#PathologieList">
                                        <div class="card-body">
                                            <p></p>
                                            <i class="fas fa-trash text-danger text-bold float-right deletePathologie" Pathologie-id=""></i>
                                        </div>
                                    </div>
                                </div>`);
                        $(trDom).find('.btn-LINK-secondary').text(data.Name);
                        $(trDom).find('.btn-LINK-secondary').attr('data-target',
                            '#collapseTwo_' + data.id);
                        $(trDom).find('.btn-LINK-secondary').attr('aria-controls',
                            'collapseTwo_' + data.id);
                        $(trDom).find('.card-body p').text(data.solution);
                        $(trDom).find('.card-body i').attr('Pathologie-id', data.id);
                        $(trDom).find('.card-header').attr('id', 'headingTwo_' + data.id);
                        $(trDom).find('.collapse').attr('id', 'collapseTwo_' + data.id);
                        $(trDom).find('.collapse').attr('aria-labelledby', 'headingTwo_' + data
                            .id);
                        $('#PathologieList').append(trDom);
                        $('#modalAddPathologie').modal('toggle');
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Pathologie Ajoutée',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                    }
                });
            });
            $('#PathologiesSection .card').on('click', '.fa-trash', function(event) {
                event.stopPropagation();
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'PathologieID': $(this).attr('Pathologie-id'),
                };
                // alert();
                $.ajax({
                    url: '/deletePathologie',
                    type: 'post',
                    data: formdata,
                    error: (error) => {
                        console.log(error.responseText);
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: error.responseText,
                            autohide: true,
                            delay: 2000,
                            class: "bg-danger",
                        });
                    },
                    success: (data) => {
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Pathologie Supprimée',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                        $(this).parent().parent().parent().remove();
                    }
                });
            });
            // Traitement Crud Handling:
            $("#inputGroupFile01").change(function(input) {
                var file = $("input[type=file]").get(0).files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $("#previewFile img").attr("src", reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            $("#browse").click(function() {
                $("#inputGroupFile01").click();
            });
            $('#addTraitementBtn').click(() => {
                $('#modalAddTraitement').modal('toggle')
            })
            $('#modalAddTraitement .btn-primary').click(function() {
                let fd = new FormData();
                fd.append('_token', $("meta[name=csrf-token]").attr("content"));
                fd.append('patient_id', $('#patient_id').val());
                fd.append('TraitementName', $('#TraitementName').val());
                fd.append('TraitementStartDate', $('#TraitementStartDate').val());
                fd.append('TraitmentDurationDays', $('#TraitmentDurationDays').val());
                fd.append('OrdonnanceImage', document.querySelector("#inputGroupFile01").files[0]);
                // console.log(formData);
                $.ajax({
                    url: '/addTraitement',
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,                    
                    dataType: 'json',
                    success: (data) => {
                        // console.log(data);
                        let TraitementDom = $(`<div class="card">
                                    <div class="card-header py-0" id="">
                                        <h6> <small class="text-small text-secondary float-right font-"></small></h6>
                                        <h2 class="mb-0">
                                            <small class="btn btn-LINK-secondary btn-link btn-block text-left collapsed"
                                                type="button" data-toggle="collapse"
                                                data-target="" aria-expanded="false"
                                                aria-controls=""></small>
                                        </h2>
                                    </div>
                                    <div class="collapse" id=""
                                        aria-labelledby="" data-parent="#TraitementsList">
                                        <div class="card-body">
                                            <p>
                                                Durée du traitement : <strong></strong>
                                            </p>
                                            <p class="float-right">
                                                <i class="fas fa-trash text-danger text-bold   btn btn-sm deleteTraitement"
                                                    Traitement-id=""></i>
                                                <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                    data-target="">Voir Ordonnance</a>
                                                <!-- Modal -->
                                            <div class="modal fade" id="" tabindex="-1"
                                                aria-labelledby=""
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="">Ordonnance
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img class="img-fluid rounded" src=""
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>`);

                        $(TraitementDom).find('.card-header').attr('id', 'headingTwo_' + data
                            .id);
                        $(TraitementDom).find('.card-header h6 small').text('Depuis Le :' + data
                            .Date_Debut);
                        $(TraitementDom).find('.card-header h2 small').attr('data-target',
                            '#collapseTwo_' + data.id);
                        $(TraitementDom).find('.card-header h2 small').attr('aria-controls',
                            'collapseTwo_' + data.id);
                        $(TraitementDom).find('.card-header h2 small').text(data
                        .Nom_Medicament);
                        // console.log(data);
                        $(TraitementDom).find('.collapse').attr('id', 'collapseTwo_' + data.id);
                        $(TraitementDom).find('.collapse').attr('aria-labelledby',
                            'headingTwo_' + data.id);
                        $(TraitementDom).find('.card-body p:eq(0) strong').text(data.duree +
                            'jours');
                        $(TraitementDom).find('.fa-trash').attr('Traitement-id', data.id);
                        $(TraitementDom).find('a.btn.btn-secondary').attr('data-target',
                            '#OrdonnanceModal_' + data.id);
                        $(TraitementDom).find('.modal').attr('id', 'OrdonnanceModal_' + data
                        .id);
                        $(TraitementDom).find('.modal').attr('aria-labelledby',
                            'OrdonnanceModal_' + data.id + '_Label');
                        $(TraitementDom).find('.modal .modal-title').attr('id',
                            'OrdonnanceModal_' + data.id + '_Label');
                        $(TraitementDom).find('.modal .modal-body img').attr('src',
                            '/storage/Images/Ordonnances/' + data.ordonnance_path);
                        $('#TraitementsList').append(TraitementDom);
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Traitement Ajouté',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                        $('#modalAddTraitement').modal('toggle')
                    }
                });
            });
            $('#TraitementsSection .card').on('click', '.fa-trash', function(event) {
                event.stopPropagation();
                let formdata = {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    'TraitementID': $(this).attr('Traitement-id'),
                };
                // alert();
                $.ajax({
                    url: '/deleteTraitement',
                    type: 'post',
                    data: formdata,
                    error: (error) => {
                        // console.log(error.responseText);
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: error.responseText,
                            autohide: true,
                            delay: 2000,
                            class: "bg-danger",
                        });
                    },
                    success: (data) => {
                        $(document).Toasts("create", {
                            title: "Mobikisi",
                            body: 'Traitement Supprimée',
                            autohide: true,
                            delay: 2000,
                            class: "bg-success",
                        });
                        $(this).parents('.card').eq(0).remove();
                    }
                });
            });
        });
    </script>
@endsection
