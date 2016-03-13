@if (isset($errors) && count($errors)>0)
    <div class="alert alert-danger" style="color:red;">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
