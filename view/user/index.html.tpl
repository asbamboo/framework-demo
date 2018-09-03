{% extends '_layout/default.html.tpl' %}

{% block content %}
<div class="container">
	<div>
	    <a href="{{ path('user_create') }}" class="btn btn-link">添加用户</a>
	</div>
	<div>
	    <table class="table">
	      <thead>
	        <tr>
	          <th scope="col">#</th>
	          <th scope="col">账号</th>
	          <th scope="col">操作</th>
	        </tr>
	      </thead>
	      <tbody>
	        {% for UserEntity in UserEntitys %}
	            <tr>
	              <th>{{ loop.index }}</th>
	              <td>{{ UserEntity.getUserId() }}</td>
	              <td>          
	                  <a href="{{ path('user_update', {user_id: UserEntity.getUserId()}) }}" class="btn btn-link">编辑</a>
	                  <form action="{{ path('user_delete') }}" method="post">
	                    <input type="hidden" name="user_id" value="{{UserEntity.getUserId()}}" />
	                    <button type="submit" class="btn btn-link">删除</button>      
	                  </form>
	              </td>
	            </tr>            
	        {% endfor %}
	      </tbody>
	    </table>
	</div>
</div>
{% endblock %}