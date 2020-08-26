package main
import (
        "html/template"
        "net/http"
        "fmt"
        "strings"
)

func main() {
        http.ListenAndServe(":80", nil)
}
