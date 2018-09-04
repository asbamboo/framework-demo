<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
      <ul class="navbar-nav">
        <li class="nav-item {% if is_current('home') %}active{% endif %}">
            <a class="nav-link" href="{{ path('home') }}">asbamboo demo{% if is_current('home') %}<span class="sr-only">(current)</span>{% endif %}</a>
        </li>
        {% if has_roles('user', 'admin') %}
            <li class="nav-item {% if is_current('post') %}active{% endif %}">
                <a class="nav-link" href="{{ path('post') }}">文章管理{% if is_current('post') %}<span class="sr-only">(current)</span>{% endif %}</a>
            </li>
        {% endif %}
        {% if has_roles('admin') %}
            <li class="nav-item {% if is_current('user') %}active{% endif %}">
                <a class="nav-link" href="{{ path('user') }}">人员管理{% if is_current('user') %}<span class="sr-only">(current)</span>{% endif %}</a>
            </li>
        {% endif %}
        {% if 'anonymous' in app.user.getRoles() %}
            <li class="nav-item">
                <a class="nav-link" href="{{ path('login') }}">登陆</a>
            </li>
        {% else %}
            <li class="nav-item">
                <a class="nav-link" href="#">当前用户:{{ app.user.getLoginName() }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ path('logout') }}">注销</a>
            </li>
        {% endif %}
      </ul>
    </div>
</nav>