<?php
if (!defined('MEDIAWIKI')) die();

class cse {
        static function sidebar( $skin, &$bar ) {
 			global $wgRequest, $resultsCode;
 			
                $cseTitle = Title::newFromText("Special:Cse");
 			
                $bar['cse'] = "<form action=\"".$cseTitle->getFullURL()."\" id=\"cse-search-box\" style=\"padding-top: 5px;\">
  <div>
    <input type=\"text\" name=\"q\" size=\"12\" value=\"".$wgRequest->getText('q')."\" />
    <input type=\"submit\" name=\"sa\" value=\"Search\" />
  </div>
</form>";
                return $bar;
 
                return true;
        }
}
