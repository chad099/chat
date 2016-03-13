<div class="container">
  <div class="row cust-row">
    <a href="/addsubject/create" class="waves-effect waves-light btn">Add Subject</a>
  </div>
    <div class="section">
      @if(isset($subjects) && count($subjects)>0)
      <table class="highlight">
        <thead>
          <tr>
              <th data-field="id">Class</th>
              <th data-field="name">Subject</th>
              <th data-field="price">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($subjects as $subject)
          <tr>
            <td>{{ $subject->std_class}}</td>
            <td>{{ $subject->name}}</td>
            <td>
              <a href="/addsubject/{{$subject->id}}/edit" class="waves-effect waves-light btn">edit</a>
              <a href="/addsubject/{{$subject->id}}/delete" onclick="return confirm('Are you sure?');" class="waves-effect waves-light btn">delete</a>
           </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <p>No Subject exists</p>
      @endif
    </div>
  </div>
