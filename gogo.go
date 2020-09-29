// for testing debugging, nice to pipe the output to dmenu
package main
import(
        "fmt"
)

func main() {
        names, nums, q := search_storename("QuikChek")
        for i, v := range names {
                fmt.Printf("Store: %s %s %d\n", v, nums[i], i)
        }
        fmt.Println(q)
}
