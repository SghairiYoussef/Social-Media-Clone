<template>
    <navBar/>
    <header>
        <h1> Contact Us! </h1>
    </header>
    <section class="formcarry-container">
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <div class="formcarry-block">
                <label for="fc-generated-1-name">Full Name</label>
                <input type="text" name="name" id="fc-generated-1-name" placeholder="Your first and last name" />
            </div>
            
            <div class="formcarry-block">
                <label for="fc-generated-1-email">Your Email Address</label>
                <input type="email" name="email" id="fc-generated-1-email" placeholder="name@example.com" />
            </div>
            
            <div class="formcarry-block">
                <label for="fc-generated-1-message">Your message</label>
                <textarea name="message" id="fc-generated-1-message" placeholder="Enter your message..."></textarea>
            </div>
            
            <div class="formcarry-block">  
            <button type="submit">Send</button>
            </div>
        
        </form>
    </section>

</template>

<style>
  
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap');

    header {
      text-align: center;
      margin-top: 2rem;
    }

    h1 {
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 1rem;
    }

    .formcarry-container {
      box-sizing: border-box;
      margin: 40px auto 0 auto;
      padding: 0;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      font-weight: 400;
      line-height: 24px;
      letter-spacing: -0.01em;

      width: 400px;
      --fc-normal-filed-bg-color: #F7F9FC;
      --fc-border-color: #ECEFF9;
      --fc-normal-text-color: #0E0B3D;
      --fc-normal-placeholder-color: #B3B8D0;
      --fc-primary-color-hue: 201;
      --fc-error-color-hue: 356;
      --fc-primary-hsl: var(--fc-primary-color-hue), 100%, 54%;
      --fc-error-hsl: var(--fc-error-color-hue), 100%, 54%;

      --fc-field-hover-bg-color: #FFFFFF;
      --fc-border-hover-color: #DDE0EE;
      --fc-field-hover-text-color: #B3B8D0;

      --fc-border-active-color: #1463FF;
    }

    .formcarry-container * {
      box-sizing: border-box;
    }

    .formcarry-container label {
      display: block;
      cursor: pointer;
    }

    .formcarry-container .formcarry-block:not(:first-child) {
      margin-top: 16px;
    }

    .formcarry-container input,
    .formcarry-container textarea,
    .formcarry-container select {
      margin-top: 4px;
      width: 100%;
      height: 42px;
      border: 1px solid var(--fc-border-color);
      box-shadow: 0 1px 2px var(--fc-border-color);
      color: var(--fc-normal-text-color);
      background-color: var(--fc-normal-filed-bg-color);
      border-radius: 10px;
      padding: 8px 12px;
      
      font-family: "Inter", sans-serif;
      font-size:14px;
      transition: 125ms background, 125ms color, 125ms box-shadow;
    }

    .formcarry-container textarea{
      min-height: 188px;
      max-width: 100%;
      padding-top: 12px;
    }

    .formcarry-container input::placeholder,
    .formcarry-container textarea::placeholder,
    .formcarry-container select::placeholder {
      color: var(--fc-normal-placeholder-color);
    }

    .formcarry-container input:hover,
    .formcarry-container textarea:hover,
    .formcarry-container select:hover {
      border-color: var(--fc-border-hover-color);
      background-color: var(--fc-field-hover-bg-color);
    }

    .formcarry-container input:hover::placeholder,
    .formcarry-container textarea:hover::placeholder,
    .formcarry-container select:hover::placeholder {
      color: var(--fc-field-hover-text-color);
    }

    .formcarry-container input:focus,
    .formcarry-container textarea:focus,
    .formcarry-container select:focus {
      background-color: #fff;
      border: 2px solid hsl(var(--fc-primary-hsl));
      box-shadow: 0px 1px 6px hsla(var(--fc-primary-hsl), 17%), 0px 2px 0px hsla(var(--fc-primary-hsl), 14%);
      outline: none;
    }

    .formcarry-container input:focus,
    .formcarry-container select:focus {
      padding: 8px 11px;
    }

    .formcarry-container textarea:focus {
      padding: 11px;
    }

    .formcarry-container select {
      background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11.9997 14.5001L8.46387 10.9642L9.64303 9.78589L11.9997 12.1434L14.3564 9.78589L15.5355 10.9642L11.9997 14.5001Z' fill='%236C6F93'/%3E%3C/svg%3E%0A");
      background-size: 24px 24px;
      background-position: 98%;
      background-repeat: no-repeat;
      appearance: none;
      -webkit-appearance: none;
    }

    .formcarry-container button {
      font-family: "Inter", sans-serif;
      font-weight: 500;
      font-size: 14px;
      letter-spacing: -0.02em;
      height: 40px;
      line-height: 24px;
      width: 100%;
      border: 0;
      border-radius: 10px;
      box-sizing: border-box;
      background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 100%), hsla(var(--fc-primary-hsl));
      color: #fff;
      cursor: pointer;
      box-shadow: 0px 2px 4px -2px hsla(var(--fc-primary-hsl), 64%), inset 0px -2px 4px rgba(255, 255, 255, 0.16);
      margin-bottom: 20px;
      transition: 125ms all;
    }
    
    .formcarry-container button:hover {
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), hsla(var(--fc-primary-hsl));
    }
    
    .formcarry-container button:focus {
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), hsla(var(--fc-primary-hsl));
      border-inline: 1px solid inline rgba(255, 255, 255, 0.6);
      box-shadow: 0px 0px 0px 3px rgba(var(--fc-primary-hsl), 12%);
    }

    .formcarry-container button:active {
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), hsla(var(--fc-primary-hsl));
    }

    .formcarry-container button:disabled {
      background-color: hsla(var(--fc-primary-hsl), 40%);
      cursor: not-allowed;
    }

    .formcarry-container input:focus:required:invalid,
    .formcarry-container input:focus:invalid, 
    .formcarry-container select:focus:required:invalid,
    .formcarry-container select:focus:invalid
    {
      color: hsl(var(--fc-error-hsl)); 
      border-color: hsl(var(--fc-error-hsl));
      box-shadow: 0px 1px 6px hsla(var(--fc-error-hsl), 17%), 0px 2px 0px hsla(var(--fc-error-hsl), 14%);
    }

</style>
  
  <script>
  import navBar from '../components/navbar.vue';
  export default {
    name: "ContactForm",
    data: () => ({
      submitted: false,
    }),
  
    methods: {
      handleSubmit() {
        setTimeout(() => {
          this.submitted = true;
        }, 100);
      },
    },
    components: {
      navBar
    }

  };
  </script>