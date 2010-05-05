<?php
echo _tag('ul',

  _tag('li', _link('http://www.facebook.com/sharer.php')->param('u', $url)->text('Facebook')).

  _tag('li', _link('http://twitter.com')->param('status', $shortUrl)->text('Twitter')).
  
  _tag('li', _link('siteWidget/list')->param('url', $url)->text('Blog / Site'))

);