#!/usr/bin/php
<?php

function fib($n) {
	if ($n == 0) return 0;
	if ($n == 1) return 1;
	return fib($n-1)+fib($n-2);
}

for ($x = 0; $x <= 40; $x++) {
	print "fib($x)=" . fib($x) . "\n";
}