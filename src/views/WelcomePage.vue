<template>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="./assets/favicon-32x32.png"
    />

    <title>INSAT: Social Club</title>
  </head>
  <body>
  <div class="hero-image"></div>
  <div class="main-wrapper">
    <header class="header">
      <img class="logo" src="./assets/logo-dark.gif" alt="logo" />
      <a @click = 'RedirectContactUs' class="header-button">Contact Us ✉️ </a>
    </header>
    <main>
      <section class="intro">
        <div class="intro-text">
          <h1 class="intro-heading">Connect, Share, and Socialize</h1>
          <p class="intro-paragraph">
            INSAT: Social Club is a Social Media platform that allows you to connect with your friends and family, share your thoughts, ideas, and memories with others.
            You can also chat with your friends in real-time and stay connected with them no matter where you are.
          </p>
          <a @click = 'SignUp' class="intro-btn">Sign Up</a>
        </div>
        <div class="intro-image"></div>
      </section>
      <div class="course-cards">
        <div class="intro-card">Check out what you can do here!</div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/icon-animation.svg"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Real-time Chatting</h2>
          <p class="course-card__description">
            Engage in seamless conversations with friends and followers instantly, fostering meaningful interactions at any moment.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/icon-design.svg"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Post, React & Share</h2>
          <p class="course-card__description">
            Share your thoughts, photos, and experiences with the world, while reacting to and sharing the content that resonates with you.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/icon-photography.svg"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Customize Your Profile</h2>
          <p class="course-card__description">
            Tailor your profile to reflect your personality and interests, with customizable features that showcase who you are to your network.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/icon-crypto.svg"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Secure Authentication</h2>
          <p class="course-card__description">
            Safeguard your account with robust authentication measures, ensuring that your personal information and interactions remain private and protected.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/icon-business.svg"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Contact us at any moment</h2>
          <p class="course-card__description">
            Have peace of mind knowing that assistance is just a message away, with dedicated support available around the clock to address any queries or concerns promptly.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
      </div>
      <div class="course-cards">
        <div class="intro-card">Who We Are!</div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/kacem.png"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Kacem Mathlouthi</h2>
          <p class="course-card__description">
            Curious software engineering student with an insatiable appetite for learning. Eager to learn more about the tech landscape and code my way to innovation. </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/aridhi.png"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Youssef Laaridhi</h2>
          <p class="course-card__description">
            Committed to excellence, I thrive on INSAT's challenges, honing my skills to craft efficient solutions in software engineering.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/Haouas.png"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Mohamed Amine Haouas</h2>
          <p class="course-card__description">
            Fueled by innovation, I'm shaping my skills as a software engineer at INSAT to push boundaries and make an impact.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/Tayeb.png"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Mohamed Yassine Tayeb</h2>
          <p class="course-card__description">
            Passionate about coding, I'm mastering software development at INSAT to innovate and solve real-world problems.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
        <div class="course-card">
          <img
              class="course-card__logo"
              src="./assets/youssef.png"
              alt="icon-animation"
          />
          <h2 class="course-card__heading">Youssef Sghairi</h2>
          <p class="course-card__description">
            a dedicated software engineering student at INSAT with a burning passion for game development. I'm constantly on the lookout for exciting opportunities to expand my knowledge and skills in the world of coding and game design.
          </p>
          <a href="#" class="course-card__link"></a>
        </div>
      </div>
    </main>
  </div>
  <footer class="footer">
    <div class="footer-wrapper">
      <img class="logo" src="./assets/logo-light.gif" alt="logo" />
      <p style="margin: 1rem;">©2024 Made with 💕 by INSAT Students </p>
      <a @click = 'RedirectContactUs()' class="footer-button">Contact Us</a>
    </div>
  </footer>
  </body>
  </html>
</template>

<style>
@import url("https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap");

:root {
  --blue-hover: #666ca3;
  --blue: #13183f;
  --text-gray: #83869a;
  --main-orange: #5271ff;
  --main-pink: #ffa7c3;
  --white: #ffffff;
  --primary-gradient: linear-gradient(180deg, #0732ff 0.04%, #f66565 100%);
  --secondary-gradient: linear-gradient(180deg, #2c36f6 0%, #2af0d2 99.92%);
}

* {
  font-family: "Plus Jakarta Sans", sans-serif;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  border: 0;
}

body {
  background: linear-gradient(180deg, #ffffff 0%, #ffffff 100%);
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  margin: 1rem;
}

.header .logo,
.footer .logo {
  height: 50px;
}

.header-button {
  background-color: var(--blue);
  color: var(--white);
  border-radius: 28px;
  width: 140px;
  height: 48px;
  line-height: 48px; /* vertically center the text by making line height be the same as the height */
  font-size: 16px;
  font-weight: 700;
  text-decoration: none;
  text-align: center;
}

.header-button:hover {
  background-color: var(--blue-hover);
  cursor: pointer;
}
.intro{
  color:white;
}
.intro-heading {
  color: var(--blue);
  font-size: 40px;
  line-height: 50px;
  font-weight: 800;
  margin: 1rem;
  margin-top: 2rem;
  margin-bottom: 26px;
}

.intro-paragraph,
.course-card__description {
  color: var(--text-gray);
  font-size: 16px;
  margin: 1rem;
  line-height: 26px;
  font-weight: 500;
}

.intro-btn {
  display: inline-block;
  background: var(--primary-gradient);
  color: white;
  border-radius: 50px;
  width: 167px;
  height: 56px;
  line-height: 56px;
  font-size: 16px;
  font-weight: 700;
  margin: 24px 1rem;
  text-decoration: none;
  text-align: center;
}

.intro-btn:hover {
  background: linear-gradient(
      0deg,
      rgba(255, 255, 255, 0.5),
      rgba(255, 255, 255, 0.5)
  ),
  var(--primary-gradient);
  cursor: pointer;
}

.intro-image {
  background-image: url("assets/logo.gif");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 300px 300px;
  height: 386px;
  width: 100%;
  margin: auto;
}

.intro-card {
  margin: 16px 1rem;
  background: var(--primary-gradient);
  color: var(--white);
  border-radius: 10px;
  padding: 1.5rem;
  font-weight: 800;
  font-size: 24px;
  line-height: 32px;
  height: 120px;
  margin-top: 40px;
}

.course-card {
  padding: 1rem;
  padding-bottom: 0;
  width: 90%;
  margin: 2.5rem auto;
  border-radius: 10px;
  background-color: var(--white);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.course-card__heading {
  color: var(--blue);
  font-weight: 800;
  font-size: 20px;
  margin-top: -25px;
  margin-bottom: 1rem;
  line-height: 28px;
}

.course-card__logo {
  position: relative;
  top: -45px;
  display: block;
  width: 56px;
}

.course-card__description {
  margin: 0;
}

.course-card__link {
  text-decoration: none;
  margin-top: 1.5rem;
  color: var(--main-orange);
  font-weight: 700;
  font-size: 18px;
  margin-bottom: 32px;
  align-self: flex-start;
}

.course-card__link:hover {
  color: var(--main-pink);
}

.footer {
  display: flex;
  align-items: center;
  background-color: var(--blue);
  height: 7rem;
}

.footer-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  color: #ffffff;
  width: 100%;
}

.footer-button {
  background: var(--secondary-gradient);
  color: #ffffff;
  border-radius: 50px;
  width: 8rem;
  height: 3rem;
  line-height: 3rem; /* vertically center the text */
  font-size: 16px;
  font-weight: 700;
  text-decoration: none;
  text-align: center;
}

.footer-button:hover {
  background: linear-gradient(
      0deg,
      rgba(255, 255, 255, 0.5),
      rgba(255, 255, 255, 0.5)
  ),
  linear-gradient(180deg, #5271ff -54.32%, #f02aa6 100%);
  cursor: pointer;
}

@media (min-width: 576px) {
  .hero-image {
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 70vh;
    background-image: url(assets/logo.gif);
    background-size: 30%;
    background-repeat: no-repeat;
    background-position: bottom left;
  }

  .header-button {
    z-index: 1;
  }

  .main-wrapper {
    width: 90%;
    margin: auto;
    margin-bottom: 86px;
  }

  .intro-card {
    margin: 40px 0 0 0;
    padding: 56px 32px;
  }
  .intro-heading {
    font-size: 36px;
  }
  .intro-text {
    height: 50vh;
    width: 48%;
    margin-top: 5rem;
    margin-bottom: 5rem;
  }

  .intro-image {
    display: none;
  }

  .intro-paragraph,
  .course-card__description {
    font-size: 16px;
    font-weight: 500;
  }

  .course-cards {
    width: 90%;
    height: 930px;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: repeat(3, 30%);
    gap: 50px 15px;
  }

  .intro-card,
  .course-card {
    width: 100%;
    height: 100%;
    margin-top: 30px;
  }
}

@media  (min-width: 768px) {
  .hero-image {
    background-image: url(assets/logo.gif);
    background-size: auto 70%;
  }

  .intro-heading {
    font-size: 56px;
    line-height: 70px;
  }

  .course-cards {
    width: 95%;
    height: 700px;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: repeat(2, 44%);
    gap: 56px 30px;
    margin-bottom: 140px;
  }
  .intro-text {
    margin-top: 10rem;
    margin-bottom: 10rem;
  }

  .intro-card {
    font-size: 1.8rem;
  }

  .intro-card,
  .course-card {
    width: 100%;
  }

  .footer-wrapper, .main-wrapper {
    width: 80%;
    max-width: 1140px;
    margin: auto;
  }
}
</style>

<script>

export default {
  methods: {
    SignIn() {
      this.$router.push('/login');
    },
    SignUp() {
      this.$router.push('/login');
    },
    RedirectContactUs() {
      this.$router.push('/Contact');
    }
  }
}

</script>