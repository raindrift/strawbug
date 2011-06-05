<?php
/* /app/views/helpers/link.php */

class BreaksHelper extends AppHelper {
	# This could, of course, be a complete wikitext parser or something.  But it's not.
    function addBreaks($text) {
		return preg_replace('/\r?\n\r?/ms', '<br/>', $text);
    }
}

?>
