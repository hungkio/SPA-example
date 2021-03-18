<template>
  <div class="container">
    <div class="row">
      <form class="mx-auto mt-3" @submit.prevent="login">
        <h2>Login</h2>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input v-model="user.email" type="email" name="email" class="form-control"
                 :class="{'is-invalid' : errors.email}"
                 id="exampleInputEmail1" aria-describedby="emailHelp">
          <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input v-model="user.password" type="password" name="password" class="form-control"
                 :class="{'is-invalid' : errors.password}"
                 id="exampleInputPassword1">
          <div v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</div>
        </div>
        <button type="submit" class="btn btn-primary">
          <span v-if="loading" class="spinner-border"></span> Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import base_request from "@/components/base_request";
export default {
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      errors: {},
      loading: false,
    }
  },
  methods: {
    login: function () {
      this.loading = true
      base_request.post('login', this.user)
          .then(response => {
            window.localStorage.setItem('token', response.data.token)
            this.$router.push({name: 'dashboard'})
          })
          .catch(error => {
            this.loading = false
            if (error.response.data.errors) {
              this.errors = error.response.data.errors
            } else {
              //
            }
          });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
