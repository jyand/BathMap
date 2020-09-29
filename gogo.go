// for testing debugging, nice to pipe the output to dmenu
package main
import(
        "fmt"
        //"strings"
)

func main() {
/*        names, nums, q := search_storename("QuikChek")
        for i, v := range names {
                fmt.Printf("Store: %s %s %d\n", v, nums[i], i)
        }
*/
        rows, err := new_entry("'Stop and Shop'", "888", "'1220 Hamburg Tpk'", "07470", "TRUE")
        if err != nil{
                fmt.Println(rows)
        }

        //fmt.Println("INSERT INTO store VALUES (" + strings.Join(str, ", ") + ")")
}
