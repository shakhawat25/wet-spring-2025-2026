

let a = 10;
let b = 20;

console.log("Before swap: a =", a, "b =", b);

[a, b] = [b, a];

console.log("After swap (Arithmetic): a =", a, "b =", b);










function square(n) {
    return n * n;
}

for (let i = 1; i <= 10; i++) {
    console.log("Square of", i, "=", square(i));
}
















const numArray = [12, 45, 7, 89, 34, 22];

let largest = numArray[0];

for (let i = 1; i < numArray.length; i++) {
    if (numArray[i] > largest) {
        largest = numArray[i];
    }
}

console.log("Largest number is:", largest);













let maxValue = numbersArray[0];

for (const num of numbersArray) {
    if (num > maxValue) {
        maxValue = num;
    }
}

console.log("Largest (for...of) =", maxValue);