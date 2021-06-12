@extends('layouts.admin')
<style>

</style>
@section('content')
<div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header"><strong class="mr-auto">Toast Title</strong><small>Subtitle</small><button
                data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span
                    aria-hidden="true">×</span></button></div>
        <div class="toast-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    });

</script>
@endsection