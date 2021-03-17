<template>
  <div class="container">
    <div class="row mx-auto">
      <h2>Dashboard</h2>
    </div>
  </div>
</template>

<script>
const axios = require('axios').default;
export default {
  data() {
    return {

    }
  },
  mounted() {
    this.checkLoggedIn()
  },
  methods: {
    checkLoggedIn: function () {
      let token = window.localStorage.getItem('token')
      if (!token) {
        this.$router.push({name: 'login'})
      }
      axios.get('http://localhost:8000/api/user', {
        headers: {'Authorization' :  'Bearer ' + token}
      })
          .then(function (response) {
            // handle success
            console.log(response);
          })
          .catch(() => {
            this.$router.push({name: 'login'})
          })
          .then(function () {
            // always executed
          });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
