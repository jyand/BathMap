package main
import (
        "fmt"
        "log"
        "database/sql"
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
        storenum int
        address string
        zip string
        haspublic bool
        storeid int
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

func search_storename(name string) (string, int, string) {
        conn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable", host, port, user, password, dbname)
        db, err := sql.Open("postgres", conn)
        checkerror(err)
        defer db.Close()

        var result Store
        query := "SELECT name, storenum FROM store WHERE name = '" + name + "'"
        err = db.QueryRow(query).Scan(&result.name, &result.storenum)

        return result.name, result.storenum, query
}

func new_entry(name string, storenum int, address string, zip string, haspublic bool) { 
}
