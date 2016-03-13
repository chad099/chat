<div class="container">
  <form method="post" action="/addsubject">
    <input type="hidden" name="id" value="{{ (isset($subject))? $subject->id:'' }}"/>
    <div class="input-field col s12">
       <select name="std_class">
         <option value="" disabled >Choose your option</option>
         {{--*/ $class = 1; /*--}}
         @while($class !=11)
         <option value="{{$class}}" {{--*/ if(isset($subject->std_class) && $subject->std_class== $class) echo "selected";/*--}}>{{$class}} std</option>
          {{--*/ $class++; /*--}}
         @endwhile
       </select>
       <label>Select class</label>
      </div>

      <div class="input-field col s12">
        <input type="text" id="subject" name="name"
        @if(old('name'))
          value="{{ old('name')}}";
        @elseif(isset($subject->name))
        value="{{ $subject->name }}";
        @endif
        >
        <label for="subject" @if(isset($subject)) class="active" @endif >Enter subject</label>
      </div>

    <button class="btn waves-effect waves-light" type="submit" name="action">Save
        <i class="material-icons right">send</i>
  </button>

  </form>
</div>
