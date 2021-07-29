const date = new Date();
var arr_date = [];
var x = date.getDate();
var y = (date.getMonth() + 1)

var s = 0;
for (let i = 0; i < 7; i++) {
    s = x - i;
    arr_date.push(s);
}

var new_db = arr_date.sort();