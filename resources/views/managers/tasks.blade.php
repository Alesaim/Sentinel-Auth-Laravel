<form action="/logout" method="post" id="logout-form">
	@csrf
	<a href="" onclick="document.getElementById('logout-form').submit()">Logout</a>
</form>