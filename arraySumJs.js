var arr = [];                              
let sum = 0;

for (var i = 0; i < 10; i++) {             
  arr.push(prompt('Enter int ' + (i+1)));
    // push the value into the array
}

for (var j=0; j < arr.length; j++) {
    sum+=parseInt(arr[j]);
  }

alert(sum);
