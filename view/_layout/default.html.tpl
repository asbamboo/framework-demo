<!doctype html>
<html lang="zh_CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Asbamboo demo</title>
    {% block stylesheet %}
        <!-- Bootstrap core CSS -->
        <link href="/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    {% endblock %}
  </head>
  <body>
    {% block top %}{% include '_include/top.html.tpl' %}{% endblock %}
    {% block content %}{% endblock %}
  </body>
</html>
