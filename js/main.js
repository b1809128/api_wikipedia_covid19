const date = new Date();
var arr_date = [];
var x = date.getDate();

var s = 0;
// console.log(x.substr(0,2));
// arr_date.push(x);
for (let i = 0; i < 7; i++) {
    s = x - i;
    arr_date.push(s);
}

var new_db = arr_date.sort();

for (let i = 0; i < new_db.length; i++) {

}