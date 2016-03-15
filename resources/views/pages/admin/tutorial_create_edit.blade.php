{{--*/
  use App\Http\Controllers\Utils;
  if(isset($video->std_class))
    $subjects = Utils::getsubjects($video->std_class);
/*--}}
<div class="row"></div>
<div class="container">
  <form method="post" action="/addtutorial" id="tutorialForm" enctype="multipart/form-data">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a href="#video">Video</a></li>
      <li class="tab col s3"><a href="#schools">Schools</a></li>
      <li class="tab col s3"><a href="#files">Files</a></li>
    </ul>
  </div>
  <div id="video" class="col s12">
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
        <input id="title" type="text" name="title" class="validate" value="{{ (isset($video))? $video->title:'' }}">
        <label for="title" @if(isset($video->title)) class="active" @endif>Title</label>
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
  </div><!-- Video closed here-->

    <div id="schools" class="col s12">
      <div class="row cust-row">
        <p style="text-align:center;" >Choose schools</p>
        {{--*/
          $school_videos = array();
          $schools = Utils::schools();
          if(isset($video)){
            $school_videos = $video->getAssindTutorial();
          }
          /*--}}
        @if(count($schools)>0)
        @foreach($schools as $school)
          <p>
            <input type="checkbox" name="schools[]" id="{{ $school->name }}" {{--*/ if(in_array($school->id,$school_videos)) echo  "checked"; /*--}} value="{{ $school->id }}" />
            <label for="{{ $school->name }}">{{ $school->name }}</label>
          </p>
        @endforeach
        @else
          <p>No School Exists</p>
        @endif

    </div>

  </div><!-- Schools closed here-->


    <div id="files" class="col s12">
      <div class="row cust-row">
        <a href="javascript:void(0);" id="more_file" class="waves-effect waves-light btn">Add More File</a>
      </div>

      <div class="file-field input-field">
        <div class="btn">
          <span>File</span>
          <input type="file" name="files[]">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
    </div>

    </div><!-- File closed here-->


    <button class="btn waves-effect waves-light" type="submit" name="action">Save
        <i class="material-icons right">send</i>
    </button>

  </form>
</div>
