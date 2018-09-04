{% extends '_layout/default.html.tpl' %}

{% block content %}
<div class="container">
    <hr/>
    {% for PostEntity in PostEntitys %}
        <div>
            <h1>{{ PostEntity.getPostTitle() }}</h1>
            <p>发布人:{{ PostEntity.getUser().getUserId() }} | 发布时间:{{ PostEntity.getPostUpdateTime()|date('Y-m-d H:i:s') }}</p>
            <p>{{ PostEntity.getPostContent() }}</p>
        </div>
        <hr/>
    {% endfor %}
</div>
{% endblock %}