function validform(){
        var z = document.forms["search"]["zip"].value ;
        if (z > 99999 || z < 0) {
                alert("Invalid zip code!") ;
                return false ;
        }
}
