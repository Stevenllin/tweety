<?php

function current_user(){
    return auth()->user();
}
// 此為global的function
// 需在composer.json檔案建制       
// "files": [
//     "app/helpers.php"
// ]
// 在執行composer dump-autoload