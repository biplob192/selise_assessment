<template>
  <div>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/books">Books</RouterLink>
      <RouterLink to="/register">Register</RouterLink>
      <RouterLink to="/login">Login</RouterLink>
      <button @click="logout()">Logout</button>
    </nav>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "PrimaryMenu",
  data() {
    return {
      //  token: localStorage.getItem("token"),
    };
  },

  methods: {
    logout() {
      let token = localStorage.getItem("token");
      axios.defaults.headers.common["Authorization"] = "Bearer " + token;
      axios
        .post("http://127.0.0.1:8000/api/logout")
        .then((response) => {
          localStorage.removeItem("token");
          this.$router.push({ name: "home" });
          alert(response.data.message);
          location.reload();
        })
        .catch((errors) => {
          console.log(errors);
          alert(errors.response.data.message);
        });
    },
  },
};
</script>

<style scoped></style>
