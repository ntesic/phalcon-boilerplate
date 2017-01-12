/*
 * Copyright (c) 2017.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by Nikola on 1/5/2017.
 */
function deleteMultiple(){
    var keys=$("#" + gridViewKey + "-grid").gridView('getSelectedRows');
    $.post("/" + currentUrl + "/deletemultiple",{pk : keys},
        function (){
            location.reload();
        }
    );
}