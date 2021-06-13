@extends('layouts.admin')
<style>
    ul#patientMatchedList{
        list-style: none;
        width: 100%;
    }
      ul#patientMatchedList li{
        /* border-right:solid 1px;
        border-left:solid 1px;
        border-bottom:solid 1px;
        padding:2px;
         width: 100%; */
         cursor: pointer;
    }
      ul#patientMatchedList li:hover{
     background-color: rgb(98, 152, 202);
    }
</style>
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
            <button class="btn btn-success" id="btnSearch">Chercher</button>
        </div>
    </div>
    <div class="row" id="searchResponseArea">
        <ul class="col-6" id="patientMatchedList">

        </ul>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        // alert('hello Blade');
        $('#InputPatientName').keyup(function(){
            let SearchQuery=$('#InputPatientName').val();
            if(SearchQuery){
                $.ajax({
                    // url:'/SearchPatients',
                    url:'/SearchPatients/'+SearchQuery,
                    type:'get',
                    data:{
                        _token: $("meta[name=csrf-token]").attr("content"),
                        // 'query':SearchQuery,
                    },
                    dataType:'json',
                    success:function(data){
                        $('#patientMatchedList').empty();
                        $('#searchResponseArea').removeClass('d-none');
                        for(Patient in data){
                            $('#patientMatchedList').append('<li class="form-control">'+data[Patient].fullName+'</li>');
                        }
                    }
                })
            }
        });
        $('ul#patientMatchedList').on('click','li',function(){
            $('#InputPatientName').val($(this).text());
            $('#searchResponseArea').addClass('d-none');
        });
    });
</script>
@endsection