<div class="row login-wrap">
  <p>User Create</p>
  @include('errors.validation')
    <form class="col s12" action="/user" method="post">
      <input type="hidden" name="id" value="{{ (isset($user))? $user->id:'' }}"/>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate" value="{{ (isset($user->name))?$user->name:'' }}">
          <label for="name">Name</label>
        </div>

        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" value="{{ (isset($user->email))? $user->email :'' }}">
          <label for="email">Email</label>
        </div>

        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate">
          <label for="password">Password</label>
        </div>

        <div class="input-field col s12">
          <input id="confirm_password" type="password" name="confirm_password" class="validate">
          <label for="confirm_password">Confirm Password</label>
        </div>

        <input type="checkbox" id="license_key" name="license_key" value="yes"
          @if(isset($user) && $user->license())
          checked = 'checked'
          @endif
        />
        <label for="license_key">Generate License key</label>

      </div>
      <div class="btn-center">
      <button class="btn waves-effect waves-light" type="submit" name="action">{{ (isset($user))? 'Update' :'Create'}}
          <i class="material-icons right">send</i>
    </button>
  </div>
    </form>
</div>
