<template>
  <div class="container">
    <div class="row mx-auto">
      <form class="mx-auto mt-3 col-8" @submit.prevent="createPost">
        <h2>Tạo bài viết</h2>
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input v-model="post.title" type="text" name="title" class="form-control"
                 :class="{'is-invalid' : errors.title}"
                 id="exampleInputEmail1" aria-describedby="emailHelp">
          <div v-if="errors.email" class="invalid-feedback">{{ errors.title[0] }}</div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword2">Content</label>
          <textarea v-model="post.content" type="text" name="content" class="form-control"
                 :class="{'is-invalid' : errors.content}" rows="10"
                    id="exampleInputPassword2"></textarea>
          <div v-if="errors.content" class="invalid-feedback">{{ errors.content[0] }}</div>
        </div>
        <button type="submit" class="btn btn-primary">
          <span v-if="loading" class="spinner-border"></span> Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
const axios = require('axios').default;
export default {
  data() {
    return {
      post: {
        title: '',
        content: ''
      },
      loading: false,
      errors: {}
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
      axios.get('http://localhost:8000/api/user',
          {
            headers: {'Authorization': 'Bearer ' + token}
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
    },
    createPost: function () {
      this.loading = true
      let token = window.localStorage.getItem('token')
      if (!token) {
        this.$router.push({name: 'login'})
      }
      axios.post(
          'http://localhost:8000/api/post',
          this.post,
          {
            headers: {'Authorization': 'Bearer ' + token}
          })
          .then(() => {
            alert('Tạo bài viết thành công!')
            this.post = {
              'title': '',
              'content': ''
            }
            this.loading = false
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
