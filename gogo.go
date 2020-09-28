package main
import(
        "fmt"
)

func main() {
        names, q := search_zipcode("07470")
        for i, v := range names {
                fmt.Printf("Store: %s %d\n", v, i)
        }
        fmt.Println(q)
}
