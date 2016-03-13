<div class="row login-wrap">
  <p>Login</p>
  @include('errors.validation')
    <form class="col s12" action="/login" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate">
          <label for="password">password</label>
        </div>
      </div>
      <div class="btn-center">
      <button class="btn waves-effect waves-light" type="submit" name="action">Login
          <i class="material-icons right">send</i>
    </button>
  </div>
    </form>
</div>
