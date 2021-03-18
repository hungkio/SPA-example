<template>
  <div class="container">
    <div class="" v-for="post in posts" :key="post.id">
      <h2>{{ post.title }}</h2>
      <div class="">{{ post.content }}</div>
    </div>
    <div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item" v-if="current_page > 1"><a @click.prevent="current_page--" class="page-link" href="#">Previous</a></li>
          <li class="page-item"  v-for="page in totalPage" :key="page" :class="{'active': current_page == page}">
            <a class="page-link" href="#" @click.prevent="current_page = page"> {{ page }} </a>
          </li>
          <li class="page-item" v-if="current_page < totalPage"><a @click.prevent="current_page++" class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import base_request from "@/components/base_request";

export default {
  data() {
    return {
      posts: [],
      current_page: 1,
      totalPage: 0
    }
  },
  mounted() {
    this.getPosts()
  },
  watch: {
    current_page: function () {
      this.getPosts()
    }
  },
  methods: {
    getPosts: function () {
      base_request.get('post?page=' + this.current_page)
          .then((response) => {
            // handle success
            console.log(response.data)
            this.posts = response.data.data
            this.current_page = response.data.current_page
            this.totalPage = response.data.last_page
          })
    }
  }
}
</script>
