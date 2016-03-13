{{--*/
  use App\Http\Controllers\Utils;
  if(isset($video->std_class))
    $subjects = Utils::getsubjects($video->std_class);
/*--}}
<div class="container">
  <form method="post" action="/addtutorial" id="tutorialForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ (isset($video))? $video->id :'' }}"/>
    <div class="input-field col s12"> @include('errors.validation') </div>
    <div class="input-field col s12">
       <select name="std_class">
         <option value="">Choose your option</option>
         {{--*/ $class = 1; /*--}}
         @while($class !=11)
         <option value="{{$class}}" {{--*/ if(isset($video) && $video->std_class ==$class) echo  "selected"; /*--}}>{{$class}} std</option>
          {{--*/ $class++; /*--}}
         @endwhile
       </select>
       <label>Select class</label>
      </div>

      <div class="input-field col s12">
         <select name="subject_id">
           <option value="" disabled selected>Choose your option</option>
          @if(isset($video) && count($video->subjects())>0)
            @foreach($video->subjects() as $subject)
              <option value="{{ $subject->id }}" {{--*/ if($subject->id == $video->subject_id) echo  "selected"; /*--}}>{{ $subject->name }}</option>
            @endforeach
          @endif
         </select>
         <label>Select Subject</label>
      </div>

      <div class="input-field col s12">
         <select name="topic_id">
           <option value="" disabled selected>Choose your option</option>
          @if(isset($video) && count($video->topics())>0)
            @foreach($video->topics() as $topic)
              <option value="{{ $topic->id }}" {{--*/ if($topic->id == $video->topic_id) echo  "selected"; /*--}}>{{ $topic->name }}</option>
            @endforeach
          @endif
         </select>
         <label>Select Topic</label>
      </div>


        <div class="input-field col s12">
          <textarea id="textarea1" name="description" class="materialize-textarea">{{ (isset($video))? $video->description:'' }}</textarea>
          <label for="textarea1" @if(isset($video->description)) class="active" @endif>Enter Description </label>
        </div>

        <div class="file-field input-field">
          <div class="btn">
            <span>Video</span>
            <input type="file" name="video">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
      </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Save
        <i class="material-icons right">send</i>
    </button>

  </form>
</div>
