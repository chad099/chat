{{--*/
  use App\Http\Controllers\Utils;
  if(isset($topic))
    $subjects = Utils::subjects($topic);

/*--}}
<div class="container">
  <form method="post" action="/topic" id="tutorialForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ (isset($topic))? $topic->id :'' }}"/>
    <div class="input-field col s12">
      @include('errors.validation')
    </div>
    <div class="input-field col s12">
       <select name="std_class">
         <option value="">Choose your option</option>
         {{--*/ $class = 1; /*--}}
         @while($class !=11)
         <option value="{{$class}}" {{--*/ if(isset($topic) && $topic->subject->std_class ==$class) echo  "selected"; /*--}}>{{$class}} std</option>
          {{--*/ $class++; /*--}}
         @endwhile
       </select>
       <label>Select class</label>
      </div>

      <div class="input-field col s12">
         <select name="subject_id">
           <option value="" disabled selected>Choose your option</option>
          @if(isset($subjects) && count($subjects))
            @foreach($subjects as $subject)
              <option value="{{ $subject->id }}" {{--*/ if($subject->id == $topic->subject_id) echo  "selected"; /*--}}>{{ $subject->name }}</option>
            @endforeach
          @endif
         </select>
         <label>Select Subject</label>
      </div>

      <div class="input-field col s12">
        <input type="text" id="name" name="name" value="{{ (isset($topic))? $topic->name:'' }}">
        <label for="name" @if(isset($topic->name)) class="active" @endif>Enter Name </label>
      </div>

    <div class="input-field col s12">
      <textarea id="textarea1" name="description" class="materialize-textarea">{{ (isset($topic))? $topic->description:'' }}</textarea>
      <label for="textarea1" @if(isset($topic->description)) class="active" @endif>Enter Description </label>
    </div>

    <button class="btn waves-effect waves-light" type="submit" name="action">{{ (isset($topic))? 'Update' :'Save'}}
        <i class="material-icons right">send</i>
    </button>

  </form>
</div>
