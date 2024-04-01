<template>

    <navBar/>
    <header>
        <h1> Contact Us! </h1>
    </header>
    <section class="formcarry-container">
        <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
          <div class="formcarry-block">
              <label for="fc-generated-1-name">Full Name</label>
              <input v-model="name" type="text" name="name" id="fc-generated-1-name" placeholder="Your first and last name" />
          </div>
          <div class="formcarry-block">
              <label for="fc-generated-1-email">Your Email Address</label>
              <input v-model="email" type="email" name="email" id="fc-generated-1-email" placeholder="name@example.com" />
          </div>
          <div class="formcarry-block">
              <label for="fc-generated-1-message">Your message</label>
              <textarea v-model="message" name="message" id="fc-generated-1-message" placeholder="Enter your message..."></textarea>
          </div>
          <div class="formcarry-block">  
            <button type="submit">Send</button>
          </div>
        </form>
    </section>
</template>

<style>

/* Modernizing the design */
body {
  font-family: 'Roboto', sans-serif; /* Using a modern font */
  background-color: #f8f9fa; /* Light background color */
}

header {
  text-align: center;
  margin-top: 2rem;
}

h1 {
  font-size: 2.5rem; /* Larger heading size */
  font-weight: 700; /* Bolder font weight */
  margin-bottom: 1.5rem; /* Increased margin */
  color: #333; /* Darker heading color */
}

/* Improving spacing and alignment */
.formcarry-container {
  margin: 40px auto;
  max-width: 500px; /* Increased container width */
  padding: 20px;
  background-color: #fff; /* White background */
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
}

.formcarry-container * {
  margin: 10px 0; /* Improved vertical spacing */
}

/* Enhancing input fields */
.formcarry-container input,
.formcarry-container textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  transition: border-color 0.3s ease;
}

.formcarry-container input:focus,
.formcarry-container textarea:focus {
  outline: none;
  border-color: #007bff; /* Highlighting border color on focus */
}

.formcarry-container label {
  display: block;
  font-weight: 600; /* Bolder font weight for labels */
}

/* Styling the button */
.formcarry-container button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 5px;
  background-color: #007bff; /* Button color */
  color: #fff;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.formcarry-container button:hover {
  background-color: #0056b3; /* Darker button color on hover */
}

</style>


<script>
import navBar from '../components/navbar.vue';
import axios from 'axios';
export default {
  name: "ContactForm",
  data: () => ({
    name: '',
    email: '',
    message: ''
  }),

  methods: {
    handleSubmit() {
      let data =new FormData();
      data.append('name', this.name);
      data.append('email', this.email);
      data.append('message', this.message);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/contactUsApi.php?action=contactUs', data)
          .then(response => {
            console.log(response.data);
            if (response.data.success) {
              console.log(response.data.message);
              this.name = '';
              this.email = '';
              this.message = '';
            }

          })
          .catch(error => {
            console.log(error);
          })

    },
  },
  components: {
    navBar
  }

};
</script>