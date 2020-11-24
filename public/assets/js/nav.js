/*  JS Navigation */
const burger = document.getElementById('burger');
const menuBurger = document.getElementById('menu-burger')
burger.addEventListener('click', event => {
    menuBurger.classList.toggle('sidebar-nav')
    burger.classList.toggle('burger-menu-white')
    document.getElementById('menu-burger').classList.toggle('display-block-nav');
})

/* End JS Navigation */

/* JS Favorites */
const stars = document.getElementsByClassName('fa-star');
for (let i = 0 ; i <stars.length; i++) {
    stars[i].addEventListener('click', (event)=>    {
        if (event.target.classList.contains('fas')) {
            event.target.classList.remove('fas');
            event.target.classList.add('far');
        }  else {
            event.target.classList.add('fas');
        }

        fetch('/favorite/add', {
            method: 'POST',
            headers: {
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                'cheatsheet': event.target.dataset.postid,
                'userid' :event.target.dataset.userid
            })
        })
            .then(response => response.json())

    })
}

/* END JS Favorites */

/* JS like, dislike and popularity */

const like = document.getElementsByClassName('fa-thumbs-up');
const dislike = document.getElementsByClassName('fa-thumbs-down');
const popularity = document.getElementsByClassName('popularity');

/* Ben : Function to create */
for (let i = 0 ; i <like.length; i++) {
    like[i].addEventListener('click', (event) => {
        let number = parseInt(popularity[i].innerHTML, 10);
        if (event.target.classList.contains('fas')) {
            event.target.classList.replace('fas', 'far');
            number--;
            popularity[i].innerHTML = number.toString();
        } else {
            event.target.classList.add('fas');
            number++;
            popularity[i].innerHTML === "" ? popularity[i].innerHTML = 1 : popularity[i].innerHTML = number.toString();
        }

        if (dislike[i].classList.contains('fas')) {
            dislike[i].classList.remove('fas');
            dislike[i].classList.add('far');
            number++;
            popularity[i].innerHTML = number.toString();
        }

        fetch('/like/addLike', {
            method: 'POST',
            headers: {
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                'cheatsheet': event.target.dataset.postid,
                'userid' :event.target.dataset.userid
            })
        })
        .then(response => response.json())
        .then(data => console.log(data))
    })
    console.log(like.length);
}



for ( let i = 0; i < dislike.length; i++ ) {
    dislike[i].addEventListener('click', (event) => {
        let number = parseInt(popularity[i].innerHTML, 10);
        if (event.target.classList.contains('fas')) {
            event.target.classList.replace('fas', 'far');
            number++;
            popularity[i].innerHTML = number.toString();
        } else {
            event.target.classList.add('fas');
            number--;
            popularity[i].innerHTML === "" ? popularity[i].innerHTML = -1 : popularity[i].innerHTML = number.toString();
        }
        if (like[i].classList.contains('fas')) {
            like[i].classList.remove('fas');
            like[i].classList.add('far');
            number--;
            popularity[i].innerHTML = number.toString();
        }

        fetch('/like/addDislike', {

            method: 'POST',
            headers: {
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                'cheatsheet': event.target.dataset.postid,
                'userid' :event.target.dataset.userid
            })
        })
        .then(response => response.json())
        .then(data => console.log(data))
    })
}


/* END JS like, dislike and popularity */

