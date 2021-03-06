<nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md mb-2">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">🏒</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/team/{{ Auth::user()->team_id }}/next" >Next Up<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/team/{{ Auth::user()->team_id }}" >Schedule<span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a target="#" class="nav-link" href="http://nycrhl.pointstreaksites.com/view/nycrhl/home-page-657">League Site</a>
      </li>
      <li class="nav-item">
        <a target="#" class="nav-link" href="/logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>