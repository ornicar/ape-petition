<?php

//echo <<<EOF
//<script charset="utf-8" src="http://bit.ly/javascript-api.js?version=latest&amp;login=tweettrackjs&amp;apiKey=R_a1e2214c91270d8d8c943df9d204863f" type="text/javascript"></script>
//<script charset="utf-8" src="http://s.bit.ly/TweetAndTrack.js?v=1.01" type="text/javascript"></script>
//EOF;

echo _tag('ul',

  _tag('li', _link('http://facebook.com')->param('status', $url)->text('Facebook')).

  _tag('li', _link('http://twitter.com')->param('status', $url)->text('Twitter')).

//  _tag('li', str_replace('%url%', $url, '<a onclick="return TweetAndTrack.open(this, \'%url%\');" href="#">Twitter</a>')).

  _tag('li', _link('siteWidget/list')->param('url', $url)->text('Blog / Site'))

);