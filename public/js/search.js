const searchBox =
document.getElementById(
"searchBox"
);

const categoryFilter =
document.getElementById(
"categoryFilter"
);

const authorFilter =
document.getElementById(
"authorFilter"
);


function loadBooks()
{

if(
searchBox.value==="" &&
categoryFilter.value==="" &&
authorFilter.value===""
)
{
return;
}


fetch(

"api/books.php?search="
+
searchBox.value
+
"&category="
+
categoryFilter.value
+
"&author="
+
authorFilter.value

)

.then(
response=>response.json()
)

.then(data=>{

let html="";


data.forEach(book=>{

html += `

<div class="card">

<h3>

${book.title}

</h3>


<p>

${book.author}

</p>


<h4>

৳${book.price}

</h4>


<p>

${book.description}

</p>


<div
style="
margin-top:15px;
display:flex;
flex-direction:column;
gap:10px;
">

<a
href="views/book.php?id=${book.id}"
style="
text-decoration:none;
"
>

<button
style="
width:100%;
padding:12px;
cursor:pointer;
">

View Details

</button>

</a>


<button

onclick="addCart(${book.id})"

style="
width:100%;
padding:12px;
background:#28a745;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
"

>

Add To Cart

</button>

</div>

</div>

`;

});


document
.getElementById(
"book-list"
)
.innerHTML =
html;

})

.catch(error=>{

console.log(error);

});

}


searchBox.addEventListener(
"keyup",
loadBooks
);

categoryFilter.addEventListener(
"change",
loadBooks
);

authorFilter.addEventListener(
"keyup",
loadBooks
);