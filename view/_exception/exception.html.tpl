{% extends '_layout/default.html.tpl' %}
{% block content %}
    <div class="container">
        <hr/>
        <h1>服务端无法处理您的请求</h1>
        <h2>{{ Exception.getMessage() }}</h2>
        <a href="javascript:history.back()">返回</a>
        {% if app.is_debug %}
            <div>
                <pre>{{ Exception.__toString() }}</pre>
            </div>
        {% endif %}
    </div>
{% endblock %}