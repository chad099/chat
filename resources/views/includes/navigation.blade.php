<div class="right custom-nav-right">
 <ul>
    <li><a href="/myfavourites">Favourites</a></li>
    <li class="divider"></li>
    @if(Auth::check())
		<a class='dropdown-button btn custom-btn' href='javascript:void(0)' data-activates='dropdown1'>welcome, {{Auth::user()->name}}</a>
		<!-- Dropdown Structure -->
		<ul id='dropdown1' class='dropdown-content'>
			<li><a href="/userprofile">Profile</a></li>
			<li><a href="/mycomments">Comments</a></li>
			<li><a href="/logout">Logout</a></li>
		</ul>
		
	@else
		<li><a href="/userlogin">Login</a></li>
    @endif
  </ul>
</div>

<ul id="slide-out" class="side-nav fixed">
	<div class="bug-logo" style="height:150px;">
	<img src="/assets/images/bug-logo1.png"/>
	</div>
	<div class="divider"></div>
	<li><a href="/">Home</a></li>
	<li><a href="/calender">Calender</a></li>
	<li><a href="/myprofile">My Profile</a></li>
     
</ul>
<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
 
 
