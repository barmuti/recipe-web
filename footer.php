
 <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


html, body {
    height: 100%; 
    display: flex;
    flex-direction: column; 
}

body > * {
    flex-shrink: 0; /* Mencegah elemen mengecil */
}

main {
    flex: 1; 
}


footer {
    margin-top: auto; 
    background-color: #343a40; 
    color: #fff; 
    text-align: center;
    padding: 10px 0; 
    border-top: 1px solid #ccc; 
    font-size: 14px;
}</style>

<footer class="bg-dark text-white py-3">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 TIES RECIPEAPP</p>
    </div>
</footer>
