

<script>
function myFunction() {
    console.log("This is my function.");
}
function automaticCall(func) {
    return function(...args) {
        const result = func(...args);
        console.log(`Function '${func.name}' was automatically called.`);
        return result;
    };
}

// Create a named function that automatically calls myFunction
const myFunctionAutomatic = automaticCall(myFunction);

// Now, calling myFunctionAutomatic will automatically print a message.
myFunctionAutomatic();
</script>

