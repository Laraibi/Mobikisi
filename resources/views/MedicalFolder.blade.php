@extends('layouts.admin')
<style>
    ul#patientMatchedList {
        list-style: none;
        width: 100%;
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

    ul{
        list-style: none;
        margin:0 !important;
        padding:0 !important;
    }
    #infosSection ul li{
        margin:5px;
    }
    .card-title{
        font-weight: bold !important ;
        font-size: 2rem !important; 
    }
    .card i{
        margin-right: 1rem;
        background-color: #BC0C37;
        border-radius:20%;
        color:white;
        padding: 10px;
        width: 50px;
        text-align: center;
    }
    .card-header{
        padding-bottom: 0 !important; 
    }
    .card{
        height: 100%;
    }
    .phoneNumber{
        padding-left: 20px;
        border-left: solid 1px black;
        margin-left: 20px;
    }
    .w-40{
        width:40%;
    }
</style>
@section('content')
    <div class="px-5">
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
            <h2>Dossier Medical</h2>
        </div>
        <form action="{{ route('getMedicalFolder') }}" method="post">
            <div class="row">
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
        <div class="row px-5">
            <div class="col-md-4 col-xs-12 " id="profileSection">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-alt"></i>Profile</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <img id="imgProfile" src="{{ asset('/storage/Images/Patients_Photos/' . $Patient->photo_path) }}"
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info"></i>Informations Générales</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Sexe:</small>{{$Patient->Sexe == 1 ?'Masculin':'Féminin'}}</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Date de Naissance:</small>{{$Patient->DateOfBirth}}</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Poids:</small>{{$Patient->weight_kg}} kg</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Taille:</small>{{$Patient->height_cm}} cm</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Groupe sanguin:</small>{{$Patient->grpSanguin}}</li>
                            <li class="font-weight-bold"><small class="font-weight-none text-secondary mx-2">Mutuelle ou assurance:</small>{{$Patient->Mutuelle}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12" id="contactsSection">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-address-card"></i>Contacts d'urgence</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li class="font-weight-bold">
                               <i class="fas fa-phone-volume font-size-5 float-right"></i>
                                <div class="row">
                                    <small class="text-secondary">Epoux</small>
                                </div>
                                <div class="row">
                                    <h6 class="font-weight-bold d-inline w-40"> Amine Laraibi </h6>
                                    <h6 class=" d-inline phoneNumber">+212 6 49 81 41 09</h6>
                                </div>
                            </li>
                            <li class="font-weight-bold">
                                <i class="fas fa-phone-volume font-size-5 float-right"></i>
                                <div class="row">
                                    <small class="text-secondary">Colocataire</small>
                                </div>
                                <div class="row">
                                    <h6 class="font-weight-bold d-inline w-40"> Hamid El Amine </h6>
                                    <h6 class=" d-inline phoneNumber">+212 6 49 81 41 09</h6>
                                </div>
                            </li>
                            <li class="font-weight-bold">
                                <i class="fas fa-phone-volume font-size-5 float-right"></i>
                                <div class="row">
                                    <small class="text-secondary">Medecin traitant</small>
                                </div>
                                <div class="row">
                                    <h6 class="font-weight-bold d-inline w-40"> Yassine El Mouss </h6>
                                    <h6 class=" d-inline phoneNumber">+212 6 49 81 41 09</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                       <i class="btn fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            makeNavLinkActive(2);
            // alert('hello Blade');
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
        });

    </script>
@endsection
