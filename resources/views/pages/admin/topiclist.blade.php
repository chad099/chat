<div class="container">
  <div class="row cust-row">
    <a href="/topic/create" class="waves-effect waves-light btn">Add Topic</a>
  </div>
    <div class="section">
      @if(isset($topics) && count($topics)>0)
      <table class="highlight">
        <thead>
          <tr>
              <th data-field="id">Sr no</th>
              <th data-field="name">Subject</th>
              <th data-field="name">Topic</th>
              <th width="200">Description</th>
              <th data-field="price">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($topics as $topic)
          <tr>
            <td>{{ $topic->id}}</td>
            <td>{{ $topic->subject->name}}</td>
            <td>{{ $topic->name }}</td>
            <td>{{ substr($topic->description,0,50) }}</td>
            <td>
              <a href="/topic/{{$topic->id}}/edit" class="waves-effect waves-light btn">edit</a>
              <a href="/topic/{{$topic->id}}/delete" onclick="return confirm('Are you sure?');" class="waves-effect waves-light btn">delete</a>
           </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <p>No Topic exists</p>
      @endif
    </div>
  </div>
