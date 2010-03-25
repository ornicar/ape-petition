<?php

if($collection->User->Photo)
{
  echo _media($collection->User->Photo)
  ->size(300, 300)
  ->method('inflate')
  ->set('.user_photo');
}
else
{
  echo _media('anonymous.jpg')
  ->size(300, 300)
  ->set('.user_photo');
}