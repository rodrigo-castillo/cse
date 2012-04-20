<?php
# Alert the user that this is not a valid entry point to MediaWiki if they try to access the special pages file directly.
if (!defined('MEDIAWIKI')) {
        echo <<<EOT
To install my extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/cse/cse.php" );

Edit the $resultsCode variable in cse.php to the code you get from Google CSE for the Results Only option in Look and Feel.

EOT;
        exit( 1 );
}

$wgExtensionCredits['validextensionclass'][] = array(
   'path' => __FILE__,
   'name' => 'GoogleCSE',
   'author' =>'Rodrigo Castillo (Sonic.net)', 
   'url' => 'https://www.mediawiki.org/wiki/Extension:GoogleCSE', 
   'description' => 'Integrates Google Custom Search Engine with Mediawiki',
   'version'  => 1.0,
   );
 
$dir = dirname(__FILE__) . '/';
 
$wgAutoloadClasses['Specialcse'] = $dir . 'Specialcse.php'; # Location of the Specialcse class (Tell MediaWiki to load this file)
$wgAutoloadClasses['cse'] = $dir . 'cse.class.php';
$wgExtensionMessagesFiles['cse'] = $dir . 'cse.i18n.php'; # Location of a messages file (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles['cseAlias'] = $dir . 'cse.alias.php'; # Location of an aliases file (Tell MediaWiki to load this file)
$wgSpecialPages['cse'] = 'Specialcse'; # Tell MediaWiki about the new special page and its class name
$wgHooks['SkinBuildSidebar'][] = 'cse::sidebar';

$resultsCode = 
'Enter your google cse results code in /extensions/cse/cse.php as the value for the variable $resultsCode';