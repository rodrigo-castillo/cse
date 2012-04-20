<?php
class Specialcse extends SpecialPage {
        function __construct() {
                parent::__construct( 'cse' );
        }
 
        function execute( $par ) {
                global $wgRequest, $wgOut, $resultsCode;
 
                $this->setHeaders();            
                $q = $wgRequest->getText('q');
                
                $title = Title::newFromText( $q );
                
                $this->goResult($q);
                
                $cseTitle = Title::newFromText("Special:Cse");
				
                        
                $form =  
'<form action="'.$cseTitle->getFullURL().'">
  <div>
    <input type="text" name="q" size="12" value="'.$q.'" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>';		

                $wgOut->addHTML( $form );
				$wgOut->addWikiText("'''Create the page \"[[$title |$title]]\" on this wiki!'''");
                $wgOut->addHTML( $resultsCode );
        }
        
    //copied almost wholesale from includes/special/specialsearch.php    
	public function goResult( $term ) {
		global $wgOut;
		
		# Try to go to page as entered.
		$t = Title::newFromText( $term );
		# If the string cannot be used to create a title
		if( is_null( $t ) ) {
			return $this->showResults( $term );
		}
		# If there's an exact or very near match, jump right there.
		$t = SearchEngine::getNearMatch( $term );
		if( !is_null( $t ) ) {
			$wgOut->redirect( $t->getFullURL() );
			return;
		}
		# No match, generate an edit URL
		$t = Title::newFromText( $term );
		if( !is_null( $t ) ) {
			global $wgGoToEdit;
			wfRunHooks( 'SpecialSearchNogomatch', array( &$t ) );
			# If the feature is enabled, go straight to the edit page
			if( $wgGoToEdit ) {
				$wgOut->redirect( $t->getFullURL( array( 'action' => 'edit' ) ) );
				return;
			}
		}
	}       
}