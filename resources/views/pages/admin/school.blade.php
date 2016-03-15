<div class="container">
  <div class="row cust-row">
    <a href="/school/create" class="waves-effect waves-light btn">Add School</a>
  </div>
    <div class="section">
      @if(isset($schools) && count($schools)>0)
      <table class="highlight">
        <thead>
          <tr>
              <th data-field="id">Sr no</th>
              <th data-field="name">Name</th>
              <th data-field="name">Address</th>
              <th width="200">Description</th>
              <th data-field="price">Action</th>
          </tr>
        </thead>

        <tbody>
          {{--*/ $inc = 1;/*--}}
          @foreach($schools as $school)
          <tr>
            <td>{{ $inc }}</td>
            <td>{{ $school->name}}</td>
            <td>{{ $school->address }}</td>
            <td>{{ substr($school->description,0,50) }}</td>
            <td>
              <a href="/school/{{$school->id}}/edit" class="waves-effect waves-light btn">edit</a>
              <a href="/school/{{$school->id}}/delete" onclick="return confirm('Are you sure?');" class="waves-effect waves-light btn">delete</a>
           </td>
          </tr>
          {{--*/ $inc++;/*--}}
          @endforeach
        </tbody>
      </table>
      @else
        <p>No School exists</p>
      @endif
    </div>
    {!! $schools->render() !!}
  </div>
