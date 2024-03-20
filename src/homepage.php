<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buzz - Home</title>
        <link rel="stylesheet" href="styles/homepage.css">
    </head>
    <body>
        <nav class="menu-container">
            <input type="checkbox" aria-label="Toggle menu" />
            <span></span>
            <span></span>
            <span></span>

            <a href="#" class="menu-logo">
                <img src="https://wweb.dev/resources/navigation-generator/logo-placeholder.png" alt="Buzz"/>
            </a>

            
            <div class="menu">
                <ul>
                    <li>
                        <div class="custom_input">
                            <input class="search" type="text" placeholder="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg_icon bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg>
                        </div>
                    </li>
                    <li>
                        <a href="#home" target="_blank" rel="noopener noreferrer">
                        Home
                        </a>
                    </li>
                    <li>
                        <a href="#messages" target="_blank" rel="noopener noreferrer">
                        Messages
                        </a>
                    </li>
                    <li>
                        <a href="#myaccount" target="_blank" rel="noopener noreferrer">
                        My Account
                        </a>
                    </li>
                    <li>
                        <a href="#contact" target="_blank" rel="noopener noreferrer">
                        Contact Us
                        </a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href=" #login" target="_blank" rel="noopener noreferrer">
                        Sign Out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" id=App v-cloak>
            <div class="post" v-for="post in Posts">
                <h2>{{post.title}}</h2>
                <img :src=post.img :alt=post.alt>
                <p>{{post.content}}</p>
                <div class="post-footer">
                    <button class=react-button>React</button>
                    <button class=comment-button>Comment</button>
                    <button class=share-button>Share</button>
                </div>
                <div class = comments>
                    <div class="comment" v-for="comment in post.comments">
                        <p>{{comment.content}}</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/vue@3"></script>
        <script>
            let App = Vue.createApp({
                data: function() {
                    return {
                        Posts: [
                            {
                                title: 'Post 1',
                                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                                img: 'https://via.placeholder.com/800x400',
                                alt: 'Post Image',
                                comments: [
                                    {content: 'Comment 1'},
                                    {content: 'Comment 2'},
                                    {content: 'Comment 3'}
                                ]
                            },
                            {
                                title: 'Post 2',
                                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                                img: 'https://via.placeholder.com/800x400',
                                alt: 'Post Image'
                            },
                            {
                                title: 'Post 3',
                                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                                img: 'https://via.placeholder.com/800x400',
                                alt: 'Post Image'
                            }
                        ]
                    }
                }
            })

            App.mount('#App');
        </script>
    </body> 
    
</html> 