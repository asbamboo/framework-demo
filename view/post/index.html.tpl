{% extends '_layout/default.html.tpl' %}

{% block content %}
<div class="container">
	<div>
	    <a href="{{ path('post_create') }}" class="btn btn-link">添加文章</a>
	    {% if app.user.getUserSecurity() %}
	    	<a href="{{ path('api_doc') }}" class="btn btn-link">通过API管理文章</a>
	    {% endif %}
	</div>
	<div>
	    <table class="table">
	      <thead>
	        <tr>
	          <th scope="col">#</th>
	          <th scope="col">标题</th>
	          <th scope="col">时间</th>
	          <th scope="col">操作</th>
	        </tr>
	      </thead>
	      <tbody>
	        {% for PostEntity in PostEntitys %}
	            <tr>
	              <th>{{ loop.index }}</th>
	              <td>{{ PostEntity.getPostTitle() }}</td>
	              <td>{{ PostEntity.getPostUpdateTime()|date('Y-m-d H:i:s') }}</td>
	              <td>          
	                  <a href="{{ path('post_update', {post_seq: PostEntity.getPostSeq()}) }}" class="btn btn-link">编辑</a>
	                  <form action="{{ path('post_delete') }}" method="post">
	                    <input type="hidden" name="post_seq" value="{{PostEntity.getPostSeq()}}" />
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