<div class="container">
    <div class="section">
      <!--   Icon Section   -->
      <div class="row">
        <h2>Watch, Learn, and Discover</h2>
      </div>

      <div class="row">
        <ul class="collection">
            @if(count($tutorials)>0)
            @foreach($tutorials as $tutorial)
            <li class="collection-item avatar">
              <img src="/assets/background2.jpg" alt="" class="circle">
              <span class="title">{{ $tutorial->description }}</span>
              <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
            </li>
            @endforeach
            @endif
        </ul>
      </div>

    </div>
  </div>
