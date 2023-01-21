<template>
  <div class="main">
    <div>
      <h3>
        Books will show after logged in. You can
        <span style="margin-left: 10px"><RouterLink to="/register">Register</RouterLink></span> or
        <span style="margin-left: 10px"><RouterLink to="/login">Login</RouterLink></span> here.
      </h3>
    </div>

    <table>
      <tr>
        <th>Name</th>
        <th>Author</th>
        <th>Price</th>
      </tr>
      <tr v-for="book in books" :key="book.id">
        <td>{{ book.name }}</td>
        <td>{{ book.author }}</td>
        <td>{{ book.price }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      token: localStorage.getItem("token"),
      books: [],
    };
  },

  mounted() {
    this.getBooks();
  },

  methods: {
    getBooks() {
      axios.defaults.headers.common["Authorization"] = "Bearer " + this.token;
      axios
        .get("http://127.0.0.1:8000/api/books")
        .then((response) => {
          this.books = response.data.data;
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
};
</script>
<style scoped>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
