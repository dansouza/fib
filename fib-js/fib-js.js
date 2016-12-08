#!/usr/bin/env node

function fib(n) {
    if (n == 0) return 0;
    if (n == 1) return 1;
    return fib(n-1)+fib(n-2);
}

for (var x = 0; x <= 40; x++) {
	console.log("fib(" + x + ")=" + fib(x))
}

