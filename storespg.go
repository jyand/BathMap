/* abstraction layer to communicate with the PostgreSQL database and process its data
*  routines for the 'store' table
*/
package main
import (
        "fmt"
        "log"
        "database/sql"
//        "strconv"
        "strings"
        _"github.com/lib/pq"
)

const (
        host = "localhost"
        port = 5432
        user = "postgres"
        password = "lfant"
        dbname = "bathmap"
)

type Store struct {
        name string
        storenum string
        address string
        zip string
        haspublic string
}

func checkerror(err error) {
        if err != nil {
                panic(err)
        }
}

func search_zipcode(zip string) ([]string, string) {
        conn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable", host, port, user, password, dbname)
        db, err := sql.Open("postgres", conn)
        checkerror(err)
        defer db.Close()

        names := make([]string, 0)
        query := "SELECT name FROM store WHERE zip = " + zip
        rows, err := db.Query(query)
        if err != nil {
                log.Fatal(err)
        }
        defer rows.Close()
        for rows.Next() {
                result := new(Store)
                err := rows.Scan(&result.name)
                checkerror(err)
                names = append(names, result.name)
        }
        checkerror(rows.Err())

        return names, query
}

func search_storename(name string) ([]string, []string, string) {
        conn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable", host, port, user, password, dbname)
        db, err := sql.Open("postgres", conn)
        checkerror(err)
        defer db.Close()

        names := make([]string, 0)
        nums := make([]string, 0)
        query := "SELECT name, storenum FROM store WHERE name = '" + name + "'"
        rows, err := db.Query(query)
        if err != nil {
                log.Fatal(err)
        }
        defer rows.Close()
        for rows.Next() {
                result := new(Store)
                err := rows.Scan(&result.name, &result.storenum)
                checkerror(err)
                names = append(names, result.name)
                nums = append(names, result.storenum)
        }
        checkerror(rows.Err())

        return names, nums, query
}

func new_entry(name string, storenum string, address string, zip string, haspublic string) (int64, error) {
        conn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable", host, port, user, password, dbname)
        db, err := sql.Open("postgres", conn)
        checkerror(err)
        defer db.Close()

        str := []string{name, storenum, address, zip, haspublic}
        query := "INSERT INTO store VALUES (" + strings.Join(str, ", ") + ")"
        result, err := db.Exec(query)
        return result.RowsAffected()
}
