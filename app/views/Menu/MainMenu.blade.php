<nav class="menu">
	<div class="content-profile">
		<figure class="profile">
	        <img src="/assets/images/profile">
	    </figure>
	    <p>
	    	<strong>Hola</strong> 
	    	<span class="name">{{ Auth::user()->username; }}</span>!
	    </p>
	</div>
	<ul class="list-unstyled">
		{{ $MoreMenu }}
		<a href="/perfil">
			<li>
				<span class="icon-user"></span>
				<span class="text">Mi Perfil</span>
			</li>
		</a>
		<a href="#" id="bug">
			<li>
				<span class="icon-bug"></span>
				<span class="text">Notificar Error</span>
			</li>
		</a>
		<a href="/logout">
			<li>
				<span class="icon-exit"></span>
				<span class="text">Cerrar Sesión</span>
			</li>
		</a>
	</ul>
	<figure class="logo">
        <img src="/img/logo.png">
        <figcaption>Checklist System</figcaption>
    </figure>
</nav>