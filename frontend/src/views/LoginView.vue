<template>
  <div class="main">
    <form v-on:submit.prevent="handleLogin()">
      <input type="text" name="email" v-model="loginData.email" placeholder="Email" style="margin: 5px" required />
      <br />
      <input
        type="password"
        name="email"
        v-model="loginData.password"
        placeholder="Password"
        style="margin: 5px"
        required
      />
      <br />
      <button type="submit" style="margin: 5px">Login</button>
      <span style="margin-left: 10px"><RouterLink to="/register">Register</RouterLink></span>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "MyLogin",
  components: {},
  data() {
    return {
      loginData: {
        email: "",
        password: "",
      },
      response: "",

      errors: {},
    };
  },

  methods: {
    // Using Async-Await
    // handleLogin: async function () {
    //   let formData = new FormData();
    //   formData.append("email", this.loginData.email);
    //   formData.append("password", this.loginData.password);
    //   try {
    //     const response = await axios.post("http://127.0.0.1:8000/api/login", formData);
    //     localStorage.setItem("token", response.data.data.token);
    //     if (response.status == 200) {
    //       this.$router.push({ name: "home" });
    //     }
    //   } catch (error) {
    //     alert(error.response.data.message);
    //   }
    // },
    // Using Promise
    handleLogin: function () {
      let formData = new FormData();
      formData.append("email", this.loginData.email);
      formData.append("password", this.loginData.password);
      axios
        .post("http://127.0.0.1:8000/api/login", formData)
        .then((response) => {
          localStorage.setItem("token", response.data.data.token);
          if (response.status == 200) {
            this.$router.push({ name: "home" });
          }
        })
        .catch(function (error) {
          alert(error.response.data.message);
        });
    },
  },
};
</script>

<style scoped></style>
