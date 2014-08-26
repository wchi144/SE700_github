//var table = $('table')[0];
function table_cnt(){
    var table = document.getElementById('results_table');
    var rowGroups = {};

    //loop through the rows excluding the first row (the header row)
    while(table.rows.length > 1){
        var row = table.rows[1];
        var id = $(row.cells[0]).text()+$(row.cells[1]).text();
        if(!rowGroups[id]) rowGroups[id] = [];
        if(rowGroups[id].length > 0){
            row.className = 'subrow';
            $(row).slideUp();

        }
        rowGroups[id].push(row);
        table.deleteRow(1);
    }
    //loop through the row groups to build the new table content
    for(var id in rowGroups){
        var group = rowGroups[id];

        for(var j = 0; j < group.length; j++){
            var row = group[j];

            if(group.length > 1 && j == 0) {   
                //add + button
                var lastCell = row.cells[row.cells.length - 1];
                lastCell.innerHTML = group.length; 
                //$("<span class='collapsed'>").appendTo(lastCell).click(plusClick); 
            }

            table.tBodies[0].appendChild(row);       

        }
    }
    sortTable();
}

function sortTable(){
    var tbl = document.getElementById("results_table").tBodies[0];
    var store = [];
    for(var i=0, len=tbl.rows.length; i<len; i++){
        var row = tbl.rows[i];
        var sortnr = parseFloat(row.cells[3].textContent || row.cells[3].innerText);
        if(!isNaN(sortnr)) store.push([sortnr, row]);
    }
    store.sort(function(x,y){
        return y[0] - x[0];
    });
    for(var i=0, len=store.length; i<len; i++){
        tbl.appendChild(store[i][1]);
    }
    store = null;
}

//function handling button click
function plusClick(e){
    var collapsed = $(this).hasClass('collapsed');
    var fontSize = collapsed ? 14 : 0;
    $(this).closest('tr').nextUntil(':not(.subrow)').slideToggle(400)
           .css('font-size', fontSize);
    $(this).toggleClass('collapsed');        
}
