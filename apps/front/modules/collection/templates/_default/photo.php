<?php

echo _media($collection->User->Photo)
->size(300, 300)
->method('inflate')
->set('.user_photo');