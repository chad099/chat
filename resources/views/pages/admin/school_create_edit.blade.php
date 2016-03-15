<div class="row login-wrap">
  <p>@if(isset($school)) Update School Information @else Create School @endif</p>
  @include('errors.validation')
    <form class="col s12" action="/school" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="{{ (isset($school))? $school->id:'' }}"/>
      <div class="row">

        @if(!isset($school) || $school->logo =='')
        <div class="input-field col s12">
          <div class="file-field input-field">
            <div class="btn">
              <span>Logo</span>
              <input type="file" name="logo">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
        </div>
        </div>
        @else
          <div class="input-field col s12">
            <div class="logo"> <img src="/logos/{{$school->logo}}"/> <span class="remov_l"><a href="/logo/{{$school->id}}/remove" onclick="return confirm('Are you sure');"><i class="material-icons">delete</i></a></span></div>
          </div>
        @endif

        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate" value="{{ (isset($school->name))?$school->name:'' }}">
          <label for="name">Name</label>
        </div>


        <div class="input-field col s12">
          <input id="address" type="text" name="address" class="validate" value="{{ (isset($school->address))?$school->address:'' }}">
          <label for="address">Address</label>
        </div>

        <div class="input-field col s12">
          <textarea id="textarea1" name="description" class="materialize-textarea">{{ (isset($school))? $school->description:'' }}</textarea>
          <label for="textarea1" @if(isset($school->description)) class="active" @endif>Enter Description </label>
        </div>

      </div>

      <div class="btn-center">
      <button class="btn waves-effect waves-light" type="submit" name="action">{{ (isset($school))? 'Update' :'Create'}}
          <i class="material-icons right">send</i>
    </button>
  </div>
    </form>
</div>
