<div class="right custom-nav-right">
 <ul>
    <li class="divider"></li>
    @if(Auth::check())
		  <a class='dropdown-button btn custom-btn' href='javascript:void(0)' data-activates='dropdown1'>welcome, {{Auth::user()->name}}</a>
  		<!-- Dropdown Structure -->
  		<ul id='dropdown1' class='dropdown-content'>
  			<li><a href="/profile">Profile</a></li>
        <li><a href="/logout">Logout</a></li>
  		</ul>
	   @else
		   <li><a href="/login">Login</a></li>
    @endif
  </ul>
</div>

<ul id="slide-out" class="side-nav fixed">
	<div class="bug-logo" style="height:150px;">
	<img src="/assets/images/bug-logo1.png"/>
	</div>
	<div class="divider"></div>
	<li><a href="/">Home</a></li>

  @if(Auth::check())

  @if(Auth::user()->type == 'admin')

  <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header subject-ta">Subject</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="/addsubject">SubjectManage</a></li>
              <li><a href="/topic">Topic</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
  	<li><a href="/addtutorial">TutorialManage</a></li>
    <li><a href="/user">UserManage</a></li>
    <li><a href="/school">SchoolManage</a></li>
  @else
    <li><a href="/tutorial">tutorial</a></li>
  @endif

  @endif
</ul>
<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
