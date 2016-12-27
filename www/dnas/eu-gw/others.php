<?php
/*
    DNASrep - DNAS replacement server
    Copyright (C) 2016  the_fog@1337.rip

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

  // get the body of the initial packet
  $packet  = file_get_contents('php://input');
  $gameID  = substr($packet, 0x1b, 8);
  $qrytype = substr($packet, 0, 4);
  $fname   = bin2hex($gameID)."_".bin2hex($qrytype);
  
  // get the answer for replaying
  if(!($packet = file_get_contents('./packets/'.$fname))) {
    $packet = file_get_contents('./error.raw');
  }
  
  // send the answer
  header("HTTP/1.0 200 OK");
  header("Content-Type: image/gif");
  header("Content-Length: ".strlen($packet));
  echo $packet;
?>
