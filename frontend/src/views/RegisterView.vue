<script>
import axios from "axios";

export default {
  name: "UserRegister",
  components: {},
  data() {
    return {
      loginData: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },

      errors: {},
    };
  },

  methods: {
    handleRegister: async function () {
      let formData = new FormData();
      formData.append("first_name", this.loginData.first_name);
      formData.append("last_name", this.loginData.last_name);
      formData.append("email", this.loginData.email);
      formData.append("password", this.loginData.password);
      formData.append("password_confirmation", this.loginData.password_confirmation);

      await axios
        .post("http://127.0.0.1:8000/api/register", formData)
        .then((response) => {
          localStorage.setItem("token", response.data.data.token);
          if (response.status == 201) {
            this.$router.push({ name: "login" });
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<template>
  <div class="main">
    <form v-on:submit.prevent="handleRegister">
      <input
        type="text"
        name="first_name"
        v-model="loginData.first_name"
        placeholder="First Name"
        style="margin: 5px"
        required
      />
      <br />
      <input
        type="text"
        name="last_name"
        v-model="loginData.last_name"
        placeholder="Last Name"
        style="margin: 5px"
        required
      />
      <br />
      <input type="text" name="email" v-model="loginData.email" placeholder="Email" style="margin: 5px" required />
      <br />
      <input
        type="password"
        name="password"
        v-model="loginData.password"
        placeholder="Password"
        style="margin: 5px"
        required
      />
      <br />
      <input
        type="password"
        name="password_confirmation"
        v-model="loginData.password_confirmation"
        placeholder="Confirm Password"
        style="margin: 5px"
        required
      />
      <br />
      <button type="submit" style="margin: 5px">Register</button>
      <span style="margin-left: 10px"><RouterLink to="/login">Login</RouterLink></span>
    </form>
  </div>
</template>

<style scoped></style>
