function openNav(x) {
    if (document.getElementById(x).style.width == "0px") document.getElementById(x).style.width = "200px";
    else document.getElementById(x).style.width = "0px";
}

{
    "use strict";
    const formSelector = '[data-filter-table-target]',
        columnSelector = '[data-column]',
        rowSelector = ':scope > tbody > tr',
        filteredClassName = 'filtered',
        getTarget = form => document.querySelector(form.dataset.filterTableTarget),
        getRows = table => Array.from(table.querySelectorAll(rowSelector)),
        getFilterValues = form => Array.from(form.querySelectorAll(columnSelector)).map(inp => ({ 'column': inp.dataset.column, 'value': inp.value }));
    checkCellValue = (cell, value) => (new RegExp(value, 'i')).test(cell.textContent), getCell = (row, value) => row.querySelector(`[data-column="${value.column}"`), filterRow = (row, values) => { const filtered = values.reduce((carry, value) => { if (!checkCellValue(getCell(row, value), value.value)) { return true; } return carry }, false); if (filtered) { row.classList.add(filteredClassName) } else { row.classList.remove(filteredClassName) } };
    const filterRows = (rows, values) => { rows.forEach(row => filterRow(row, values)) };
    const onInput = e => {
        const form = e.target.closest(formSelector);
        if (!form) return;
        const target = getTarget(form),
            rows = getRows(target),
            values = getFilterValues(form);
        filterRows(rows, values);
    };
    document.addEventListener('input', onInput);
}

function platfunc() {
    loc = document.getElementById("id_location");
    strid = document.getElementById("id_id").value;
    len = strid.length;
    uncut_num = document.getElementById("id_id").value;
    uncut_num = uncut_num.slice(0, 1);
    list = document.getElementById("id_plat");
    if (uncut_num == "2" || uncut_num == 2) { list.selectedIndex = 2; } else if (uncut_num == "3" || uncut_num == 3) { list.selectedIndex = 3; } else if (uncut_num == "1" || uncut_num == 1) { list.selectedIndex = 1; }
}

function sidenav_height() {
    document.getElementById("filterside").style.top = (document.getElementById("head_box").clientHeight - 1) + "px";
}

function check_limit() {
    let limit = document.getElementById("id_tcount").value;
    let counter = 0;
    if (limit.length > 0) {
        var id_str = "method_";
        var id_dis = "disguise_";
        var method_id;
        for (var i = 1; i < 23; i++) { method_id = id_str + i; if (document.getElementById(method_id).checked === true) { counter++; } if (counter == limit) { for (var j = 1; j < 23; j++) { method_id = id_str + j; if (document.getElementById(method_id).checked === false) { document.getElementById(method_id).disabled = true; } } } else { for (var k = 1; k < 23; k++) { method_id = id_str + k; if (document.getElementById(method_id).checked === false) { document.getElementById(method_id).disabled = false; } } } }
        counter = 0;
        for (var m = 1; m < 4; m++) { method_id = id_dis + m; if (document.getElementById(method_id).checked === true) { counter++; } if (counter == limit) { for (var n = 1; n < 4; n++) { method_id = id_dis + n; if (document.getElementById(method_id).checked === false) { document.getElementById(method_id).disabled = true; } } } else { for (var s = 1; s < 4; s++) { method_id = id_dis + s; if (document.getElementById(method_id).checked === false) { document.getElementById(method_id).disabled = false; } } } }
    }
}

function sortTable(dir, w, r, ff) {
    {
        document.getElementById(w).style.color = "#ffffff";
        document.getElementById(w).style.backgroundColor = "red";
        document.getElementById(r).style.color = "#000000";
        document.getElementById(r).style.backgroundColor = "#ffffff";
        document.getElementById(ff).style.color = "#000000";
        document.getElementById(ff).style.backgroundColor = "#ffffff";
    }
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            if (dir == "asc") {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "des") {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
        // else {
        //     if (switchcount == 0 && dir == "asc") {
        //         dir = "desc";
        //         switching = true;
        //     }
        // }
    }
}

function sortTablee(dir, w, r, ff) {
    {
        document.getElementById(w).style.color = "#ffffff";
        document.getElementById(w).style.backgroundColor = "red";
        document.getElementById(r).style.color = "#000000";
        document.getElementById(r).style.backgroundColor = "#ffffff";
        document.getElementById(ff).style.color = "#000000";
        document.getElementById(ff).style.backgroundColor = "#ffffff";
    }
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (x.innerHTML < y.innerHTML) {
            shouldSwitch = true;
            break;
            }
        
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
    }
}


function show_more(x) {
    var index = x - 1;
    if (document.getElementById(index).innerText.length == 0) {
        alert("Share Link: " + window.location.host + window.location.pathname + "#" + x + "\n\nNot Specified.");
    } else {
        alert("Share Link: " + window.location.host + window.location.pathname + "#" + x + "\n\n" + document.getElementById(index).innerText);
    }
}
$(document).ready(function() {
    $('#method_21').click(function() {
        if ($(this).prop("checked") === true) {
            document.getElementById("id_method_1").hidden = false;
            document.getElementById("id_method_1").disabled = false;
        } else if ($(this).prop("checked") === false) {
            document.getElementById("id_method_1").hidden = true;
            document.getElementById("id_method_1").disabled = true;
        }
    });
    $('#method_22').click(function() {
        if ($(this).prop("checked") === true) {
            document.getElementById("id_method_2").hidden = false;
            document.getElementById("id_method_2").disabled = false;
        } else if ($(this).prop("checked") === false) {
            document.getElementById("id_method_2").hidden = true;
            document.getElementById("id_method_2").disabled = true;
        }
    });
    $('#disguise_3').click(function() {
        if ($(this).prop("checked") === true) {
            document.getElementById("id_disguise").hidden = false;
            document.getElementById("id_disguise").disabled = false;
        } else if ($(this).prop("checked") === false) {
            document.getElementById("id_disguise").hidden = true;
            document.getElementById("id_disguise").disabled = true;
        }
    });
    $('#complication_12').click(function() {
        if ($(this).prop("checked") === true) {
            document.getElementById("id_time").hidden = false;
            document.getElementById("id_time").disabled = false;
        } else if ($(this).prop("checked") === false) {
            document.getElementById("id_time").hidden = true;
            document.getElementById("id_time").disabled = true;
        }
    });
    $('#complication_1').click(function() {
        if ($(this).prop("checked") === true) {
            for (var i = 2; i < 13; i++) {
                var index = "complication_" + i;
                document.getElementById(index).disabled = true;
            }
        } else if ($(this).prop("checked") === false) {
            for (var i = 2; i < 13; i++) {
                var index = "complication_" + i;
                document.getElementById(index).disabled = false;
            }
        }
    });
});
$(document).ready(function() {
    $("#id_tcount").change(function() {
        for (i = 1; i < 23; i++) {
            var y = "method_" + i;
            document.getElementById(y).checked = false;
            document.getElementById(y).disabled = false;
        }
        for (i = 1; i < 4; i++) {
            var y = "disguise_" + i;
            document.getElementById(y).checked = false;
            document.getElementById(y).disabled = false;
        }
        document.getElementById("id_method_1").hidden = true;
        document.getElementById("id_method_1").disabled = true;
        document.getElementById("id_method_2").hidden = true;
        document.getElementById("id_method_2").disabled = true;
        document.getElementById("id_disguise").hidden = true;
        document.getElementById("id_disguise").disabled = true;
    });
});