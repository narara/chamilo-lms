{% extends app.template_style ~ "/layout/no_layout.tpl" %}

{% block body %}

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ _p.web_lib }}elfinder/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ _p.web_lib }}elfinder/css/theme.css">

    <!-- elFinder JS (REQUIRED) -->
    <script type="text/javascript" src="{{ _p.web_lib }}elfinder/js/elfinder.min.js"></script>

    <!-- elFinder translation (OPTIONAL) -->
    <script type="text/javascript" src="{{ _p.web_lib }}elfinder/js/i18n/elfinder.ru.js"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
            var elf = $('#elfinder').elfinder({
                url : '{{ url('editor_connector') }}'  // connector URL (REQUIRED)
                // lang: 'ru',             // language (OPTIONAL)
            }).elfinder('instance');
        });
    </script>
    <script type="text/javascript" charset="utf-8">
      // Helper function to get parameters from the query string.
      function getUrlParam(paramName) {
          var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
          var match = window.location.search.match(reParam) ;
          return (match && match.length > 1) ? match[1] : '' ;
      }

      $().ready(function() {
          var funcNum = getUrlParam('CKEditorFuncNum');
          var elf = $('#elfinder').elfinder({
              url : 'php/connectorChamilo.php',
              getFileCallback : function(file) {
                  window.opener.CKEDITOR.tools.callFunction(funcNum, file);
                  window.close();
              },
              resizable: false
          }).elfinder('instance');
      });
  </script>

    <div id="elfinder"></div>


{% endblock %}
