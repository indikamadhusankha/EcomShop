@if (Session::has('Success'))
<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Success!</h4>
    <p>{{ Session::get('Success') }}</p>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (Session::has('Errors'))
<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Success!</h4>
    <p>{{ Session::get('Errors') }}</p>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@push('js')

<script>
$( document ).ready(function() {

    $('#alert').delay(3000).slideUp(1000);
});

</script>
@endpush
