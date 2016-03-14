<div class="container">
  <div class="row cust-row">
    <a href="/user/create" class="waves-effect waves-light btn">User Create</a>
  </div>
    <div class="section">
      @if(isset($users) && count($users)>0)
      <table class="highlight">
        <thead>
          <tr>
              <th data-field="id">Sr no</th>
              <th data-field="name">name</th>
              <th data-field="name">Email</th>
              <th data-field="price">Action</th>
          </tr>
        </thead>

        <tbody>
          {{--*/ $conter = 1;/*--}}
          @foreach($users as $user)
          <tr>
            <td>{{$conter}}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email }}</td>
            <td>
              <a href="/user/{{$user->id}}/edit" class="waves-effect waves-light btn">edit</a>
              <a href="/user/{{$user->id}}/delete" onclick="return confirm('Are you sure?');" class="waves-effect waves-light btn">delete</a>
           </td>
          </tr>
          {{--*/ $conter++;/*--}}
          @endforeach
        </tbody>
      </table>
      @else
        <p>No User exists</p>
      @endif
    </div>
    {!! $users->render() !!}

  </div>
