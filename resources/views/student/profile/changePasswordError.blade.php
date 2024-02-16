 @if(Session::has('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get( 'success' )}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

@endif

@if(Session::has('notSameBoth'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get( 'notSameBoth' )}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif

@if(Session::has('errorLength'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get( 'errorLength' )}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif


<div class="container">
    @if(Session::has('not Match'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
     {{ Session::get( 'not Match' )}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>

@endif
