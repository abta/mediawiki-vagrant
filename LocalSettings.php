<?php
/**
 * MediaWiki configuration
 *
 * To customize your MediaWiki instance, you may change the content of this
 * file. See settings/README for an alternate way of managing small snippets of
 * configuration data, such as extension invocations.
 *
 * This file is part of Mediawiki-Vagrant.
 */

// Enable error reporting
error_reporting( -1 );
ini_set( 'display_errors', 1 );

$wgArticlePath = "/wiki/$1";

// Show the debug toolbar if 'debug' is set on the request, either as a
// parameter or a cookie.
if ( !empty( $_REQUEST['debug'] ) ) {
	$wgDebugToolbar = true;
}

// Expose debug info for PHP errors.
$wgShowExceptionDetails = true;
$wgDebugLogFile = __DIR__ . '/vagrant/logs/mediawiki-debug.log';

// Expose debug info for SQL errors.
$wgDebugDumpSql = true;
$wgShowDBErrorBacktrace = true;
$wgShowSQLErrors = true;

// Profiling
$wgDebugProfiling = false;

// Images
$wgLogo = '/mediawiki-vagrant.png';
$wgUseInstantCommons = true;
$wgEnableUploads = true;

$wgGroupPermissions['*']['createpage'] = false;

// Caching
$wgMainCacheType = CACHE_MEMCACHED;
$wgMemCachedServers = array( '127.0.0.1:11211' );

$wgEnableJavaScriptTest = true;

$wgProfilerParams = array(
	'forceprofile' => 'ProfilerSimpleText',
	'forcetrace' => 'ProfilerSimpleTrace'
);

foreach( $wgProfilerParams as $param => $cls ) {
	if ( array_key_exists( $param, $_REQUEST ) ) {
		$wgProfiler['class'] = $cls;
	}
}

// Load configuration snippets from ./settings. See settings/README.
foreach( glob( __DIR__ . '/settings/*.php' ) as $snippet ) {
	if ( !include_once( $snippet ) ) {
		echo "Failed to load \"$snippet\".\n";
	}
}
