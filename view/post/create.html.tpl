{% extends '_layout/default.html.tpl' %}

{% block content %}
    <div class="container">
        {% if error_message %}
            <div class="alert alert-danger" role="alert">{{ error_message }}</div>
        {% endif %}
        <form method="post">
          <h1 class="h3 mb-3 font-weight-normal">创建新文章</h1>
          <div class="form-group">
            <label for="post_title">标题</label>
            <input type="text" class="form-control" name="post_title" id="post_title" placeholder="请输入文章标题">
          </div>
          <div class="form-group">
            <label for="post_content">内容</label>
            <textarea class="form-control" name="post_content" id="post_content" rows="20" placeholder="请输入文章内容"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">提交表单</button>
        </form>
    </div>
{% endblock %}