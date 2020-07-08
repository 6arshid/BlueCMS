
@if ($message = Session::get('success'))
<div class="bg-gradient-success shadow-success uk-light" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}
    </p>
</div>


@endif @if ($message = Session::get('error'))
<div class="bg-gradient-danger  shadow-danger  uk-light" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}
    </p>
</div>


@endif @if ($message = Session::get('warning'))
<div class="bg-gradient-warning  shadow-warning  uk-light" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}
    </p>
</div>


@endif @if ($message = Session::get('info'))
<div class="bg-gradient-info  shadow-info  uk-light" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ $message }}
    </p>
</div>


@endif @if ($errors->any())
<div class="bg-gradient-danger  shadow-danger  uk-light" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{trans('sentence.full_error')}}
    </p>
</div>

@endif