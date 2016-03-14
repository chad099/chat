<div class="row login-wrap">
  <p>My Profile</p>
  @include('errors.validation')
    <form class="col s12" action="/profile" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate" value="{{ $user->name}}">
          <label for="name">Name</label>
        </div>

        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" value="{{ $user->email }}">
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

      </div>
      <div class="btn-center">
      <button class="btn waves-effect waves-light" type="submit" name="action">Update
          <i class="material-icons right">send</i>
    </button>
  </div>
    </form>
</div>
