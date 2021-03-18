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
import base_request from "@/components/base_request";
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
      base_request.get('user')
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
      base_request.post('post', this.post)
          .then((res) => {
            console.log(res)
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
