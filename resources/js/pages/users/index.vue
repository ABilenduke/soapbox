<template>
  <UserInfiniteScroll :users="users" @hitTheBottom="getResults()" />
</template>

<script>
import UserInfiniteScroll from "~/components/base/UserInfiniteScroll.vue";
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "UsersIndexPage",
  components: { UserInfiniteScroll },
  data: () => ({
    users: [],
    paginatedUsers: null,
    isLoading: false
  }),
  async created() {
    await this.getResults();
  },
  methods: {
    getResults() {
      if (
        this.paginatedUsers &&
        this.paginatedUsers.current_page === this.paginatedUsers.last_page
      )
        return;

      let page = 1;

      if (
        this.paginatedUsers &&
        this.paginatedUsers.current_page < this.paginatedUsers.last_page
      ) {
        page = this.paginatedUsers.current_page + 1;
      }

      this.isLoading = true;
      axios
        .get("/api/users?page=" + page)
        .then(({ data }) => {
          this.paginatedUsers = data.users;
          data.users.data.map(user => {
            this.users.push(user);
          });
        })
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>

<style lang="scss" scoped>
.profile-picture-container {
  background-color: #f1f2f3;
  border-radius: 5px;
}
</style>
