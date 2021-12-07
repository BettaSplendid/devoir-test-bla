const urli = 'https://api.blog.loryleticee.fr/api/getArticles.php';

// fetch(urli)
//     .then(function(response) {
//         var la_reponse = response.json();
//         console.log(response)
//         console.log(la_reponse)
//             // append_in_body(response)
//         console.log("Ca marche")
//         return la_response;
//     })
//     .catch(function(error) {
//         console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
//         console.log(error)
//             // error_report_bb(error)

//     });

get_the_articles_man()

async function get_the_articles_man() {
    const response = await fetch(urli)
        // .then(function(response) {
        //     console.log("bababa")
        // }).catch(function(error) {
        //     console.log("bababouuu")
        // })





    const movies = await response.json()
    console.log(movies)

    append_in_body(movies)
}


function yell_error() {
    console.error(error)
}

function append_in_body(in_html) {
    $('body').append(in_html);

    var top_block_to_insert
    var container_block
    var bababalise_a
    var ze_article_id
    var zeeee_article_title
    var licocone

    for (let i = 0; i < in_html.length; i++) {

        zeeee_article_title = in_html[i].title
        ze_article_id = in_html[i].id

        top_block_to_insert = document.createElement('div')
        top_block_to_insert.className = `article-title`

        bababalise_a = document.createElement('a')
        bababalise_a.id = `lid_de_la_vie-${ze_article_id}`
            // bababalise_a.href = `/controller/ArticleController.php?action=show&id=${ze_article_id}`
            // bababalise_a.onclick = function() { alert("bababa") }
        container_block = document.getElementById('container-article')


        container_licocones = document.createElement('div')
        container_licocones.className = 'button_container'

        licocone_modify = document.createElement('span')
        licocone_modify.className = `material-icons`
        licocone_modify.innerHTML = 'mode_edit_outline'

        licocone_delete = document.createElement('span')
        licocone_delete.className = `material-icons`
        licocone_delete.innerHTML = 'delete'

        var element = document.getElementById('container-article')
        element.appendChild(top_block_to_insert)

        var le_element = document.getElementsByClassName('article-title')[i]
        le_element.appendChild(bababalise_a)

        le_element.appendChild(container_licocones)
        le_element = document.getElementsByClassName('button_container')[i]
        le_element.appendChild(licocone_modify)
        le_element.appendChild(licocone_delete)

        var le_titretre = document.getElementsByTagName('a')[0]
        bababalise_a.innerHTML = zeeee_article_title

        const lineBreak = document.createElement('br');

        le_element.appendChild(lineBreak);
    }


}