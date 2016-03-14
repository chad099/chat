<div class="row"></div>

<div class="vid-body">
<div class="row login-wrap">
  <div class="video"><span class="video-title">{{ $video->title }}</span> <span class="in-ext">in</span> <span class="video-subject"> {{ $video->subject->name }}</span> </div>
  @if(isset($video) && $video->video)
  <video class="responsive-video" controls>
    <source src="/files/{{$video->video}}" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
  @endif

  <div class="row description-body">
    <div class="description row">{{ $video->description }}</div>
    <div class="file row">
      @if(count($video->files)>0)
      <div>Download File:</div>
        @foreach($video->files as $file)
        <a href="/download/{{$file->id}}" class="waves-effect waves-light btn"><i class="material-icons">file_download</i>
        {{ $file->name }}</a>
        @endforeach
    </div>
    @endif

  </div>
</div>
</div>
