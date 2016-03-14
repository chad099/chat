<div class="container">

    @if(Auth::check())
    <div class="section">
      <!--   Icon Section   -->
      <div class="row">
        <h2>Watch, Learn, and Discover</h2>
      </div>

      <div class="row">
        <ul class="collection">
            @if(count($tutorials)>0)
            @foreach($tutorials as $tutorial)
            <a href="/tutorial/{{$tutorial->id}}"><li class="collection-item avatar">
              <img src="/assets/background2.jpg" alt="" class="circle">
              <span class="title">{{ $tutorial->title }}</span>
              <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
            </li></a>
            @endforeach
            @endif
        </ul>
      </div>

    </div>
    @else
    <div class="container">
        <div class="section">
          <!--   Icon Section   -->
          <div class="row">
            <div class="col s12 m4">
              <div class="icon-block">
                <h2 class="center brown-text"><i class="mdi-image-flash-on"></i></h2>
                <h5 class="center">Speeds up development</h5>

                <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
              </div>
            </div>

            <div class="col s12 m4">
              <div class="icon-block">
                <h2 class="center brown-text"><i class="mdi-social-group"></i></h2>
                <h5 class="center">User Experience Focused</h5>

                <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
              </div>
            </div>

            <div class="col s12 m4">
              <div class="icon-block">
                <h2 class="center brown-text"><i class="mdi-action-settings"></i></h2>
                <h5 class="center">Easy to work with</h5>

                <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about APIs.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    @endif
  </div>
