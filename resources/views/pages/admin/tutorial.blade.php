<div class="container">
  <div class="row cust-row">
    <a href="/addtutorial/create" class="waves-effect waves-light btn">Add Tutorial</a>
  </div>

    <div class="section">
      @if(count($videos)>0)
      <table class="highlight">
        <thead>
          <tr>
              <th>Class</th>
              <th>Subject</th>
              <th>Desciption</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($videos as $video)
          <tr>
            <td>{{ $video->std_class}}</td>
            <td>{{ $video->subject->name}}</td>
            <td>{{ $video->description}}</td>
            <td>
              <a href="/addtutorial/{{$video->id}}/edit" class="waves-effect waves-light btn">edit</a>
              <a href="/addtutorial/{{$video->id}}/delete" onclick="return confirm('Are you sure?');" class="waves-effect waves-light btn">delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <p>No video exists</p>
      @endif

    </div>
  </div>
