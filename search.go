package main
import (
        //"html/template"
        //"net/http"
        "fmt"
        //"strings"
        "database/sql"
        _ "github.com/lib/pq"
        //"log"
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
        zip int
        haspublic bool
        storeid int
}

func checkerror(err error) {
        if err != nil {
                panic(err)
        }
}

func main() {
        //http.ListenAndServe(":80", nil)
        conn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable", host, port, user, password, dbname)
        db, err := sql.Open("postgres", conn)
        checkerror(err)
        defer db.Close()

        var result Store
        query := "SELECT name, storenum FROM store WHERE haspublic = TRUE"
        err = db.QueryRow(query).Scan(&result.name, &result.storenum)

        if err == nil {
                fmt.Println("Store:", result.name, result.storenum)
        }
}
