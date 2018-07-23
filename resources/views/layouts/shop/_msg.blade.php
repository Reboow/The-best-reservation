@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message">

                    <p class="alert alert-{{ $msg }}" id="close">
                        {{ session()->get($msg) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="hide">&times;</span></button>
                    </p>
        </div>
    @endif
@endforeach