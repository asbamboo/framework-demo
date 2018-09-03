{% extends '_layout/default.html.tpl' %}

{% block content %}
    <div class="container">
        {% if error_message %}
            <div class="alert alert-danger" role="alert">{{ error_message }}</div>
        {% endif %}
        <form method="post">
          <h1 class="h3 mb-3 font-weight-normal">编辑用户</h1>
          <div class="form-group">
            <label for="user_id">ID</label>
            <input type="text" class="form-control-plaintext" name="user_id" id="user_id" value="{{UserEntity.getUserId()}}" readonly>
          </div>
          <div class="form-group">
            <label for="user_password">密码</label>
            <input type="password" class="form-control" name="user_password" id="user_password" value="{{UserEntity.getUserPassword()}}" placeholder="请输入用户密码">
          </div>
          <div class="form-group">
            <label for="user_confirm_password">密码</label>
            <input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" value="{{UserEntity.getUserPassword()}}" placeholder="请确认用户密码">
          </div>
          <button type="submit" class="btn btn-primary">提交表单</button>
        </form>
    </div>
{% endblock %}