#!/usr/bin/php
<?php

define('TEST_SHA1', '411408252ac0d24ad99c6bbd130063ca7e8ff2ee');

$missing = [];

$tests = [
	"fib-c" => [
		"bin" => "./fib-c/fib-c",
		"build" => "cd fib-c && gcc -O3 -o fib-c fib-c.c"
	],
	"fib-go" => [
		"bin" => "./fib-go/fib-go",
		"build" => "cd fib-go && go build"
	],
	"fib-go-multicore" => [
		"bin" => "./fib-go-multicore/fib-go-multicore",
		"build" => "cd fib-go-multicore && go build"
	],
	"fib-go-multimemo" => [
		"bin" => "./fib-go-multimemo/fib-go-multimemo",
		"build" => "cd fib-go-multimemo && go build"
	],
	"fib-go-iter" => [
		"bin" => "./fib-go-iter/fib-go-iter",
		"build" => "cd fib-go-iter && go build"
	],
	"fib-asm" => [
		"bin" => "./fib-asm/fib-asm",
		"build" => "cd fib-asm && gcc -o fib-asm fib-asm.s"
	],
	"fib-js" => [
		"bin" => "nodejs fib-js/fib-js.js",
		"requires" => "/usr/bin/nodejs",
		"build" => ""
	],
	/*
	"fib-php" => [
		"bin" => "php fib-php/fib-php.php",
		"requires" => "/usr/bin/php",
		"build" => ""
	],
	"fib-py" => [
		"bin" => "python fib-py/fib-py.py",
		"requires" => "/usr/bin/python",
		"build" => ""
	],
	*/
];

print "\n";
print str_pad("TEST", 20) . str_pad("ELAPSED", 10) . str_pad("HASH", 43) . "RESULT" . "\n";

foreach ($tests as $test => $info) {
	if (isset($info['requires']) && !file_exists($info['requires'])) {
		$missing[$test] = $info;
		continue;
	}
	$cmd = $info['bin'];
	$start = gettimeofday(true);
	$output = `$cmd`;
	$elapsed = (gettimeofday(true) - $start);
	$hash = sha1($output);
	$pass = ($hash == TEST_SHA1 ? "PASS" : "FAIL");

	print str_pad($test, 20) . str_pad(number_format($elapsed, 3), 10) . str_pad($hash, 43) . $pass . "\n";
}

print "\n";

if ($missing) {
	foreach ($missing as $test => $info) {
		print "[*] skipped '$test' because '{$info['required']}' is missing.\n";
	}
	print "\n";	
}
