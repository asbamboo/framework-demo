{% extends '_layout/default.html.tpl' %}

{% block stylesheet %}
    {{ parent() }}
    <style>
        .form-signin {
          width: 100%;
          max-width: 330px;
          padding: 15px;
          margin: 0 auto;
        }
        .form-signin .checkbox {
          font-weight: 400;
        }
        .form-signin .form-control {
          position: relative;
          box-sizing: border-box;
          height: auto;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>
{% endblock %}

{% block content %}
    <form class="form-signin">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">请登陆</h1>
      <label for="user_id" class="sr-only">ID</label>
      <input type="text" id="user_id" class="form-control" placeholder="请输入用户ID" required autofocus>
      <label for="user_password" class="sr-only">密码</label>
      <input type="password" id="user_password" class="form-control" placeholder="请输入用户密码" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    </form>
{% endblock %}