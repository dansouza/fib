// go build && ./fib

package main

import (
	"fmt"
)

func fib(n int) int {
	if n == 0 {
		return 0
	}
	if n == 1 {
		return 1
	}
	return fib(n-1) + fib(n-2)
}

func main() {
	for x := 0; x <= 40; x++ {
		fmt.Printf("fib(%d)=%d\n", x, fib(x))
	}
}
